<!--<div class="row expand-card-content mb-0 ">
    <div class="col s12 mt-20">-->
<!--<div class="row mb-0">-->
<div class="col-md-8">
    <ul class="tabs">
        <li class="tab"><a class="pl-0 text-left active" href="#tab1_<?php echo $id; ?>">General</a></li>
        <!--        <li class="tab"><a class="pl-0 left-align" href="#tab2_-->
        <?php //echo $id; ?><!--">Transection</a></li>-->
    </ul>
</div>
<div id="tab1_<?php echo $id; ?>" class="col-md-12 mt-30">

    <div class="row mb-0">
        <div class="col-md-4">
            <div class="row mb-0">
                <div class="col-md-12">
                    <div class="logo-wrp ">
                        <img src="<?php echo Yii::app()->baseUrl ?>/uploads/company/logo/<?php echo $employerData->employer_image; ?>"
                             alt="">
                    </div>
                </div>
                <div class="col-md-12 mt-15">
                    <h5 class="f-18 text-center"><?php echo $employerData->employer_name; ?></h5>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 mb-15">
                    <h6 class="info-title">Address</h6>
                    <h5 class="info-detail"><?php echo $employerData->employer_address; ?></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-15">
                    <h6 class="info-title">Email</h6>
                    <h5 class="info-detail"><?php echo $employerData->employer_email; ?></h5>
                </div>
                <div class="col-md-6 mb-15">
                    <h6 class="info-title">Contact Person</h6>
                    <h5 class="info-detail"><?php echo $employerData->employer_contact_person; ?></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-15">
                    <h6 class="info-title">Contact No</h6>
                    <h5 class="info-detail"><?php echo $employerData->employer_tel; ?></h5>
                </div>
                <div class="col-md-6 mb-15">
                    <h6 class="info-title">Contact No(Optional)</h6>
                    <h5 class="info-detail"><?php echo $employerData->employer_mobi; ?></h5>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary btn-edit">Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div id="tab2_<?php //echo $id; ?>" class="col s12 mt-30">

    <div class="row">
        <div class="col s12">
            <table class="responsive-table bordered striped">
                <thead>
                    <tr>
                        <th style="width: 10%">Inv No</th>
                        <th style="width: 15%">Package</th>
                        <th style="width: 10%">Purchase Date</th>
                        <th style="width: 10%">Expire Date</th>
                        <th style="width: 10%">No of Adv</th>
                        <th style="width: 5%">Used</th>
                        <th style="width: 5%">Balance</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr id="12">
                        <td style="width: 10%">00012</td>
                        <td style="width: 15%">Lorem</td>
                        <td style="width: 10%">12 June 2017</td>
                        <td style="width: 10%">12 Aug 2017</td>
                        <td style="width: 10%">10</td>
                        <td style="width: 5%">2</td>
                        <td style="width: 5%">8</td>
                        <td class="adm-tbl-action_2">
                            <button type="button"
                                    class="btnActive right btn waves-effect waves-light green lighten-1">
                                Active
                            </button>
                        </td>
                    </tr>
                    <tr id="13">
                        <td style="width: 10%">00012</td>
                        <td style="width: 15%">Lorem</td>
                        <td style="width: 10%">12 June 2017</td>
                        <td style="width: 10%">12 Aug 2017</td>
                        <td style="width: 10%">10</td>
                        <td style="width: 5%">2</td>
                        <td style="width: 5%">8</td>
                        <td class="adm-tbl-action_2">
                            <button type="button"
                                    class="btnActive right btn waves-effect waves-light green lighten-1">
                                Active
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>-->

<!--</div>-->


<!--    </div>
</div>-->

<script>

    function getPopupTemplate() {
        var html = null;
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/LoadPaymentPopup'; ?>",
            success: function (res) {
                html = res;
            }
        });

        return html;
    }

    $('.btnActive').on('click', function () {
        var $this = $(this);
        var $rowId = $this.parents('tr').prop('id');

        Modal.show({
            loadAjax: function (modal) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo Yii::app()->baseUrl . '/Admin/Employer/LoadPaymentPopup'; ?>",
                    success: function (res) {
                        $(modal).html(res);
                    }
                });
            }
        });
    });

</script>
