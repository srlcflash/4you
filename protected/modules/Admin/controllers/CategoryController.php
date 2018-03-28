<?php

class CategoryController extends Controller {

    public function init() {
        $this->redirectToLogin();
    }

    public function actionViewCategory() {
        $this->render('/Settings/Category/viewCategory');
    }

    public function actionViewCategoryData() {
        $categories = AdmCategory::model()->findAll();
        $this->renderPartial('/Settings/Category/ajaxLoad/viewCategoryData', array('categories' => $categories));
    }

    public function actionSaveCategory() {        
        try {

            if ($_POST['hiddenId'] == 0) {
                $model = new AdmCategory();
            } else {
                $model = AdmCategory::model()->findByPk($_POST['hiddenId']);
            }
            $model->cat_name = $_POST['name'];
            $model->cat_order = $_POST['order'];

            if ($model->save(false)) {
                $catId = $model->cat_id;
                $data = $_POST['hiddenSubCat'];
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i] == 0) {
                        $subCat = new AdmSubcategory();
                    } else {
                        $subCat = AdmSubcategory::model()->findByPk($data[$i]);
                    }
                    $subCat->ref_cat_id = $catId;
                    $subCat->scat_name = $_POST['subCatName'][$i];
                    $subCat->scat_order = 0;
                    $subCat->save(false);
                }


                $this->msgHandler(200, "Successfully Saved...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionDeleteCategory() {
        try {
            $id = $_POST['id'];
            $model = new AdmCategory();
            if ($model->deleteByPk($id)) {

                $subCategory = new AdmSubcategory();
                $subCategory->deleteAllByAttributes(array('ref_cat_id' => $id));
                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionDeleteSubCategory() {
        try {
            $id = $_POST['id'];
            $model = new AdmSubcategory();
            if ($model->deleteByPk($id)) {

                $this->msgHandler(200, "Deleted Successfully...");
            }
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

    public function actionGetEditCategoryData() {
        try {
            $id = $_POST['id'];
            $categoryData = AdmCategory::model()->findByPk($id);
            $category["cat_id"] = $categoryData->cat_id;
            $category["cat_name"] = $categoryData->cat_name;
            $category["cat_order"] = $categoryData->cat_order;

            $subCatData = array();
            $subCategoryData = AdmSubcategory::model()->findAllByAttributes(array('ref_cat_id' => $id));
            foreach ($subCategoryData as $subCategory) {
                $subCat["scat_id"] = $subCategory->scat_id;
                $subCat["ref_cat_id"] = $subCategory->ref_cat_id;
                $subCat["scat_name"] = $subCategory->scat_name;
                $subCat["scat_order"] = $subCategory->scat_order;
                array_push($subCatData, $subCat);
            }

            $this->msgHandler(200, "Deleted Successfully...", array('categoryData' => $category, 'subCategoryData' => $subCatData));
        } catch (Exception $exc) {
            $this->msgHandler(400, $exc->getTraceAsString());
        }
    }

}
?>

