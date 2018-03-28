<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formAddAdvertisement',
    'stateful' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    )));
?>
<div class="card ">
    <div class="card-content">
        <h5 class="grey-text text-darken-1">Add Advertisement</h5>
        <input type="hidden" id="adId" name="adId" value="<?php echo $adId; ?>">
        <input type="hidden" id="empId" name="empId" value="<?php echo $empId; ?>">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Advertisement title</label>
                    <input id="title" name="title" type="text" class="form-control designation"
                           value="<?php echo $model->ad_title; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Job Category</label>
                    <?php echo Chtml::dropDownList('ref_cat_id', "", CHtml::listData(AdmCategory::model()->findAll(), 'cat_id', 'cat_name'), array('class' => 'form-control','empty' => 'Select Category', 'options' => array($model->ref_cat_id => array('selected' => true)), 'onChange' => 'loadSubCategories()')); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Sub Category</label>
                    <select class="form-control type" name="subCategories" id="subCategories"></select>
                </div>
            </div>
            <!--            <div class="col-md-4">
                            <div class="form-group">
            <?php // echo Chtml::dropDownList('ref_designation_id', "", CHtml::listData(AdmDesignation::model()->findAll(), 'desig_id', 'desig_name'), array('empty' => 'Select Designation'));  ?>
                                <select class="type" name="designations" id="designations">
                                </select>
                                <label>Designation</label>
                            </div>
                        </div>-->
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Expected Experience (Yrs)</label>
                    <input id="experience" name="experience" type="text" class="form-control salary-input"
                           value="<?php echo $model->ad_expected_experience ?>" required>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input id="salary" name="salary" type="text" class="form-control salary-input"
                                           value="<?php echo $model->ad_salary; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-30">
                                    <input id="isNegotiable" name="isNegotiable" class="filled-in" type="checkbox" id="negotiable"
                                           checked="<?php echo $model->ad_is_negotiable == 1 ? "on" : ""; ?>"/>
                                    <label for="isNegotiable">Negotiable</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <?php echo Chtml::dropDownList('ref_work_type_id', "", CHtml::listData(AdmWorkType::model()->findAll(), 'wt_id', 'wt_name'), array('class' => 'form-control','options' => array($model->ref_work_type_id => array('selected' => true)))); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>District</label>
                    <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('class' => 'form-control','empty' => 'Select District', 'options' => array($model->ref_district_id => array('selected' => true)), 'onChange' => 'loadCities()')); ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?php // echo Chtml::dropDownList('ref_city_id', "", CHtml::listData(AdmCity::model()->findAll(), 'city_id', 'city_name'), array('empty' => 'Select City'));  ?>
                    <!--<ul class="option-list"></ul>-->
                    <label>City</label>
                    <select id="city" name="city" class="form-control city"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-30">
                    <input id="intern" name="intern" name="isNegotiable" class="filled-in" type="checkbox"
                           type="checkbox" <?php echo $model->ad_is_intern == 1 ? "checked=checked" : ""; ?>>
                    <label for="intern">Intern Opportunity</label>
                </div>
            </div>
        </div>
        <!--        <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input id="title" name="title" type="text" class="designation"
                                   value="<?php //echo $model->ad_title;       ?>">
                            <label>Advertisement title</label>
                        </div>
                    </div>-->

        <!--            <div class="col-md-4">
                        <div class="form-group">
                            <input id="isDesigAsTitle" name="isDesigAsTitle" class="filled-in" type="checkbox" id="designation"
                                   checked="<?php // echo $model->ad_is_use_desig_as_title == 1 ? "on" : "";          ?>"/>
                            <label for="isDesigAsTitle">Use designation as title</label>
                        </div>
                    </div>-->
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="designation">Expire Date</label>
                    <input id="expireDate" name="expireDate" type="text" class="form-control datepicker2"
                           value="<?php echo $model->ad_expire_date; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p>
                    <input class="with-gap uploaderOrEditor" name="group1" type="radio" id="uploader"
                           value="1" checked="<?php echo $model->ad_is_image == 1 ? "checked" : ""; ?>"/>
                    <label for="uploader">Upload Image</label>
                </p>
            </div>
            <div class="col-md-4">
                <p>
                    <input class="with-gap uploaderOrEditor" name="group1" type="radio" id="text-editor"
                           value="2"/>
                    <label for="text-editor">User Text Editor</label>
                </p>
            </div>

            <div class="col-md-12 uploader">
                <div class="col-md-4">
                    <div class="file-field form-group">
                        <div class="btn">
                            <span>Upload</span>
                            <?php
                            if ($adId == 0) {
                                $model = new EmpAdvertisement();
                            } else {
                                $model = EmpAdvertisement::model()->findByPk($adId);
                            }

                            echo CHtml::activeFileField($model, 'AdverImage');
                            echo $form->error($model, 'AdverImage');
                            ?>
                        </div>

                        <div class="file-path-wrapper">
                            <?php
                            if ($adId > 0) {
                                $image = end(split('/', $model->ad_image_url));
                            } else {
                                $image = $model->ad_image_url;
                            }
                            ?>
                            <input id="imagePath" name="imagePath" class="file-path validate" type="text"
                                   value="<?php echo $image; ?>">
                        </div>
                    </div>
                    <!--<a href="<?php // echo Yii::app()->baseUrl . '/' . $model->ad_image_url;         ?>">Download Advertisement</a>-->
                </div>
            </div>

            <div class="col-md-12 editor hide-block">
                <div class="form-group col-md-12">
                    <textarea id="textarea1" name="advertisementText" class="form-control materialize-textarea"></textarea>
<!--                    <label for="textarea1">Textarea</label>-->
                </div>
            </div>
        </div>
    </div>

    <div class="card-action right-align">
        <button id="closeAddAdvertisement" type="button" onclick="close()"
                class=" btn_close btn btn-default">Close
        </button>
<!--        <button id="clearAddAdvertisement" type="button" class=" btn waves-effect waves-light red lighten-1">Clear-->
        </button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>
<?php $this->endWidget(); ?>


<!--Back End-->
<script>
    $(document).ready(function () {
        <?php
        if ($adId > 0) {
        ?>
        loadCities();
        loadSubCategories('<?php echo $model->ref_subcat_id; ?>');

        <?php
        }
        ?>

    });

    $('#formAddAdvertisement').submit(function (e) {
        Animation.load('body');
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/SaveAdvertisement'; ?>",
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (responce) {
                if (responce.code == 200) {
                    Animation.hide();
                    Message.success(responce.msg);
                    window.location = '<?php echo Yii::app()->request->baseUrl; ?>/Admin/Employer/ViewEmployer';
                }else{
                    Animation.hide();
                    Message.danger(responce.msg);
                }
            }
        });
        e.preventDefault();
    });

    function loadSubCategories(id) {
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
                    }, 200);

//                    loadDesignations();

                }
            }
        });
    }

    //    function loadDesignations() {
    //        $("#designations").empty();
    //
    //        var id = $('#ref_cat_id').val();
    //        $.ajax({
    //            type: 'POST',
    //            url: "<?php // echo Yii::app()->baseUrl . '/JobSeeker/GetDesignationsByCat';    ?>",
    //            data: {id: id},
    //            dataType: 'json',
    //            success: function (responce) {
    //                if (responce.code == 200) {
    //                    var designations = responce.data.designationData;
    //                    for (var i = 0, max = designations.length; i < max; i++) {
    //                        $('#designations').append(
    //                                $("<option>" + designations[i]['desig_name'] + "</option>")
    //                                .attr("value", designations[i]['desig_id'])
    //                                .text(designations[i]['desig_name'])
    //                                );
    //                    }
    //
    //                    setTimeout(function () {
    //                       
    //                        $("#designations > [value=" + '<?php // echo $model->ref_designation_id;    ?>' + "]").attr("selected", "true");
    //                    }, 200);
    //                }
    //            }
    //        });
    //    }

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

                    setTimeout(function () {
                       
                        $("#city > [value=" + '<?php echo $model->ref_city_id; ?>' + "]").attr("selected", "true");
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

    $('#clearAddAdvertisement').click(function (e) {
        $("#formAddAdvertisement")[0].reset();
    });

    $('#closeAddAdvertisement').click(function (e) {
        $("#formAddAdvertisement")[0].reset();
        $('.company-form').slideUp('fast', function () {
            $('.search-area,.company-cards').slideDown('slow');
            loadEmployerData();
        })
    });

    $('#closeAddAdvertisement').click(function (e) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Admin/Employer/ViewEmployer'; ?>';
    });
</script>

<script>
    $(document).ready(function () {
       
    });

    //Uploader or Editor
    $('.uploaderOrEditor').on('change', function () {
        if ($(this).val() == 1) {
            $('.editor').slideUp('fast', function () {
                $('.uploader').slideDown('fast');
            });

        } else {
            $('.uploader').slideUp('fast', function () {
                $('.editor').slideDown('fast');
            });
        }
    });

    var nowDate = new Date();
    var expDate = nowDate.setDate(nowDate.getDate() + 14);

    $('.datepicker2').datepicker({
        language: 'en',
        position:"top left",
        minDate:new Date(),
        maxDate:new Date(expDate),
        autoClose:true
    });

    $('#negotiable').on('change', function () {
        if ($(this).is(':checked')) {
            $('.salary-input').prop('disabled', true);
        } else {
            $('.salary-input').prop('disabled', false);
        }
    });

    $('#designation').on('change', function () {
        if ($(this).is(':checked')) {
            $('.designation').prop('disabled', true);
        } else {
            $('.designation').prop('disabled', false);
        }
    });
</script>

<!-- Include external JS libs. -->
<script type="text/javascript"
        src="<?php echo $this->module->assetsUrl ?>/js/plugins/editor/codemirror.min.js"></script>
<script type="text/javascript"
        src="<?php echo $this->module->assetsUrl ?>/js/plugins/editor/xml.min.js"></script>

<!-- Include Editor JS files. -->
<script type="text/javascript"
        src="<?php echo $this->module->assetsUrl ?>/js/plugins/editor/froala_editor.pkgd.min.js"></script>

<!-- Initialize the editor. -->
<script>
    $(function () {
        $('textarea').froalaEditor({
            heightMin: 380
        })
    });

</script>