<section class="main-block" id="searchContent">
    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1 col-xs-12">
                <div class="row">
                    <div class="total-jobs col-xs-12">
                        <h4><?php echo count($data) + (($currentPage - 1) * $limit); ?>
                            <span>of</span><?php echo $pageCount; ?></h4>
                    </div>

                    <div id="jobs" class="job-list-wrap col-xs-12">

                        <ul class="float-block job-list">
                            <?php
//                            $adPublishedTime = date('Y-m-d H:i:s');
                            foreach ($data as $value) {
                                if (date('Y-m-d', strtotime($value->ad_published_time)) == date('Y-m-d') && (strtotime(date('Y-m-d H:i:s')) - strtotime($value->ad_published_time)) > 3600) {
                                    $datetime1 = new DateTime($value->ad_published_time);
                                    $datetime2 = new DateTime(date('Y-m-d H:i:s'));

                                    $interval = $datetime1->diff($datetime2);
                                    $adPublishedTime = $interval->format('%h') . " hrs";
                                } elseif (date('Y-m-d', strtotime($value->ad_published_time)) == date('Y-m-d') && (strtotime(date('Y-m-d H:i:s')) - strtotime($value->ad_published_time)) < 3600) {
                                    $datetime1 = strtotime(date('H:i:s'));
                                    $datetime2 = strtotime(date('H:i:s', strtotime($value->ad_published_time)));
                                    $adPublishedTime = (($datetime1 - $datetime2) - (($datetime1 - $datetime2) % 60)) / (60);

                                    $adPublishedTime = $adPublishedTime . " min";
                                } elseif (date('Y-m-d', strtotime($value->ad_published_time)) < date('Y-m-d')) {
                                    $datetime1 = strtotime(date('Y-m-d'));
                                    $datetime2 = strtotime(date('Y-m-d', strtotime($value->ad_published_time)));
                                    $adPublishedTime = ($datetime1 - $datetime2) / (24 * 3600);

                                    $adPublishedTime = ($adPublishedTime < 2) ? $adPublishedTime . " day" : $adPublishedTime . " days";
                                }

                                $title = $value->ad_is_use_desig_as_title == 1 ? $value->desig_name : $value->ad_title;
                                $encryptedAdId = $value->ad_id;
                                ?>
                                <li id="<?php echo $encryptedAdId; ?>">
                                    <input type="hidden" id="currentPage" name="currentPage"
                                           value="<?php echo $currentPage; ?>">
                                    <a href="<?php echo Yii::app()->baseUrl . '/Advertisement/ViewAdvertisement/id/' . $currentPage . '-' . $encryptedAdId; ?> ">
                                        <div class="row">
                                            <div class="col-md-12 mb-15">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h3><?php echo $title; ?></h3>
                                                    </div>

                                                    <div class="col-md-4 mt-6 text-right">
                                                        <h6>
                                                            <span><?php echo $value->employer_name; ?></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-10 hidden-xs">
                                                        <ul class="more-details-list">
                                                            <li>
                                                                <i class="dot"></i>
                                                                <?php echo $value->wt_name; ?>
                                                            </li>
                                                            <li>
                                                                <i class="dot"></i>
                                                                <?php echo explode('.', $value->ad_expected_experience)[0]; ?>
                                                                Yrs
                                                            </li>
                                                            <li>
                                                                <i class="dot"></i>
                                                                <?php echo $value->city_name; ?>
                                                            </li>
                                                            <li>
                                                                <i class="dot"></i>
                                                                <?php
                                                                $salary = $value->ad_is_negotiable == 0 ? $value->ad_salary : "Negotiable";
                                                                echo $salary;
                                                                ?>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <span class="time-left"><?php echo $adPublishedTime; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>

                        </ul>

                    </div>


                </div>

            </div>

            <!--Focus on this '<?php // echo $adId;   ?>'-->
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <div class="site-pagination">
                    <?php
                    Paginations::setLimit(10);
                    Paginations::setPage($currentPage);
                    Paginations::setJSCallback("loadAdvertisementData");
                    Paginations::setTotalPages($pageCount);
                    Paginations::makePagination();
                    Paginations::drawPagination();
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    var focusId = <?php echo $adId; ?>;

    $('html, body').animate({
        //scrollTop: ($("#" + focusId).delay(2000).offset().top + 400)
    }, 1000);

</script>