<?php
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.server.js', CClientScript::POS_HEAD);
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frmAdver')); ?>
<?php
$empId = Controller::getRefEmpOrJsId(Yii::app()->user->id);

$employerData = EmpEmployers::model()->findByPk($empId);
$companyLogo = count($employerData) > 0 ? $employerData->employer_image : '';
$employerAddress = count($employerData) > 0 ? $employerData->employer_address : '';

$workType = AdmWorkType::model()->findByPk($adData->ref_work_type_id);
$workType = count($workType) > 0 ? $workType->wt_name : 'Not Mentioned';

$jobPostUrl = $adData->ad_is_image == 1 ? $adData->ad_image_url : "";
$jobPostText = $adData->ad_is_image == 2 ? $adData->ad_text : "";
?>
<div class="nav-bar-space"></div>

<section class="main-block add-block">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row">
                    <?php
                    if ($adData->ad_is_image == 2) {
                        ?>
                        <div class="col-md-12 mb-25">
                            <img src="<?php echo Yii::app()->baseUrl ?>/uploads/Profile/Employer/<?php echo $companyLogo; ?>" alt="">
                        </div>
                        <?php
                    }
                    ?>

                    <div class="col-sm-12 col-md-8">
                        <div class="row">
                            <!-- Image -->
                            <?php
                            if ($adData->ad_is_image == 1) {
                                ?>
                                <div class="col-md-12">                                                           
                                    <img class="img-responsive" src="<?php echo Yii::app()->baseUrl . "/" . $jobPostUrl; ?>" alt=""/>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if ($adData->ad_is_image == 2) {
                                ?>
                                <!-- text -->
                                <div class="col-md-12">
                                    <h2 class="text-dark-blue mb-25"><?php echo $adData->ad_title; ?></h2>

                                    <?php echo $jobPostText; ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                        <div class="side-panel">
                            <div class="side-panel-row">
                                <h6 class="title">Type</h6>
                                <h6 class="info"><?php echo $workType; ?></h6>
                            </div>

                            <div class="side-panel-row">
                                <h6 class="title">Experience</h6>
                                <h6 class="info"><?php echo $adData->ad_expected_experience . ' Year(s)'; ?></h6>
                            </div>

                            <div class="side-panel-row">
                                <h6 class="title">Address</h6>
                                <h6 class="info"><?php echo $employerAddress; ?></h6>
                            </div>

                            <div class="side-panel-row">
                                <h6 class="title">Salary</h6>
                                <h6 class="info"><?php echo $adData->ad_is_negotiable == 1 ? "Negotiable" : $adData->ad_salary; ?></h6>
                            </div>

                            <div class="side-panel-row">
                                <button type="button" onclick="publish('<?php echo $id; ?>')" class="cm-btn large light-blue-4 up-case">Send</button>
                                <button type="button" onclick="edit('<?php echo $id; ?>')" class="cm-btn large light-blue-4 up-case">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endWidget(); ?>

<script>
    function edit(id) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employer/CreateAdvertisement/id/'; ?>' + id;
    }

    function publish(id) {
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl . '/Employer/PublishAdvertisement'; ?>",
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.message').Success(responce.msg);
                    setTimeout(function () {
                        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employer/ProfileDetails'; ?>';
                    }, 800)

                } else {
                    $('.message').Error(responce.msg);
                }
            }
        });
    }
</script>