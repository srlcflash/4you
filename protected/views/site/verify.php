<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formVerify',
    'stateful' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
    )));
?>
<div class="nav-bar-space"></div>
<div class="col-md-12 text-center mt-50">
    <div class="row">
        <div class="col-md-12">

            <h2 class="mb-30">
                <span class="icon icon-55 icon-check v-middle"></span>
                <span class="text-black pl-15">Account Verification is Successful</span>
            </h2>

            <h4 class="text-black text-light-2">User Name</h4>
            <h3 class="text-orange"><?php echo $userName; ?></h3>

        </div>
        <div class="mt-35 col-md-4 pl-60 pr-60 pt-50 pb-50 col-md-offset-4 shadow-card">
            <div class="row">
                <h4 class="text-black text-light-2 f-20 col-md-12">Enter your Password to Continue...</h4>
                <div class="col-md-10 col-md-offset-1 mt-5">
                    <div class="input-wrapper">
                        <input id="password" name="password" type="password" onkeyup="validatePassword()"
                               pattern="(?=.*\d)(?=.*[A-Z]).{8,}" required>
                        <div class="float-text">Password</div>
                        <span id="statusPassword" class="status invalid"></span>
                    </div>
                    <div class="input-wrapper">
                        <input id="repassword" name="repassword" type="password" required onkeyup="validatePassword()">
                        <div class="float-text">Re-enter Password</div>
                        <span id="statusMatchPassword" class="status invalid"></span>
                    </div>
                    <div class="float-block mt-15">
                        <button type="submit" class="cm-btn large text-uppercase light-blue right formBtn">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<script>
    //disabled Submit buton
    $(function () {
        $('.formBtn').Button({disabled: true});
    });

    $('#repassword').bind("cut copy paste", function (e) {
        e.preventDefault();
    });

    function validatePassword() {
        var passwordInput = $("#password");
        var rePasswordInput = $("#repassword");
        var result = false;
        // Validate length
        if (passwordInput.val().length >= 6) {
            $('#statusPassword').removeClass("invalid");
            $('#statusPassword').addClass("valid");

            if (passwordInput.val() === rePasswordInput.val()) {
                $('#statusMatchPassword').removeClass("invalid").addClass("valid");

                //enabled Submit button
                $('.formBtn').Button({disabled: false});

                result = true;
            } else {
                $('#statusMatchPassword').removeClass("valid").addClass("invalid");
                $('.formBtn').Button({disabled: true});
                result = false;
            }

        } else {
            $('#statusPassword').removeClass("valid");
            $('#statusPassword').addClass("invalid");
            result = false;
        }

        return result;

    }

    $('#formVerify').submit(function (e) {
        e.preventDefault();

        var $form = $(this);

        if (!$form.valid())
            return;
        Animation.load('body');
        //disabled Submit button
        $('.formBtn').Button({disabled: true});

        if (validatePassword() === true) {
            $.ajax({
                url: "<?php echo Yii::app()->baseUrl . '/site/PasswordSave'; ?>",
                type: 'POST',
                data: $('#formVerify').serialize() + '&accessId=<?php echo $accessId; ?>',
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        $('.message').Success(responce.msg);
                        setTimeout(function () {
                            Animation.hide();
                            var url = '<?php echo Yii::app()->baseUrl; ?>' + responce.data.url + '/id/' + '<?php echo $accessId; ?> ';
                            window.location.href = url;
                        }, 800)

                    } else {
                        $('.message').Error(responce.msg);
                    }
                }
            });
        } else {
            //Invalid password
            $('.formBtn').Button({disabled: true});
        }

    });
</script>