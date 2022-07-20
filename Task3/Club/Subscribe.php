<?php session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['mainMember'])) {
    $mainMember = $_POST['mainMember'];
    $_SESSION['mainMember'] = $mainMember;
    $_SESSION['familyCount'] = $_POST['familyCount'] + 1;

    //$_SESSION['allFamily'][0]['name0'] = $mainMember;

    header('location:Games.php');
};
?>
<!doctype html>
<html lang="en">

<head>
    <title>Subscribe</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="row container-fluid vh-100 justify-content-around align-items-center">
        <aside class="col-6 p-3">
            <img src="" class="img-fluid rounded-top" alt="">
            <h2 class="text-center">Welcome to the Club..</h2>
        </aside>
        <form method="post" action="" class="col-4 p-2">
            <div class="mb-3">
                <label for="" class="form-label">Member Name:</label>
                <input type="text" class="form-control" name="mainMember" id="" aria-describedby="helpId" placeholder="Please enter your Name">
                <small id="helpId" class="form-text text-muted">initial subscribtion cost is 10,000 LE</small>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Number of family members:</label>
                <input type="number" class="form-control" name="familyCount" id="" aria-describedby="helpId" placeholder="Please enter your family members count">
                <small id="helpId" class="form-text text-muted">cost per family member is 2500 LE</small>
            </div>
            <button type="submit" class="btn btn-primary px-3">Next</button>
        </form>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>