<?php session_start();


$gameFee = [
    'Football' => 300,
    'Swimming' => 250,
    'Volly' => 150,
    'Others' => 100
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {

    $_SESSION['memberData'] = $_POST;
    $_SESSION['gameFee']=$gameFee;
    // for ($i = 0; $i <= $_SESSION['familyCount']; $i++) {
    //     $_SESSION['allFamily'] = [["name{$i}" => '', 'games' => []]];
    // }
    // $_SESSION['allFamily'][0]['name0'] = $mainMember;

    //print_r($_POST);
    header('location:Result.php');
};
?>


<!doctype html>
<html lang="en">

<head>
    <title>Games</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>

<body>
    <div class="row container vh-100 justify-content-center align-items-center">
        <div class="wrapper">
            <h2 class="text-center mb-4">Select Games</h2>
            <form method="post" action="" class="row justify-content-between">
                <div class="row col-7">
                    <?php for ($i = 1; $i <= $_SESSION['familyCount']; $i++) { ?>
                        <div class="memberDetails col-5">
                            <div class="mb-3">
                                <label for="" class="form-label mt-3">Member <?= $i ?> Name</label>
                                <input type="text" class="form-control" name="<?= "member$i" ?>" value="<?php echo $value = $i == 1 ?  $_SESSION['mainMember'] : $_POST["member$i"] ?? ''; ?>" id="" placeholder="name of family member">
                            </div>
                            <?php foreach ($gameFee as $game => $fee) {

                                //$checked =  in_array($_POST["member$i"], $_POST["$game"]) ? 'checked' : ''; 
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" <?= $checked ?? '' ?> type="checkbox" name='<?="{$game}[]"?>' value="<?= $_POST["member$i"] ?? '' ?>" id="">
                                    <label class="form-check-label" for="">
                                        <?= $game ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>


                </div>
                <div class=" row col-4 align-items-center text-center">
                    <h3>Welcome to<br> Your Club..</h3>
                    <div class="mb-3 row justify-content-evenly">
                        <button class="btn btn-primary">Subscribe</button>
                    </div>
                </div>


            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>