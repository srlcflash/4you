<div class="row">
    <div class="col s12">
        <div class="card ">
            <div class="card-content">
                <h5 class="grey-text text-darken-1">Packages</h5>

                <div class="row">
                    <div class="col s12 m8">
                        <div class="input-field">
                            <input type="text">
                            <label>Package Name</label>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="input-field">
                            <input type="text">
                            <label>Amount(LKR)</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col s8 mt-40">
                        <div class="row">
                            <div class="col s4">
                                <h6 class="grey-text text-darken-1">Number of Advertisement/s</h6>
                            </div>
                            <div class="col s6">
                                <div class="row mb-0">
                                    <div class="col s4">
                                        <div class="input-no-label mt-0">
                                            <input class="mb-0 input-adv right-align" type="text">
                                        </div>
                                    </div>
                                    <div class="col s4">
                                        <input type="checkbox" class="filled-in chb-unlimited" id="filled-in-box"/>
                                        <label for="filled-in-box">Unlimited</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col s4">
                        <div class="row">
                            <div class="col 4">
                                <div class="input-field">
                                    <select class="mb-0">
                                        <option value="" disabled selected>Choose Month</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <label>Validity Period</label>
                                </div>
                            </div>
                            <div class="col 4">
                                <h6 class="grey-text text-darken-1 mt-40">Months</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-action right-align">
                <button type="button" class=" btn waves-effect waves-light red lighten-1 btnCleanForm">Clear</button>
                <button type="submit" class="btn waves-effect waves-light blue lighten-1">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="card-panel detail-card outer-tb-15">
    <div class="row mb-0">
        <div class="col s8">
            <h6 class="grey-text text-darken-1 ">lorem ipsum </h6>
        </div>
        <div class="col s4">
            <button class="cm-btn right">
                <i class="material-icons red-text mr-0">delete</i>
            </button>
            <button class="cm-btn right">
                <i class="material-icons grey-text">edit</i>
            </button>
        </div>
    </div>
</div>

<!-- ===========================================================================
        Custom Script
============================================================================ -->
<script>
    $(document).ready(function () {
        $('select').material_select();

        advertisementLimit($('.chb-unlimited'));
    });

    $('.chb-unlimited').on('change', function () {
        advertisementLimit($(this));
    });

    function advertisementLimit(ele) {
        if ($(ele).is(':checked')) {
            $('.input-adv').prop('disabled', true).val('');
        } else {
            $('.input-adv').prop('disabled', false).focus();
        }
    }

</script>

<!-- ===========================================================================
        Backend Script
============================================================================ -->
<script>

    (function () {
        //Page Load

    })();

</script>