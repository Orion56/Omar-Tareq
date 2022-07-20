<?php session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

    $name = $_POST['name'];
    $loanAmount = $_POST['loanAmount'];
    $loanPeriod = $_POST['loanPeriod'];

    $_SESSION['name'] = $name;
    $_SESSION['loanAmount'] = $loanAmount;
    $_SESSION['loanPeriod'] = $loanPeriod;

    if ($_POST['loanPeriod'] <= 3) $i = 0.1;
    else $i = 0.15;

    $_SESSION['i'] = $i;
    $totalInterest = $loanAmount * $i * $loanPeriod;
    $totalPaid = $loanAmount + $totalInterest;
    $monthlyInstallment = $totalPaid / (12 * $loanPeriod);
};


?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="container d-flex vh-100 justify-content-center align-items-center">
        <div class="wrapper">
            <form method="POST" action="" class="row justify-content-between">
                <div class="col-6">
                    <div class="mb-3 row">
                        <label for="name" class="col-xs-4 col-form-label">Client Name</label>
                        <div class="col-xs-8">
                            <input type="text" class="form-control" name="name" id="name" value='<?= $_POST['name'] ?? ""; ?>' placeholder="Client Name..">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="loanAmount" class="col-xs-4 col-form-label">Loan Amount</label>
                        <div class="col-xs-8">
                            <input type="number" class="form-control" name="loanAmount" id="loanAmount" value='<?= $_POST['loanAmount'] ?? ""; ?>' placeholder="loan amount..">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="loanPeriod" class="col-xs-4 col-form-label">Loan Period</label>
                        <div class="col-xs-8">
                            <input type="number" class="form-control" name="loanPeriod" id="loanPeriod" value='<?= $_POST['loanPeriod'] ?? ""; ?>' placeholder="loan period..">
                        </div>
                    </div>

                </div>
                <div class=" row col-6 align-items-center text-center">
                    <h3>Welcome to<br> Your Bank..</h3>
                    <div class="mb-3 row justify-content-evenly">
                        <button type="submit" class="btn btn-primary col-6">Proceed</button>
                    </div>
                </div>
            </form>
            <div class="alert alert-success text-center">
                <?= "Interest Rate: " . $i * 100 . " % per year<br>" ?>
                <?= "You shall pay: " . round($monthlyInstallment, 2) . " per month" ?>
            </div>
        </div>
    </div>



    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>