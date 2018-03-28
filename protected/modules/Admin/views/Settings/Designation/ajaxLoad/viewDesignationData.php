<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-content">

                <h5 class="grey-text text-darken-1">Designations</h5>

                <table class="responsive-table bordered table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $row = 1;
                        foreach ($designations as $designation) {
                            ?>
                            <tr>
                                <td><?php echo $row; ?></td>
                                <td><?php echo $designation->desig_name; ?></td>
                                <td><?php
                                    $category = AdmCategory::model()->findByPk($designation->ref_cat_id);
                                    echo $category->cat_name;
                                    ?></td>
                                <td class="adm-tbl-action_2">
                                    <a id="<?php echo $designation->desig_id; ?>" onclick="editDesignation(this.id)"><i class="material-icons grey-text lighten-2">mode_edit</i></a>
                                    <a id="<?php echo $designation->desig_id; ?>" onclick="deleteDesignation(this.id)"><i class="material-icons red-text lighten-2">delete</i></a>
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
    function deleteDesignation(id) {
        function _deleteDesignation(id) {
            $.ajax({
                type: 'POST',
                url: "<?php echo Yii::app()->baseUrl . '/Admin/Designation/DeleteDesignation'; ?>",
                data: {id: id},
                dataType: 'json',
                success: function (responce) {
                    if (responce.code == 200) {
                        $("#formAddDesignation")[0].reset();
                        loadDesignation();
                    }
                }
            });
        }

        Alert.confirm({
            confirmed: function () {
                _deleteDesignation(id);
            }
        });

    }

    function editDesignation(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Admin/Designation/GetEditDesignationData'; ?>",
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