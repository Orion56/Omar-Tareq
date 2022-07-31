<?php
if (empty($_SESSION['user'])) {
    header('location:signin.php');
    die;
}
