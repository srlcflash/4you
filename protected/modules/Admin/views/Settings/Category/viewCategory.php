<?php $form = $this->beginWidget('CActiveForm', array('id' => 'formAddCategory')); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-content">
                <h5 class="grey-text text-darken-1">Add Category</h5>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input id="hiddenId" name="hiddenId" type="hidden" value="0" required>
                            <label>Category Name</label>
                            <input class="form-control" id="name" name="name" type="text" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category Order</label>
                            <input class="form-control" id="order" name="order" type="text" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-15">
                    <div class="col-md-12">
                        <button type="button" class="cm-btn add right add-new-input">
                            <i class="material-icons left">&#xE148;</i>
                            Add New
                        </button>
                    </div>
                </div>

                <div class="row row-input">
                    <div class="col-md-4">
                        <input id="hiddenSubCatId[]" name="hiddenSubCat[]" type="hidden" value="0" class="hiddenSubCat">
                        <div class="ds-table">

                            <div class="cell">
                                <div class="form-group mb-0">
                                    <input class="form-control" id="subCatId[]" name="subCatName[]" type="text">
                                </div>
                            </div>
                            <div class="cell width-0">
                                <button type="button" id="delSubCatId_0" class="cm-btn btn-delete-input">
                                    <i class="material-icons m-0 red-text">delete</i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-action right-align">
                <button type="button" class="btn btn-default" onclick="clearCategory()">
                    Clear
                </button>
                <button id="saveCategory" type="submit" class="btn btn-primary">Save
                </button>

            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<!--Data Showing area-->
<div class="row">
    <div class="col-md-12 ajaxLoad"></div>
</div>

<!-- ===========================================================================
        Custom Script
============================================================================ -->

<script>

    var i = 0;

    function buildInput(appendEle) {
        i = i + 1;
        //Clear old
        if (arguments[1]) {
            $(appendEle).html('');
        }

        var html = '';
        html += '<div class="col-md-4">';
        html += '<input type="hidden" id="hiddenSubCatId_' + i + '" name="hiddenSubCat[]" value="0" class="hiddenSubCat">';
        html += '<div class="ds-table mb-15">';
        html += '<div class="cell">';
        html += '<div class="form-group mb-0">';
        html += '<input type="text" id="subCatId_' + i + '" name="subCatName[]" class="form-control">';
        html += '</div>';
        html += '</div>';
        html += '<div class="cell width-0">';
        html += '<button id="delSubCatId_0" type="button" class="cm-btn btn-delete-input">';
        html += '<i class="material-icons m-0 red-text">delete</i>';
        html += '</button>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $(appendEle).append($(html));
        $('.input-no-label input[type="text"]').focus();
    }

    //Add new inputs
    $('.add-new-input').on('click', function () {
        buildInput('.row-input');
    });

    //Delete Input
    $(document).on('click', '.btn-delete-input', function () {
        var clickedId = this.id;
        var id = clickedId.split("_")[1];
        if (id > 0) {
            deleteSubCategory(id);
        }

        $(this).parents('.col-md-4').remove();
    });

    //Form clean
    $(document).on('click', '.btn-form-clean', function () {
        buildInput('.row-input', true);
        $('input').val('');
        $(document).ready(function () {
            Materialize.updateTextFields();
        });
    });


</script>

<!-- ===========================================================================
        Backend Script
============================================================================ -->
<script type="text/javascript">
    $(document).ready(function (e) {
        loadCategoryData();
    });

    function loadCategoryData() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Category/ViewCategoryData'; ?>",
            data: '',
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }

    $("#formAddCategory").validate({
        submitHandler: function () {
            SaveCategory();
        }
    });

    function SaveCategory() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Category/SaveCategory'; ?>",
            data: $('#formAddCategory').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    //Message.success(responce.msg);
                    $("#formAddCategory")[0].reset();
                    $('.row-input > .col-md-4 input[type="text"]').attr('value', '');
                    $('.row-input > .col-md-4').not(':first').remove();
                    loadCategoryData();
                    Animation.hide();
                }
            }
        });
    }

    function loadDataToEdit(data) {

        //Update Text fields
        $(document).ready(function () {
            //page Scroll to up
            Scroll.toUp();
        });

        $("#formAddCategory")[0].reset();
        var categories = data.categoryData;
        var subCategories = data.subCategoryData;

        $('#hiddenId').val(categories.cat_id);
        $('#name').val(categories.cat_name);
        $('#order').val(categories.cat_order);

        if (subCategories.length > 0) {
            $('.row-input > .col-md-4').remove();
        } else {
            $('.row-input > .col-md-4 input[type="text"]').attr('value', '');
            $('.row-input > .col-md-4').not(':first').remove();
        }

        for (var i = 0, max = subCategories.length; i < max; i++) {
            var html = '';
            html += '<div class="col-md-4">';
            html += '<input type="hidden" id="hiddenSubCatId_' + i + '" name="hiddenSubCat[]" value="' + subCategories[i]['scat_id'] + '" class="hiddenSubCat">';
            html += '<div class="ds-table mb-15">';
            html += '<div class="cell">';
            html += '<div class="form-group mb-0">';
            html += '<input type="text" id="subCatId_' + i + '"  name="subCatName[]" value="' + subCategories[i]['scat_name'] + '" class="form-control">';
            html += '</div>';
            html += '</div>';
            html += '<div class="cell width-0">';
            html += '<button id="delSubCatId_' + subCategories[i]['scat_id'] + '" class="cm-btn btn-delete-input">';
            html += '<i class="material-icons m-0 red-text">delete</i>';
            html += '</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            $('.row-input').append(html);
        }
    }

    function deleteSubCategory(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Category/DeleteSubCategory'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    Message.success(responce.msg);
                }
            }
        });
    }

    function clearCategory() {
        $("#formAddCategory")[0].reset();
        $('.col-md-4 input[type="text"]').attr('value', '');
        $('.row-input > .col-md-4').not(':first').remove();
    }

</script>
