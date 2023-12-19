<?php

include_once('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_bus'])) {
        addBus($conn);
    } elseif (isset($_POST['delete_bus'])) {
        deleteBus($conn);
    }
}

function addBus($conn) {
    $bus_name = mysqli_real_escape_string($conn, $_POST['bus_name']);
    $capacity = isset($_POST['capacity']) ? (int)$_POST['capacity'] : 0;
    $departure_time = mysqli_real_escape_string($conn, $_POST['departure_time']);

    $insert_query = "INSERT INTO buses (bus_name, capacity, departure_time) 
                     VALUES ('$bus_name', $capacity, '$departure_time')";
    $insert_result = mysqli_query($conn, $insert_query);

    if ($insert_result) {
        header("Location: ../views/bus_view.php");
        exit();
    } else {
        echo "Error adding bus: " . mysqli_error($conn);
    }
}

function deleteBus($conn) {
    $bus_id = isset($_POST['bus_id']) ? (int)$_POST['bus_id'] : 0;

    $delete_query = "DELETE FROM buses WHERE bus_id = $bus_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        header("Location: ../views/bus_view.php");
        exit();
    } else {
        echo "Error deleting bus: " . mysqli_error($conn);
    }
}

function getBusList($conn) {
    $query = "SELECT * FROM buses";
    $result = mysqli_query($conn, $query);

    $bus_list = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bus_list[] = $row;
        }
    }

    return $bus_list;
}

$bus_list = getBusList($conn);

?>
