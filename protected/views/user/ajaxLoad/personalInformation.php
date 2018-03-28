<?php
$userId = Yii::app()->user->id;
$user = User::model()->findByAttributes(array('user_id' => $userId));
$userType = $user->user_type;
if ($userType == 1) {
    $model = JsBasic::model()->findByAttributes(array('ref_jsbt_id' => $user->ref_emp_or_js_id));
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
                            <h6 class="text-black text-light-2">Address</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $model->js_address; ?></h6>
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
                            <h6 class="text-black"><?php echo date('d/m/Y',strtotime($model->js_dob)); ?></h6>
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
                            <h6 class="text-black"><?php echo $model->js_experience; ?> Year(s)</h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Highest Acadamic
                                Qualification</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $model->js_highest_academic_quali; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Professional Qualification</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black"><?php echo $model->js_nameof_academic_quali; ?></h6>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="data">
                            <h6 class="text-black text-light-2">Membership</h6>
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <h6 class="text-black">CIM</h6>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>