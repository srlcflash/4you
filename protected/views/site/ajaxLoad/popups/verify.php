<div class="row">

    <div class="col-md-12 mt-60 mb-60">

        <div class="row text-center">
            <div class="col-md-12 mb-30">
                <span class="verify-icon-mail icon icon-70 icon-mail">
                    <i class="tick s-28 green"></i>
                </span>
            </div>

            <div class="col-md-12">
                <h3 class="text-black mb-52">Please Verify Your Email</h3>

                <p class="f-18 text-black text-light-2 mb-45">
                    You may get an email with a verification link. Once your email address is verified, you can log in to the system
                    
                </p>

                <p class="f-18 text-black text-light-2">Still didn’t get email <a href="javascript:resend()" class="text-orange f-18 hover">Resend</a></p>

            </div>
        </div>

    </div>

</div>


<script>

    function resend() {
        $.ajax({
            type: 'GET',
            url: "<?php echo Yii::app()->baseUrl . '/Site/ResendPopup'; ?>",
            data: {accessKey: '<?php echo $accessKey; ?>'},
            success: function (res) {
                Popup.loadNewLayout(res);
                Popup.addClass('size-50');
            }
        });
    }

</script>

