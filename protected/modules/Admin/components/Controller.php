<?php

class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public static function msgHandler($code, $msg, $data = NULL) {
        if ($code == 200) {
            echo json_encode(array("code" => $code, "msg" => $msg, "data" => $data));
        } else {
            echo json_encode(array("code" => $code, "msg" => $msg, "data" => $data));
        }
    }

    public function redirectToLogin() {
        parent::init();
        if (yii::app()->user->isGuest) {
            $this->redirect(array('Default/ViewLogin?', 'controllerAction' => Yii::app()->urlManager->parseUrl(Yii::app()->request), 'request_arr' => $_REQUEST));
        }
    }

    public static function validateImage($fileData, $targetDir) {
        $targetFile = $targetDir . basename($_FILES["EmpAdvertisement"]["name"]['AdverImage']);
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        $status = 1;
        $reason = "";

        // Check file size
        if ($fileData["EmpAdvertisement"]["size"]["AdverImage"] > 3145728) {
            $status = 0;
            $reason = "File is too Large";
        }

        // Check if file already exists
        if (file_exists($targetFile)) {
            $status = 0;
            $reason = "Sorry, file already exists.";
        }

        // Check if file type
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $status = 0;
            $reason = "Sorry, only JPG, JPEG, PNG files are allowed.";
        }

        $arr["status"] = $status;
        $arr["reason"] = $reason;

        return $arr;
    }

    public static function UploadImage($fileData, $targetDir, $fileName) {
        $year = date('Y');
        $month = date('F');

        $targetFile = $targetDir . basename($fileData["EmpAdvertisement"]["name"]['AdverImage']);
        $imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);

        $path = $targetDir . $year . "/$month";
        if (!file_exists($path)) {
            $oldmask = umask(0);
            mkdir($path, 0777, true);
            umask($oldmask);
        }


        $fileName = $fileName . "." . $imageFileType;
        move_uploaded_file($fileData["EmpAdvertisement"]["tmp_name"]["AdverImage"], $path . '/' . $fileName);
        return $path . '/' . $fileName;
    }

    public static function getAdvertisementReferenceNo($id) {
        $reference = "1" . str_pad($id, 8, '0', STR_PAD_LEFT);
        return $reference;
    }

    public static function getEmployeeReferenceNo($id) {
        $reference = "E1" . str_pad($id, 5, '0', STR_PAD_LEFT);
        return $reference;
    }

// Advertisement Search
    public static function createSearchCriteriaForAdvertisement($query, $joinUsing, $page, $limit = NULL, $orderBy = NULL) {
        $sqlLimit = '';
        if ($limit == NULL) {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        } elseif ($limit > 0 && $limit != NULL) {
            $limit = $limit;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $askedQuery = explode("WHERE", $query, 2);
        $askedJoin = explode("LEFT JOIN", $query, 2);
        $requestedJoin = '';

        $join = Controller::searchJoinCriterias();
        $where = Controller::searchWhereCriterias();

        $askedWhere = '';
        if (count($askedQuery) > 1) {
            $askedWhere = $askedQuery[1] == NULL ? '' : ' AND ' . $askedQuery[1];
        }

        $orderBy = $orderBy != NULL ? 'ORDER BY ' . $orderBy . " DESC" : "";
        $returnQuery = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ' . $orderBy . $sqlLimit;
        $returnQueryCount = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ';
        $result = yii::app()->db->createCommand($returnQuery)->setFetchMode(PDO::FETCH_OBJ)->queryAll();
        $count = count(yii::app()->db->createCommand($returnQueryCount)->setFetchMode(PDO::FETCH_OBJ)->queryAll());

        return array('result' => $result, 'count' => $count);
    }

    public static function searchJoinCriterias() {
        $joinCriteria = Yii::app()->db->createCommand()
                ->leftJoin('adm_category ac', 'ad.ref_cat_id=ac.cat_id')
                ->leftJoin('adm_subcategory as1', 'ad.ref_subcat_id=as1.scat_id')
                ->leftJoin('adm_work_type awt', 'ad.ref_work_type_id=awt.wt_id')
                ->leftJoin('adm_district dis', 'ad.ref_district_id=dis.district_id')
                ->leftJoin('adm_city acity', 'ad.ref_city_id=acity.city_id')
                ->leftJoin('adm_designation desig', 'ad.ref_designation_id=desig.desig_id')
                ->leftJoin('emp_employers emp', 'ad.ref_employer_id=emp.employer_id')
                ->getText();

        $joinCriteria = explode("SELECT *", $joinCriteria, 2);
        return $joinCriteria[1];
    }

    public static function searchWhereCriterias() {
        $str = "ad.ad_id !=0 ";
        if (!empty($_REQUEST['ref_cat_id']) && $_REQUEST['ref_cat_id'] != 'undefined' && $_REQUEST['ref_cat_id'] != 0) {
            $str .= " AND ad.ref_cat_id = " . $_REQUEST['ref_cat_id'];
        }
        if (!empty($_REQUEST['subCatId']) && $_REQUEST['subCatId'] != 'undefined' && $_REQUEST['subCatId'] != 0) {
            $str .= " AND ad.ref_subcat_id = " . $_REQUEST['subCatId'];
        }
        if (!empty($_REQUEST['district_id']) && $_REQUEST['district_id'] != 'undefined' && $_REQUEST['district_id'] != 0) {
            $str .= " AND ad.ref_district_id = " . $_REQUEST['district_id'];
        }
        if (!empty($_REQUEST['cities']) && $_REQUEST['cities'] != 'undefined' && $_REQUEST['cities'] != 0) {
            $str .= " AND ad.ref_city_id =" . $_REQUEST['cities'] . " ";
        }
        if (!empty($_REQUEST['wt_id']) && $_REQUEST['wt_id'] != 'undefined' && $_REQUEST['wt_id'] != 0) {
            $str .= " AND ad.ref_work_type_id =" . $_REQUEST['wt_id'] . " ";
        }
        if (!empty($_REQUEST['Status']) && $_REQUEST['Status'] != 'undefined') {
            $currentDate = date('Y-m-d');
            if ($_REQUEST['Status'] == "expired") {
                $str .= " AND ad.ad_expire_date < '" . $currentDate . "' ";
            } else {
                $str .= " AND ad.ad_expire_date >= '" . $currentDate . "' ";
            }
        }
        if (!empty($_REQUEST['searchAddText']) && $_REQUEST['searchAddText'] != 'undefined') {
            $str .= " AND  ( ad.ad_reference Like '%" . $_REQUEST['searchAddText'] . "%' OR emp.employer_name Like '%" . $_REQUEST['searchAddText'] . "%' OR ad.ad_title Like '%" . $_REQUEST['searchAddText'] . "%')";
        }

        return $str;
    }

// Advertisement Search
//    Employer Search
    public static function createSearchCriteriaForEmployer($query, $joinUsing, $page, $limit = NULL) {
        $sqlLimit = '';
        if ($limit == NULL) {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        } elseif ($limit > 0 && $limit != NULL) {
            $limit = $limit;
            $offset = ($page - 1) * $limit;
            $sqlLimit = ' LIMIT ' . $limit . ' OFFSET ' . $offset;
        }

        $askedQuery = explode("WHERE", $query, 2);
        $askedJoin = explode("LEFT JOIN", $query, 2);
        $requestedJoin = '';

        $join = Controller::searchEmployerJoinCriterias();
        $where = Controller::searchEmployerWhereCriterias();

        $askedWhere = '';
        if (count($askedQuery) > 1) {
            $askedWhere = $askedQuery[1] == NULL ? '' : ' AND ' . $askedQuery[1];
        }

        $returnQuery = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ' . $sqlLimit;
        $returnQueryCount = $askedQuery[0] . $join . ' WHERE ' . $where . $askedWhere . ' ';
        $result = yii::app()->db->createCommand($returnQuery)->setFetchMode(PDO::FETCH_OBJ)->queryAll();
        $count = count(yii::app()->db->createCommand($returnQueryCount)->setFetchMode(PDO::FETCH_OBJ)->queryAll());

        return array('result' => $result, 'count' => $count);
    }

    public static function searchEmployerJoinCriterias() {
        $joinCriteria = Yii::app()->db->createCommand()
                ->leftJoin('adm_district dis', 'emp.ref_district_id=dis.district_id')
                ->leftJoin('adm_city acity', 'emp.ref_city_id=acity.city_id')
                ->getText();

        $joinCriteria = explode("SELECT *", $joinCriteria, 2);
        return $joinCriteria[1];
    }

    public static function searchEmployerWhereCriterias() {
        $str = "emp.employer_id !=0 ";

        if (!empty($_REQUEST['searchEmployerText']) && $_REQUEST['searchEmployerText'] != 'undefined') {
            $str .= " AND  ( emp.employer_name Like '%" . $_REQUEST['searchEmployerText'] . "%' OR emp.employer_tel Like '%" . $_REQUEST['searchEmployerText'] . "%' OR emp.employer_mobi Like '%" . $_REQUEST['searchEmployerText'] . "%')";
        }

        return $str;
    }

//    Employer Search

    public function getActiveFilter() {
        return array('active' => 'Active', 'expired' => 'expired');
    }

    public function saveImageInMultipleSizes($widthArray, $fileName, $upload_dir, $data) {
        foreach ($widthArray as $newWidth) {
            $image = imagecreatefromstring($data);
            $width = imagesx($image);
            $height = imagesy($image);
            $newHeight = ($height / $width) * $newWidth;
// Resample
            $image_p = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
// Buffering
            ob_start();
            imagepng($image_p);
            $data = ob_get_contents();
            ob_end_clean();
            $file = $upload_dir . "/" . $fileName;
            $result = file_put_contents($file, $data);
        }
        return $result;
    }

    public static function randomPassword($length = 8) {
        $chars = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789!@#$%&*";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

    public static function getUserType($id) {
        $userType = User::model()->findByPk($id)->user_type;
        return $userType;
    }

}
