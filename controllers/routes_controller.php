<?php

include_once('../includes/db.php');
include_once('../models/routes_model.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_route'])) {
        addRoute($conn);
    } elseif (isset($_POST['delete_route'])) {
        deleteRoute($conn);
    }
}

function addRoute($conn) {
    $route_name = mysqli_real_escape_string($conn, $_POST['route_name']);
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

    $insert_query = "INSERT INTO routes (route_name, price) VALUES ('$route_name', $price)";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        header("Location: ../views/routes_view.php");
        exit();
    } else {
        echo "Error adding route: " . mysqli_error($conn);
    }
}

function getRoutes($conn) {
    $query = "SELECT * FROM routes ORDER BY route_id DESC";
    $result = mysqli_query($conn, $query);

    $routes = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $routes[] = $row;
        }
    }

    return $routes;
}

function deleteRoute($conn) {
    $route_id = isset($_POST['route_id']) ? (int)$_POST['route_id'] : 0;
    $delete_query = "DELETE FROM routes WHERE route_id = $route_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        header("Location: ../views/routes_view.php");
        exit();
    } else {
        echo "Error deleting route: " . mysqli_error($conn);
    }
}
$routes = getRoutes($conn);
mysqli_close($conn);
?>
