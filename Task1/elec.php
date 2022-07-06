<?php
if ($_POST) {

    $units = $_POST['units'];
    define('additional', 0.2);
    if ($units > 0) {
        switch ($units) {
            case $units > 0 && $units <= 50:
                $charge = 0.5;
                break;
            case $units <= 100:
                $charge = 0.75;
                break;
            case $units <= 250:
                $charge = 1.2;
                break;
            case $units > 250:
                $charge = 1.5;
                break;
        }
        $bill = $units * $charge;
        $additionalCharge = $bill*additional;
        $bill += $additionalCharge;
        $conpumtion = "Consumption = {$units} units <br/>";
        $billTotal = "Your bill total = {$bill} EGP";
    } else $message = 'Please enter your consumption!';
}
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
    <div class="container mt-5">
        <h1>Min & Max Numbers</h1>
        <hr>
        <form action="" method="post">
            <section class="row">
                <div class="col-4 me-5">
                    <h3>Inputs:</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label">Consumption Uints</label>
                        <input type="text" class="form-control" name="units" id="" placeholder="enter your consumption here">
                    </div>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
                <aside class="col-4 border-start-1 border-success text-center flex-grow-1">
                    <h3>Results:</h3>
                    <hr>
                    <p>
                        <?php
                        echo $conpumtion ?? '';
                        echo $billTotal ?? '';
                        echo $message ?? '';
                        ?>
                    </p>
                </aside>

            </section>

        </form>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>