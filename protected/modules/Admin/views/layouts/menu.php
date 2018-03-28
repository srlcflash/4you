<?php
$mainLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => 0, 'lnk_is_module' => 0), array('order' => 'lnk_order ASC'));
?>



<nav class="navbar navbar-fixed-top nav-yellow">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand brand-logo logo-link"
               href="<?php echo Yii::app()->request->baseUrl . "/Admin/Default/Index"; ?>">
                <img src="<?php echo Yii::app()->baseUrl . '/images/system/logo/logo.png'; ?>" alt="">
            </a>
        </div>

        <div class="collapse navbar-collapse">

            <ul class="nav navbar-nav navbar-right">
                <?php
                foreach ($mainLinks as $mainLink) {
                    ?>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?php echo strtoupper($mainLink->lnk_name); ?><span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $subLinks = AdmLinks::model()->findAllByAttributes(array('lnk_parent_id' => $mainLink->lnk_id), array('order' => 'lnk_order ASC'));
                            foreach ($subLinks as $subLink) {
                                if ($subLink->lnk_is_module == 1) {
                                    $subUrl = Yii::app()->request->baseUrl . '/' . $subLink->lnk_module . '/' . $subLink->lnk_controller . '/' . $subLink->lnk_action;
                                } else {
                                    $subUrl = Yii::app()->request->baseUrl . '/' . $subLink->lnk_controller . '/' . $subLink->lnk_action;
                                }
                                ?>
                                <li><a href="<?php echo $subUrl ?>"><?php echo $subLink->lnk_name; ?></a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <li><a href="<?php echo Yii::app()->request->baseUrl . '/Admin/Default/Logout' ?>">Sign Out</a>
                <li>

            </ul>
        </div>
    </div>
</nav>



