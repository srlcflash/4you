<!--echo  $this->module->assetsUrl-->
<!-- Include external CSS. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"
      type="text/css"/>
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl ?>/css/plugins/editor/codemirror.css">

<!-- Include Editor style. -->
<link href="<?php echo $this->module->assetsUrl ?>/css/plugins/editor/froala_editor.pkgd.min.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo $this->module->assetsUrl ?>/css/plugins/editor/froala_style.min.css" rel="stylesheet"
      type="text/css"/>

<div class="ajaxLoadAdd"></div>
<div class="row">

    <div class="col-md-12">
<!--        <button class="cm-btn add right addNew">
            <i class="material-icons left">&#xE148;</i>Add New
        </button>-->
    </div>

    <div class="col-md-12 addForm hide-block">

    </div>
</div>
<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchAdvertisement'));
?>
<div class="row search-area">
    <div class="col-md-12">
        <div class="card-panel">
            <div class="search-input-wrp grey ">
                <div class="search-input">
                    <i class="material-icons search-icon blue-text text-lighten-3">search</i>
                    <input id="searchText" name="searchAddText" class="input-search" type="text" placeholder="Search" onkeyup="loadAdvertisementData(1)">
                </div>
                <div class="search-action">
                    <button type="button" class="btn-search" onclick="loadAdvertisementData(1)">Search</button>
                </div>
                <div class="search-action">
                    <button type="button" class="btn-flat btnAdvance" >Advance</button>
                </div>
            </div>

            <div class="row hide-block more-panel mt-30">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Category</label>
                        <?php echo Chtml::dropDownList('ref_cat_id', "", CHtml::listData(AdmCategory::model()->findAll(), 'cat_id', 'cat_name'), array('class'=>'form-control','empty' => 'Select Category')); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php
                        $Status = Controller::getActiveFilter();
                        echo Chtml::label('Active Filter', "", array('class' => 'control-label'));
                        ?>    
                        <label>Status</label>
                        <?php echo Chtml::dropdownlist('Status', '', $Status, array('class'=>'form-control','empty' => 'Select Status')); ?>
                    </div>
                </div>

                <!--Action Area-->
                <div class="col-md-12 text-right">
                    <button type="button" class=" btn btn-default btnAdvance">Close</button>
                    <button type="button" class=" btn btn-primary" onclick="loadAdvertisementData(1)">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<div class="row">
    <div class="ajaxLoad col-md-12"></div>
</div>

<script>
    $(document).ready(function (e) {
        loadAdvertisementData(1);
    });

    function loadAdvertisementData(page) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Advertisement/ViewAdvertisementData'; ?>",
            data: $('#searchAdvertisement').serialize() + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }
</script>

<script>
    //Add New
    $('.addNew').on('click', function () {
        $('.addNew,.search-area,.details-cards').slideUp('fast', function () {
            $('.addForm').slideDown('slow');
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Admin/Advertisement/ViewAddAdvertisement'; ?>",
                data: '',
                success: function (responce) {
                    $('.addNew,.search-area,.details-cards').slideUp('fast', function () {
                        $(".ajaxLoadAdd").html(responce);
                        $('.company-form').slideDown('slow');

                    })
                }
            });
        });
    });

    //Close Form
    $('.btn_close').click(function (e) {
        $('.addForm').slideUp('fast', function () {
            $('.search-area,.details-cards').slideDown('slow', function () {
                $('.addNew').slideDown('fast');
            });
        })
    });

    //Card expand script
    $(function () {
        $('.btn_expand').on('click', function () {
            var $this = $(this);
            var card = $this.parents('.expand-card');

            if (!$this.hasClass('expand')) {
                $this.addClass('expand').html('expand_less');
                card.find('.expand-card-content').slideDown('fast');
            } else {
                $this.removeClass('expand').html('expand_more');
                card.find('.expand-card-content').slideUp('fast');
            }
        });
    });

</script>

