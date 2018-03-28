<div class="row ">
    <div class="col-md-12 text-right">
        <button type="button" class="btn-img edit btn-profile-edit">Edit</button>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="data-table data-user-profile">

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
                            <h6 class="text-black"><?php echo $jsBasic->js_address; ?></h6>
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
                            <h6 class="text-black"><?php echo $jsBasic->js_contact_no1; ?></h6>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Date of Birth</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo date('d/m/Y',strtotime($jsBasic->js_dob)); ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Total No of years
                                experience</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $jsBasic->js_experience_years; ?> Year(s) and  <?php echo $jsBasic->js_experience_months; ?> Month(s)  </h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Highest Academic Qualification</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $jsBasic->js_highest_academic_quali; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Name of the Academic Qualification</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $jsBasic->js_nameof_academic_quali; ?></h6>
                        </div>
                    </td>
                </tr>
                <tr>
                    <div class="row mb-15">

                <!--Proffesional Qualification-->
<!--                <div class="col-md-6">
                    <div class="row input-collection">
                        <div class="col-md-12 input-container">
                            <?php
                            //foreach ($jsProfQualifications as $jsProfQualification) {
                                ?>
                            
                                <div class="input-wrapper">
                                    <label><?php //echo $jsProfQualification->jsquali_qualification ?></label>
                                </div>
                                <?php
                            //}
                            ?>
                        </div>

                    </div>
                </div>-->

                <!--Memberships-->
<!--                <div class="col-md-6">
                    <div class="row input-collection">
                        <div class="col-md-12 input-container">
                            <div class="input-wrapper">
                            <?php
                            //foreach ($jsMemberships as $jsMembership) {
                                ?>
                            <div class="input-wrapper"> 
                                <label><?php //echo $jsMembership->jsquali_qualification; ?></label>
                                <?php
                            //}
                            ?>
                        </div>
                    </div>

                </div>

            </div>-->
                </tr>
            </tbody>
        </table>
    </div>
</div>