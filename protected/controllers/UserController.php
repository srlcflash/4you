<?php

class UserController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionProfile() {
        $userId = Yii::app()->user->id;
        $user = User::model()->findByPk($userId);
        $userType = $user->user_type;

        if ($userType == 1) {
            if ($user->user_is_finished == 0) {
                $jsData = JsBasic::model()->findByPk($user->ref_emp_or_js_id);
                $jsTempData = JsBasicTemp::model()->findByPk($jsData->ref_jsbt_id);


                $this->redirect(Yii::app()->request->redirect(Yii::app()->createAbsoluteUrl("JobSeeker/ViewJobSeekerRegistration/id", array("id" => $jsTempData->jsbt_encrypted_id))));
            }

            $model = JsBasic::model()->findByAttributes(array('js_id' => $user->ref_emp_or_js_id));
            $employment = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $model->js_id));
        }

        $model = $model == NULL ? new JsBasic() : $model;
        $employment = $employment == NULL ? new JsEmploymentData() : $employment;

        $this->render('profile', array('model' => $model, 'employment' => $employment));
    }

    public function actionPersonalInfo() {
        $this->renderPartial('ajaxLoad/personalInformation');
    }

    public function actionPersonalInfoEdit() {
        $this->renderPartial('ajaxLoad/personalInformation_form');
    }

    public function actionCurrentPositionInfo() {
        $this->renderPartial('ajaxLoad/currentPositionInfo');
    }

    public function actionExpectedPositionInfo() {
        $this->renderPartial('ajaxLoad/expectedPositionInfo');
    }

    //Popup
    public function actionImageCrop() {
        $this->renderPartial('ajaxLoad/popup/imageCrop');
    }

}
