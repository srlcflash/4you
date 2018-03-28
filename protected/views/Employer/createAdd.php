<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<?php
//--------------------------------------------
//Style
//--------------------------------------------
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/editor/codemirror.css', 'screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/editor/froala_editor.pkgd.min.css', 'screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/editor/froala_style.min.css', 'screen');

//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/custom/advertisement.server.js', CClientScript::POS_HEAD);

//Include external JS libs.
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/editor/codemirror.min.js', CClientScript::POS_HEAD);
//Include Editor JS files.
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/editor/xml.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/editor/froala_editor.pkgd.min.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/datepicker/datepicker.min.css', 'screen');
//--------------------------------------------
//Javascript
//--------------------------------------------
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/datepicker/datepicker.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/datepicker/i18n/datepicker.en.js', CClientScript::POS_HEAD);
?>


<div class="nav-bar-space"></div>


<section class="main-block top-space-block">
    <?php
    $form = $this->beginWidget('CActiveForm', array('id' => 'formAddAdvertisement',
        'stateful' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'novalidate' => 'novalidate',
    )));
    ?>

    <div class="container">
        <div class="row mb-30">

            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">

                            <h2 class="col-md-12 f-light mb-50">Create Advertisement</h2>

                            <div class="col-md-12 mt-10">
                                <input type="hidden" id="adId" name="adId" value="<?php echo $adId; ?>">
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <div class="input-wrapper">
                                            <input id="title" name="title" type="text"
                                                   value="<?php echo $model->ad_title; ?>" required>
                                            <div class="float-text">Advertisement title</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-6">
                                        <div class="selector dark">
                                            <div class="selected-option">
                                                <span>Job Category</span>
                                            </div>
                                            <ul class="option-list"></ul>
                                            <?php echo Chtml::dropDownList('ref_cat_id', "", CHtml::listData(AdmCategory::model()->findAll(), 'cat_id', 'cat_name'), array('empty' => 'Category', 'options' => array($model->ref_cat_id => array('selected' => true)), 'required' => 'required', 'onChange' => 'loadSubCats()')); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="selector dark subSelector">
                                            <div class="selected-option">
                                                <span>Sub Category</span>
                                            </div>
                                            <ul class="option-list"></ul>
                                            <select class="type" name="subCategories" id="subCategories">
                                                <option id="0">Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-15">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="selector dark">
                                                    <div class="selected-option">
                                                        <span>Type</span>
                                                    </div>
                                                    <ul class="option-list"></ul>
                                                    <?php echo Chtml::dropDownList('ref_work_type_id', "", CHtml::listData(AdmWorkType::model()->findAll(), 'wt_id', 'wt_name'), array('empty' => 'Type', 'options' => array($model->ref_work_type_id => array('selected' => true)))); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="state-wrapper">
                                                    <input id="intern" name="intern"
                                                           type="checkbox" <?php echo $model->ad_is_intern == 1 ? "checked=checked" : ""; ?>>
                                                    <label for="intern">Intern Opportunity</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 disabled-on-intern">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-wrapper">
                                                    <input id="experience" name="experience" type="text"
                                                           class="salary-input"
                                                           value="<?php echo $model->ad_expected_experience ?>"
                                                           required>
                                                    <div class="float-text">Expected Experience</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 pl-0 mt-20">
                                                <h6>Year(s)</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-6 disabled-on-intern">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="state-wrapper">
                                                    <input id="isNegotiable" name="isNegotiable" class="filled-in"
                                                           type="checkbox" id="negotiable"
                                                           <?php echo $model->ad_is_negotiable == 1 ? "checked=checked" : ""; ?>/>
                                                    <label for="isNegotiable">Negotiable</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="input-wrapper">
                                                    <input id="salary" name="salary" type="text" class="salary-input"
                                                           value="<?php echo $model->ad_salary; ?>" required>
                                                    <div class="float-text">Salary</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-wrapper">
                                            <input readonly="readonly" id="expireDate" name="expireDate" type="text"
                                                   class="datePicker"
                                                   value="<?php echo $model->ad_expire_date; ?>" required>
                                            <div class="float-text">Expire Date</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">

                                    <div class="col-md-6">
                                        <div class="selector dark">
                                            <div class="selected-option">
                                                <span>District</span>
                                            </div>
                                            <ul class="option-list"></ul>
                                            <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('empty' => 'District', 'options' => array($districtLoad => array('selected' => true)), 'onChange' => 'loadCities()')); ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="selector dark citySelector">
                                            <div class="selected-option">
                                                <span>City</span>
                                            </div>
                                            <ul class="option-list"></ul>

                                            <select id="city" name="city" class="city"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-6">
                                        <div class="state-wrapper">
                                            <input class="add_type_group upload" name="group1"
                                                   id="upload" type="radio"
                                                   value="1" <?php echo $model->ad_is_image == 1 || $model->ad_is_image == 0 ? "checked=checked" : "" ?>>
                                            <label for="upload">Upload Image</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="state-wrapper">
                                            <input class="add_type_group editor" name="group1" id="editor"
                                                   type="radio"
                                                   value="2" <?php echo $model->ad_is_image == 2 ? "checked=checked" : "" ?>>
                                            <label for="editor">Use Text Editor</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-15 mb-15">
                                        <div class="row">
                                            <div class="col-md-12 upload-area">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="pl-25 file-uploader">
                                                            <div class="button">Brows...</div>
                                                            <?php
                                                            $imageModel = new EmpAdvertisement();
                                                            echo CHtml::activeFileField($imageModel, 'AdverImage');
                                                            echo $form->error($imageModel, 'AdverImage');
                                                            ?>
                                                        </div>
                                                        <p class="text-dark-blue text-light-2 f-12 ml-25 mt-7">File size
                                                            Should
                                                            be less than 2 MB and JPG/PNG fomat . Image width should not
                                                            be
                                                            than
                                                            950 pixels.</p>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12 pl-40 hide-block text-editor-area">
                                                <textarea name="advertisementText" id="advertisementText" cols="30"
                                                          rows="10"><?php echo $model->ad_text; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12  mt-10">
                                        <div class="message cm-message"></div>
                                    </div>
                                    <div class="col-md-12 mt-20">
                                        <button type="submit"
                                                class="cm-btn large text-uppercase light-blue right btnSave">Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</section>


<script>
    var isUploaded = true;
    var nowDate = new Date();
    var expDate = nowDate.setDate(nowDate.getDate() + 14);
    $('.datePicker').datepicker({
        language: 'en',
        minDate: new Date(),
        maxDate: new Date(expDate),
        autoClose: true
    });
    $(document).ready(function () {

<?php
if ($adId != 0) {
    ?>
            loadCities();
            loadSubCats('<?php echo $model->ref_subcat_id; ?>');
    <?php
} else {
    ?>
            loadCities();
    <?php
}
?>

        if ($('#adId').val().length > 0) {
            isUploaded = false;
        }
    });
    $('#formAddAdvertisement').submit(function (e) {
        e.preventDefault();
        var $form = $(this);

        if (!$form.valid())
            return;

        if (isUploaded) {
            if ($('#upload').is(':checked') && !$('#EmpAdvertisement_AdverImage').get(0).files.length) {
                $('.message').Error('Please select an Advertisement');
                return;
            }
        }

        var loader = Animation.load('body');

        $.ajax({
            url: "<?php echo Yii::app()->baseUrl . '/Employer/SaveAdvertisement'; ?>",
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (responce) {
                if (responce.code == 200) {
                    var adId = responce.data.adId;

                    loader.message = responce.msg;

                    document.getElementById("formAddAdvertisement").reset();
                    setTimeout(function () {
                        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employer/ViewPreviewJobAdvertisement/id/'; ?>' + adId;
                    }, 800)

                } else {
                    Animation.hide();
                    $('.message').Error(responce.msg);
                }
            }
        });
    });

    function showHideOnIntern($this) {
        var $elements = $('#experience,#isNegotiable,#salary'),
                $disabledOnIntern = $('.disabled-on-intern');
        if ($this.is(':checked')) {
            $elements.prop('disabled', true);
            $('#isNegotiable').prop('checked', false);
            $disabledOnIntern.css('opacity', 0.5);
        } else {
            $elements.prop('disabled', false);
            $disabledOnIntern.css('opacity', '');
        }

    }

    function disabledSalary(isValid) {
        if (isValid) {
            $('#salary').prop('disabled', true);
            $('#salary').parent().css('opacity', 0.5);
        } else {
            $('#salary').prop('disabled', false);
            $('#salary').parent().css('opacity', '');
        }
    }

    $('#intern').on('change', function () {
        showHideOnIntern($(this));
    });
    $('#isNegotiable').on('change', function () {
        if ($(this).is(':checked')) {
            disabledSalary(true);
        } else {
            disabledSalary(false);
        }
    });

    function showOtherText($thisVal) {
        if ($thisVal === 'other') {
            $('.showOnlyOther').show();
        } else {
            $('.showOnlyOther').hide();
        }
    }

    $('#designations').on('change', function () {
        showOtherText($(this).val())
    });
    $(function () {
        showHideOnIntern($('#intern'));
        var isNegotiable = $('#isNegotiable').is(':checked') ? true : false;
        disabledSalary(isNegotiable);
        var designationsVal = $('#designations').val();
        showOtherText(designationsVal);
    });

    function addContentStatus($this) {
        console.log($this);
        if ($this.hasClass('upload')) {
            $('.text-editor-area').slideUp('fast', function () {
                $('.upload-area').slideDown('fast');
            });
        } else {
            $('.upload-area').slideUp('fast', function () {
                $('.text-editor-area').slideDown('fast', function () {
                    //editor().setavl($('#ccc').val())
                });
            });
        }
    }

    $('.add_type_group').on('change', function () {
        var $this = $(this);
        addContentStatus($this);
    });
    $(function () {
        addContentStatus($('input[name="group1"]:checked'));
    });
    $(function () {
        $('textarea').froalaEditor({
            heightMin: 380,
            toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|', 'color', 'emoticons', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '-', 'insertLink', 'insertFile', 'insertTable', '|', 'quote', 'insertHR', 'undo', 'redo', 'clearFormatting', 'selectAll', 'html']
        })
    });

    function loadSubCats(id) {
        $("#subCategories").empty();
        var id = $('#ref_cat_id').val();
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
                        $("#subCategories > [value=" + '<?php echo $model->ref_subcat_id; ?>' + "]").attr("selected", "true");
                        Select.init('.subSelector');
                    }, 200);
//                    loadDesignations();
                }
            }
        });
    }

    function loadDesignations() {
        $("#designations").empty();
        var id = $('#ref_cat_id').val();
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
                    $('#designations').append(
                            $("<option>Other</option>")
                            .attr("value", "other")
                            .text("Other")
                            );
                    $("#designations > [value=" + '<?php echo $model->ref_designation_id; ?>' + "]").attr("selected", "true");
                    setTimeout(function () {
                        $("#designations > [value=" + '<?php echo $model->ref_designation_id; ?>' + "]").attr("selected", "true");

                        Select.init('.designationsSelector');
                    }, 200);
                }
            }
        });
    }

    function loadCities() {
        $("#city").empty();
        var id = $('#district_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Site/GetCitiesByDistrictID'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var cities = responce.data.cityData;
                    addEmptyToAjaxDropDowns('city', 'City');
                    for (var i = 0, max = cities.length; i < max; i++) {
                        $('#city').append(
                                $("<option>" + cities[i]['city_name'] + "</option>")
                                .attr("value", cities[i]['city_id'])
                                .text(cities[i]['city_name'])
                                );
                    }

                    $("#city > [value=" + '<?php echo $adId != 0 ? $model->ref_city_id : $cityLoad; ?>' + "]").attr("selected", "true");
                    setTimeout(function () {
                        Select.init('.citySelector');
                    }, 200)
                }
            }
        });
    }

    function addEmptyToAjaxDropDowns(id, defaultText) {
        var text = defaultText != undefined ? defaultText : "Select";
        $('#' + id).append(
                $("<option>Select</option>")
                .attr("value", 0)
                .text("Select")
                );
    }


    function editor() {
        var $text = $('#advertisementText');
        return {
            getVal: function () {
                return $text.froalaEditor('html.get', true);
            },
            setavl: function (val) {
                $text.froalaEditor('html.set', val);
            }
        };
    }
</script>
