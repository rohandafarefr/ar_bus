<?php
include('../includes/db.php');

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    include('../models/login_model.php');
    $login_result = login($conn, $username, $password);

    if ($login_result) {
        header('Location: home_controller.php');
        exit();
    } else {
        header('Location: ../index.php?error=1');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
