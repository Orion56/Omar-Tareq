<?php

use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Services\Media;

$title = "Profile";
include "layouts/head.php";
include "App/Http/Middlewares/auth.php";
include "layouts/navbar.php";
include "layouts/breadcrumb.php";

$validate = new Validation;
$media = new Media;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['update-profile'])) {
        $validation->setValueName('first name')->setValue($_POST['first_name'] ?? NULL)->required()->string()->max(32);
        $validation->setValueName('last name')->setValue($_POST['last_name'] ?? NULL)->required()->string()->max(32);
        $validation->setValueName('gender')->setValue($_POST['gender'] ?? NULL)->required()->string()->in(['f', 'm']);
        if (empty($validation->getErrors())) {
            $user = new User;
            $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])
                ->setGender($_POST['gender'])->setEmail($_SESSION['user']->email);
            if ($user->update()) {
                $_SESSION['user']->first_name = $_POST['first_name'];
                $_SESSION['user']->last_name = $_POST['last_name'];
                $_SESSION['user']->gender = $_POST['gender'];
                $successfullUpdate = "<div class='alert alert-success text-center'> Profile Updated Successfully </div>";
            } else {
                $failedUdpate = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
            }
        }
    }
    if (isset($_POST['update-image'])) {
        if ($_FILES['image']['error'] == 0) {
            $media->setFile($_FILES['image'])->size(1000000)->extension(['png', 'jpg', 'jpeg']);
            if (empty($media->getErrors())) {
                if ($_SESSION['user']->image != 'default.jpg') {
                    media::delete('assets/img/users/' . $_SESSION['user']->image);
                }
                $media->upload('assets/img/users/');
                $user = new User;
                $user->setImage($media->getNewFileName())->setEmail($_SESSION['user']->email);
                if ($user->updateProfilePic()) {
                    $_SESSION['user']->image = $media->getNewFileName();
                    $profilePicSuccess = "<div class='alert alert-success text-center'> Profile Pic Updated Successfully </div>";
                } else {
                    $profilePicError = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
                }
            }
        }
    }
    if (isset($_POST['change-password'])) {

        $validate->setValueName('current password')->setValue($_POST['current-password'])->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/', "Invalid password!");
        $validate->setValueName('new password')->setValue($_POST['new-password'])->required()->regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/", "Minimum eight and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character.");
        $validate->setValueName('new password confirmation')->setValue($_POST['new-password-confirmation'])->required()->compare($_POST['new-password']);

        if (empty($validate->getErrors())) {
            $user = new User;
            $user->setEmail($_SESSION['user']->email);
            //verify user password from db || get user data from the current saved session
            $result = $user->getUserByEmail();
            if ($result->num_rows == 1) {
                $userData = $result->fetch_object();
                if (password_verify($_POST['current-password'], $userData->password)) {
                    $user->setPassword($_POST['new-password']);
                    if ($user->changePassword()) {
                        $_SESSION['user']->password = $_POST['new-password'];
                        $successfullPasswordChange = "<div class='alert alert-success text-center'> Password changed Successfully </div>";
                    } else {
                        $failedUdpate = "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
                    }
                } else {
                    $wrongPass = "<p class='text-danger font-weight-bold'> Wrong password!</p>";
                }
            }
        }
    }
}
?>
<!-- my account start -->
<div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse <?= isset($_POST['update-profile']) || isset($_POST['update-image']) ? 'show' : '' ?>">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>
                                        </div>
                                        <form method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?= $media->getError('size') ?>
                                                    <?= $media->getError('extension') ?>
                                                    <?= $profilePicSuccess ?? "" ?>
                                                    <?= $profilePicError ?? "" ?>
                                                </div>
                                                <div class="col-4 offset-4 text-center">
                                                    <label for="file">
                                                        <img class="w-100 rounded-circle" style="cursor:pointer" src="assets/img/users/<?php if ($_SESSION['user']->image == 'user_default.jpg') {
                                                                                                                                            if ($_SESSION['user']->gender == 'm') {
                                                                                                                                                echo "male.jpg";
                                                                                                                                            } else {
                                                                                                                                                echo "female.jpg";
                                                                                                                                            }
                                                                                                                                        } else {
                                                                                                                                            echo $_SESSION['user']->image;
                                                                                                                                        } ?>" alt="<?= $_SESSION['user']->first_name ?>" id="image">
                                                    </label>
                                                    <input type="file" name="image" id="file" class="d-none" onchange="loadFile(event)">
                                                    <div class="billing-btn">

                                                        <button type="submit" name="update-image" class="my-5 d-none" id="change-btn"> Change </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form method="post">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?= $successfullUpdate ?? "" ?>
                                                    <?= $failedUdpate ?? "" ?>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="first_name" value="<?= $_SESSION['user']->first_name ?>">
                                                    </div>
                                                    <?= $validate->getMessage('first name') ?>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= $_SESSION['user']->last_name ?>">
                                                    </div>
                                                    <?= $validate->getMessage('last name') ?>
                                                </div>
                                                <div class="col-lg-4 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Gender</label>
                                                        <select class="form-control" name="gender">
                                                            <option <?= $_SESSION['user']->gender == 'm' ?  'selected' : '' ?> value="m">Male</option>
                                                            <option <?= $_SESSION['user']->gender == 'f' ?  'selected' : '' ?> value="f">Female</option>
                                                        </select>
                                                    </div>
                                                    <?= $validate->getMessage('gender') ?>
                                                </div>

                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <form method="POST">
                                <div id="my-account-2" class="panel-collapse collapse <?= isset($_POST['change-password']) ? 'show' : '' ?>">
                                    <div class="col-12">
                                        <?= $successfullPasswordChange ?? "" ?>
                                        <?= $failedUdpate ?? "" ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="billing-information-wrapper">
                                            <div class="account-info-wrapper">
                                                <h4>Change Password</h4>
                                                <h5>Your Password</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Current Password</label>
                                                        <input type="password" name="current-password">
                                                        <?= $validate->getMessage('current password') ?>
                                                        <?= $wrongPass ?? '' ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new-password">
                                                        <?= $validate->getMessage('new password') ?>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Re-type New Password</label>
                                                        <input type="password" name="new-password-confirmation">
                                                        <?= $validate->getMessage('new password confirmation') ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-back">
                                                    <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                                </div>
                                                <div class="billing-btn">
                                                    <button type="submit" name="change-password">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                        </div>
                        <div id="my-account-3" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="billing-information-wrapper">
                                    <div class="account-info-wrapper">
                                        <h4>Address Book Entries</h4>
                                    </div>
                                    <div class="entries-wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                <div class="entries-info text-center">
                                                    <p>Farhana hayder (shuvo) </p>
                                                    <p>hastech </p>
                                                    <p> Road#1 , Block#c </p>
                                                    <p> Rampura. </p>
                                                    <p>Dhaka </p>
                                                    <p>Bangladesh </p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                <div class="entries-edit-delete text-center">
                                                    <a class="edit" href="#">Edit</a>
                                                    <a href="#">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="billing-back-btn">
                                        <div class="billing-back">
                                            <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                        </div>
                                        <div class="billing-btn">
                                            <button type="submit">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5 class="panel-title"><span>4</span> <a href="wishlist.php">Modify your wish list </a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('image');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
            document.getElementById('change-btn').classList.remove('d-none');
        }
    };
</script>
<!-- my account end -->
<?php
include "layouts/footer.php";
include "layouts/scripts.php";

?>