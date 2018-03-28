<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="theme-color" content="#FBAB18">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <!--========================================================
         Stylesheet
     =========================================================-->

    <!--CSS | bootstrap-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css">
    <!--CSS | Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <!--CSS | Main-->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

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
    <!--JS | Admin Validation-->
<!--    <script src="--><?php //echo Yii::app()->baseUrl . '/js/validate/jquery.validate.js'; ?><!--"></script>-->
    
    <!--========================================================
     Global site tag (gtag.js) - Google Analytics
    =========================================================-->
    
<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-108066807-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-108066807-1');
    </script>-->

    <title>4You</title>
</head>

<body>
<div class="popup-container">
    <div class="popup">
        <span class="close"></span>
        <div class="content">

        </div>
    </div>
</div>

<!-- Header Container -->
<header>
    <?php $this->beginContent('//layouts/menu'); ?>
    <?php echo $content; ?>
    <?php $this->endContent(); ?>
</header>

<!-- Main Container -->
<?php echo $content; ?>

<?php $this->beginContent('//layouts/footer'); ?>
<?php echo $content; ?>
<?php $this->endContent(); ?>

<!--========================================================
                     Javascript
 =========================================================-->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/validate/jquery.validate.js', CClientScript::POS_HEAD);
?>

<!--JS | Common js-->
<script src="<?php echo Yii::app()->baseUrl . '/js/custom/common.js'; ?>"></script>
<!--JS | Common Server js-->
<script src="<?php echo Yii::app()->baseUrl . '/js/custom/common.server.js'; ?>"></script>
</body>

<!------------------------------------
Footer Section
------------------------------------->
<!--<footer>
    <script src="<?php echo Yii::app()->baseUrl . '/js/custom/common.server.js'; ?>"></script>
    </footer>-->
</html>
