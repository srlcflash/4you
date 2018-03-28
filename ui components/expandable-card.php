<div class="card-panel expand-card detail-card outer-tb-15">
    <div class="row mb-0 expand-card-head">
        <div class="col s11">
            <div class="row mb-0">
                <div class="col s6">
                    <h6 class="grey-text text-darken-1 ">Abc Company</h6>
                </div>
                <div class="col s3">
                    <h6 class="grey-text text-darken-1">E0023</h6>
                </div>
            </div>
        </div>
        <div class="col s1 mt-5">
            <i class="right material-icons btn_expand">expand_more</i>
        </div>
    </div>

    <div class="row expand-card-content mb-0 ">
        <div class="col s12 mt-20">
            Content
        </div>
    </div>
</div>

<script>
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