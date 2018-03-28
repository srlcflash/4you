<div class="modal-content">

    <div class="row mb-0">
        <div class="col s12 mb-30">
            <h4>Payment Method</h4>
        </div>
    </div>


    <div class="col s12">
        <form action="#">

            <div class="col s12">
                <div class="row">
                    <div class="col s4">
                        <input class="paymentRadio" data-show="amount" name="group1" type="radio" id="cash"
                               checked="checked"/>
                        <label for="cash">Cash</label>
                    </div>
                    <div id="amount" class="col s4 hiding-block">
                        <div class="input-field mt-0">
                            <input name="" type="text">
                            <label>Amount</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s4">
                        <input class="paymentRadio" data-show="payslip" name="group1" type="radio" id="bank"/>
                        <label for="bank">Bank</label>
                    </div>
                    <div id="payslip" class="col s6 hide-block hiding-block">
                        <button type="button" class="download-payslip cm-btn download">
                            <i class="material-icons left">arrow_downward</i>Download Pay Slip
                        </button>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col s4">
                        <input class="paymentRadio" data-show="cheques" name="group1" type="radio" id="cheque"/>
                        <label for="cheque">Cheque</label>
                    </div>
                    <div id="cheques" class="col s12 hide-block hiding-block">

                        <div class="col s4">
                            <div class="input-field">
                                <input name="" type="text">
                                <label class="">Cheque No</label>
                            </div>
                        </div>

                        <div class="col s4">
                            <div class="input-field">
                                <input type="text" class="datepicker">
                                <label class="">Date</label>
                            </div>
                        </div>

                        <div class="col s4">
                            <div class="input-field">
                                <input name="" type="text">
                                <label class="">Bank</label>
                            </div>
                        </div>

                        <div class="col s4">
                            <div class="input-field">
                                <input name="" type="text">
                                <label class="">Branch</label>
                            </div>
                        </div>

                        <div class="col s4">
                            <div class="input-field">
                                <input name="" type="text">
                                <label class="">Amount</label>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </form>
    </div>


</div>
<div class="modal-footer">
    <a href="#!" class="btnClose btn waves-effect waves-light red lighten-1 waves-green">Cancel</a>
    <a href="#!" class="btnSave btn waves-effect waves-light green lighten-1 waves-green">Confirm</a>
</div>


<script>

    $('.btnSave').on('click', function () {
        Modal.close();
    });

    $('.btnClose').on('click', function () {
        Modal.close();
    });


    $(document).ready(function () {
        $('select').material_select();
    });

    $('.paymentRadio').on('change', function () {
        var $this = $(this);
        var show = $this.data('show');

        $('.hiding-block').hide();

        $('#' + show).show();

    });

    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false
    });
</script>