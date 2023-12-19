<?php

include_once('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_ticket'])) {
        deleteTicket($conn);
    } elseif (isset($_POST['print_ticket'])) {
        printTicket($conn);
    }
}

function printTicket($conn) {
    $ticket_id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;

    header("Location: ../views/print_ticket_view.php?booking_id=$ticket_id");
    exit();
}

function deleteTicket($conn) {
    $ticket_id = isset($_POST['ticket_id']) ? (int)$_POST['ticket_id'] : 0;

    $delete_query = "DELETE FROM tickets WHERE ticket_id = $ticket_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        header("Location: ../views/booking_history_view.php");
        exit();
    } else {
        echo "Error deleting ticket: " . mysqli_error($conn);
    }
}

function getBookingHistory($conn) {
    $query = "SELECT * FROM tickets ORDER BY booking_time DESC";
    $result = mysqli_query($conn, $query);

    $booking_history = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $booking_history[] = $row;
        }
    }

    return $booking_history;
}

$booking_history = getBookingHistory($conn); 

mysqli_close($conn);

?>
