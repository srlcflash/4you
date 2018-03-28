<?php $form = $this->beginWidget('CActiveForm', array('id' => 'formAddIndustry')); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-content">
                <h5 class="grey-text text-darken-1">Add Industry</h5>

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input id="hiddenId" name="hiddenId" type="hidden" value="0" required>
                            <label>Industry Name</label>
                            <input class="form-control" id="name" name="name" type="text" autocomplete="off" required>
                        </div>
                    </div>
                </div>              

            </div>
            <div class="card-action right-align">
                <button type="button" class="btn btn-default" onclick="clearIndustry()">Clear </button>
                <button id="saveIndustry" type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<!--Data Showing area-->
<div class=" row">
    <div class="col-md-12 ajaxLoad"></div>
</div>

<!-- ===========================================================================
        Custom Script
============================================================================ -->

<script>
    //Delete Input
    $(document).on('click', '.btn-delete-input', function () {
        var clickedId = this.id;
        var id = clickedId.split("_")[1];
        if (id > 0) {
            deleteSubCategory(id);
        }

        $(this).parents('.input-no-label').remove();
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
        loadIndustry();
    });

    function loadIndustry() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Industry/ViewIndustryData'; ?>",
            data: '',
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }

    $("#formAddIndustry").validate({
        submitHandler: function () {
            SaveIndustry();
        }
    });

    function SaveIndustry() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Industry/SaveIndustry'; ?>",
            data: $('#formAddIndustry').serialize(),
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    //Message.success(responce.msg);
                    $("#formAddIndustry")[0].reset();
                    loadIndustry();
                    Animation.hide();
                }
            }
        });
    }

    function loadDataToEdit(data) {

        //Update Text fields
        $(document).ready(function () {
            Materialize.updateTextFields();
            //page Scroll to up
            Scroll.toUp();
        });

        $("#formAddIndustry")[0].reset();
        var industries = data.industryData;

        $('#hiddenId').val(industries.ind_id);
        $('#name').val(industries.ind_name);
    }

    function clearIndustry() {
        $("#formAddIndustry")[0].reset();
        $("#hiddenId").val('0');
        $(document).ready(function () {
            Materialize.updateTextFields();
        });
    }

</script>


