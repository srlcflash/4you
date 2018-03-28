<?php $form = $this->beginWidget('CActiveForm', array('id' => 'login')); ?>
<div class="row">

    <div class="col-md-12">
        <h3 class="text-black mb-50 text-center">Sign In</h3>

        <form>
            <div class="row">

                <div class="col-md-12">
                    <div class="input-wrapper">
                        <input type="text" id="username"  name="username" required>
                        <div class="float-text">Email</div>
                    </div>

                    <div class="input-wrapper">
                        <input name="password" type="password" autocomplete="off" type="password" required> 
                        <div class="float-text">Password</div>
                    </div>
                </div>

<!--                <div class="col-md-12 text-right mt-10">-->
<!--                    <a class="forget_password" href="#">Forget Password</a>-->
<!--                </div>-->

                <div class="col-md-12  mt-10">
                    <div class="message cm-message"></div> 
                </div>

                <div class="col-md-12 mt-20">  
                    <button type="submit" class="cm-btn large text-uppercase light-blue right">Login</button>
                </div>
            </div>
        </form>

    </div>

</div>
<?php $this->endWidget(); ?>

<script>

    $("#login").validate({
        submitHandler: function () {
            login();
        }
    });

    $(function () {
        $('#pword').keypress(function (e) {
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                login()
                return false;
            }
        });

        $("#username").keypress(function (e) {
            if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
                login()
                return false;
            }
        });
    });

    function login() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Default/Login'; ?>",
            data: $('#login').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    window.location = http_path + responce.data.url;
                } else { 
                    $('.message').Error(responce.msg);
                }
            }
        });
    }
</script>
