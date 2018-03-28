<?php

class DesignationController extends Controller {

    public function init() {
        $this->redirectToLogin();
    }

    public function actionViewDesignation() {
        $this->render('/Settings/Designation/viewDesignation');
    }

    public function actionViewDesignationData() {
        $designations = AdmDesignation::model()->findAll();
        $this->renderPartial('/Settings/Designation/ajaxLoad/viewDesignationData', array('designations' => $designations));
    }

    public function actionSaveDesignation() {
        try {
            if ($_POST['hiddenId'] == 0) {
                $model = new AdmDesignation();
            } else {
                $model = AdmDesignation::model()->findByPk($_POST['hiddenId']);
            }
            $model->ref_cat_id = $_POST['ref_cat_id'];
            $model->desig_name = $_POST['name'];
            if ($model->save(false)) {
                $this->msgHandler(200, "Successfully Saved...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionDeleteDesignation() {
        try {
            $id = $_POST['id'];
            $model = new AdmDesignation();
            if ($model->deleteByPk($id)) {
                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionGetEditDesignationData() {
        try {
            $id = $_POST['id'];
            $designationData = AdmDesignation::model()->findByPk($id);
            $designation["desig_id"] = $designationData->desig_id;
            $designation["ref_cat_id"] = $designationData->ref_cat_id;
            $designation["desig_name"] = $designationData->desig_name;

            $this->msgHandler(200, "", array('designationData' => $designation));
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

}
