<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}
include('../views/home_view.php');
?>
