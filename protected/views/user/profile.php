<?php
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/user.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/user.server.js', CClientScript::POS_HEAD);
?>

<div class="nav-bar-space"></div>

<section class="main-block top-space-block">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-md-offset-1 mb-30">
                <div class="row">
                    <div class="col-md-12 mb-20">
                        <div class="row">
                            <div class="col-md-3 pr-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <figure>
                                            <img class="profile-img img-166"
                                                 src="<?php //echo Yii::app()->baseUrl . '/images/profile/166/img-166.png'; ?>"
                                                 alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-10 mt-12">
<!--                                        <h6 class="text-center pointer uploadImage">
                                            <i class="icon icon-20 camera mr-13"></i>
                                            Upload Image
                                        </h6>-->
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-9 pl-0 pt-30 pb-20 bottom-line">  
                                <h2 class="text-black mb-5"><?php echo $model->js_fname . ' ' . $model->js_lname; ?></h2>
                                <h5 class="text-dark-blue text-light-2 text-uppercase"><?php
                                    if ($employment->ref_designation_id != NULL) {
                                        echo AdmDesignation::model()->findByPk($employment->ref_designation_id)->desig_name;
                                    }
                                    ?></h5>


                                <div class="d-table width-auto mt-20">
                                    <div class="d-table-cell pr-25">
                                        <h5 class="text-dark-blue text-light-1">
                                            <i class="icon icon-24 call mr-10 v-middle"></i>
                                            <span><?php echo $model->js_contact_no1; ?>/ <?php echo $model->js_contact_no2; ?></span>
                                        </h5>
                                    </div>
                                    <div class="d-table-cell pl-25">
                                        <h5 class="text-dark-blue text-light-1">
                                            <i class="icon icon-24 email mr-10 v-middle"></i>
                                            <span><?php echo $model->js_email; ?></span> 
                                        </h5>
                                    </div>
                                </div>

                                <h5 class="text-dark-blue text-light-1 mt-20">
                                    <i class="icon icon-20 linkedin mr-10 v-middle"></i>
                                    <span><?php //echo $model->js_email; ?></span>
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-3 pr-0">
                                <ul class="tab-horizontal profile-tab">
                                    <li class="active"><a href="#tab1">Personal Information</a></li>
                                    <li><a href="#tab2">Current position</a></li>
                                    <li><a href="#tab3">Expected Position</a></li>
                                    <li><a href="#tab4">Password</a></li>
                                    <li><a href="#tab5">Job Apply History</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9">

                                <div class="tab-horizontal-content ">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



