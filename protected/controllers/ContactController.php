<?php

class ContactController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    public function actionSendInquiry() {
        $emailconfig = AdmEmailConfig::model()->find();
        $msg = $_POST["message"];
        $subjct = "INQUIRY [" . $_POST["name"] . "] - [" . $_POST["email"] . "]";
//        $to = $emailconfig->smtp_server;
        $to = "srlcarrow@gmail.com";
        EmailGenerator::SendEmail($msg, $to, $subjct);
        $this->msgHandler(200, "Successfully Send...");
    }

}
