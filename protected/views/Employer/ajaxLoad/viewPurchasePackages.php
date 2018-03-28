<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">

                <h5 class="grey-text text-darken-1">Packages</h5>

                <table class="responsive-table bordered striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>No: Of Ads</th>
                            <th>Validity (Months)</th>
                            <th>Effective Date</th>
                            <th>Expire Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($purchaseedpackages as $purchpackages) { 
                            ?>
                            <tr>
                                <td><?php echo $purchpackages->epp_pack_name; ?></td>
                                <td><?php echo $purchpackages->epp_pack_amount; ?></td>
                                <td><?php echo $purchpackages->epp_pack_is_unlimited == 1 ? "Unlimited" : floor($purchpackages->epp_pack_num_of_ads); ?></td>
                                <td><?php echo floor($purchpackages->epp_pack_validity_period); ?></td>
                                <td class="adm-tbl-action_2">
                                    <a id="<?php echo $purchpackages->epp_id; ?>" onclick="deletePackage(this.id)"><i class="material-icons red-text lighten-2">delete</i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var row = 0;
    function editPackage(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Package/GetEditPackageData'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    loadDataToEdit(responce.data);
                }
            }
        });
    }
</script>