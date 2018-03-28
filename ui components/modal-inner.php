<div class="modal-content">
    <div class="col s12 mb-30">
        <h4>Payment Method</h4>
    </div>

    <div class="col s12">
        <div class="row">
            <div class="col s12">
                <div class="input-field">
                    <select name="" id="">
                        <option value="" disabled selected></option>
                        <option value="1">Baby</option>
                    </select>
                    <label class="">Package Name</label>
                </div>
            </div>
            <div class="col s4">
                <h6 class="f-12 grey-text text-darken-1">Price</h6>
                <h5 class="f-14 grey-text text-darken-3">2300 LKR</h5>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer">
    <a href="#!" class="btnSave waves-effect waves-green btn-flat">Save</a>
</div>


<script>

    $('.btnSave').on('click', function () {
        Modal.close();
    });

    $(document).ready(function () {
        $('select').material_select();
    });
</script>