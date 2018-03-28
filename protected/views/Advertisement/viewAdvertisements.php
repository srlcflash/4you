<?php
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.server.js', CClientScript::POS_HEAD);
?>
<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frmAdver')); ?>
<?php
$employerData = EmpEmployers::model()->findByPk($adData->ref_employer_id);
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

                            <input type="hidden" name="id" value="<?php echo $currentPage . '-' . $adData->ad_id; ?>">
                            <div class="side-panel-row">
                                <button type="button" class="cm-btn large light-blue-4 up-case btn-apply-job">Apply</button>
                                <?php echo CHtml::button('Back', array('submit' => array('Site/Index'),'class'=>'cm-btn large text-uppercase light-blue right')) ?>
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
    $(function () {
        $('.btn-apply-job').on('click', function () {
            Animation.load('body');
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/advertisement/ApplyJob'; ?>",
                data: {adId: '<?php echo $adId; ?>'},
                success: function (html) {
                    Animation.hide();
                    Popup.addClass('small-size');
                    Popup.show(html)
                }
            });
        });
    })

    function back() {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Site/Index'; ?>';
//       Site/Index
    }
</script>

<!-- _ajax(
                    {
                        type: 'POST',
                        url: '/advertisement/ApplyJob',
                        data: {adId: '<?php // echo $adId;                            ?>'},
                    },
                    function (html) {
                        Popup.addClass('small-size');
                        Popup.show(html)
                    }
            );-->