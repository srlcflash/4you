
<div class="modal-dialog" role="">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="f-24 grey-text lighten-1 text-center">Logo Upload</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="image-editor">

                            <div class="cropit-preview border-8 m-auto"></div>

                            <div class="mt-15 file-uploader ds-block m-auto width-100 u-small mb-15">
                                <div class="button">Brows...</div>
                                <input type="file" class="cropit-image-input">
                            </div>

                            <div class="row mb-10">
                                <div class="col-md-6 col-md-offset-3">
                                    <input type="range" min="0" max="100" value="1" class="cropit-image-zoom-input">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary export">Export</button>
        </div>
    </div><!-- /.modal-content -->
</div>

<!--JS | Image Crop-->

<script src="<?php echo Yii::app()->baseUrl . '/js/lib/jquery.2.0.0.js'; ?>"></script>
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
            profileImage(imageData);

            $uploadModal.modal('hide');
        });
    });
</script>