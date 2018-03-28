<?php

class CandidateController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionQualificationInput() {
        $this->renderPartial('ajaxLoad/qualification-input');

    }

    public function actionMembership() {
        $this->renderPartial('ajaxLoad/membership-input');
    }


}
?>

