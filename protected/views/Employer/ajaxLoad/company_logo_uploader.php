<h3 class="text-black mb-50 text-center">Logo Upload</h3>
<div class="image-editor">


    <div class="cropit-preview"></div>

    <div class="mt-15 file-uploader u-small mb-15">
        <div class="button">Brows...</div>
        <input type="file" class="cropit-image-input">
    </div>

    <div class="row mb-10">
        <div class="col-md-8 col-md-offset-2">
            <input type="range" min="0" max="100" value="1" data-rangeslider class="rangeSlide cropit-image-zoom-input">
        </div>
    </div>

    <button type="button" class="cm-btn light-blue right export">Export</button>

</div>

<!--JS | Image Crop-->

<script src="<?php echo Yii::app()->baseUrl . '/js/plugins/cropit/jquery.cropit.js'; ?>"></script>

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

            alert(imageData);
        });
    });
</script>