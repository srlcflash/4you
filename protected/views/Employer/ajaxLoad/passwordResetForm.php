<?php $form = $this->beginWidget('CActiveForm', array('id' => 'employerChangePassword')); ?>
<div class="col-md-8 pl-30 pr-0">
    <div class="row">
        <div class="col-md-12 ">
            <div class="input-wrapper">
                <input type="password" class="" name="oldPassword" required>
                <div class="float-text">Old Password</div>
            </div>
            <div class="input-wrapper">
                <input type="password" class="" name="newPassword" required>
                <div class="float-text">New Password</div>
            </div>
            <div class="input-wrapper">
                <input type="password" class="" name="rePassword" required>
                <div class="float-text">Re Password</div>
            </div>
        </div>

        <div class="col-md-12  mt-10">
            <div class="message cm-message"></div>
        </div>

        <div class="col-md-12 mt-15 pr-0">
            <button type="submit" class="cm-btn large text-uppercase light-blue">Update</button>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    Input.init();

    $("#employerChangePassword").validate({
        submitHandler: function () {
            changeEmployerPassword();
        }
    });

    function changeEmployerPassword() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employer/ChangeEmployerPassword'; ?>",
            data: $('#employerChangePassword').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    $('.message').Success(responce.msg);     
                    $('#employerChangePassword')[0].reset();
                } else {
                    $('.message').Error(responce.msg);
                }
            }
        });
    }

</script>