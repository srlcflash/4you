<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/datepicker/datepicker.min.css', 'screen');
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/datepicker/datepicker.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/datepicker/i18n/datepicker.en.js', CClientScript::POS_HEAD);
?>


<section class="main-block jobSeeker-block">
    <div class="container">
        <div class="row mb-30">

            <div class="col-sm-12 col-md-10 mt-30 col-md-offset-1">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12 mb-50">
                                <ul class="step-list job-seeker-list">
                                    <li class="active">
                                        <a data-step="0">
                                            <span class="number">1.</span>
                                            <span class="text">
                                                Personal<br>Information
                                            </span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a data-step="1">
                                            <span class="number">2.</span>
                                            <span class="text">
                                                Current<br>Position
                                            </span>
                                        </a>
                                    </li>
                                    <li class="width-200 text-right">
                                        <a data-step="2">
                                            <span class="number">3.</span>
                                            <span class="text">
                                                Expected<br>Position
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div id="step" class="col-md-12 ">
                                <div class="row loadStep">

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
    var isStepOneCompleted = 0;
    var isStepTwoCompleted = 0;
    $(document).ready(function (e) {
        stepOne();
    });

    function stepOne() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/FormStepOne'; ?>",
            data: {accessId: "<?php echo $accessId; ?>"},
            success: function (responce) {
                $("#step").html(responce);
            }
        });
    }

    function stepTwo() {
        alert('step Two');
    }

    function stepThree() {
        alert('step Three');
    }

    function addEmptyToAjaxDropDowns(id, defaultText) {
        var text = defaultText != undefined ? defaultText : "Select";
        $('#' + id).append(
                $("<option>Select</option>")
                .attr("value", 0)
                .text("Select")
                );
    }

    function selectStep(index) {
        var $li = $('.job-seeker-list li');
        $li.removeClass('active');
        $li.eq(index).addClass('active');
    }
</script>