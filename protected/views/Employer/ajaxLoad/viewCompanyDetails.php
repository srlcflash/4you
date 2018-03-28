<div class="row ">
    <div class="col-md-12 text-right">
        <button type="button" class="btn-img edit btn-employer-edit">Edit</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12 pl-30">
        <table class="data-table data-employer-profile">

            <colgroup>
                <col class="heading">
                <col class="details">
            </colgroup>

            <tbody>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Address</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $employerData->employer_address ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Contact No</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $employerData->employer_tel ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Contact No(Optional)</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $employerData->employer_mobi ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Name of Contact Person</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $employerData->employer_contact_person ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Industry</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black">
                                <?php
                                $industry = AdmIndustry::model()->findByPk($employerData->ref_ind_id);
                                echo $industry->ind_name;
                                ?>
                            </h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">District</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black">
                                <?php
                                $district = AdmDistrict::model()->findByPk($employerData->ref_district_id);
                                echo $district->district_name;
                                ?>
                            </h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">City</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black">
                                <?php
                                $city = AdmCity::model()->findByPk($employerData->ref_city_id);
                                echo $city->city_name;
                                ?>
                            </h6>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>