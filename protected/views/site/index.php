<?php
//CSS
//mScroll CSS
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/plugins/scrollbar/jquery.mCustomScrollbar.min.css', 'screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/site.css', 'screen');
// mScroll Bar
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js', CClientScript::POS_HEAD);
?>




<?php $form = $this->beginWidget('CActiveForm', array('id' => 'frmSearch')); ?>
<section class="main-block search-section gradient full-height ">
    <div class="container">
        <div class="row">

            <div class="col-md-12 main-title" id="title">
                <h1>Find a job that fits your life style</h1>
                <!--                <h3>Simply dummy text of the printing and typesetting industry</h3>-->
            </div>

            <div id="searchWrapper" class="col-sm-12 col-md-10 col-md-offset-1">

                <div class="col-sm-12 search-area search-box">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 hidden-xs job-drop-down show-category">
                            <div class="selected-item">
                                <span>Job Category</span>
                                <i class="icon icon-20 icon-arrow-down right"></i>
                            </div>
                            <div class="list"></div>
                        </div>
                        <div class="col-md-8 col-xs-12 col-sm-6 job-input">
                            <input id="searchText" name="searchText" autocomplete="off" type="text"
                                   placeholder="Type Job Title, Keyword or Company Name">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 hidden-xs filters">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <h4 class="subCategory ">Sub Category</h4>
                        </div>
                        <div class="col-md-8 col-sm-6">
                            <div class="row">
                                <div class="selector-wrap col-xs-12 col-sm-4 col-md-3">
                                    <div class="selector">
                                        <div class="selected-option">
                                            <span>Type</span>
                                        </div>
                                        <ul class="option-list"></ul>
                                        <?php echo Chtml::dropDownList('wt_id', "", CHtml::listData(AdmWorkType::model()->findAll(), 'wt_id', 'wt_name'), array('empty' => 'Type', 'onchange' => 'loadAdvertisementData(1-1)')); ?>
                                    </div>
                                </div>
                                <div class="selector-wrap col-xs-12 col-sm-4 col-md-4 lg-ml-20">
                                    <div class="selector">
                                        <div class="selected-option">
                                            <span>District</span>
                                        </div>
                                        <ul class="option-list"></ul>
                                        <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('empty' => 'District', 'onChange' => 'loadCities()'), array('order' => 'district_name')); ?>
                                    </div>
                                </div>
                                <div class="selector-wrap col-xs-12 col-sm-4 col-md-4 lg-ml-20">
                                    <div class="selector citySelector">
                                        <div class="selected-option">
                                            <span>City</span>
                                        </div>
                                        <ul id="citiesList" class="option-list"></ul>
                                        <select id="cities" name="cities"
                                                onchange="loadAdvertisementData(1 - 1)"></select>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>
<?php $this->endWidget(); ?>
<!------------------------------------
Search Result Section
------------------------------------->
<div id="ajaxLoadAdvertisements">

</div>


<!--JS | Server js-->
<script src="<?php echo Yii::app()->baseUrl . '/js/custom/index.server.js'; ?>"></script>

<!--JS | Main js-->
<script src="<?php echo Yii::app()->baseUrl . '/js/custom/site.js'; ?>"></script>

<script>
    $(document).ready(function (e) {
        loadAdvertisementData('<?php echo $page != NULL ? $page : "1-1" ?>');
    });

    $('#searchText').keyup(function () {
        loadAdvertisementData("1-1");
    });

    var loaderHtml = "<div class='absolute' id='loadingmessage'><img src='<?php echo Yii::app()->baseUrl; ?>/images/system/loader/frontLoader.gif'/></div>";

    var currentRequest = null;

    function loadAdvertisementData(page) {
        $("#ajaxLoadAdvertisements").html(loaderHtml);

        var catId = null;
        var subCatId = null;
        catId = MAIN_ID !== undefined ? MAIN_ID.split("_")[1] : 0;
        subCatId = SUB_ID !== undefined ? SUB_ID.split("_")[1] : 0;

        currentRequest = jQuery.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Advertisement/ViewAdvertisementsData'; ?>",
            data: $('#frmSearch').serialize() + "&catId=" + catId + "&subCatId=" + subCatId + "&page=" + page + "&Status='active'",
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (responce) {
                $("#ajaxLoadAdvertisements").html(responce);
                scrollFun();
                // scrollToDown()
            }
        });
    }


    $('#district_id').on('change', function () {
        //$('#cities').parents('.selector').find('.selected-option span').html('City')
    });

    function loadCities() {
        $("#cities").empty();

        var id = $('#district_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Site/GetCitiesByDistrictID'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var cities = responce.data.cityData;
                    $('#cities').append(
                        $("<option></option>")
                            .attr("value", 0)
                            .text("City")
                    );
                    for (var i = 0, max = cities.length; i < max; i++) {
                        $('#cities').append(
                            $("<option>aaaa</option>")
                                .attr("value", cities[i]['city_id'])
                                .text(cities[i]['city_name'])
                        );
                    }

                    setTimeout(function () {
                        Select.init('.citySelector');
                    }, 200)

                    loadAdvertisementData(1);
                }
            }
        });
    }
</script>