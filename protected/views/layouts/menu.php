<nav class="navbar light-blue nav-bottom-space">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="" href="<?php echo Yii::app()->baseUrl ?>/site">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/system/logo/logo.png" alt="Logo">
            </a>
            <span class="mobile-menu">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/system/icon/site/30/ic_bar_menu.png" alt="">
            </span>
        </div>
        <ul class="navbar-nav navbar-right">

            <li><a href="<?php echo Yii::app()->request->baseUrl . '/site'; ?>">Home</a></li>
<!--            <li><a href="--><?php //echo Yii::app()->request->baseUrl . '/site/candidate'; ?><!--">Job Seeker</a></li>-->
<!--            <li><a href="--><?php //echo Yii::app()->request->baseUrl . '/site/Employer'; ?><!--">Employer</a></li>-->
<!--            <li><a href="--><?php //echo Yii::app()->request->baseUrl . '/Contact'; ?><!--">Contact Us</a></li>-->


            <?php if (yii::app()->user->isGuest) { ?>
                <li class="sign-link"><a class="btn-sign-in" href="#">Sign in</a></li>
                <li class="register-link"><a class="cm-btn btn-registration" href="">Register</a></li>
                <?php
            } else {

                $logUserId = Yii::app()->user->id;
                $logUserDetails = User::model()->findByAttributes(array('user_id' => $logUserId));

                if ($logUserDetails->user_type == 1) {
                    $JsBasic = JsBasic::model()->findByAttributes(array('js_id' => $logUserDetails->ref_emp_or_js_id));

                    if (count($JsBasic) > 0) {
                        $firstName = substr($JsBasic->js_fname, 0, 10);
                        $fullName = $JsBasic->js_fname . ' ' . $JsBasic->js_lname;
                        $email = $JsBasic->js_email;
                        ?> 
                        <li class="profile-link"><a href="<?php echo Yii::app()->request->baseUrl . '/JobSeeker/Profile'; ?>">My Account</a></li>
                        <?php
                    } else {
                        Yii::app()->user->logout();
                    }
                } elseif ($logUserDetails->user_type == 2) {
                    $EmpEmployers = EmpEmployers::model()->findByAttributes(array('employer_id' => $logUserDetails->ref_emp_or_js_id));
                    $firstName = substr($EmpEmployers->employer_name, 0, 10);
                    $fullName = $EmpEmployers->employer_name;
                    $email = $EmpEmployers->employer_email;
                    ?> <li class="profile-link"><a href="<?php echo Yii::app()->request->baseUrl . '/Employer/ProfileDetails'; ?>">My Account</a></li><?php
                    } else {
                        $firstName = $logUserDetails->user_name;
                        $fullName = $logUserDetails->user_name;
                        $email = "";
                    }
                    ?>

                <li class="profile-link">
                    <a class="" href="#">
                        <span class="text-hi">Hi,</span>

                        <span class="text-name"><?php echo $firstName; ?></span>

                        <span class="arrow-down"></span>
                    </a>
                    <div class="drop-box">
                        <div class="row">

                            <h5 class="col-md-12 text-black text-light-2"><?php echo $fullName; ?></h5>
                            <h6 class="col-md-12 text-black text-light-3"><?php echo $email; ?></h6>

                            <div class="col-md-12 mt-10">
                                <a href="<?php echo Yii::app()->request->baseUrl . '/Default/Logout'; ?>"
                                   class="logout">Logout</a>
                            </div>
                        </div>

                    </div>
                </li>

            <?php }
            ?>

        </ul>
    </div>
</nav>

