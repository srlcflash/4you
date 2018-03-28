<?php

class IndustryController extends Controller {

    public function init() {
        $this->redirectToLogin();
    }

    public function actionViewIndustry() {
        $this->render('/Settings/Industry/viewIndustry');
    }

    public function actionViewIndustryData() {
        $industries = AdmIndustry::model()->findAll();
        $this->renderPartial('/Settings/Industry/ajaxLoad/viewIndustryData', array('industries' => $industries));
    }

    public function actionSaveIndustry() {
        try {
            if ($_POST['hiddenId'] == 0) {
                $model = new AdmIndustry();
            } else {
                $model = AdmIndustry::model()->findByPk($_POST['hiddenId']);
            }
            $model->ind_name = $_POST['name'];
            if ($model->save(false)) {
                $this->msgHandler(200, "Successfully Saved...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionDeleteIndustry() {
        try {
            $id = $_POST['id'];
            $model = new AdmIndustry();
            if ($model->deleteByPk($id)) {
                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionGetEditIndustryData() {
        try {
            $id = $_POST['id'];
            $industryData = AdmIndustry::model()->findByPk($id);
            $industry["ind_id"] = $industryData->ind_id;
            $industry["ind_name"] = $industryData->ind_name;

            $this->msgHandler(200, "", array('industryData' => $industry));
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

}
