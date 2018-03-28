<?php

class AdvertisementController extends Controller {

//    public function init() {
//        $this->redirectToLogin();
//    }

    public function actionTest() {

        EmailGenerator::SendEmail("Test", "srlcarrow@gmail.com", "Hi");
    }

    public function actionViewAdvertisements() {
        $this->renderPartial('/site/ajaxLoad/viewAdvertisements');
    }

    public function actionViewAdvertisementsData() {
//        try {             
        set_time_limit(900);

        $sql = Yii::app()->db->createCommand()
                ->select('ad.ad_id,ad.ad_reference,ad.ad_reference,ad.ad_expected_experience,ad.ad_salary,ad.ad_is_negotiable,ad.ad_title,ad.ad_is_use_desig_as_title,ad.ad_expire_date,desig.desig_name,emp.employer_name,awt.wt_name,acity.city_name,ad.ad_published_time,ad.ad_expire_date')
                ->from('emp_advertisement ad')
                ->getText();

        $page = explode('-', Yii::app()->request->getPost('page'))[0];
        $adId = array_key_exists(1, explode('-', Yii::app()->request->getPost('page'))) ? explode('-', Yii::app()->request->getPost('page'))[1] : 1;

        $limit = 30;
        $data = Controller::createSearchCriteriaForAdvertisement($sql, '', $page, $limit, 'ad.ad_published_time');

        $result = $data['result'];
        $pageCount = $data['count'];
        $currentPage = $page;
         
        $this->renderPartial('/site/ajaxLoad/viewAdvertisements', array('data' => $result, 'pageCount' => $pageCount, 'currentPage' => $currentPage, 'adId' => $adId, 'limit' => $limit));
        

//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
    }

    public function actionViewAdvertisement($id) {
        $adId = explode('-', $id)[1];
        $currentPage = explode('-', $id)[0];
        $adData = EmpAdvertisement::model()->findByPk($adId);

        $this->render('/Advertisement/viewAdvertisements', array('adData' => $adData, 'adId' => $adId, 'currentPage' => $currentPage));
    }

    //Popup
    public function actionApplyJob() {
        $userId = Yii::app()->user->getId();
        $userType = 0;
        if (isset($userId)) {
            $userType = Controller::getUserType($userId);
        }
        $this->renderPartial('/Advertisement/ajaxLoad/popup/jobApply', array('user' => $userId, 'userType' => $userType, 'adId' => $_POST['adId']));
    }

    public function actionApplyVacancy() {
        $status = 1;
        $reason = "";
        $userId = Yii::app()->user->getId();

        if (isset($userId)) {
            $jsId = Controller::getRefEmpOrJsId($userId);
            $jsData = JsBasic::model()->findByPk($jsId);

            if ($_POST['group1'] == 1) {
                if ($jsData->js_cv_path == "" || $jsData->js_cv_path == NULL) {
                    $status = 0;
                    $reason = "There is no existing CV.";
                } else {
                    if (!file_exists($jsData->js_cv_path)) {
                        $status = 0;
                        $reason = "There is no existing CV.";
                    }
                }
            } elseif ($_POST['group1'] == 2) {
                if ($_FILES['JsBasic']['name']['cv'] == "") {
                    $status = 0;
                    $reason = "Please Select a CV to send";
                } else {
                    $target_dir = "uploads/CV/Registered/";
                    $target_file = $target_dir . basename($_FILES['JsBasic']['name']['cv']);
                    $validateData = Controller::validateCV($_FILES, $target_dir);
                    $status = $validateData["status"];
                    $reason = $validateData["reason"];
                }
            }
        } else {
            if ($_FILES['JsBasic']['name']['cv'] == "") {
                $status = 0;
                $reason = "Please Select a CV to send";
            } else {
                $target_dir = "uploads/CV/Unregistered/";
                $target_file = $target_dir . basename($_FILES['JsBasic']['name']['cv']);
                $validateData = Controller::validateCV($_FILES, $target_dir);
                $status = $validateData["status"];
                $reason = $validateData["reason"];
            }
        }

        if ($status == 1) {
            if (isset($userId)) {
                if ($_POST['group1'] == 1) {
                    $jsId = Controller::getRefEmpOrJsId($userId);
                    $jsData = JsBasic::model()->findByPk($jsId);

                    $appliedData = new JsAppliedDetails();
                    $appliedData->ref_advertisement_id = $_POST['adId'];
                    $appliedData->is_registered_user = 1;
                    $appliedData->ref_js_id = Controller::getRefEmpOrJsId($userId);
                    $appliedData->jsad_name = $jsData->js_fname . " " . $jsData->js_lname;
                    $appliedData->jsad_email = $jsData->js_email;
                    $appliedData->jsad_cv_path = 1;
                    $appliedData->jsad_applied_time = date('Y-m-d H:i:s');
                    $appliedData->jsad_applied_user = $userId;
                    if ($appliedData->save(false)) {
                        //Send the mail to employer by attaching the CV
                        $adData = EmpAdvertisement::model()->findByPk($_POST['adId']);
                        $employerData = EmpEmployers::model()->findByPk($adData->ref_employer_id);
                        $path = $jsData->js_cv_path;

                        $msg = "";
                        $subjct = $adData->ad_title . " [ " . $adData->ad_reference . "] [ CV of " . $jsData->js_fname . " " . $jsData->js_lname . " ]";
                        $to = $employerData->employer_email;
                        EmailGenerator::SendEmail($msg, $to, $subjct, $path);
                    }
                } elseif ($_POST['group1'] == 2) {
                    $target_dir = "uploads/CV/Registered/";

                    $jsId = Controller::getRefEmpOrJsId($userId);
                    $jsData = JsBasic::model()->findByPk($jsId);

                    $appliedData = new JsAppliedDetails();
                    $appliedData->ref_advertisement_id = $_POST['adId'];
                    $appliedData->is_registered_user = 1;
                    $appliedData->ref_js_id = Controller::getRefEmpOrJsId($userId);
                    $appliedData->jsad_name = $jsData->js_fname . " " . $jsData->js_lname;
                    $appliedData->jsad_email = $jsData->js_email;
                    $appliedData->jsad_cv_path = "";
                    $appliedData->jsad_applied_time = date('Y-m-d H:i:s');
                    $appliedData->jsad_applied_user = $userId;
                    if ($appliedData->save(false)) {
                        //Send the mail to employer by attaching the CV
                        $adData = EmpAdvertisement::model()->findByPk($_POST['adId']);
                        $employerData = EmpEmployers::model()->findByPk($adData->ref_employer_id);

                        $cvName = $jsData->js_reference_no;
                        $path = $this->UploadCV($_FILES, $target_dir, $cvName);

                        $msg = "";
                        $subjct = $adData->ad_title . " [ " . $adData->ad_reference . "] [ CV of " . $jsData->js_fname . " " . $jsData->js_lname . " ]";
                        $to = $employerData->employer_email;
                        EmailGenerator::SendEmail($msg, $to, $subjct, $path);
                    }
                }
            } else {
                $target_dir = "uploads/CV/Unregistered/";

                $appliedData = new JsAppliedDetails();
                $appliedData->ref_advertisement_id = $_POST['adId'];
                $appliedData->is_registered_user = 0;
                $appliedData->ref_js_id = 0;
                $appliedData->jsad_name = $_POST['fname'];
                $appliedData->jsad_email = $_POST['email'];
                $appliedData->jsad_cv_path = "";
                $appliedData->jsad_applied_time = date('Y-m-d H:i:s');
                $appliedData->jsad_applied_user = 0;

                if ($appliedData->save(false)) {
                    $cvName = md5('cv' . $appliedData->jsad_id);
                    $path = $this->UploadCV($_FILES, $target_dir, $cvName);
                    $appliedData->jsad_cv_path = $path;
                    $appliedData->save(false);

                    //Send the mail to employer by attaching the CV

                    $adData = EmpAdvertisement::model()->findByPk($_POST['adId']);
                    $employerData = EmpEmployers::model()->findByPk($adData->ref_employer_id);

                    $msg = "";
                    $subjct = $adData->ad_title . " [ " . $adData->ad_reference . "] [ CV of " . $_POST['fname'] . " ]";
                    $to = $employerData->employer_email;
                    EmailGenerator::SendEmail($msg, $to, $subjct, $path);
                }
            }
            $this->msgHandler(200, "Successfully Applied");
        } else {
            $this->msgHandler(400, $reason);
        }
    }

}
?>

