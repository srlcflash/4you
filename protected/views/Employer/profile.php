<?php
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/employer.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/employer.server.js', CClientScript::POS_HEAD);
?>
<script src="<?php echo Yii::app()->baseUrl . '/js/validate/jquery.validate.js'; ?>"></script>
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
                                            <img class="m-auto employer-logo img-155"
                                                 src="<?php echo Yii::app()->baseUrl . '/uploads/Profile/Employer/' . $employerData->employer_image; ?>"
                                                 alt="">
                                        </figure>
                                    </div>
                                    <div class="col-md-12 mt-12">
                                        <h6 class="text-center pointer uploadImage">
                                            <i class="icon icon-20 camera mr-13"></i>
                                            Upload Image
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 pl-30 pr-0 pb-20 bottom-line">
                                <h2 class="text-black mb-5"><?php echo $employerData->employer_name; ?></h2>
                                <h5 class="text-dark-blue text-light-2 text-uppercase"><?php echo $employerData->employer_address; ?></h5>

                                <div class="d-table width-auto mt-20">
                                    <div class="d-table-cell pr-25">
                                        <h5 class="text-dark-blue text-light-1">
                                            <i class="icon icon-24 call mr-10 v-middle"></i>
                                            <span><?php echo $employerData->employer_tel; ?>
                                                <?php
                                                if ($employerData->employer_tel != '') {
                                                    echo '/ ' . $employerData->employer_mobi;
                                                }
                                                ?>     
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="d-table-cell pl-25">
                                        <h5 class="text-dark-blue text-light-1">
                                            <i class="icon icon-24 email mr-10 v-middle"></i>
                                            <span><?php echo $employerData->employer_email; ?></span>
                                        </h5>
                                    </div>
                                </div>

                                <h5 class="text-dark-blue text-light-1 mt-20">
                                    <i class="icon icon-20 linkedin mr-10 v-middle"></i>
                                    <span><?php echo $employerData->employer_contact_person; ?></span>
                                </h5>

                            </div>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 pr-0">
                                <ul class="tab-horizontal employer-tab">
                                    <li class="active"><a href="#tab1">Job Post</a></li>
                                    <li><a href="#tab2">Package</a></li>
                                    <li><a href="#tab4">Company</a></li>
                                    <li><a href="#tab3">Password</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9 pr-0 pl-0">

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


<script>
    function updateImage(imageName) {
        $('.employer-logo').attr('src', BASE_URL + '/uploads/Profile/Employer/' + imageName);
    }

</script>