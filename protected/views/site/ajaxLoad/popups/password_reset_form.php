<?php $form = $this->beginWidget('CActiveForm', array('id' => 'resetPaswd')); ?>
<div class="row">
    <div class="col-md-12">

        <h3 class="text-black mb-50 text-center">Password Reset </h3>

        <form>
            <div class="row">

                <div class="col-md-12">
                    <div class="input-wrapper">
                        <input class="emil_username" type="text" name="email" id="email" autofocus required>
                        <div class="float-text">Email</div>
                    </div>
                </div>
                <div class="col-md-12  mt-10">
                    <div class="message cm-message"></div>
                </div>
                <div class="col-md-12 mt-20">
                    <button type="submit" class="cm-btn large text-uppercase light-blue right">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    $('.emil_username').focus();

    $("#resetPaswd").validate({
        submitHandler: function () {
            //resetPassword();
        }
    });

    function resetPassword() {

        $('.message').Info('Processing...', {stay: true});

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Default/ResetPassword'; ?>",
            data: $('#resetPaswd').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.message').Success(responce.msg);
                } else {
                    $('.message').Error(responce.msg);
                }
            }
        });
    }
</script>