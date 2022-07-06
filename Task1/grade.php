<?php
if ($_POST) {

    $Physics = $_POST['Physics'];
    $Chemistry = $_POST['Chemistry'];
    $Biology = $_POST['Biology'];
    $Mathematics = $_POST['Mathematics'];
    $Computer = $_POST['Computer'];
    define('fullMark', 100);
    if (
        $Physics <= 100 && $Physics > 0 &&
        $Computer <= 100 && $Computer > 0 &&
        $Mathematics <= 100 && $Mathematics > 0 &&
        $Biology <= 100 && $Biology > 0 &&
        $Chemistry <= 100 && $Chemistry > 0
    ) {

        $total = $Physics + $Chemistry + $Biology + $Mathematics + $Computer;
        $percentage = $total * 100 / 500;
        $grade = 'Your Total Grade is: ';

        switch ($percentage) {
            case $percentage >= 90:
                $grade .= 'A';
                break;
            case $percentage >= 80:
                $grade .= 'B';
                break;
            case $percentage >= 70:
                $grade .= 'C';
                break;
            case $percentage >= 60:
                $grade .= 'D';
                break;
            case $percentage >= 40:
                $grade .= 'E';
                break;
            case $percentage < 40:
                $grade .= 'F';
                break;

            default:
                $grade = null;
                break;
        }
    } else {
        $message = 'Please enter a valid mark[0-100]';
    }
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
                        <label for="" class="form-label">Physics</label>
                        <input type="text" class="form-control" name="Physics" id="" placeholder="enter your mark here">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Chemistry</label>
                        <input type="text" class="form-control" name="Chemistry" id="" placeholder="enter your mark here">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Biology</label>
                        <input type="text" class="form-control" name="Biology" id="" placeholder="enter your mark here">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Mathematics</label>
                        <input type="text" class="form-control" name="Mathematics" id="" placeholder="enter your mark here">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Computer</label>
                        <input type="text" class="form-control" name="Computer" id="" placeholder="enter your mark here">
                    </div>
                    <button class="btn btn-primary">Evaluate</button>
                </div>
                <aside class="col-4 border-start-1 border-success text-center flex-grow-1">
                    <h3>Results:</h3>
                    <hr>
                    <p>
                        <?php
                        echo "Percentage = {$percentage}% <br/>";
                        echo $grade ?? '';
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