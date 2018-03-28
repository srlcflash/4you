<div class="nav-bar-space"></div>
<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'employerRegistration',
//    'htmlOptions' => array(
//        'enctype' => 'multipart/form-data',
//        'novalidate' => 'novalidate',
//    )
        ));
?>
<section class="main-block ">
    <div class="container">
        <div class="row mb-30">

            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row mb-15">
                                    <div class="col-md-12">
                                        <div class="company-logo-wrp">
                                            <img src="" alt="">
                                        </div>
                                        <button type="button" class="cm-btn large cmp_logo_upload">Upload Company Logo
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-12">
                                        <div class="input-wrapper">
                                            <input id="address" name="address" type="text" required>
                                            <div class="float-text">Address</div>
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

                                            <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('empty' => 'Select District', 'onChange' => 'loadCities()')); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="selector dark">
                                            <div class="selected-option">
                                                <span>City</span>
                                            </div>
                                            <ul class="option-list"></ul>

                                            <select id="city" name="city" class="city">
                                                <option value="0">Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-6">
                                        <div class="input-wrapper">
                                            <input id="contactNo" name="contactNo" type="text">
                                            <div class="float-text">Contact ( Optional )</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-wrapper">
                                            <input id="contactPerson" name="contactPerson" type="text" required>
                                            <div class="float-text">Name of Contact Person</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-15">
                                    <div class="col-md-6">
                                        <div class="selector dark">
                                            <div class="selected-option">
                                                <span>Industry</span>
                                            </div>
                                            <ul class="option-list"></ul>
                                            <?php echo Chtml::dropDownList('ind_id', "", CHtml::listData(AdmIndustry::model()->findAll(), 'ind_id', 'ind_name'), array('empty' => 'Select Industry', 'required' => 'required')); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 mt-20">
                                <button id="Register" type="submit"
                                        class="cm-btn large text-uppercase light-blue right">Finish
                                </button>
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
    $('.cmp_logo_upload').on('click', function () {

        Popup.beforeShow();

        loadLayoutByAjax('/Employer/CompanyLogoUploadPopup', function (html) {
            Popup.addClass('small-size');
            Popup.addClass('company-logo-upload');
            Popup.show(html);
        })
    });

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
                    addEmptyToAjaxDropDowns('city', 'city');
                    for (var i = 0, max = cities.length; i < max; i++) {
                        $('#city').append(
                                $("<option>" + cities[i]['city_name'] + "</option>")
                                .attr("value", cities[i]['city_id'])
                                .text(cities[i]['city_name'])
                                );
                    }

                    setTimeout(function () {
                        Select.init();
                    }, 200)
                }
            }
        });
    }

    $("#employerRegistration").validate({
        submitHandler: function () {
            saveEmployer();
        }
    });

    function updateImage(image) {
        var url = '<?php echo Yii::app()->baseUrl . '/uploads/Profile/Employer/' ?>' + image;
        $('.company-logo-wrp img').attr('src', url);
    }

    function saveEmployer() {
        Animation.load('body');
        var image = imageCropData.get();

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employer/SaveEmployer'; ?>",
            data: $('#employerRegistration').serialize() + '&image=' + image + '&accessId=<?php echo $accessId; ?>',
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
//                    window.location = http_path + 'Employer/Profile/id/' + responce.data.employerKey;
                    window.location = http_path + 'Employer/ProfileDetails';
                    Animation.hide();
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
</script>