<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">

                <h5 class="grey-text text-darken-1">Industries</h5>

                <table class="responsive-table table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $row = 1;
                        foreach ($industries as $industry) {
                            ?>
                            <tr>
                                <td><?php echo $row; ?></td>
                                <td><?php echo $industry->ind_name; ?></td>
                                <td class="adm-tbl-action_2">
                                    <a id="<?php echo $industry->ind_id; ?>" onclick="editIndustry(this.id)"><i class="material-icons grey-text lighten-2">mode_edit</i></a>
                                    <a id="<?php echo $industry->ind_id; ?>" onclick="deleteIndustry(this.id)"><i class="material-icons red-text lighten-2">delete</i></a>
                                </td>
                            </tr>
                            <?php
                            $row++;
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
    function deleteIndustry(id) {
        function _deleteIndustry(id) {
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Admin/Industry/DeleteIndustry'; ?>",
                data: {id: id},
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        $("#formAddIndustry")[0].reset();
                        loadIndustry();
                    }
                }
            });
        }

        Alert.confirm({
            confirmed: function () {
                _deleteIndustry(id);
            }
        });
    }

    function editIndustry(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Industry/GetEditIndustryData'; ?>",
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