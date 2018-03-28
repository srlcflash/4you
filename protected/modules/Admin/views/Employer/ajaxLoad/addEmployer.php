<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog"></div>

<?php $form = $this->beginWidget('CActiveForm', array('id' => 'formAddEmployer')); ?>

<div class="row">
    <div class="col-md-12 company-form">
        <div class="card ">
            <div class="card-content">
                <h5 class="grey-text text-darken-1">Add Company</h5>

                <div class="row">
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="logo-wrp ">
                                    <img id="profileImage" src="/myProjects/uploads/company/logo/logo23.png" alt="">
                                </div>
                            </div>

                            <div class="col-md-12 text-center mt-30">
                                <button type="button" class="btn btn-default btnUpload">Upload</button>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Industry</label>
                                    <?php echo Chtml::dropDownList('ref_ind_id', "", CHtml::listData(AdmIndustry::model()->findAll(), 'ind_id', 'ind_name'), array('class' => 'form-control', 'empty' => 'Select Industry')); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input class="form-control" name="comName" type="text" autocomplete="off" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>District</label>
                                    <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('class' => 'form-control', 'empty' => 'Select District', 'onChange' => 'loadCities()')); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <select class="form-control" id="city" name="city" class="city"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" name="comAddress" type="text" autocomplete="off"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input class="form-control" name="comTel" type="tel" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact No (Optional)</label>
                                    <input class="form-control" name="comMobi" autocomplete="off" type="tel">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="comEmail" id="email" type="email"
                                           autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input class="form-control" name="comConPerson" autocomplete="off" type="text"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="col-md-12">
                <div class="cm-message message"></div>
            </div>
            <div class="card-action right-align">
                <button id="closeAddEmployer" type="button"
                        class="btn_close_Company btn btn-default">Close
                </button>
                <!-- Don't Activate this -->
                <!--                <button id="clearAddEmployer" type="button" class=" btn waves-effect waves-light red lighten-1">Clear
                                </button>-->
                <button id="saveEmployer" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<!--</div>-->

<script>

    var $uploadModal = $('#uploadModal');

    var imageBase64;

    function profileImage(url) {
        imageBase64 = url;
        $('#profileImage').prop('src', imageBase64);
    }

    function isValidEmail(emailField) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!reg.test(emailField)) {
            return false;
        }
        return true;
    }

    function checkEmail(emailField, callback) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Registration/IsExistingEmail'; ?>",
            data: {email: emailField},
            dataType: 'json',
            success: function (responce) {
                //console.log(emailField, ' -- ', responce)
                if (responce.code == 200) {
                    callback(responce.data.isExistingEmail);
                }
            }
        });
    }

    $("#formAddEmployer").validate({
        submitHandler: function () {

            var emailAdd = $("#email").val();
            var stat = isValidEmail(emailAdd);

            if (stat) {
                checkEmail(emailAdd, function (valid) {
                    console.log('is Valid ', valid)
                    if (!valid) {
                        saveEmployer();
                    } else {
                        $('.message').Error('This email already taken');
                    }
                });
            } else {
                $('.message').Error('Invalid Email Address');
            }
        }
    });

    function saveEmployer() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/SaveEmployer'; ?>",
            data: $('#formAddEmployer').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    Message.success(responce.msg);
                    $("#formAddEmployer")[0].reset();
                    Animation.hide();
                }
            }
        });
    }

    $('#clearAddEmployer').click(function (e) {
        $("#formAddEmployer")[0].reset();
    });

    $('#closeAddEmployer').click(function (e) {
        $("#formAddEmployer")[0].reset();
        $('.company-form').slideUp('fast', function () {
            $('.search-area,.company-cards').slideDown('slow');
            window.location = '<?php echo Yii::app()->request->baseUrl; ?>/Admin/Employer/ViewEmployer';
        })
    });

    $(document).ready(function () {

    });



    (function ($) {
        $(function () {
            $('.btnUpload').on('click', function () {

                $uploadModal.modal('show');

                $.ajax({
                    type: 'GET',
                    url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/LogoUploadPopup'; ?>",
                    success: function (responce) {
                        $uploadModal.html(responce);
                    }
                });
            });
        })
    }(jQuery));

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
                        $("#city > [value=" + '<?php // echo $model->ref_city_id; ?>' + "]").attr("selected", "true");
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


</script>