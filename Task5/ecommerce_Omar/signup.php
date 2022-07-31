<?php

use App\Database\Models\User;
use App\HTTP\Requests\Validation;
use App\Mails\VerificationCodeMail;

$title = 'Sign Up';
include "layouts/head.php";
include "App/HTTP/Middlewares/guest.php";
include "layouts/navbar.php";
include "layouts/breadCrumb.php";

$validate = new Validation;
if ($_SERVER['REQUEST_METHOD'] == "POST" &&  $_POST) {

    $validate->setValueName('first name')->setValue($_POST['first_name'])->required()->string()->max(32);
    $validate->setValueName('last name')->setValue($_POST['last_name'])->required()->string()->max(32);
    $validate->setValueName('email')->setValue($_POST['email'])->required()->regex("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/");
    $validate->setValueName('phone')->setValue($_POST['phone'])->required()->regex("/^01[0125][0-9]{8}$/");
    $validate->setValueName('password')->setValue($_POST['password'])->required()->regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", "Minimum eight and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character.");
    $validate->setValueName('password confirmation')->setValue($_POST['password_confirmation'])->required()->compare($_POST['password']);
    $validate->setValueName('gender')->setValue($_POST['gender'])->required()->in(['m', 'f']);
    if (empty($validate->getErrors())) {

        $user = new User;
        $verification_code = rand(100000, 999999);
        $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])
            ->setPassword($_POST['password'])->setPhone($_POST['phone'])->setGender($_POST['gender'])
            ->setEmail($_POST['email'])->setVerification_code($verification_code);
        if ($user->create()) {
            $subject = "Verification Code";
            $body = "<p> Dear {$_POST['first_name']} {$_POST['last_name']}</p>
            <p>Your Verification Code: <b style='color:blue'>{$verification_code}</b></p>
            <p>Thank You</p>";
            $verificationCodeMail = new VerificationCodeMail($_POST['email'], $subject, $body);
            if ($verificationCodeMail->send()) {
                $_SESSION['verification_email'] = $_POST['email'];
                header('location:verification-code.php?page=signup');
                die;
            }
        } else {
            $error = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
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
                            <h4> <?= strtoupper($title) ?> </h4>
                        </a>

                    </div>
                    <div class="tab-content ">

                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <?= $error ?? "" ?>
                                    <form method="post">
                                        <input type="text" value="<?= $_POST['first_name'] ?? "" ?>" name="first_name" placeholder="First Name">
                                        <?= $validate->getMessage('first name') ?>
                                        <input type="text" value="<?= $_POST['last_name'] ?? "" ?>" name="last_name" placeholder="Last Name">
                                        <?= $validate->getMessage('last name') ?>
                                        <input name="email" value="<?= $_POST['email'] ?? "" ?>" placeholder="Email" type="email">
                                        <?= $validate->getMessage('email') ?>
                                        <input name="phone" value="<?= $_POST['phone'] ?? "" ?>" placeholder="Phone" type="tel">
                                        <?= $validate->getMessage('phone') ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validate->getMessage('password') ?>
                                        <input type="password" name="password_confirmation" placeholder="Password Confirmation">
                                        <?= $validate->getMessage('password confirmation') ?>
                                        <select name="gender" class="form-control">
                                            <option <?= isset($_POST['gender']) && $_POST['gender'] == 'm' ? 'selected' : '' ?> value="m">Male</option>
                                            <option <?= isset($_POST['gender']) && $_POST['gender'] == 'f' ? 'selected' : '' ?> value="f">Female</option>
                                        </select>
                                        <?= $validate->getMessage('gender') ?>
                                        <div class="d-flex justify-content-center button-box mt-4">
                                            <button type="submit"><span><?= $title ?></span></button>
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
<?php
include "layouts/footer.php";
include "layouts/scripts.php";
?>