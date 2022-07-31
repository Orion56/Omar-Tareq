<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Set New Password";
include "layouts/head.php";

$validate = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST" &&  $_POST) {

    $validate->setValueName('password')->setValue($_POST['password'])->required()
        ->regex(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',
            "Minimum eight and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character."
        )->compare($_POST['password_confirmation']);
    $validate->setValueName('password confirmation')->setValue($_POST['password_confirmation'])->required();
    if (empty($validate->getErrors())) {
        $user = new User;
        $user->setPassword($_POST['password'])->setEmail($_SESSION['verification_email']);
        if ($user->changePassword()) {
            unset($_SESSION['verification_email']);
            $success = "<div class='alert alert-success text-center'> Your password updated successfully you will be directed to sign in shortly.. </div>";
            header('refresh:3;url=signin.php');
            die;
        } else {
            $error = "<p class='text-danger font-weight-bold' > Something Went Wrong </p>";
        }
    }
}

?>
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">

            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg2">
                            <h4> Change Your Password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane  active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $success ?? "" ?>
                                    <?= $error ?? "" ?>
                                    <form method="post">
                                        <input type="password" name="password" placeholder="New Password">
                                        <?= $validate->getMessage('password') ?>
                                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                                        <?= $validate->getMessage('password confirmation') ?>
                                        <div class="button-box mt-5">
                                            <button type="submit"><span>Change</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>
<?php
include "layouts/scripts.php";
?>