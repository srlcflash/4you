<?php
$userId = Yii::app()->user->id;
$user = User::model()->findByAttributes(array('user_id' => $userId));
$userType = $user->user_type;
if ($userType == 1) {
    $model = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $user->ref_emp_or_js_id));
    $employment = JsEmploymentData::model()->findByAttributes(array('ref_js_id' => $user->ref_emp_or_js_id));
} else {
    $model = new JsBasic();
}
?>

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
                            <h6 class="text-black text-light-2">Industry</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo AdmIndustry::model()->findByPk($employment->jsemp_expected_ref_industry_id)->ind_name; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Category (Field)</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo AdmCategory::model()->findByPk($employment->jsemp_expected_ref_category_id)->cat_name; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Sub Category</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo AdmSubcategory::model()->findByPk($employment->jsemp_expected_sub_category_id)->scat_name; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Current Job title</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo AdmDesignation::model()->findByPk($employment->jsemp_expected_designation_id)->desig_name; ?></h6>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>