<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">

                <h5 class="grey-text text-darken-1">Packages</h5>

                <table class="responsive-table table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>No: Of Ads</th>
                            <th>Validity (Months)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($packages as $package) { 
                            ?>
                            <tr>
                                <td><?php echo $package->pack_name; ?></td>
                                <td><?php echo $package->pack_amount; ?></td>
                                <td><?php echo $package->pack_is_unlimited == 1 ? "Unlimited" : floor($package->pack_num_of_ads); ?></td>
                                <td><?php echo floor($package->pack_validity_period); ?></td>
                                <td class="adm-tbl-action_2">
                                    <a id="<?php echo $package->pack_id; ?>" onclick="editPackage(this.id)"><i class="material-icons grey-text lighten-2">mode_edit</i></a>
                                    <a id="<?php echo $package->pack_id; ?>" onclick="deletePackage(this.id)"><i class="material-icons red-text lighten-2">delete</i></a>
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
    function deletePackage(id) {
        function _deletePackage(id) {
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Admin/Package/DeletePackage'; ?>",
                data: {id: id},
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        $("#formAddPackages")[0].reset();
                        loadPackagesData();
                    }
                }
            });
        }

        Alert.confirm({
            confirmed: function () {
                _deletePackage(id);
            }
        });
    }

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