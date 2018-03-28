<?php
foreach ($employers as $employer) {
    ?>
    <div class="row mb-0 company-cards ">
        <div class="col-md-12">
            <div class="card-panel mb-15 expand-card detail-card outer-tb-10">
                <div class="row mb-0 expand-card-head">
                    <div class="col-md-11">
                        <div class="row mb-0">
                            <div class="col-md-6">
                                <h5 class="grey-text text-darken-1 "><?php echo $employer->employer_name; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <h5 class="grey-text text-darken-1"><?php echo $employer->employer_reference_no; ?></h5>
                            </div>
                            <div class="col-md-3">
                                <button id="<?php echo $employer->employer_id; ?>" onclick="publishAdvertisement(this.id)" class="btn btn-default btn-create-add" type="button">Create Advertisement</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 mt-5 right-align">
                        <i id="<?php echo $employer->employer_id; ?>" class="right material-icons btn_expand" onclick="loadEmployerData(this.id,this)">expand_more</i>
                    </div>
                </div>

                <div class="row expand-card-content mb-0 ">
                    <div class="col-md-12 mt-20">
                        <div class="row mb-0">
                            <div class="ajaxLoad"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
}
?>

<div class="col-xs-12 col-md-10 col-md-offset-1">
    <div class="site-pagination">
        <?php
        Paginations::setLimit($limit);
        Paginations::setPage($currentPage);
        Paginations::setJSCallback("viewEmployerData");
        Paginations::setTotalPages($pageCount);
        Paginations::makePagination();
        Paginations::drawPagination();
        ?>
    </div>
</div>


<script>
    function loadTab() {
        $('.company-cards').each(function () {
            $(this).find('ul.tabs').tabs();
        });
    }



    $(function () {
        $('.btn_expand').on('click', function () {
            var $this = $(this);
            var card = $this.parents('.expand-card');

            if (!$this.hasClass('expand')) {
                $this.addClass('expand').html('expand_less');
                card.find('.expand-card-content').slideDown('fast');
                loadTab();
            } else {
                $this.removeClass('expand').html('expand_more');
                card.find('.expand-card-content').slideUp('fast');
            }
        });
    });
    
    
    function loadEmployerData(id,_this) {
        var $parent = $(_this).parents('.expand-card');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/LoadEmployerData'; ?>",
            data: {id: id},
            success: function (responce) {
                $parent.find('.ajaxLoad').html(responce);
            }
        });
    }


    function publishAdvertisement(id) {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/ViewAddAdvertisement'; ?>",
            data: {id: id},
            success: function (responce) {
                $('.search-area,.company-cards').slideUp('fast', function () {
                    $("#ajaxLoadAdd").html(responce);
                    $('.company-form').slideDown('slow');
                    Animation.hide();
                })
            }
        });
    }


</script>