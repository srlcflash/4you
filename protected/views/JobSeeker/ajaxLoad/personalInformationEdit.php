<?php $form = $this->beginWidget('CActiveForm', array('id' => 'editPersonalInformation', 'htmlOptions' => array('novalidate' => 'novalidate',))); ?>
<div class="row">
    <div class="col-md-12">
        <table class="data-table data-user-profile">
            <colgroup>
                <col class="heading">
                <col class="details">
            </colgroup>
            <tbody>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">First Name</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" name="js_fname"
                                                                             value="<?php echo $jsBasic->js_fname; ?>"
                                                                             required></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Last Name</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" name="js_lname"
                                                                             value="<?php echo $jsBasic->js_lname; ?>"
                                                                             required></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Address</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" name="js_address"
                                                                             value="<?php echo $jsBasic->js_address; ?>"
                                                                             required></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Date of Birth</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0 "><input id="dob" name="dob" class="datePicker"
                                                                              type="text"
                                                                              value="<?php echo $jsBasic->js_dob; ?>"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Contact No ( Optional )</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" id="js_contact_no1"
                                                                             name="js_contact_no1"
                                                                             value="<?php echo $jsBasic->js_contact_no1; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Total No of years experience</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="pl-0 col-md-6 mb-0">
                                <div class="input-wrapper mb-0"><input class="mt-0" id="js_experience_years"
                                                                       placeholder="Year" name="js_experience_years"
                                                                       type="text"
                                                                       value="<?php echo $jsBasic->js_experience_years; ?>">
                                </div>
                            </div>
                            <div class="pr-0 col-md-6 mb-0">
                                <div class="input-wrapper mb-0"><input class="mt-0" id="js_experience_months"
                                                                       placeholder="Months" name="js_experience_months"
                                                                       type="text"
                                                                       value="<?php echo $jsBasic->js_experience_months; ?>">
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Highest Academic Qualification</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" id="js_highest_academic_quali"
                                                                             name="js_highest_academic_quali"
                                                                             value="<?php echo $jsBasic->js_highest_academic_quali; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data"><h6 class="text-black text-light-2">Professional Qualification</h6></div>
                    </td>
                    <td>
                        <div class="data">
                            <div class="input-wrapper not-title mb-0"><input type="text" id="js_nameof_academic_quali"
                                                                             name="js_nameof_academic_quali"
                                                                             value="<?php echo $jsBasic->js_nameof_academic_quali; ?>">
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-12 mt-30">
        <div class="col-md-6 pr-0">
            <div class="row input-collection">
                <div class="col-md-12 mb-15">
                    <button data-btn="profQuali" type="button" class="cm-btn text-uppercase right addInput">
                        Add New
                    </button>
                </div>
                <div class="col-md-12 input-container">                            <?php foreach ($jsProfQualifications as $jsProfQualification) { ?>
                        <div class="input-wrapper"><input id="profQualiHiddenId[]"
                                                          name="profQualiHiddenName[]"
                                                          value="<?php echo $jsProfQualification->jsquali_id ?>"
                                                          placeholder="' + placeholder + '" type="hidden">
                            <input id="profQualiId[]" name="profQualiName[]"
                                   placeholder="Professional Qualification"
                                   value="<?php echo $jsProfQualification->jsquali_qualification ?>"
                                   type="text" autofocus> <span
                                   class="icon icon-16 ic-cross btn-remove-input"></span>
                        </div>                                <?php } ?>
                    <div class="input-wrapper"><input id="profQualiHiddenId[]" name="profQualiHiddenName[]"
                                                      value="0" placeholder="' + placeholder + '"
                                                      type="hidden"> <input id="profQualiId[]"
                                                      name="profQualiName[]"
                                                      placeholder="Professional Qualification"
                                                      type="text" autofocus> <span
                                                      class="icon icon-16 ic-cross btn-remove-input"></span></div>
                </div>
            </div>
        </div>                <!--Memberships-->
        <div class="col-md-6 pr-0">
            <div class="row input-collection">
                <div class="col-md-12 mb-15">
                    <button data-btn="membership" type="button"
                            class="cm-btn text-uppercase right membership addInput"> Add New
                    </button>
                </div>
                <div class="col-md-12 input-container">
                    <!--<div class="input-wrapper">--> <?php foreach ($jsMemberships as $jsMembership) { ?>
                        <div class="input-wrapper"><input id="membershipHiddenId[]"
                                                          name="membershipHiddenName[]"
                                                          value="<?php echo $jsMembership->jsquali_id; ?>"
                                                          placeholder="' + placeholder + '" type="hidden">
                            <input id="membershipId[]" name="membershipName[]" type="text"
                                   value="<?php echo $jsMembership->jsquali_qualification; ?>"
                                   placeholder="Membership" autofocus> <span
                                   class="icon icon-16 ic-cross btn-remove-input"></span>
                        </div>                                <?php } ?>
                    <div class="input-wrapper"><input id="membershipHiddenId[]"
                                                      name="membershipHiddenName[]" value="0"
                                                      placeholder="' + placeholder + '" type="hidden">
                        <input id="membershipId[]" name="membershipName[]" type="text"
                               placeholder="Membership" autofocus> <span
                               class="icon icon-16 ic-cross btn-remove-input"></span></div>
                    <!--</div>-->                        </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 pr-0 mt-10">
        <div class="message-persnl-info cm-message"></div>
    </div>
    <div class="col-md-12 mt-15 ">
        <button type="submit" class="cm-btn large text-uppercase light-blue right">Update</button>
    </div>
</div>
<?php $this->endWidget(); ?>
<script>
    Input.init();

    $('.datePicker').datepicker({language: 'en', autoClose: true});

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
            var $this = $(this), $inputCollection = $this.parents('.input-collection'),
                    $inputContainer = $inputCollection.find('.input-container'), $dataButton = $this.attr('data-btn');
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
    $("#editPersonalInformation").validate({
        submitHandler: function () {
            updatePersonalInformation();
        }
    });

    function updatePersonalInformation() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/UpdatePersonalInformation'; ?>",
            data: $('#editPersonalInformation').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.message-persnl-info').Success(responce.msg);
                    setTimeout(function () {
                        loadPage('/JobSeeker/PersonalInfo');
                    }, 1000);

                }
            }
        });
    }

    function loadPage(url) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl; ?>" + url,
            success: function (responce) {
                $('.tab-horizontal-content').html(responce);
            }
        });
    }

</script>