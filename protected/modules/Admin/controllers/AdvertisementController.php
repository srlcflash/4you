<?php

class AdvertisementController extends Controller {

    public function actionIndex() {
        $this->render('viewAdvertisement');
    }

    public function actionViewAddAdvertisement() {
        $model = new EmpAdvertisement();
        $adId = 0;
        $this->renderPartial('ajaxLoad/viewAddAdvertisement', array('model' => $model, 'adId' => $adId));
    }

    public function actionViewAdvertisementData() {
        $sql = Yii::app()->db->createCommand()
                ->select('ad.ad_id,ad.ref_designation_id,ad.ad_reference,ad.ad_reference,ad.ad_expected_experience,ad.ad_salary,ad.ad_is_negotiable,ad.ad_title,ad.ad_is_use_desig_as_title,ad.ad_expire_date,desig.desig_name,emp.employer_name,awt.wt_name,acity.city_name')
                ->from('emp_advertisement ad')
                ->getText();

        $limit = 15;
        $data = Controller::createSearchCriteriaForAdvertisement($sql, '', Yii::app()->request->getPost('page'), $limit,'ad.ad_published_time');

        $result = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('ajaxLoad/viewAdvertisementData', array('data' => $result, 'pageCount' => $pageCount, 'currentPage' => $currentPage, 'limit' => $limit));
    }

    public function actionEditAdvertisement() {     
        $model = EmpAdvertisement::model()->findByPk($_POST['id']);
        $adId = $model->ad_id;
        $this->renderPartial('ajaxLoad/viewAddAdvertisement', array('model' => $model, 'adId' => $adId));
    }

    public function actionSaveAdvertisement() {
        try {
            if ($_POST['adId'] > 0) {
                $model = EmpAdvertisement::model()->findByPk($_POST['adId']);
                $refEmpId = EmpAdvertisement::model()->findByPk($_POST['adId'])->ref_employer_id;
            }

            $status = 1;
            $reason = "";
            if ($_POST['group1'] == 1) {
                if ($_FILES['EmpAdvertisement']['name']['AdverImage'] == "" && $model->ad_is_image == 1) {
                    $status = 1;
                    $reason = "";
                } elseif ($_FILES['EmpAdvertisement']['name']['AdverImage'] == "" && $model->ad_is_image == 0) {
                    $status = 0;
                    $reason = "Please Select an Advertisement";
                } else {
                    $target_dir = "uploads/JobAdvertisements/";
                    $target_file = $target_dir . basename($_FILES["EmpAdvertisement"]["name"]['AdverImage']);
                    $validateData = Controller::validateImage($_FILES, $target_dir);
                    $status = $validateData["status"];
                    $reason = $validateData["reason"];
                }
            }

            if ($status == 1) {
                $employerData = EmpEmployers::model()->findByPk($refEmpId);

                $model->ref_district_id = $_POST['district_id'];
                $model->ref_city_id = $_POST['city'];
//                $model->ref_industry_id = $_POST['ref_industry_id'];
                $model->ref_industry_id = $employerData->ref_ind_id;
                $model->ref_cat_id = $_POST['ref_cat_id'];
                $model->ref_subcat_id = $_POST['subCategories'];
                $model->ref_designation_id = 0;
                $model->ad_expected_experience = $_POST['experience'];
                $model->ad_salary = $_POST['salary'];
                $model->ad_is_negotiable = isset($_POST['isNegotiable']) && $_POST['isNegotiable'] == "on" ? 1 : 0;
                $model->ref_work_type_id = $_POST['ref_work_type_id'];
                $model->ad_title = $_POST['title'];
//                $model->ad_is_use_desig_as_title = isset($_POST['isDesigAsTitle']) && $_POST['isDesigAsTitle'] == "on" ? 1 : 0;
                $model->ad_expire_date = date('Y-m-d', strtotime($_POST['expireDate']));
                $model->ad_is_image = $_POST['group1'] == 1 ? 1 : 0;
                $model->ad_is_intern = isset($_POST['intern']) && $_POST['intern'] == "on" ? 1 : 0;
//                $model->ad_image_url = "";
                $model->ad_text = $_POST['advertisementText'];
                if ($model->save(false)) {
                    $model->ad_reference = Controller::getAdvertisementReferenceNo($model->ad_id);

                    if ($_POST['group1'] == 1 && $_FILES['EmpAdvertisement']['name']['AdverImage'] != "") {
                        $path = $this->UploadImage($_FILES, $target_dir, $model->ad_reference);
                        $model->ad_image_url = $path;
                    } elseif ($_POST['group1'] == 2) {
                        if ($model->ad_image_url != "") {
                            chmod($model->ad_image_url, 0777);
                            unlink($model->ad_image_url);
                        }
                        $model->ad_is_image = 2;
                        $model->ad_image_url = "";
                    } elseif ($_POST['group1'] == 1 && $_FILES['EmpAdvertisement']['name']['AdverImage'] == "" && $model->ad_is_image == 1) {
                        $model->ad_image_url = $model->ad_image_url;
                    }
                    $model->ad_token = $model->ad_token;
                    $model->save(false);

                    $this->msgHandler(200, "Successfully Saved...");
                }
            } else {
                $this->msgHandler(400, $reason);
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionViewPendingAdvertisementsToPublish() {
        $this->render('viewPendingAdsToPub');
    }

    public function actionViewPendingAdvertisementsToPublishData() {
        $sql = Yii::app()->db->createCommand()
                ->select('ad.ad_id,ad.ref_designation_id,ad.ad_reference,ad.ad_reference,ad.ad_expected_experience,ad.ad_salary,ad.ad_is_negotiable,ad.ad_title,ad.ad_is_use_desig_as_title,ad.ad_expire_date,desig.desig_name,emp.employer_name,awt.wt_name,acity.city_name')
                ->from('emp_advertisement ad')
                ->where('ad_is_published=1')
                ->getText();

        $limit = 15;
        $data = Controller::createSearchCriteriaForAdvertisement($sql, '', Yii::app()->request->getPost('page'), $limit);

        $result = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');

        $this->renderPartial('ajaxLoad/viewPendingAdsToPubData', array('data' => $result, 'pageCount' => $pageCount, 'currentPage' => $currentPage, 'limit' => $limit));
    }

    public function actionViewPreviewAdToPub($id) {
        $adData = EmpAdvertisement::model()->findByAttributes(array('ad_id' => $id));
        $this->render('/advertisement/viewPreviewAdvertisement', array('adData' => $adData, 'id' => $id));
    }

    public function actionPublishAdvertisement() {
        $id = $_POST['id'];

        $adData = EmpAdvertisement::model()->findByAttributes(array('ad_id' => $id));
        $adData->ad_token = "";
        $adData->ad_is_published = 2;
        $adData->ad_published_time = date('Y-m-d H:i:s');
        $adData->save(false);
        $this->msgHandler(200, "Successfully Saved...");
    }

}
?>

