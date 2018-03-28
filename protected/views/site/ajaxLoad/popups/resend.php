<?php $form = $this->beginWidget('CActiveForm', array('id' => 'formResendMail')); ?>
<div class="row">

    <div class="col-md-12 mt-60 mb-60">

        <div class="row text-center">
            <div class="col-md-12 mb-30">
                <span class="verify-icon-mail icon icon-70 icon-mail">
                    <i class="icon icon-35 ic-resend"></i>
                </span>
            </div>

            <h3 class="text-black mb-15 col-md-12">Resend Email</h3>

            <div class="col-md-8 col-md-offset-2 mb-14">
                <div class="input-wrapper">
                    <input id="reMail" name="reMail" type="text" required="required" autofocus>
                </div>
            </div>

            <p class="col-md-12 f-18 text-black text-light-2">
                Please check email address and click resend
            </p>

            <div class="col-md-12 mt-30">
                <button type="submit" class="cm-btn large text-uppercase light-blue center">Re-Send
                </button>
            </div>
        </div>

    </div>

</div>
<?php $this->endWidget(); ?>

<script>
    Input.init();

    $("#formResendMail").validate({
        submitHandler: function () {

            var emailAdd = $("#reMail").val();
            var stat = isValidEmail(emailAdd);

            if (stat) {
                checkEmail(emailAdd, function (valid) {
                    console.log('is Valid ', valid)
                    if (!valid) {
                        reSendMail();
                    } else {
                        $('.message').Error('This email already taken');
                    }
                });
            } else {
                $('.message').Error('Invalid Email Address');
            }
        }
    });

    function checkEmail(emailField, callback) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Registration/IsExistingEmailForResend'; ?>",
            data: {email: emailField, accessKey: '<?php echo $accessKey; ?>'},
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

    function loadVerifyPage(accessKey) {
        $.ajax({
            type: 'GET',
            url: "<?php echo Yii::app()->baseUrl . '/Site/VerifyPopup'; ?>",
            data: {accessKey: accessKey},
            success: function (res) {
                Popup.loadNewLayout(res);
                Popup.addClass('size-50');
            }
        });
    }

    function reSendMail() {
        Animation.load();
        var currentRequest = jQuery.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Registration/ResendMail'; ?>",
            data: {accessKey: '<?php echo $accessKey; ?>'},
            dataType: 'json',
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (responce) {
                if (responce.code == 200) {
                    Animation.hide();
                    Popup.hide();
//                    Popup.loadNewLayout('<div class="pop-message success">Registration Successfully</div>');
                }
            }
        });
    }
</script>