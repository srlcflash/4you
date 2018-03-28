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

<div class="row mb-15">
    <div class="col-md-12">
        <button class="cm-btn add right addNewCompany" type="button" onclick="addEmployer()">
            <i class="material-icons left">&#xE148;</i>Add New
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-12" id="ajaxLoadAdd"></div>
</div>


<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'searchEmployer'));
?>
<div class="row search-area ">

    <div class="col-md-12">
        <div class="card-panel">
            <div class="search-input-wrp">
                <div class="search-input">
                    <i class="material-icons search-icon">search</i>
                    <input name="searchEmployerText" class="input-search" type="text" placeholder="Search"
                           onkeyup="viewEmployerData(1)">
                </div>
                <div class="search-action">
                    <button class="btn btn-search">Search</button>
                </div>
                <div class="search-action">
                    <button type="button" class="btn-flat">Advance</button>
                    <!--<button class="waves-effect waves-teal btn-flat btnAdvance">Advance</button>-->
                </div>
            </div>
            <div class="row hide-block more-panel">
                <div class="col-md-4">
                    <div class="input-field">
                        <input type="text">
                        <label>Label</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-field">
                        <input type="text">
                        <label>Label</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-field">
                        <input type="text">
                        <label>Label</label>
                    </div>
                </div>

                <!--Action Area-->
                <div class="col-md-12 right-align">
                    <button type="button" class=" btn waves-effect waves-light btnAdvance red">Close</button>
                    <button type="button" class=" btn waves-effect waves-light deep-orange">Search</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 ajaxLoad"></div>
</div>
<?php $this->endWidget(); ?>

<script>


    $(document).ready(function (e) {
        viewEmployerData(1);
    });

    function viewEmployerData(page) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/ViewEmployerData'; ?>",
            data: $('#searchEmployer').serialize() + "&page=" + page,
            success: function (responce) {
                $(".ajaxLoad").html(responce);
            }
        });
    }

    function addEmployer() {

        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/EmployerAdd'; ?>",
            data: '',
            success: function (responce) {
                $('.search-area,.company-cards').slideUp('fast', function () {
                    $("#ajaxLoadAdd").html(responce).slideDown('fast');
                    $('.company-form').slideDown('slow');

                })
            }
        });
    }

</script>