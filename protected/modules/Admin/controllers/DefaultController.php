<?php

class DefaultController extends Controller {

    public function actionIndex() {
        if (Yii::app()->user->isGuest) {
            $this->actionViewLogin();
        } else {
            $userId = Yii::app()->user->id;
            $userType = $this->getUserType($userId);
            if ($userType == 3) {
                $this->render('index');
            } else {
                $this->actionLogout();
                $this->actionViewLogin();
            }
        }
    }

    public function actionViewLogin() {
        if (yii::app()->user->isGuest) {
            $this->layout = 'login_layout';
            $model = new AdmUser();
            $url = '';

            if (isset($_REQUEST['controllerAction'])) {
                if (!empty($_REQUEST['request_arr'])) {
                    $url_param = '';
                    foreach ($_REQUEST['request_arr'] as $key => $val) {
                        $url_param .= "$key/$val/";
                    }
                    $url = $_REQUEST['controllerAction'] . "/" . $url_param;
                } else {
                    $url = $_REQUEST['controllerAction'];
                }
            }


            $this->render('login', array('model' => $model, 'url' => $url));
        } else {
            $this->render('index');
        }
    }

    public function actionLogin() {
        $model = new LoginForm('login');

        $model->username = $_POST['username'];
        $model->password = $_POST['password'];


        if ($model->login()) {
            if (isset($url)) {
                $this->redirect(array($url));
            }
            $this->msgHandler(200, "Login Successfull...");
        } else {
            $this->msgHandler(400, "Error In Login Details...");
        }
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl . '/Admin');
    }

}
