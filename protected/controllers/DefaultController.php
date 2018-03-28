<?php

class DefaultController extends Controller {

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->actionViewLogin();
        } else {
            $userId = Yii::app()->user->id;
            $this->render('index');
        }
    }

    public function actionLogin() {
        $model = new SiteLoginForm('login');

        $model->username = $_POST['username'];
        $model->password = $_POST['password'];

        if ($model->login()) {
            $url = '';
            $userId = Yii::app()->user->id;
            $userData = User::model()->findByAttributes(array('user_id' => $userId));

            if ($userData->user_is_verified == 1 && $userData->user_is_finished == 1) {
                if ($userData->user_type == 1) {
                    $url = '';
                } elseif ($userData->user_type == 2) {
                    $url = 'Employer/ProfileDetails';
                }
                $this->msgHandler(200, "Login Successfull!", array('url' => $url));
            } elseif ($userData->user_is_verified == 0 && $userData->user_is_finished == 0) {
                Yii::app()->user->logout();
                $this->msgHandler(400, "Please verify your email first!");
            } elseif ($userData->user_is_verified == 1 && $userData->user_is_finished == 0) {
                if ($userData->user_type == 1) {
                    $jsData = JsBasic::model()->findByPk($userData->ref_emp_or_js_id);
                    $jsTempData = JsBasicTemp::model()->findByPk($jsData->ref_jsbt_id);

                    $url = "JobSeeker/ViewJobSeekerRegistration/id/" . $jsTempData->jsbt_encrypted_id;
                    $this->msgHandler(200, "Login Successfull!", array('url' => $url));
                } elseif ($userData->user_type == 2) {    
                    $jsTempData = JsBasicTemp::model()->findByPk($userData->ref_emp_or_js_id);

                    $url = "Employer/ViewEmployerRegistration/id/" . $jsTempData->jsbt_encrypted_id;
                    $this->msgHandler(200, "Login Successfull!", array('url' => $url));                    
                }
            }
        } else {
            $this->msgHandler(400, "Incorrect Username or Password!");
        }
    }

    public function actionResetPassword() {
        $email = trim($_POST['email']);
        $user = User::model()->findByAttributes(array('user_name' => $email));

        if (count($user) > 0) {
            $password = $this->randomPassword();
            $userType = $user->user_type;
            $jsId = $user->ref_emp_or_js_id;
            $user->user_password = md5(md5('SRLC' . $password . $password));
            if ($user->save(false)) {
                if ($userType == 1) {
                    $msg = EmailGenerator::setEmailMessageBodyJobSeeker('reset_password', '1', $jsId, $email, $password, false);
                } elseif ($userType == 2) {
                    $msg = EmailGenerator::setEmailMessageBodyEmployer('reset_password', '2', $jsId, $email, $password, false);
                }

                $subjct = "Verify Your Account";
                $to = $email;
                EmailGenerator::SendEmail($msg, $to, $subjct);
            }

            $this->msgHandler(200, "New Password has been sent to your email!");
        } else {
            $this->msgHandler(400, "Incorrect email!");
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl . '/Site');
    }

}
