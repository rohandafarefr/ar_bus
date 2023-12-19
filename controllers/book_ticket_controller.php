<?php
include('../includes/db.php');
include('../models/book_ticket_model.php');

if (isset($_POST['book_ticket'])) {
    
    $route_name = $_POST['route_name'];
    $bus_name = $_POST['bus_name'];
    $passenger_name = $_POST['passenger_name'];
    $ticket_quantity = $_POST['quantity'];

    
    $booking_id = book_ticket($conn, $route_name, $bus_name, $passenger_name, $ticket_quantity);

        if ($booking_id) {
        header("Location: ../views/print_ticket_view.php?booking_id=$booking_id");
        exit();
    } else {
        
        echo "Booking failed. Please try again.";
    }
} else {
    echo "Form not submitted.";
}
?>
