<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formStepTwo', 'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
        )));
?>
<div class="col-md-12 ">

    <div class="row mb-15">

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Industry</span>
                </div>

                <ul class="option-list"></ul>
                <?php echo Chtml::dropDownList('ind_id', "", CHtml::listData(AdmIndustry::model()->findAll(), 'ind_id', 'ind_name'), array('empty' => 'Select Industry', 'options' => array($jsEmploymentData->ref_industry_id => array('selected' => true)))); ?>

            </div>
        </div>

        <div class="col-md-6">
            <div class="state-wrapper">
                <input type="checkbox" id="isFresher" class="fresherChb" name="isFresher" <?php echo $jsEmploymentData->jsemp_is_fresher == 1 ? "checked=checked" : "" ?>>
                <label for="isFresher">Still I am a Fresher</label>
            </div>
        </div>

    </div>

    <div class="row mb-15">

        <div class="col-md-6">
            <div class="selector dark isDisabledOnFresher">
                <div class="selected-option">
                    <span>Category (Field)</span>
                </div>
                <ul class="option-list"></ul>
                <?php echo Chtml::dropDownList('cat_id', "", CHtml::listData(AdmCategory::model()->findAll(array('order' => 'cat_order')), 'cat_id', 'cat_name'), array('empty' => 'Select Category', 'options' => array($jsEmploymentData->ref_category_id => array('selected' => true)), 'required' => 'required', 'onChange' => 'loadSubCategories()')); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="selector dark subCategories-select isDisabledOnFresher">
                <div class="selected-option">
                    <span>Sub Category</span>
                </div>
                <ul class="option-list"></ul>

                <select class="type" name="subCategories" id="subCategories" required="required">
                </select>
            </div>
        </div>

    </div>


    <div class="row mb-15">

        <div class="col-md-6">
            <div class="selector dark designations-select isDisabledOnFresher">
                <div class="selected-option">
                    <span>Current Job title</span>
                </div>
                <ul class="option-list"></ul>

                <select class="type" name="designations" id="designations">
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-wrapper isDisabledOnFresher jobTitle">
                <input id="designationOther" name="designationOther" type="text">
                <div class="float-text">If Others Enter your Job title</div>
            </div>
        </div>

    </div>

</div>

<div class="col-md-12 mt-20">
    <button type="submit" class="cm-btn large text-uppercase light-blue right btn-next">Next</button>
    <button type="button" class="cm-btn large text-uppercase light-blue right" onclick="goToStepOne()">Back</button>
    <button type="button" onclick="skip()" class="cm-btn large text-uppercase light-blue right">Skip</button>
</div>
<?php $this->endWidget(); ?>


<script>

    //Select Step
    selectStep(1);

    Input.init();
    Select.init();

    function loadSubCategories() {
        $("#subCategories").empty();

        var id = $('#cat_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/GetSubCategories'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var subCats = responce.data.subCategoryData;
                    addEmptyToAjaxDropDowns("subCategories", 'Sub Categories');
                    for (var i = 0, max = subCats.length; i < max; i++) {
                        $('#subCategories').append(
                                $("<option>" + subCats[i]['scat_name'] + "</option>")
                                .attr("value", subCats[i]['scat_id'])
                                .text(subCats[i]['scat_name'])
                                );
                    }

                    setTimeout(function () {
                        //$("#subCategories option[value=" + '<?php //echo $jsEmploymentData->ref_sub_category_id;     ?>' + "]").prop("selected", true);
                        Select.init('.subCategories-select');
                    }, 200);

                    loadDesignations();

                }
            }
        });
    }

    function loadDesignations() {
        $("#designations").empty();

        var id = $('#cat_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/GetDesignationsByCat'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var designations = responce.data.designationData;
                    addEmptyToAjaxDropDowns('designations', 'Designations');
                    for (var i = 0, max = designations.length; i < max; i++) {
                        $('#designations').append(
                                $("<option>" + designations[i]['desig_name'] + "</option>")
                                .attr("value", designations[i]['desig_id'])
                                .text(designations[i]['desig_name'])
                                );
                    }

                    setTimeout(function () {
                        Select.init(".designations-select");
                    }, 200);
                }
            }
        });
    }

    $("#formStepTwo").validate({
        submitHandler: function () {
            saveStepTwo();
        }
    });

    function saveStepTwo() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/SaveStepTwo'; ?>",
            data: $('#formStepTwo').serialize() + '&accessId=<?php echo $accessId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    isStepTwoCompleted = 1;
                    goToStepThree(responce.data.accessId);
                }
            }
        });
    }


    function goToStepThree(accessId) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/FormStepThree'; ?>",
            data: {accessId: accessId},
            success: function (responce) {
                Animation.hide();
                $("#step").html(responce);
            }
        });
    }

    function goToStepOne() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/FormStepOne'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            success: function (responce) {
                Animation.hide();
                $("#step").html(responce);
            }
        });
    }

    function skip() {
        Animation.load('body');
        isStepTwoCompleted = 0;
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/IsSecondStepFinished'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    if (responce.data.status == 1) {
                        isStepTwoCompleted = 1;
                    }
                }
            }
        });

        goToStepThree('<?php echo $accessId; ?>');
    }

    function addEmptyToAjaxDropDowns(id, defaultText) {
        var text = defaultText != undefined ? defaultText : "Select";
        $('#' + id).append(
                $("<option>Select</option>")
                .attr("value", 0)
                .text("Select")
                );
    }


    (function () {
        $('.fresherChb').on('change', function () {

            var $this = $(this);

            if ($this.is(':checked')) {
                disabledFn();
            } else {
                enabledFn();
            }
        });

        function disabledFn() {
            $('.isDisabledOnFresher').addClass('is-disabled');
        }

        function enabledFn() {
            var selector = $('.isDisabledOnFresher');

            selector.find('select').each(function () {
                var $this = $(this);
                if ($this.find('option').length > 0) {
                    $this.parent().removeClass('is-disabled');
                }
            });

            if (selector.hasClass('input-wrapper')) {
                $('.jobTitle').removeClass('is-disabled');
            }
        }
    })();

</script>