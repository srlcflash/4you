<div class="col s12 input-no-label">
    <input type="text" class="pr-20" placeholder="Highest Professional Qualification">
    <button class="cm-btn ps-absolute right-5 btn-delete-input">
        <i class="material-icons m-0 red-text">delete</i>
    </button>
</div>

<script>
    $('.btn-delete-input').on('click',function () {
        $(this).parents('.input-no-label').remove();
    });
</script>