<?php $form = $this->beginWidget('CActiveForm', array('id' => 'formRegister')); ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="text-black mb-50 text-center">Create Account</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="checkbox-wrapper">
                    <input class="radio-group" data-show="job_seeker" id="job_seeker" checked="checked" name="group1"
                           type="radio">
                    <label for="job_seeker">Job Seeker</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="radio-wrapper">
                    <input  class="radio-group " data-show="employer" id="employer" name="group1" type="radio">
                    <label for="employer">Employer</label>
                </div>
            </div>

<!--            <div class="col-md-12">
                <h5 class="text-black text-light-2 text-uppercase" style="color: #fbab18;">Register as an Employer</h5>
            </div>-->

            <div class="col-md-12 hide-show job_seeker">
                <div class="input-wrapper">
                    <input id="fname" name="fname" type="text" required>
                    <div class="float-text">First Name</div>
                </div>

                <div class="input-wrapper">
                    <input id="lname" name="lname" type="text">
                    <div class="float-text">Last Name</div>
                </div>
            </div>

            <div class="col-md-12  hide-show employer ">
                <div class="input-wrapper">
                    <input id="cname" name="cname" type="text" required>
                    <div class="float-text">Company Name</div>
                </div>
            </div>

            <div class="col-md-12 ">
                <div class="input-wrapper">
                    <input id="email" name="email" type="text" required>
                    <!--                        <input id="email" name="email" type="text" onblur="validateEmail(this.value)" required>-->
                    <div class="float-text">Email</div>
                </div>

                <div class="input-wrapper">
                    <input id="contactNo" name="contactNo" type="text" required>
                    <div class="float-text">Contact No</div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="cm-message message"></div>
            </div>

            <div class="col-md-12 mt-20">
                <button id="Register" type="submit"
                        class="cm-btn large text-uppercase light-blue right">Register
                </button>
            </div>

        </div>
    </div>
</div>
<?php $this->endWidget(); ?>


<script>
    $('.radio-group').on('change', function () {
        var $this = $(this);
        var show = $this.data('show');

        $('.hide-show').slideUp('fast', function () {
            $('.' + show).slideDown('slow')
        })
    });

    $(function () {
        var $this = $('.radio-group');
        var show = $this.data('show');

        $('.hide-show').slideUp('fast', function () {
            $('.' + show).slideDown('slow')
        })
    })

    $("#formRegister").validate({
        submitHandler: function () {

            var emailAdd = $("#email").val();
            var stat = isValidEmail(emailAdd);

            if (stat) {
                checkEmail(emailAdd, function (valid) {
                    console.log('is Valid ', valid)
                    if (!valid) {
                        userRegistration();
                    } else {
                        $('.message').Error('This email already taken');
                    }
                });
            } else {
                $('.message').Error('Invalid Email Address');
            }
        }
    });

    function loadVerifyPage(accessKey) {
        $.ajax({
            type: 'GET',
            url: '<?php echo Yii::app()->baseUrl . '/Site/VerifyPopup'; ?>',
            data: {accessKey: accessKey},
            success: function (res) {
                Popup.loadNewLayout(res);
                Popup.addClass('size-50');
            }
        });
    }

    function userRegistration() {

        Animation.load();

        var isCheckedJobSeeker = $('#job_seeker').is(':checked');
        var currentRequest = jQuery.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Registration/Register'; ?>",
            data: $('#formRegister').serialize() + "&isCheckedJobSeeker=" + isCheckedJobSeeker,
            dataType: 'json',
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (responce) {
                if (responce.code == 200) {
                    loadVerifyPage(responce.data.encryptedId);
                    Animation.hide();
//                    Popup.loadNewLayout('<div class="pop-message success">Registration Successfully</div>');
                }
            }
        });
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

    function isValidEmail(emailField) {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        if (!reg.test(emailField)) {
            return false;
        }
        return true;
    }

</script>

