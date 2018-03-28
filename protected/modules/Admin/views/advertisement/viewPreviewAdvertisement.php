<?php
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.server.js', CClientScript::POS_HEAD);
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frmAdver')); ?>
<?php
$empId = $adData->ref_employer_id;

$employerData = EmpEmployers::model()->findByPk($empId);
$companyLogo = count($employerData) > 0 ? $employerData->employer_image : '';
$employerAddress = count($employerData) > 0 ? $employerData->employer_address : '';

$workType = AdmWorkType::model()->findByPk($adData->ref_work_type_id);
$workType = count($workType) > 0 ? $workType->wt_name : 'Not Mentioned';

$jobPostUrl = $adData->ad_is_image == 1 ? $adData->ad_image_url : "";
$jobPostText = $adData->ad_is_image == 2 ? $adData->ad_text : "";
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content pb-30">
                <div class="row">
                    <div class="col-md-9">
                        <?php
                        if ($adData->ad_is_image == 2) {
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="<?php echo Yii::app()->baseUrl ?>/uploads/Profile/Employer/<?php echo $companyLogo; ?>" alt="">
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="row">

                            <!-- Image -->
                            <?php
                            if ($adData->ad_is_image == 1) {
                                ?>
                                <div class="col-md-12">                                                           
                                    <img class="responsive-img" src="<?php echo Yii::app()->baseUrl . "/" . $jobPostUrl; ?>" alt=""/>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                            if ($adData->ad_is_image == 2) {
                                ?>
                                <!-- text -->
                                <div class="col-md-12">
                                    <h2 class=""><?php echo $adData->ad_title; ?></h2>

                                    <?php echo $jobPostText; ?>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class=info-title">Type</h6>
                                <h5 class="info-detail"><?php echo $workType; ?></h5>
                            </div>

                            <div class="col-md-12">
                                <h6 class="info-title">Experience</h6>
                                <h5 class="info-detail"><?php echo $adData->ad_expected_experience . ' Year(s)'; ?></h5>
                            </div>

                            <div class="col-md-12">
                                <h6 class="info-title">Address</h6>
                                <h5 class="info-detail"><?php echo $employerAddress; ?></h5>
                            </div>

                            <div class="col-md-12">
                                <h6 class="info-title">Salary</h6>
                                <h5 class="info-detail"><?php echo $adData->ad_is_negotiable == 1 ? "Negotiable" : $adData->ad_salary; ?></h5>
                            </div>

                            <div class="col-md-12 mt-15">
                                <button type="button" onclick="publish('<?php echo $id; ?>')" class="btn btn-primary">Publish</button>
                                <!--<button type="button" onclick="edit('<?php // echo $id; ?>')" class="btn waves-effect waves-light red lighten-1">Edit</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->endWidget(); ?>

<script>
//    function edit(id) {
//        window.location.href = '<?php // echo Yii::app()->baseUrl . '/Admin/Advertisement/EditAdvertisement/id/'; ?>' + id;
//    }

    function publish(id) {
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Advertisement/PublishAdvertisement'; ?>",
            type: 'POST',
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {                
                    setTimeout(function () {
                        window.location.href = '<?php echo Yii::app()->baseUrl . '/Admin/Advertisement/ViewPendingAdvertisementsToPublish'; ?>';
                    }, 800)

                } else {
                    $('.message').Error(responce.msg);
                }
            }
        });
    }
</script>