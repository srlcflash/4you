<?php

class PackageController extends Controller {

    public function actionViewPackages() {
        $this->render('/Settings/Package/viewPackage');
    }

    public function actionViewPackageData() {
        $packages = AdmPackage::model()->findAll();
        $this->renderPartial('/Settings/Package/ajaxLoad/viewPackageData', array('packages' => $packages));
    }

    public function actionSavePackage() {
        try {
            if ($_POST['hiddenId'] == 0) {
                $model = new AdmPackage();
            } else {
                $model = AdmPackage::model()->findByPk($_POST['hiddenId']);
            }
            $model->pack_name = $_POST['name'];
            $model->pack_amount = $_POST['amount'];
            $model->pack_num_of_ads = isset($_POST['isUnlimited']) && $_POST['isUnlimited'] == "on" ? 0 : $_POST['noOfAds'];
            $model->pack_is_unlimited = isset($_POST['isUnlimited']) && $_POST['isUnlimited'] == "on" ? 1 : 0;
            $model->pack_validity_period = $_POST['validity'];

            if ($model->save(false)) {
                $this->msgHandler(200, "Successfully Saved...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionGetEditPackageData() {
        try {
            $id = $_POST['id'];
            $packageData = AdmPackage::model()->findByPk($id);

            $packData["pack_id"] = $packageData->pack_id;
            $packData["pack_name"] = $packageData->pack_name;
            $packData["pack_amount"] = $packageData->pack_amount;
            $packData["pack_num_of_ads"] = $packageData->pack_is_unlimited == 1 ? '' : $packageData->pack_num_of_ads;
            $packData["pack_is_unlimited"] = $packageData->pack_is_unlimited == 1 ? "on" : '';
            $packData["pack_validity_period"] = $packageData->pack_validity_period;

            $this->msgHandler(200, "", array('packageData' => $packData));
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionDeletePackage() {
        try {
            $id = $_POST['id'];
            $model = new AdmPackage();
            if ($model->deleteByPk($id)) {
                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }
    
}
?>

