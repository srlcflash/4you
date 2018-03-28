<div class="col-md-12 pr-0 mb-15">
    <div class="col-md-12 pr-0">
        <button class="cm-btn large right light-blue-4" onclick="goToPostJob()">Post a Job</button>
    </div>

    <div class="col-md-12">
    </div>
</div>

<div class="col-md-12 pl-30 pr-0 mb-50">
    <table class="data-table td-border-bottom">
        <colgroup>
            <col style="width: 60%">
            <col style="width: 20%">
            <col style="width: 20%">
        </colgroup>
        <thead>
            <tr>
                <th>Title</th>
                <th>Published Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($advertisements as $advertisement) {
                ?>
                <tr>
                    <td>
                        <div class="data"><?php echo $advertisement->ad_title ?></div>
                    </td>
                    <td>
                        <div class="data"><?php echo $advertisement->ad_is_published == 1 ? date('Y-m-d', strtotime($advertisement->ad_published_time)) : "-" ?></div>
                    </td>
                    <td>
                        <div class="data">
                            <?php $statusText = $advertisement->ad_is_published == 2 ? "Published" : ($advertisement->ad_is_published == 0 ? "Not Sent" : "Pending"); ?>
                            <span class="status-text green"><?php echo $statusText ?></span>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <?php
                            if ($advertisement->ad_is_published == 0 || $advertisement->ad_is_published == 1) {
                                ?>
                                <button class="cm-btn small light-blue-4" type="button" id="<?php echo $advertisement->ad_token; ?>" onclick="editAd(this.id)">Edit</button>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!--Back End-->
<script>
    function goToPostJob() {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employer/CreateAdvertisement'; ?>';
    }

    function editAd(id) {
        window.location.href = '<?php echo Yii::app()->baseUrl . '/Employer/ViewPreviewJobAdvertisement/id/'; ?>' + id;
    }
</script>    