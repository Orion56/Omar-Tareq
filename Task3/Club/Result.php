<?php session_start();

$mainSubscribtionFee = 10000;
$familySubscribtionFee = 2500;
$totalFamilySubscribtion = ($_SESSION['familyCount'] - 1) * $familySubscribtionFee;
$totalGamesSubscribtion = 0;
foreach ($_SESSION['gameFee'] as $game => $fee) {
    $totalGameFees = count($_SESSION['memberData']["$game"]) * $fee;
    $totalGamesSubscribtion += $totalGameFees;
}
$totalSubscribtion = $mainSubscribtionFee + $totalFamilySubscribtion + $totalGamesSubscribtion;


?>

<!doctype html>
<html lang="en">

<head>
    <title>Result</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="row container-fluid vh-100 justify-content-around align-items-center">
        <div class="wrapper">

            <h2 class="text-center">Total Subscribtion Fees</h2>
            <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Item</th>
                        <th class="text-center">Fees</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="text-center alert alert-success fw-bold">
                <?php

                echo "Total fees: " . $totalSubscribtion;

                echo "<br>Welcome to your Club";
                ?>

            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>