<?php

if(! isset($_SESSION['verification_email'])){
    header("location:layouts/errors/404.php");die;
}