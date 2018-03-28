<?php

class EmployerController extends Controller {

    public function actionViewEmployer() {
        $this->render('/Employer/ViewEmployer');
    }

    public function actionViewEmployerData() {
        $sql = Yii::app()->db->createCommand()
                ->select('*')
                ->from('emp_employers emp')
                ->getText();

        $limit = 15;
        $data = Controller::createSearchCriteriaForEmployer($sql, '', Yii::app()->request->getPost('page'), $limit);

        $employers = $data['result'];
        $pageCount = $data['count'];
        $currentPage = Yii::app()->request->getPost('page');


        $this->renderPartial('/Employer/ajaxLoad/ViewEmployerData', array('employers' => $employers, 'pageCount' => $pageCount, 'currentPage' => $currentPage, 'limit' => $limit));
    }

    public function actionLoadEmployerData() {
        $employerData = EmpEmployers::model()->findByPk($_POST['id']);
        $this->renderPartial('/Employer/ajaxLoad/viewLoadEmployerData', array('employerData' => $employerData, 'id' => $_POST['id']));
    }

    public function actionViewAddAdvertisement() {
        $empId = $_POST['id'];
        $model = new EmpAdvertisement();
        $adId = 0;
        $this->renderPartial('/Employer/ajaxLoad/viewAddAdvertisement', array('model' => $model, 'adId' => $adId, 'empId' => $empId));
    }

    public function actionLoadPaymentPopup() {
        $this->renderPartial('/Employer/ajaxLoad/paymentPopup');
    }

    public function actionLogoUploadPopup() {
        $this->renderPartial('/Employer/ajaxLoad/logoUpload');
    }

    public function actionEmployerAdd() {
        $this->renderPartial('/Employer/ajaxLoad/addEmployer');
    }

    public function actionSaveEmployer() {
//        try {
        $model = new EmpEmployers();
        $model->ref_ind_id = $_POST['ref_ind_id'];
        $model->ref_jsbt_id = 0;
        $model->ref_district_id = $_POST['district_id'];
        $model->ref_city_id = $_POST['city'];
        $model->employer_name = $_POST['comName'];
        $model->employer_address = $_POST['comAddress'];
        $model->employer_tel = $_POST['comTel'];
        $model->employer_mobi = $_POST['comMobi'];
        $model->employer_email = strtolower(str_replace(' ', '', $_POST['comEmail']));
        $model->employer_contact_person = $_POST['comConPerson'];
        $model->employer_created_time = date('Y-m-d H:i:s');
        if ($model->save(false)) {
            $model->employer_reference_no = Controller::getEmployeeReferenceNo($model->employer_id);
//                $path = $this->UploadImage($_FILES, $target_dir, $model->ad_reference);
//                $model->ad_image_url = $path;
            $model->employer_image = '';
            $model->save(false);

            $password = $model->employer_reference_no;
            $user = new User();
            $user->ref_emp_or_js_id = $model->employer_id;
            $user->user_name = strtolower(str_replace(' ', '', $_POST['comEmail']));
            $user->user_password = md5(md5('SRLC' . $password . $password));
            $user->user_access_token = '';
            $user->user_type = 2;
            $user->user_is_verified = 1;
            $user->user_is_finished = 1;
            $user->user_created_date = date('Y-m-d H:i:s');
            $user->save(false);

            $this->msgHandler(200, "Successfully Saved...");
        }
//        } catch (Exception $exc) {
//            $this->msgHandler(400, $exc->getTraceAsString());
//        }
    }

    public function actionUploadLogo() {
        try {
            define('UPLOAD_DIR', 'uploads/company/logo/');
            $img = $_POST['imageData'];
            $img = str_replace('data:image/jpeg;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = "employerCompany_" . uniqid() . '.png';
            $widthArray = array('212');
            $success = Controller::saveImageInMultipleSizes($widthArray, $fileName, UPLOAD_DIR, $data);
            if ($success) {
                $this->msgHandler(200, "Data Transfer", array('fileName' => $fileName));
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actionSaveAdvertisement() {
        try {
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
                $model = new EmpAdvertisement();
                if ($_POST['adId'] > 0) {
                    $model = EmpAdvertisement::model()->findByPk($_POST['adId']);
                }
                if (isset($_POST['designations'])) {
                    $designationData = AdmDesignation::model()->findByPk($_POST['designations']);
                }
                $employerData = EmpEmployers::model()->findByPk($_POST['empId']);

                $model->ad_reference = 0;
                $model->ref_employer_id = $_POST['empId'];
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
                $model->ad_title = isset($_POST['isDesigAsTitle']) && $_POST['isDesigAsTitle'] == "on" ? $designationData->desig_name : $_POST['title'];
                $model->ad_is_use_desig_as_title = isset($_POST['isDesigAsTitle']) && $_POST['isDesigAsTitle'] == "on" ? 1 : 0;
                $model->ad_expire_date = date('Y-m-d', strtotime($_POST['expireDate']));
                $model->ad_is_image = $_POST['group1'] == 1 ? 1 : 0;
                $model->ad_image_url = "";
                $model->ad_created_time = date('Y-m-d H:i:s');
                $model->ad_text = $_POST['advertisementText'];
                $model->ad_is_intern = isset($_POST['intern']) && $_POST['intern'] == "on" ? 1 : 0;
                $model->ad_is_published = 1;
                $model->ad_published_time = "0000-00-00 00:00:00";
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
                        $model->ad_is_image = 0;
                        $model->ad_image_url = "";
                    } elseif ($_POST['group1'] == 1 && $_FILES['EmpAdvertisement']['name']['AdverImage'] == "" && $model->ad_is_image == 1) {
                        $model->ad_image_url = $model->ad_image_url;
                    }
                    
                    $model->ad_token = md5('adId-' . $model->ad_id);
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

}
?>

