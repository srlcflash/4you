<h3 class="text-black mb-50 text-center">Upload Logo</h3>
<div class="image-editor">


    <div class="col-md-12">
        <div class="cropit-preview with-border bd-width-6 m-auto"></div>
    </div>

    <div class="col-md-12 align-center">
        <div class="mt-15 file-uploader u-small mb-15">
            <div class="button">Brows...</div>
            <input type="file" class="cropit-image-input">
        </div>
    </div>

    <div class="col-md-12 mb-10">
        <input type="range" min="0" max="100" value="1" data-rangeslider class="rangeSlide cropit-image-zoom-input">
    </div>

    <div class="col-md-12">
        <!--        <div class="cm-message success">Save Success</div>-->

        <button type="button" class="cm-btn light-blue right export">Upload</button>
    </div>

</div>

<!--JS | Image Crop-->
<script src="<?php echo Yii::app()->baseUrl; ?>/js/lib/jquery.2.0.0.js"></script>
<script src="<?php echo Yii::app()->baseUrl; ?>/js/plugins/cropit/jquery.cropit.js"></script>

<script>


    $(function () {
        $('.image-editor').cropit({
            imageState: {
                src: './../images/system/other/212x114.png',
            },
            width: 212,
            height: 114,
            imageBackgroundBorderWidth: 15 // Width of background border
        });

        $('.export').click(function () {
            var imageData = $('.image-editor').cropit('export', {
                type: 'image/jpeg'
            });

            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Employer/UploadLogo'; ?>",
                data: {imageData: imageData},
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        imageCropData.set(responce.data.fileName);
                        imageCropData.trigger('updateImage',responce.data.fileName);
                        Popup.hide();
                    }
                }
            });
        });
    });
</script>
