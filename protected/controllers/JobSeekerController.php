<?php

class JobSeekerController extends Controller {

    public function actionViewRegistration($id) {
        try {
            $key = $id;
            $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $key));
            if (count($jsBasicTempData) > 0) {
                if ($jsBasicTempData->jsbt_is_verified == 1 && $jsBasicTempData->jsbt_is_finished == 0) {
                    $this->render('/Error/index', array('error' => "Already Verified Your Account"));
                } elseif ($jsBasicTempData->jsbt_is_verified == 1 && $jsBasicTempData->jsbt_is_finished == 1) {
                    $this->render('/Error/index', array('error' => "Expired URL"));
                } else {
                    $this->render('/site/verify', array('accessId' => $id, 'userName' => $jsBasicTempData->jsbt_email));
                }
            } else {
                $this->render('/Error/index', array('error' => "Invalid URL"));
            }
        } catch (Exception $exc) {
            $this->render('/Error/index', array('error' => "Invalid Verification"));
        }
    }

    public function actionViewJobSeekerRegistration($id) {
        if ($id == "") {
            $this->render('/Error/index', array('error' => "Invalid URL"));
        } else {
            $this->render('/JobSeeker/jobSeekerRegistration', array('accessId' => $id));
        }
    }

    public function actionFormStepOne() {
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $_POST['accessId']));
        $jsTempId = $jsBasicTempData->jsbt_id;
        $userId = $jsTempId;

        $jsBasicId = 0;
        $status = 0;
        if ($jsTempId > 0) {
            $jsBasicTempData = JsBasicTemp::model()->findByPk($jsTempId);

            if ($jsBasicTempData->jsbt_type == 1) {
                if ($jsBasicTempData->save(false)) {
                    $jsData = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsTempId));

                    if (count($jsData) > 0) {
                        $jsBasic = $jsData;
                        $jsId = $jsData->js_id;
                    } else {
                        $jsBasic = new JsBasic();
                        $jsBasic->ref_jsbt_id = $jsBasicTempData->jsbt_id;
                        $jsBasic->js_fname = $jsBasicTempData->jsbt_fname;
                        $jsBasic->js_lname = $jsBasicTempData->jsbt_lname;
                        $jsBasic->js_email = $jsBasicTempData->jsbt_email;
                        $jsBasic->js_contact_no1 = $jsBasicTempData->jsbt_contact_no;
                        $jsBasic->js_contact_no2 = '';
                        $jsBasic->js_address = '';
                        $jsBasic->js_gender = 0;
                        $jsBasic->js_experience_years = 0;
                        $jsBasic->js_experience_months = 0;
                        $jsBasic->js_highest_academic_quali = '';
                        $jsBasic->js_nameof_academic_quali = '';
                        $jsBasic->js_created_time = date('Y-m-d H:i:s');
                        $jsBasic->js_updated_time = date('Y-m-d H:i:s');
                        $jsBasic->js_cv_path = '';
                        if ($jsBasic->save(false)) {
                            $jsBasic->js_reference_no = Controller::getJobSeekerReferenceNo($jsBasic->js_id);
                            $jsBasic->save(false);

                            $user = User::model()->findByAttributes(array('ref_emp_or_js_id' => $jsBasicTempData->jsbt_id, 'user_type' => 1));
                            $user->ref_emp_or_js_id = $jsBasic->js_id;
                            $user->user_is_verified = 1;
                            $user->save(false);
                            $status = 1; // Verified But Not Finished 
                        }
                    }
                }
            }
        }

        $jsBasicData = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsTempId));

        $jsProfQualifications = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasicData->js_id, 'jsquali_type' => 1));
        $jsMemberships = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasicData->js_id, 'jsquali_type' => 2));

        $this->renderPartial('/JobSeeker/ajaxLoad/form_step1', array('jsBasicData' => $jsBasicData, 'jsProfQualifications' => $jsProfQualifications, 'jsMemberships' => $jsMemberships, 'accessId' => $_POST['accessId']));
    }

    public function actionSaveStepOne() {
//        try {
            $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $_POST['accessId']));

            $jsbtId = $jsBasicTempData->jsbt_id;

            $model = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsbtId));

            $model->js_address = $_POST['address'];
            $model->js_contact_no2 = $_POST['contactNo'];
            $model->js_gender = 1;
            $model->js_dob = date('Y-m-d', strtotime($_POST['dob']));
            $model->js_experience_years = $_POST['experienceYear'];
            $model->js_experience_months = $_POST['experienceMonth'];
            $model->js_highest_academic_quali = $_POST['ahaq_id'];
            $model->js_nameof_academic_quali = $_POST['nameOfAcaQuali'];
            $model->js_updated_time = date('Y-m-d H:i:s');
            $model->js_step1_is_finished = 1;
            if ($model->save(false)) {
                $profQualiIds = $_POST['profQualiHiddenName'];
                $profQualiNames = $_POST['profQualiName'];

                for ($i = 0; $i < count($profQualiIds); $i++) {
                    if ($profQualiNames[$i] != "") {
                        if ($profQualiIds[$i] == 0) {
                            $JsQualifications = new JsQualifications();
                        } else {
                            $JsQualifications = JsQualifications::model()->findByPk($profQualiIds[$i]);
                        }
                        $JsQualifications->ref_js_id = $model->js_id;
                        $JsQualifications->jsquali_type = 1;
                        $JsQualifications->jsquali_qualification = $profQualiNames[$i];
                        $JsQualifications->save(false);
                    }
                }

                $membershipIds = $_POST['membershipHiddenName'];
                $membershipNames = $_POST['membershipName'];
                for ($i = 0; $i < count($membershipIds); $i++) {
                    if ($membershipNames[$i] != "") {
                        if ($membershipIds[$i] == 0) {
                            $JsQualifications = new JsQualifications();
                        } else {
                            $JsQualifications = JsQualifications::model()->findByPk($membershipIds[$i]);
                        }
                        $JsQualifications->ref_js_id = $model->js_id;
                        $JsQualifications->jsquali_type = 2;
                        $JsQualifications->jsquali_qualification = $membershipNames[$i];
                        $JsQualifications->save(false);
                    }
                }

                $this->msgHandler(200, "Successfully Saved...", array('accessId' => $_POST['accessId']));
            }
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
    }

    public function actionIsFistrStepFinished() {
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $_POST['accessId']));
        $jsbtId = $jsBasicTempData->jsbt_id;
        $jsData = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsbtId));
        $this->msgHandler(200, "Data Transfer", array('status' => $jsData->js_step1_is_finished));
    }

    public function actionIsSecondStepFinished() {
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $_POST['accessId']));
        $jsbtId = $jsBasicTempData->jsbt_id;
        $jsData = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsbtId));
        $this->msgHandler(200, "Data Transfer", array('status' => $jsData->js_step2_is_finished));
    }

    public function actionDeleteQualification() {
        try {
            $id = $_POST['id'];
            if (JsQualifications::model()->deleteByPk($id)) {
                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function actionFormStepTwo() {
        $accessId = $_POST['accessId'];
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $accessId));
        $jsBasic = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsBasicTempData->jsbt_id));


        $jsId = $jsBasic->js_id;
        $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsId));
        $categories = AdmCategory::model()->findAll();
        if (count($jsEmploymentData) == 0) {
            $jsEmploymentData = new JsEmploymentData();
        }

        $this->renderPartial('/JobSeeker/ajaxLoad/form_step2', array('categories' => $categories, 'accessId' => $accessId, 'jsEmploymentData' => $jsEmploymentData));
    }

    public function actionGetSubCategories() {
        $subCatData = $this->GetSubCategoriesByCatId($_POST['id']);
        $this->msgHandler(200, "Data Transfer", array('subCategoryData' => $subCatData));
    }

    public function actionGetDesignationsByCat() {
        $designationData = $this->GetDesignationsByCatId($_POST['id']);
        $this->msgHandler(200, "Data Transfer", array('designationData' => $designationData));
    }

    public function actionSearchSkills() {
        $skillsData = $this->searchSkills($_POST['searchSkill']);
        $this->msgHandler(200, "Data Transfer", array('skillsData' => $skillsData));
    }

    public function actionFormStepThree() {
        $accessId = $_POST['accessId'];
        $workTypes = AdmWorkType::model()->findAll();
        $this->renderPartial('/JobSeeker/ajaxLoad/form_step3', array('workTypes' => $workTypes, 'accessId' => $accessId));
    }

    public function actionSaveStepTwo() {
        try {
            $accessId = $_POST['accessId'];
            $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $accessId));
            $jsBasic = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsBasicTempData->jsbt_id));
            $jsId = $jsBasic->js_id;

            $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsId));
            if (count($jsEmploymentData) > 0) {
                $model = $jsEmploymentData;
            } else {
                $model = new JsEmploymentData();
            }

            $model->ref_js_id = $jsId;
            $model->ref_industry_id = $_POST['ind_id'];
            $model->ref_category_id = isset($_POST['cat_id']) == true && !isset($_POST['isFresher']) ? $_POST['cat_id'] : 0;
            $model->ref_sub_category_id = isset($_POST['subCategories']) == true && !isset($_POST['isFresher']) ? $_POST['subCategories'] : 0;
            $model->ref_designation_id = isset($_POST['designations']) == true && !isset($_POST['isFresher']) ? $_POST['designations'] : 0;
            $model->jsemp_expected_ref_industry_id = isset($_POST['ind_id']) == true ? $_POST['ind_id'] : 0;
            $model->jsemp_expected_ref_category_id = isset($_POST['cat_id']) == true && !isset($_POST['isFresher']) ? $_POST['cat_id'] : 0;
            $model->jsemp_expected_sub_category_id = isset($_POST['subCategories']) == true && !isset($_POST['isFresher']) ? $_POST['subCategories'] : 0;
            $model->jsemp_expected_designation_id = isset($_POST['designations']) == true && !isset($_POST['isFresher']) ? $_POST['designations'] : 0;
            $model->jsemp_expected_salary = 0;
            $model->jsemp_no_of_experience_years = 0;
            $model->jsemp_no_of_experience_months = 0;
            $model->jsemp_is_fresher = isset($_POST['isFresher']) && $_POST['isFresher'] == "on" ? 1 : 0;
            if ($model->save(false)) {
                $jsBasic->js_step2_is_finished = 1;
                $jsBasic->save(false);
                $this->msgHandler(200, "Successfully Saved...", array('accessId' => $accessId));
            }
        } catch (Exception $ex) {
            $this->msgHandler(400, $ex->getTraceAsString());
        }
    }

    public function actionIsFormsFillingFinished() {
        $status = 0;
        $accessId = $_POST['accessId'];
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $accessId));
        $jsBasic = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsBasicTempData->jsbt_id));

        if ($jsBasic->js_step1_is_finished == 1 && $jsBasic->js_step2_is_finished == 1) {
            $status = 1;
        }

        $this->msgHandler(200, "Successfully Saved...", array('status' => $status));
    }

    public function actionSaveStepThree() {
//        try {
            $target_dir = "uploads/CV/Registered/";
            if ($_FILES["JsBasic"]["name"]["cv"] != "") {
                $status = Controller::validateCV($_FILES, $target_dir);
                if ($status['status'] == 0) {
                    $this->msgHandler(400, $status['reason'], array('status' => $status));
                    exit;
                }
            }
            $skills = explode(',', $_POST['skills']);
            $skillsString = '';
            $skillsArray = array();
            foreach ($skills as $skill) {
                if (is_numeric($skill)) {
                    array_push($skillsArray, $skill);
                } else {
                    $modelSkills = new AdmSkills();
                    $modelSkills->skill_name = $skill;
                    if ($modelSkills->save(false)) {
                        array_push($skillsArray, $modelSkills->skill_id);
                    }
                }
            }

            $skillsString = implode(',', $skillsArray);

            $workTypes = AdmWorkType::model()->findAll();
            $workTypeArray = array();
            foreach ($workTypes as $workType) {
                if (array_key_exists('workType_' . $workType->wt_id, $_POST)) {
                    array_push($workTypeArray, $workType->wt_id);
                }
            }
            $workTypesString = implode(',', $workTypeArray);

            $accessId = $_POST['accessId'];
            $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $accessId));
            $jsBasic = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsBasicTempData->jsbt_id));
            $jsId = $jsBasic->js_id;

            $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsId));
            if (count($jsEmploymentData) > 0) {
                $model = $jsEmploymentData;
            } else {
                $model = new JsEmploymentData();
            }

            $model->ref_js_id = $jsId;
            $model->ref_industry_id = $_POST['ind_id'];
            $model->ref_category_id = $_POST['cat_id'];
            $model->ref_sub_category_id = $_POST['subCategories'];
            $model->ref_designation_id = $_POST['designations'];
            $model->jsemp_expected_ref_industry_id = $_POST['ind_id'];
            $model->jsemp_expected_ref_category_id = $_POST['cat_id'];
            $model->jsemp_expected_sub_category_id = $_POST['subCategories'];
            $model->jsemp_expected_designation_id = $_POST['designations'];
            $model->jsemp_expected_salary = $_POST['salary'];
            $model->jsemp_no_of_experience_years = $_POST['experienceYears'];
            $model->jsemp_no_of_experience_months = $_POST['experienceMonths'];
            $model->jsemp_expected_cities_to_work = $_POST['city'];
            $model->jsemp_skills = $skillsString;
            $model->jsemp_work_types = $workTypesString;
            $model->jsemp_linkedin_url = $_POST['linkedin'];
            $model->jsemp_is_actively_finding_job = $_POST['group2'];

            $model->jsemp_create_time = date('Y-m-d H:i:s');
            $model->jsemp_updated_time = date('Y-m-d H:i:s');
            if ($model->save(false)) {
                $cvName = Controller::getJobSeekerReferenceNo($jsId);

                $path = $this->UploadCV($_FILES, $target_dir, $cvName);

                $jsBasic = JsBasic::model()->findByPk($jsId);
                $jsBasic->js_cv_path = $path;
                $jsBasic->save(false);

                $jsBasicTempData = JsBasicTemp::model()->findByPk($jsBasic->ref_jsbt_id);
                $jsBasicTempData->jsbt_is_finished = 1;
                $jsBasicTempData->save(false);

                $user = User::model()->findByAttributes(array('ref_emp_or_js_id' => $jsId, 'user_type' => 1));
                $user->user_is_finished = 1;
                $user->save(false);

                // Auto-login//                       
                $identity = new UserIdentity($user->user_name, '');
                $identity->setUpUser($user->user_id); // id of user
                Yii::app()->user->login($identity); //  

                $this->msgHandler(200, "Successfully Saved...");
            }
//        } catch (Exception $ex) {
//            $this->msgHandler(400, $ex->getTraceAsString());
//        }
    }

    function actionSkipStepThree() {
        $accessId = $_POST['accessId'];
        $jsBasicTempData = JsBasicTemp::model()->findByAttributes(array('jsbt_encrypted_id' => $accessId));
        $jsBasic = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $jsBasicTempData->jsbt_id));
        $jsId = $jsBasic->js_id;

        $user = User::model()->findByAttributes(array('ref_emp_or_js_id' => $jsId, 'user_type' => 1));

        // Auto-login//                       
        $identity = new UserIdentity($user->user_name, '');
        $identity->setUpUser($user->user_id); // id of user
        Yii::app()->user->login($identity); //  


        $this->msgHandler(200, "Successfully Saved...");
    }

    public function actionProfile() {
        $userId = Yii::app()->user->id;
        $user = User::model()->findByPk($userId);
        $userType = $user->user_type;

        if ($userType == 1) {
            if ($user->user_is_finished == 0) {
                $jsData = JsBasic::model()->findByPk($user->ref_emp_or_js_id);
                $jsTempData = JsBasicTemp::model()->findByPk($jsData->ref_jsbt_id);

                $this->redirect(Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("JobSeeker/ViewJobSeekerRegistration/id/" . $jsTempData->jsbt_encrypted_id)));
//                $this->redirect(array('JobSeeker/ViewJobSeekerRegistration', 'id' => $jsTempData->jsbt_encrypted_id));
            }

            $model = JsBasic::model()->findByAttributes(array('js_id' => $user->ref_emp_or_js_id));
            $employment = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $model->js_id));
        }

        $model = $model == NULL ? new JsBasic() : $model;
        $employment = $employment == NULL ? new JsEmploymentData() : $employment;

        $this->render('/JobSeeker/profile', array('model' => $model, 'employment' => $employment));
    }

    public function actionPersonalInfo() {
        $jobSeekerId = $this->getRefEmpOrJsId(Yii::app()->user->id);
        $jsBasic = JsBasic::model()->findByPk($jobSeekerId);
        $jsProfQualifications = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasic->js_id, 'jsquali_type' => 1));
        $jsMemberships = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasic->js_id, 'jsquali_type' => 2));
        $this->renderPartial('/JobSeeker/ajaxLoad/personalInformation', array('jsBasic' => $jsBasic, 'jsProfQualifications' => $jsProfQualifications, 'jsMemberships' => $jsMemberships));
    }

    public function actionPersonalInfoEdit() {
        $jobSeekerId = $this->getRefEmpOrJsId(Yii::app()->user->id);
        $jsBasic = JsBasic::model()->findByPk($jobSeekerId);
        $jsProfQualifications = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasic->js_id, 'jsquali_type' => 1));
        $jsMemberships = JsQualifications::model()->findAllByAttributes(array('ref_js_id' => $jsBasic->js_id, 'jsquali_type' => 2));
        $this->renderPartial('/JobSeeker/ajaxLoad/personalInformationEdit', array('jsBasic' => $jsBasic, 'jsProfQualifications' => $jsProfQualifications, 'jsMemberships' => $jsMemberships));
    }

    public function actionCurrentPositionInfo() {
        $this->renderPartial('/JobSeeker/ajaxLoad/currentPositionInfo');
    }

    public function actionCurrentPositionInfoEdit() { //test
        $jobSeekerId = $this->getRefEmpOrJsId(Yii::app()->user->id);
        $jsBasic = JsBasic::model()->findByPk($jobSeekerId);
        $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsBasic->js_id));
        $this->renderPartial('/JobSeeker/ajaxLoad/currentPositionInfoEdit', array('jsBasic' => $jsBasic, 'jsEmploymentData' => $jsEmploymentData));
    }

    public function actionExpectedPositionInfo() {
        $this->renderPartial('/JobSeeker/ajaxLoad/expectedPositionInfo');
    }

    public function actionExpectedPositionInfoEdit() {
        $jobSeekerId = $this->getRefEmpOrJsId(Yii::app()->user->id);
        $jsBasic = JsBasic::model()->findByPk($jobSeekerId);
        $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsBasic->js_id));
        $workTypes = AdmWorkType::model()->findAll();
        $this->renderPartial('/JobSeeker/ajaxLoad/expectedPositionInfoEdit', array('jsBasic' => $jsBasic, 'jsEmploymentData' => $jsEmploymentData, 'workTypes' => $workTypes,));
    }

    public function actionResetPassword() {
        $this->renderPartial('/JobSeeker/ajaxLoad/resetPassword');
    }

    public function actionUpdatePersonalInformation() {
        try {
            $userId = Yii::app()->user->id;
            $user = User::model()->findByPk($userId);
            $jsBasic = JsBasic::model()->findByPk($user->ref_emp_or_js_id);

            $jsBasic->js_fname = $_POST['js_fname'];
            $jsBasic->js_lname = $_POST['js_lname'];
            $jsBasic->js_address = $_POST['js_address'];
            $jsBasic->js_dob = $_POST['dob'];
            $jsBasic->js_contact_no1 = $_POST['js_contact_no1'];
            $jsBasic->js_experience_years = $_POST['js_experience_years'];
            $jsBasic->js_experience_months = $_POST['js_experience_months'];
            $jsBasic->js_highest_academic_quali = $_POST['js_highest_academic_quali'];
            $jsBasic->js_nameof_academic_quali = $_POST['js_nameof_academic_quali'];

            if ($jsBasic->save(false)) {
                $profQualiIds = $_POST['profQualiHiddenName'];
                $profQualiNames = $_POST['profQualiName'];

                for ($i = 0; $i < count($profQualiIds); $i++) {
                    if ($profQualiNames[$i] != "") {
                        if ($profQualiIds[$i] == 0) {
                            $JsQualifications = new JsQualifications();
                        } else {
                            $JsQualifications = JsQualifications::model()->findByPk($profQualiIds[$i]);
                        }
                        $JsQualifications->ref_js_id = $jsBasic->js_id;
                        $JsQualifications->jsquali_type = 1;
                        $JsQualifications->jsquali_qualification = $profQualiNames[$i];
                        $JsQualifications->save(false);
                    }
                }

                $membershipIds = $_POST['membershipHiddenName'];
                $membershipNames = $_POST['membershipName'];
                for ($i = 0; $i < count($membershipIds); $i++) {
                    if ($membershipNames[$i] != "") {
                        if ($membershipIds[$i] == 0) {
                            $JsQualifications = new JsQualifications();
                        } else {
                            $JsQualifications = JsQualifications::model()->findByPk($membershipIds[$i]);
                        }
                        $JsQualifications->ref_js_id = $jsBasic->js_id;
                        $JsQualifications->jsquali_type = 2;
                        $JsQualifications->jsquali_qualification = $membershipNames[$i];
                        $JsQualifications->save(false);
                    }
                }
                $this->msgHandler(200, "Successfully Updated!");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc);
        }
    }

    public function actionUpdateCurrentPositionInfo() {
        try {
            $userId = Yii::app()->user->id;
            $user = User::model()->findByPk($userId);
            $jsBasic = JsBasic::model()->findByPk($user->ref_emp_or_js_id);
            $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsBasic->js_id));

            $jsEmploymentData->ref_industry_id = $_POST['ind_id'];
            $jsEmploymentData->ref_category_id = $_POST['cat_id'];
            $jsEmploymentData->ref_sub_category_id = $_POST['subCategories'];
            $jsEmploymentData->ref_designation_id = $_POST['designations'];

            if ($jsEmploymentData->save(false)) {
                $this->msgHandler(200, "Successfully Updated!");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc);
        }
    }

    public function actionUpdateExpectedPositionInfo() {
        try {
            $userId = Yii::app()->user->id;
            $user = User::model()->findByPk($userId);
            $jsBasic = JsBasic::model()->findByPk($user->ref_emp_or_js_id);
            $jsEmploymentData = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $jsBasic->js_id));

            $jsEmploymentData->jsemp_expected_ref_industry_id = $_POST['ind_id'];
            $jsEmploymentData->jsemp_expected_ref_category_id = $_POST['cat_id'];
            $jsEmploymentData->jsemp_expected_sub_category_id = $_POST['subCategories'];
            $jsEmploymentData->jsemp_expected_designation_id = $_POST['designations'];
            $jsEmploymentData->jsemp_expected_salary = $_POST['salary'];

            if ($jsEmploymentData->save(false)) {
                $this->msgHandler(200, "Successfully Updated!");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc);
        }
    }

}
