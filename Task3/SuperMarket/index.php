<?php session_start();

$citiesFees = [
    'Cairo' => 0,
    'Giza' => 30,
    'Alex' => 50,
    'Other' => 100
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['customerName'] && $_POST['city'] != 'please select a city..' && $_POST['noOfProducts']) {
    // print_r($_POST);
    // die;
    foreach ($citiesFees as $city => $fee) {
        if ($city == $_POST['city']) {
            $delivery = $fee;
        }
    };
    $_SESSION['customerName'] = $_POST['customerName'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['delivery'] = $delivery;
    $_SESSION['noOfProducts'] = $_POST['noOfProducts'];
    $_SESSION['receipt'] = false;
    if ($_POST['noOfProducts']) {
        $products = [];
        $j = $_SESSION['noOfProducts'];
        for ($i = 1; $i <= $j; $i++) {
            if (!empty($_POST["productName{$i}"]) && !empty($_POST["productPrice{$i}"]) && !empty($_POST["qty{$i}"])) {
                $subTotal = $_POST["productPrice{$i}"] * $_POST["qty{$i}"];
                $products[] = [$_POST["productName{$i}"], $_POST["productPrice{$i}"], $_POST["qty{$i}"], $subTotal];
            } else $products[] = ['', '', '', ''];
        };
        $_SESSION['products'] = $products;
        if (!empty($products[0])) {
            $_SESSION['receipt'] = true;
            $total = 0;
            foreach ($products as $i => $product) {
                $total += (int)end($product);
            };
            switch ($total) {
                case $total <= 1000:
                    $discount = 0;
                    break;
                case $total <= 3000:
                    $discount = 0.1;
                    break;
                case $total <= 4500:
                    $discount = 0.15;
                    break;
                case $total > 4500:
                    $discount = 0.2;
                    break;
            };
            $discountValue = $total * $discount;
            $_SESSION['discount'] = $discount * 100 . " %";
            $_SESSION['total'] = $total + $delivery - $discountValue;
        }
    }
    //header('location:index.php');

    print_r($_SESSION);
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
    <style>
        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="row container-fluid vh-100 justify-content-around align-items-center">
        <div class="wrapper">
            <div class="container">
                <form method="POST" action="" class="row justify-content-between">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="customerName" class="col-xs-4 col-form-label">Customer Name</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="customerName" id="customerName" value='<?= $_POST['customerName'] ?? ""; ?>' placeholder="Customer Name..">
                            </div>
                        </div>
                        <label for="city" class="col-xs-4 col-form-label">City</label>
                        <select class="form-select" name='city'>
                            <option>please select a city..</option>
                            <?php
                            foreach ($citiesFees as $city => $fee) {
                                $selected =  $_SESSION['city'] == $city ? 'selected' : '';
                                echo "<option value='{$city}' {$selected}>{$city}</option>";
                            }
                            ?>
                        </select>
                        <label for="noOfProducts" class="col-xs-4 col-form-label">Number of products</label>
                        <div class="col-xs-8 mb-3">
                            <input type="number" class="form-control" name="noOfProducts" id="noOfProducts" value='<?= $_POST['noOfProducts'] ?? "" ?>' placeholder="enter no. of products">
                        </div>
                    </div>
                    <div class=" row col-6 align-items-center text-center">
                        <h3>Welcome<br> Awesome Market..</h3>
                        <div class="mb-3 row justify-content-evenly">
                            <button type="submit" class="btn btn-primary col-6">Proceed</button>
                        </div>
                    </div>
                    <div class="row">
                        <?php if ($_SESSION['noOfProducts']) {
                            for ($i = 1, $j = 0; $i <= $_SESSION['noOfProducts']; $i++, $j++) {
                                echo " 
                        <div class='wrapper col-4'>                    
                        <fieldset class='mb-3 row'>
                        <div class='mb-3'>
                            <label for='' class='form-label'>Product {$i}</label>
                            <input type='text' name='productName{$i}' value='{$products[$j][0]}' class='form-control' id='' placeholder=''>
                            <label for='' class='form-label'>price</label>
                            <input type='number' name='productPrice{$i}' value='{$products[$j][1]}' class='form-control' id='' placeholder=''>
                            <label for='' class='form-label'>qty.</label>
                            <input type='number' name='qty{$i}' value='{$products[$j][2]}' class='form-control' id='' placeholder=''>
                        </div>
                    </fieldset> </div> ";
                            }
                        }
                        ?>
                    </div>

                    <?php if ($_SESSION['receipt']) { ?>
                        <div class="row justify-content-center">
                            <table class="table table-striped table-inverse table-responsive">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Qty.</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($products as $i => $product) {
                                        echo "<tr>";
                                        foreach ($product as $j => $detail) {
                                            if (!empty($detail)) {
                                                echo "<td >{$detail}</td>";
                                            }
                                        };
                                        echo "</tr>";
                                    }

                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <table class="table text-center">
                                <tbody>
                                    <?= "<tr><td>Customer: <b>" . $_SESSION['customerName'] ?? '' . "</b></td></tr>"; ?>
                                    <?= "<tr><td>Shipping to: <b>" . $_SESSION['city'] ?? '' . "</b></td></tr>"; ?>
                                    <?= "<tr><td>Shipping Fees: <b>" . $_SESSION['delivery'] ?? '' . "</b></td></tr>"; ?>
                                    <?= "<tr><td>Applied Discount: <b>" . $_SESSION['discount'] ?? '' . "</b></td></tr>"; ?>
                                    <?= "<tr><td>Total Bill: <b>" . $_SESSION['total'] ?? '' . "</b></td></tr>"; ?>
                                </tbody>
                            </table>
                            <div class="alert alert-success text-center">Thank you for shopping with us..</div>
                        </div>
                    <?php }; ?>
                </form>
            </div>

            <!--  -->
        </div>
    </div>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>