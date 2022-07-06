<?php

use LDAP\Result;

if ($_POST) {

    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];
    if (is_numeric($num1) && is_numeric($num2)) {
        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                break;
            case '-':
                $result = $num1 - $num2;
                break;
            case '*':
                $result = $num1 * $num2;
                break;
            case '**':
                $result = $num1 ** $num2;
                break;
            case '/':
                if ($num2 == 0) $result = "can't devid by Zero";
                else $result = $num1 / $num2;
                break;
        }
    } else $message = 'Please enter two numbers!';
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
        <h1>Calculator</h1>
        <hr>
        <form action="" method="post">
            <section class="row">
                <div class="col-4 me-5">
                    <h3>Inputs:</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="" class="form-label">Number 1</label>
                        <input type="text" class="form-control" name="num1" id="" placeholder="enter your 1st number here">
                        <label for="" class="form-label">Number 2</label>
                        <input type="text" class="form-control" name="num2" id="" placeholder="enter your 2nd number here">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="operation" required id="" value='+'>
                                add
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="operation" required id="" value="-">
                                subtract
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="operation" required id="" value="*">
                                multiply
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="operation" required id="" value="**">
                                power
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="operation" required id="" value="/">
                                divide
                            </label>
                        </div>

                        <button class="btn btn-primary">Evaluate</button>
                    </div>
                </div>
                <aside class="col-4 border-start-1 border-success text-center flex-grow-1">
                    <h3>Results:</h3>
                    <hr>
                    <p>
                        <?php
                        echo $result ?? '';
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