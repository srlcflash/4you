<div class="ajaxLoad_purchPackage"></div>

<div class="col-md-12 pl-30 pr-0 mb-50">
    <table class="data-table td-border-bottom">
        <colgroup>
            <col style="width: 15%">
            <col style="width: 10%">
            <col style="width: 10%">
            <col style="width: 10%">
            <col style="width: 10%">
            <col style="width: 10%">
        </colgroup>
        <thead>
        <tr>
            <th>Package</th>
            <th>Start</th>
            <th>Expire</th>
            <th>Used</th>
            <th>Balance</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><div class="data limit l-150">Free</div></td>
            <td><div class="data">1 Oct 2017</div></td>
            <td><div class="data">30 Oct 2017</div></td>
            <td><div class="data">-</div></td>
            <td><div class="data">-</div></td>
            <td>
                <div class="data">
                    <span class="status-text green">Active</span>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="col-md-12 pl-30 pr-0">
    <div class="col-md-12 pl-0 pr-30 package-block">
        <div class="col-md-9">
            <div class="col-md-7">
                <h3 class="f-medium">Free</h3>
                <h4 class="text-orange">0.00 LKR</h4>
            </div>

            <div class="col-md-5">
                <h6 class="text-dark-blue mb-15">
                    <i class="dot mr-5"></i>
                    <span>20 Advertisement(s)</span>
                </h6>

                <h6 class="text-dark-blue">
                    <i class="dot mr-5"></i>
                    <span>Valid 1 Month</span>
                </h6>

            </div>
        </div>

        <div class="col-md-3 mt-30 pr-0">
<!--            <button type="button" class="cm-btn small light-blue right" onclick="">Add Package</button>-->
        </div>
    </div>
</div>

<!--Temporally hide-->
<?php /*foreach ($packages as $package) { */?><!--
    <div class="col-md-12 pl-30 pr-0">
        <div class="col-md-12 pl-0 pr-30 package-block">
            <div class="col-md-9">
                <div class="col-md-7">
                    <h3 class="f-medium"><?php /*echo $package->pack_name; */?></h3>
                    <h4 class="text-orange"><?php /*echo $package->pack_amount; */?> LKR</h4>
                </div>
                <div class="col-md-5">
                    <h6 class="text-dark-blue mb-15">
                        <i class="dot mr-5"></i>
                        <span><?php /*echo $package->pack_is_unlimited == 1 ? "Unlimited" : floor($package->pack_num_of_ads) . ' Advertisement(s)'; */?></span>
                    </h6>
                    <h6 class="text-dark-blue">
                        <i class="dot mr-5"></i>
                        <span>Valid <?php /*echo floor($package->pack_validity_period); */?> Month(s)</span>
                    </h6>
                </div>
            </div>
            <div class="col-md-3 mt-30 pr-0">
                <button type="button" class="cm-btn small light-blue right" onclick="purchasePackage(<?php /*echo $package->pack_id; */?>)">Add Package</button>
            </div>
        </div>
    </div>
--><?php /*} */?>

<script type="text/javascript">
    
    $(document).ready(function (e) {
        //loadPurchPackagesData();
    });

    function loadPurchPackagesData() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employer/ViewPurchasedPackages'; ?>",
            data: '',
            success: function (responce) {
                $(".ajaxLoad_purchPackage").html(responce);
            }
        });
    }
    
    function purchasePackage(id) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Employer/PurchasePackage'; ?>",    
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                       //loadPurchPackagesData();   
                }
            }
        });
    }
</script>