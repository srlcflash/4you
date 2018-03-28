<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formContactUs',
    'stateful' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
    )));
?>
<div class="nav-bar-space"></div>

<section class="main-block top-space-block">
    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-8 col-md-offset-2 mb-30">
                <div class="row mb-20">
                    <div class="col-md-12">
                        <div class="input-wrapper">
                            <input type="text" name="name" id="name">
                            <div class="float-text">Name</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="input-wrapper">
                            <input type="email" name="email" id="email">
                            <div class="float-text">Email</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-wrapper">
                            <input type="text" name="contactNo">
                            <div class="float-text">Contact No.</div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-wrapper">
                            <textarea name="message" cols="30" rows="10"></textarea>
                            <div class="float-text">Message</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="cm-btn large light-blue-4 up-case right">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->endWidget(); ?>

<script>
    $('#formContactUs').submit(function (e) {
        e.preventDefault();
        var $form = $(this);

        if (!$form.valid())
            return;

        send();

    });

    function send() {
        $.ajax({
            url: "<?php echo Yii::app()->baseUrl . '/Contact/SendInquiry'; ?>",
            type: 'POST',
            data: $('#formContactUs').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    document.getElementById("formContactUs").reset();
                } else {
                    $('.message').Error(responce.msg);
                }
            }
        });
    }

</script>
