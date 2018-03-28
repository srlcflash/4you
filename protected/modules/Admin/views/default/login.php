<?php $form = $this->beginWidget('CActiveForm', array('id' => 'login')); ?>

<div class="col-md-12 login-form ">
    <div class="row mb-0">
        <div class="col-md-4 col-md-offset-4">
            <div class="card-panel login-panel">
                <h5 class="f-24 grey-text text-darken-2 mb-30">Login</h5>

                <form action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Username</label>
                                <input id="username" class="form-control" autocomplete="off" name="username" type="text" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" class="form-control" autocomplete="off" name="password" type="password" required>
                            </div>
                        </div>
                        <div class="col-md-12 mt-15 text-right">
                            <button type="button" onclick="login()" class="btn-login btn-primary btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    $(function () {
        $('#password').keypress(function (e) {
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
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Default/Login'; ?>",
            data: $('#login').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                Message.success('Login Success..');
                <?php if ($url != '') { ?> window.location = http_path + "<?php echo $url ?>";
                <?php } else { ?> window.location = http_path + "Admin/Default/Index";
                <?php } ?>
                }
                else {
                Message.danger('Ops!, Something went wrong.');
                }
            }
        });
    }
</script>