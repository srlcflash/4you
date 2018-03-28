<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'editCurrentPositionInfo', 'htmlOptions' => array(
        'novalidate' => 'novalidate',
        )));
?>

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

                        <div class="data">

                            <h6 class="text-black text-light-2">Industry</h6>

                        </div>

                    </td>

                    <td>

                        <div class="data">

                            <div class="not-title mb-0">


                                <div class="selector dark industrySelector">
                                    <div class="selected-option">
                                        <span>Industry</span>
                                    </div>

                                    <ul class="option-list"></ul>
                                    <?php echo Chtml::dropDownList('ind_id', "", CHtml::listData(AdmIndustry::model()->findAll(), 'ind_id', 'ind_name'), array('empty' => 'Select Industry', 'options' => array($jsEmploymentData->ref_industry_id => array('selected' => true)))); ?>

                                </div>

                            </div>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <div class="data">
                            <h6 class="text-black text-light-2">Still I am a Fresher</h6>
                        </div>

                    </td>

                    <td>
                        <div class="data">
                            <div class="col-md-12 pl-0">

                                <div class="state-wrapper mt-0">

                                    <input type="checkbox" id="s"
                                           name="isFresher" <?php echo $jsEmploymentData->jsemp_is_fresher == 1 ? "checked" : ""; ?> >

                                    <label for="s"></label>

                                </div>

                            </div>
                        </div>
                    </td>

                </tr>


                <tr>

                    <td>

                        <div class="data">

                            <h6 class="text-black text-light-2">Category (Field)</h6>

                        </div>

                    </td>

                    <td>

                        <div class="data">

                            <div class="not-title mb-0">

                                <div class="selector dark categorySelector">
                                    <div class="selected-option">
                                        <span>Category</span>
                                    </div>

                                    <ul class="option-list"></ul>
                                    <?php echo Chtml::dropDownList('cat_id', "", CHtml::listData(AdmCategory::model()->findAll(array('order' => 'cat_order')), 'cat_id', 'cat_name'), array('empty' => 'Select Category', 'options' => array($jsEmploymentData->ref_category_id => array('selected' => true)), 'required' => 'required', 'onChange' => 'loadSubCategories()')); ?>

                                </div>


                            </div>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <div class="data">

                            <h6 class="text-black text-light-2">Sub Category</h6>

                        </div>

                    </td>

                    <td>

                        <div class="data">

                            <div class="not-title mb-0 ">

                                <div class="selector dark subSelector">
                                    <div class="selected-option">
                                        <span>Sub Category</span>
                                    </div>

                                    <ul class="option-list"></ul>
                                    <select class="type" name="subCategories" id="subCategories"></select>

                                </div>
                            </div>

                        </div>

                    </td>

                </tr>


                <tr>

                    <td>

                        <div class="data">

                            <h6 class="text-black text-light-2">Current Job title</h6>

                        </div>

                    </td>

                    <td>

                        <div class="data">

                            <div class="not-title mb-0">

                                <div class="selector dark designationsSelector">
                                    <div class="selected-option">
                                        <span>Current Job Title</span>
                                    </div>

                                    <ul class="option-list"></ul>
                                    <select class="type" name="designations" id="designations"></select>

                                </div>


                            </div>

                        </div>

                    </td>

                </tr>


            </tbody>

        </table>

    </div>

    <div class="col-md-12 pr-0 mt-10">

        <div class="message-current-positn cm-message"></div>

    </div>

    <div class="col-md-12 mt-15 ">

        <button type="submit" class="cm-btn large text-uppercase light-blue right">Update</button>

    </div>

</div>

<?php $this->endWidget(); ?>


<script>

    Input.init();
    Select.init();

    loadSubCategories();

    //Date piker

    $('.datePicker').datepicker({
        language: 'en',
        autoClose: true

    });


    $("#editCurrentPositionInfo").validate({
        submitHandler: function () {

            updateCurrentPositionInfo();

        }

    });


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

                    for (var i = 0, max = subCats.length; i < max; i++) {

                        $('#subCategories').append(
                                $("<option>" + subCats[i]['scat_name'] + "</option>")

                                .attr("value", subCats[i]['scat_id'])

                                .text(subCats[i]['scat_name'])
                                );

                    }


                    setTimeout(function () {

                        $("#subCategories > [value=" + '<?php echo $jsEmploymentData->ref_sub_category_id; ?>' + "]").attr("selected", "true");

                        Select.init('.subSelector');

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

                    for (var i = 0, max = designations.length; i < max; i++) {

                        $('#designations').append(
                                $("<option>" + designations[i]['desig_name'] + "</option>")

                                .attr("value", designations[i]['desig_id'])

                                .text(designations[i]['desig_name'])
                                );

                    }


                    setTimeout(function () {

                        Select.init(".designationsSelector");

                    }, 200);

                }

            }

        });

    }


    function updateCurrentPositionInfo() {

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/UpdateCurrentPositionInfo'; ?>",
            data: $('#editCurrentPositionInfo').serialize(),
            dataType: 'json',
            success: function (responce) {

                if (responce.code == 200) {

                    $('.message-current-positn').Success(responce.msg);

                    loadPage('/JobSeeker/CurrentPositionInfo');

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