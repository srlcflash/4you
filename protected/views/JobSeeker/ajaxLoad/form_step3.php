<?php
$form = $this->beginWidget('CActiveForm', array('id' => 'formStepThree',
    'stateful' => true,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'novalidate' => 'novalidate',
        )));
?>
<div class="col-md-12 ">
    <div class="row mb-15">
        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Industry</span>
                </div>
                <ul class="option-list"></ul>

                <?php echo Chtml::dropDownList('ind_id', "", CHtml::listData(AdmIndustry::model()->findAll(), 'ind_id', 'ind_name'), array('empty' => 'Select Industry', 'required' => 'required')); ?>
            </div>
        </div>

    </div>

    <div class="row mb-15">
        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Category (Field)</span>
                </div>
                <ul class="option-list"></ul>
                <?php echo Chtml::dropDownList('cat_id', "", CHtml::listData(AdmCategory::model()->findAll(array('order' => 'cat_order')), 'cat_id', 'cat_name'), array('empty' => 'Select Category', 'required' => 'required', 'onChange' => 'loadSubCategories()')); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Sub Category</span>
                </div>
                <ul class="option-list"></ul>

                <select class="type" name="subCategories" id="subCategories" required>
                    <option id="0">Select Sub Category</option>
                </select>
            </div>
        </div>

    </div>


    <div class="row mb-15">

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>Expected Job title</span>
                </div>
                <ul class="option-list"></ul>

                <select class="type" name="designations" id="designations" required>

                </select>
            </div>
        </div>

    </div>

    <div class="row mb-15">

        <div class="col-md-6 mt-30">
            <div class="d-table work-type">
                <?php
                foreach ($workTypes as $workType) {
                    ?>
                    <div class="d-table-cell">
                        <input type="checkbox" id="<?php echo $workType->wt_id; ?>"
                               name="<?php echo 'workType_' . $workType->wt_id; ?>" value="<?php echo $workType->wt_id; ?>">
                        <label for="<?php echo $workType->wt_id; ?>"><?php echo $workType->wt_name; ?></label>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>

    </div>


    <div class="row mb-15">
        <div class="col-md-6">
            <h6 class="text-black text-light-2 f-12 mb-2">Relevant No of years Experience</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-wrapper mb-0 text-top">
                        <span class="side-label">Year</span>
                        <input class="mt-0" id="experienceYears" name="experienceYears" type="text" value="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-wrapper mb-0 text-top">
                        <span class="side-label">Month</span>
                        <input class="mt-0" id="experienceMonths" name="experienceMonths" type="text" value="0">
                    </div>
                </div>
            </div>

            <!--            <div class="input-wrapper">-->
            <!--                <input id="experience" name="experience" type="text" required>-->
            <!--                <div class="float-text">Relevant No of years Experience</div>-->
            <!--            </div>-->
        </div>
        <div class="col-md-6">
            <div class="input-wrapper">
                <input id="salary" name="salary" type="text">
                <div class="float-text">Expected Monthly Salary (LKR)</div>
            </div>
        </div>
    </div>

    <div class="row mb-15 mt-35">
        <div class="col-md-6">
            <input id="activelylooking" name="group2" value="1" type="radio" checked="checked">
            <label for="activelylooking">Actively looking right now </label>
            <p class="text-dark-blue text-light-3 f-12 ml-25 mt-7">Maximum matches. We'll get you in front of
                employers ASAP and send you any new jobs that match your interests.</p>
        </div>
        <div class="col-md-6">
            <input id="activelynotlooking" name="group2" value="2" type="radio">
            <label for="activelynotlooking">Open, but not actively looking</label>
            <p class="text-dark-blue text-light-3 f-12 ml-25 mt-7">Fewer matches. Employers can find you and we'll
                be selective with the matches we send. </p>
        </div>
    </div>

    <div class="row mb-15 mt-35 item-main-wrap">
        <div class="col-md-12">
            <h5 class="text-black">Where would you like to work </h5>
            <p class="text-dark-blue text-light-3 f-12 mt-5">Select Maximum 3 Cities.</p>
        </div>

        <div class="col-md-12 selected-items city-item">

        </div>

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>District</span>
                </div>
                <ul class="option-list"></ul>
                <?php echo Chtml::dropDownList('district_id', "", CHtml::listData(AdmDistrict::model()->findAll(), 'district_id', 'district_name'), array('empty' => 'Select District', 'onChange' => 'loadCities()')); ?>
            </div>
        </div>

        <div class="col-md-6">
            <div class="selector dark">
                <div class="selected-option">
                    <span>City</span>
                </div>
                <ul class="option-list"></ul>

                <select id="city" name="city" class="city">

                </select>
            </div>
        </div>
    </div>

    <div class="row mb-15 mt-35 skill-main-wrap">
        <div class="col-md-12">
            <h5 class="text-black">Skills</h5>
            <p class="text-dark-blue text-light-3 f-12 mt-5">Used to match you with jobs that fit your skill set and
                interests.</p>
        </div>

        <div class="col-md-12 skills-item selected-items ">

        </div>

        <div class="col-md-6">
            <div class="input-wrapper input-search-box">
                <input id="searchSkills" name="searchSkills" type="text" onkeyup="skillsSearch()">

                <div class="search-result">
                    <ul id="skills">
                    </ul>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="d-table">
                <div class="d-table-cell width-0">
                    <span class="icon icon-20 icon-linkin mt-12"></span>
                </div>
                <div class="d-table-cell width-100">
                    <div class="input-wrapper">
                        <input id="linkedin" name="linkedin" type="text">
                        <div class="float-text">Linked in Account</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-6">
            <h5>Upload CV</h5>
            <div class="file-uploader">
                <div class="button">Brows...</div>
                <?php
                $cvModel = new JsBasic();
                echo CHtml::activeFileField($cvModel, 'cv');
                echo $form->error($cvModel, 'cv');
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="cm-message message"></div>
        </div>
    </div>

</div>

<div class="col-md-12 mt-20">
    <button type="submit" class="cm-btn large text-uppercase light-blue right">Finish</button>
    <button type="button" class="cm-btn large text-uppercase light-blue right" onclick="back()">Back</button>
    <button type="button" class="cm-btn large text-uppercase light-blue right" onclick="skip()">Skip</button>
</div>
<?php $this->endWidget(); ?>


<script>

    //Select Step
    selectStep(2);

    //Load fileUploader
    fileUploader.load();

    Input.init();
    Select.init();


    function getItems(_el) {
        var result = [];
        $(_el).each(function () {
            result.push($(this).attr('id'));
        });
        return result;
    }

    function workTypes() {
        var result = [];
        $('.work-type').find('input[type="checkbox"]').each(function () {
            var $this = $(this);
            if ($this.is(':checked')) {
                result.push($this.attr('id'));
            }
        });
        return result;
    }

    //Item
    function html(val, id) {
        var html = '';
        html += '<div class="item" id="' + id + '">' + val + '<span class="icon icon-10 icon-cross v-middle pointer btn-close"></span></div>';
        return html;
    }

    var mainWrap = $('.skill-main-wrap');
    var selectedItems = mainWrap.find('.selected-items');

    function loadSkillFnc() {
        $('.input-search-box').SearchBox({
            itemClick: function (item) {
                selectedItems.append(html(item.text(), item.attr('id')));
            },
            onEnter: function (input) {
                if (input.val().length > 0) {
                    var h = html(input.val(), input.val());
                    selectedItems.append(h);
                }
            }
        });
    }

    $(function () {
        //loadSkillFnc();

        $('.skill-main-wrap').on('click', '.btn-close', function () {
            var $this = $(this);
            $this.parent('.item').remove();
        });

    });


    //City
    $(function () {
        var city = [];

        //City change
        $('.city').change(function () {

            var $this = $(this);
            var mainWrap = $this.parents('.item-main-wrap');
            var selectedItems = mainWrap.find('.selected-items');
            var selected = $this.find('option:selected');
            var selectedId = selected.val();

            var isExit = function () {
                var isValid = false;
                city.map(function (city) {
                    if (selectedId === city) {
                        isValid = true;
                    }
                });
                return isValid;
            };

            if (city.length < 3 && !isExit()) {
                selectedItems.append(html(selected.text(), selectedId));
                city.push(selected.val());
            }
        });

        //Remove Item
        $('.item-main-wrap').on('click', '.btn-close', function () {
            var $this = $(this);
            var $item = $this.parent('.item');
            var $id = $item.attr('id');
            $item.remove();
            city.splice(city.indexOf($id), 1);
        })

    })


    function loadSubCategories() {
        $("#subCategories").empty();

        var id = $('#cat_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/GetSubCategories'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var subCats = responce.data.subCategoryData;
                    addEmptyToAjaxDropDowns('subCategories', 'Sub Category');
                    for (var i = 0, max = subCats.length; i < max; i++) {
                        $('#subCategories').append(
                                $("<option>" + subCats[i]['scat_name'] + "</option>")
                                .attr("value", subCats[i]['scat_id'])
                                .text(subCats[i]['scat_name'])
                                );
                    }

                    setTimeout(function () {
                        Select.init();
                    }, 200);

                    loadDesignations();

                }
            }
        });
    }

    function loadDesignations() {
        $("#designations").empty();

        var id = $('#cat_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/GetDesignationsByCat'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var designations = responce.data.designationData;
                    addEmptyToAjaxDropDowns('designations', 'Designation');
                    for (var i = 0, max = designations.length; i < max; i++) {
                        $('#designations').append(
                                $("<option>" + designations[i]['desig_name'] + "</option>")
                                .attr("value", designations[i]['desig_id'])
                                .text(designations[i]['desig_name'])
                                );
                    }

                    setTimeout(function () {
                        Select.init();
                    }, 200);
                }
            }
        });
    }

    function loadCities() {
        $("#city").empty();

        var id = $('#district_id').val();
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/Site/GetCitiesByDistrictID'; ?>",
            data: {id: id},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    var cities = responce.data.cityData;
                    addEmptyToAjaxDropDowns('city', 'city');
                    for (var i = 0, max = cities.length; i < max; i++) {
                        $('#city').append(
                                $("<option>" + cities[i]['city_name'] + "</option>")
                                .attr("value", cities[i]['city_id'])
                                .text(cities[i]['city_name'])
                                );
                    }

                    setTimeout(function () {
                        Select.init();
                    }, 200)
                }
            }
        });
    }

    function back() {
        Animation.load('body');
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/FormStepTwo'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            success: function (responce) {
                Animation.hide();
                $("#step").html(responce);
            }
        });
    }

    var currentRequest = null;

    function skillsSearch() {
        var searchSkill = "";
        searchSkill = $('#searchSkills').val();

        currentRequest = jQuery.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/SearchSkills'; ?>",
            data: {searchSkill: searchSkill},
            dataType: 'json',
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (responce) {
                if (responce.code == 200) {
                    $('#skills').empty();
                    var skills = responce.data.skillsData;

                    for (var i = 0, max = skills.length; i < max; i++) {
                        $('#skills').append($("<li id=" + skills[i]['skill_id'] + ">" + skills[i]['skill_name'] + "</li>"));
                    }
                    loadSkillFnc();
                }
            }
        });
    }

    $('#formStepThree').submit(function (e) {
        e.preventDefault();
        var $form = $(this);

        if (!$form.valid())
            return;

        var loader = Animation.load('body');

        var city = getItems('.city-item .item');
        var skills = getItems('.skills-item .item');
        var workType = workTypes();

        var formData = new FormData(this);
        formData.append('city', city.toString());
        formData.append('skills', skills.toString());
        formData.append('accessId', '<?php echo $accessId; ?>');

        getFormFinishedStatus(function (status) {
            if (Number(status) === 1) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/SaveStepThree'; ?>",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (responce) {
                        if (responce.code == 200) {
                            window.location = http_path + 'Site/Index';
                        } else {
                            Animation.hide();
                        }
                    }
                });
            } else {

                loader.message = "Please Complete the skipped Steps to finish.";
                setTimeout(function () {
                    Animation.hide();
                }, 2000);
            }
        });


    });

    function getFormFinishedStatus(callback) {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/IsFormsFillingFinished'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    callback(responce.data.status);
                }
            }
        });
    }

    function skip() {
        $.ajax({
            type: 'POST',
            url: "<?php echo Yii::app()->baseUrl . '/JobSeeker/SkipStepThree'; ?>",
            data: {accessId: '<?php echo $accessId; ?>'},
            dataType: 'json',
            success: function (responce) {
                if (responce.code == 200) {
                    window.location = http_path + 'Site/Index';
                }
            }
        });
    }


</script>