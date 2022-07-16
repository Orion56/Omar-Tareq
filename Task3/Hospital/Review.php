<?php session_start();

$questionSet1 = [
    "Are you satisfied with the level of cleanliness?" => '1',
    "Are you satisfied with the service price?" => '2',
    "Are you satisfied with the nursing service?" => '3',
    "Are you satisfied with the doctors?" => '4',
    "Are you satisfied with the calmness inside hospital?" => '5'
];
$reviews = [
    "bad" => 0,
    "good" => 3,
    "very good" => 5,
    "exelent" => 10
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questionSet1 as $question => $id) {
        $userReview[$question] = $_POST[$id];
        print_r($userReview);
    }
    $_SESSION['userReview'] = $userReview;
    $_SESSION['reviews'] = $reviews;
    header('location:Result.php');
};
?>


<!doctype html>
<html lang="en">

<head>
    <title>Review</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="row container-fluid vh-100 justify-content-around align-items-center">
        <div class="wrapper">

            <h2 class="text-center">Review</h2>
            <form method="post" action="">
                <table class="table table-striped table-inverse table-responsive">
                <thead class="thead-inverse">
                    <tr>
                        <th>Questions</th>
                        <?php foreach ($reviews as $review => $value) {
                            echo "<th class='text-center'>{$review}</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($questionSet1 as $question => $id) {
                        echo "<tr><td scope='row'>{$question}</td>";
                        foreach ($reviews as $review => $value) {
                            echo "<td class='text-center'><input type='radio' required name='{$id}' id='' value='{$value}' class='custom-control-input'></td>";
                        };
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button class="btn btn-primary">submit</button>
        </form>
    </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>