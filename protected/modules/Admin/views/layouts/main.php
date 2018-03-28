<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <!--========================================================
        Stylesheet
    =========================================================-->
    <!--CSS | Materialize-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css">
    <!--CSS | Materialize Icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--CSS | Common-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/custom/common.css">
    <!--CSS | Sweet Alert-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/plugins/sweetalert.css">
    <!--CSS | Datepicker-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/plugins/datepicker/datepicker.min.css">
    <!--CSS | Admin-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/admin/main.css">

    <!--========================================================
        Javascript
    =========================================================-->
    <script>
        var BASE_URL = "<?php echo Yii::app()->baseUrl; ?>";
    </script>

    <script type="text/javascript">
        var http_path = "<?php echo Yii::app()->getBaseUrl(true); ?>/";
    </script>

    <!--JS | Jquery Lib-->
    <script src="<?php echo Yii::app()->baseUrl . '/js/lib/jquery-3.2.1.min.js'; ?>"></script>
    <!--JS | Lodash-->
    <script src="<?php echo Yii::app()->baseUrl . '/js/bootstrap.min.js'; ?>"></script>
    <!--JS | Sweet Alert-->
    <script src="<?php echo $this->module->assetsUrl . '/js/plugins/sweetalert/sweetalert.min.js'; ?>"></script>
    <!--JS | Admin Validation-->
    <script src="<?php echo $this->module->assetsUrl . '/js/admin/jquery.validate.js'; ?>"></script>
    <!--JS | Datepicker-->
    <script src="<?php echo Yii::app()->baseUrl . '/js/plugins/datepicker/datepicker.min.js'; ?>"></script>
    <script src="<?php echo Yii::app()->baseUrl . '/js/plugins/datepicker/i18n/datepicker.en.js'; ?>"></script>
    <!--JS | Admin Common-->
    <script src="<?php echo $this->module->assetsUrl . '/js/admin/common.js'; ?>"></script>


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<!-- Modal Structure -->
<div id="modal1" class="modal">

</div>

<!-- ======================================================
        Header Container
=========================================================-->
<header>
    <?php $this->beginContent('/layouts/menu'); ?>
    <?php echo $content; ?>
    <?php $this->endContent(); ?>
</header>


<!-- ======================================================
       Main Container
=========================================================-->
<div class=" container-fluid" id="page">


    <?php echo $content; ?>

    <!--Message area-->
    <div class="card-panel adm-alert" role="alert"></div>

</div>

<!-- ======================================================
       Footer Container
=========================================================-->

</body>
</html>
