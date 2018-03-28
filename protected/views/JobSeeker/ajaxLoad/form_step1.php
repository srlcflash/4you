<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formStepOne',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
    )
        ));
?>
<div class="col-md-12">
    <div class="row mb-15">
        <div class="col-md-12">
            <div class="input-wrapper">
                <input id="address" name="address" type="text" value="<?php echo $jsBasicData->js_address; ?>" required>
                <div class="float-text">Address</div>
            </div>
        </div>
    </div>
    <div class="row mb-15">

        <div class="col-md-6">
            <div class="input-wrapper">
                <input id="dob" name="dob" class="datePicker" type="text" value="<?php echo $jsBasicData->js_dob; ?>">
                <div class="float-text">Date of birth</div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="input-wrapper">
                <input id="contactNo" name="contactNo" type="text" value="<?php echo $jsBasicData->js_contact_no1; ?>">
                <div class="float-text">Contact No ( Optional )</div>
            </div>
        </div>

    </div>

    <div class="row mb-15">

        <div class="col-md-6">

            <h6 class="text-black text-light-2 f-12 mb-2">Total No of years experience</h6>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper mb-0">
                        <input class="mt-0" id="experience" name="experienceYear" type="text"
                               value="<?php echo $jsBasicData->js_experience_years; ?>">
                        <span class="side-label">Year</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-wrapper  mb-0">
                        <input class="mt-0" name="experienceMonth" type="text"
                               value="<?php echo $jsBasicData->js_experience_months; ?>">
                        <span class="side-label">Month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Highest Acadamic Qualification</span>
                </div>

                <ul class="option-list"></ul>
                <?php echo Chtml::dropDownList('ahaq_id', "", CHtml::listData(AdmHigherAcademicQuali::model()->findAll(), 'ahaq_id', 'ahaq_name'), array('empty' => 'Select Higher Academic Qualification', 'options' => array($jsBasicData->js_highest_academic_quali => array('selected' => true)))); ?>               

            </div>
        </div>
    </div>


    <div class="row mb-15">

        <div class="col-md-6">
            <div class="input-wrapper">
                <input id="nameOfAcaQuali" name="nameOfAcaQuali" type="text"
                       value="<?php echo $jsBasicData->js_nameof_academic_quali; ?>">
                <div class="float-text">Name of the Academic Qualification</div>
            </div>
        </div>

    </div>

    <div class="row mb-15">

        <!--Proffesional Qualification-->
        <div class="col-md-6">
            <div class="row input-collection">
                <div class="col-md-12 mb-15">
                    <button data-btn="profQuali" type="button" class="cm-btn text-uppercase right addInput">Add New
                    </button>
                </div>

                <div class="col-md-12 input-container">
                    <?php
                    foreach ($jsProfQualifications as $jsProfQualification) {
                        ?>
                        <div class="input-wrapper">
                            <input id="profQualiHiddenId[]" name="profQualiHiddenName[]"
                                   value="<?php echo $jsProfQualification->jsquali_id ?>"
                                   placeholder="' + placeholder + '" type="hidden">
                            <input id="profQualiId[]" name="profQualiName[]" placeholder="Professional Qualification"
                                   value="<?php echo $jsProfQualification->jsquali_qualification ?>" type="text"
                                   autofocus>
                            <span class="icon icon-16 ic-cross btn-remove-input"></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="input-wrapper">
                        <input id="profQualiHiddenId[]" name="profQualiHiddenName[]" value="0"
                               placeholder="' + placeholder + '" type="hidden">
                        <input id="profQualiId[]" name="profQualiName[]" placeholder="Professional Qualification"
                               type="text" autofocus>
                        <span class="icon icon-16 ic-cross btn-remove-input"></span>
                    </div>
                </div>

            </div>
        </div>

        <!--Memberships-->
        <div class="col-md-6">
            <div class="row input-collection">
                <div class="col-md-12 mb-15">
                    <button data-btn="membership" type="button" class="cm-btn text-uppercase right membership addInput">
                        Add New
                    </button>
                </div>

                <div class="col-md-12 input-container">
                    <!--<div class="input-wrapper">-->
                    <?php
                    foreach ($jsMemberships as $jsMembership) {
                        ?>
                        <div class="input-wrapper">
                            <input id="membershipHiddenId[]" name="membershipHiddenName[]"
                                   value="<?php echo $jsMembership->jsquali_id; ?>" placeholder="' + placeholder + '"
                                   type="hidden">
                            <input id="membershipId[]" name="membershipName[]" type="text"
                                   value="<?php echo $jsMembership->jsquali_qualification; ?>" placeholder="Membership"
                                   autofocus>
                            <span class="icon icon-16 ic-cross btn-remove-input"></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="input-wrapper">
                        <input id="membershipHiddenId[]" name="membershipHiddenName[]" value="0"
                               placeholder="' + placeholder + '" type="hidden">
                        <input id="membershipId[]" name="membershipName[]" type="text" placeholder="Membership"
                               autofocus>
                        <span class="icon icon-16 ic-cross btn-remove-input"></span>
                    </div>
                    <!--</div>-->

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12 mt-20">
            <button type="submit" class="cm-btn large text-uppercase light-blue right btn-next">Next</button>
            <button type="button" onclick="skip()" class="cm-btn large text-uppercase light-blue right">Skip</button>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>

<script>

    //Select Step
    selectStep(0);

    Input.init();
    Select.init();

    //Date piker
    $('.datePicker').datepicker({
        language: 'en',
        autoClose: true
    });

    $(function () {
        var i = 0;

        function htmlInput(placeholder, membership) {
            var id = membership + 'Id_' + i;
            var nameArray = membership + 'Name[]';
            var hiddenId = membership + 'HiddenId_' + i;
            var nameHiddenArray = membership + 'HiddenName[]';

            var html = '';
            html += '<div class="input-wrapper">';
            html += '<input id="' + hiddenId + '" name="' + nameHiddenArray + '" placeholder="' + placeholder + '" type="hidden" value="0">';
            html += '<input id="' + id + '" name="' + nameArray + '" placeholder="' + placeholder + '" type="text">';
            html += '<span class="icon icon-16 ic-cross btn-remove-input"></span>';
            html += '<div class="input-line"></div>';
            html += '<div class="animate-line"></div>';
            html += '</div>';

            return html;
        }

        $('.addInput').on('click', function () {
            var $this = $(this),
                    $inputCollection = $this.parents('.input-collection'),
                    $inputContainer = $inputCollection.find('.input-container'),
                    $dataButton = $this.attr('data-btn');

            if ($this.hasClass('membership')) {
                $inputContainer.append(htmlInput('Membership', $dataButton));
                $inputContainer.find('.input-wrapper:last input[type="text"]').focus();
            } else {
                $inputContainer.append(htmlInput('Professional Qualification', $dataButton));
                $inputContainer.find('.input-wrapper:last input[type="text"]').focus();
            }

        });

        $('.input-collection').on('click', '.btn-remove-input', function () {
            var $this = $(this);
            var idVal = $this.siblings('input[type="hidden"]').val();
            if (idVal > 0) {
                deleteQualifications(idVal);
            }
            $this.parents('.input-wrapper').remove();
        });
    });

    $('#formStepOne').submit(function (e) {
        e.preventDefault();
        var $form = $(this);

        if (!$form.valid())
            return;

        saveStepOne();

    });

    function saveStepOne() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/SaveStepOne'; ?>",
            data: $('#formStepOne').serialize() + '&accessId=<?php echo $accessId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    isStepOneCompleted = 1;
                    goToStepTwo(responce.data.accessId);
                }
            }
        });
    }

    function deleteQualifications(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/DeleteQualification'; ?>",
            data: {id: id},
            dataType: 'json',
        });
    }

    function goToStepTwo(accessId) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/FormStepTwo'; ?>",
            data: {accessId: accessId},
            success: function (responce) {
                Animation.hide();
                $("#step").html(responce);
            }
        });
    }

    function skip() {
        Animation.load('body');
        isStepOneCompleted = 0;
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/IsFistrStepFinished'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    if (responce.data.status == 1) {
                        isStepOneCompleted = 1;
                    }
                }
            }
        });

        goToStepTwo('<?php echo $accessId; ?>');
    }

</script>
