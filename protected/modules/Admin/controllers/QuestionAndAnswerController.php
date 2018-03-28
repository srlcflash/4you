<?php

class QuestionAndAnswerController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionLoadQuestion() {
        $this->renderPartial('ajaxLoad/question');
    }

    public function actionLoadAnswerInput() {
        $this->renderPartial('ajaxLoad/answer');
    }

}
?>

