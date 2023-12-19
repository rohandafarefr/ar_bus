<?php

function book_ticket($conn, $route_name, $bus_name, $passenger_name, $ticket_quantity) {
    $route_name = mysqli_real_escape_string($conn, $route_name);
    $bus_name = mysqli_real_escape_string($conn, $bus_name);
    $passenger_name = mysqli_real_escape_string($conn, $passenger_name);
    $route_query = "SELECT route_id FROM routes WHERE route_name = '$route_name'";
    $bus_query = "SELECT bus_id FROM buses WHERE bus_name = '$bus_name'";

    $route_result = mysqli_query($conn, $route_query);
    $bus_result = mysqli_query($conn, $bus_query);

    if ($route_result && $bus_result) {
        $route_row = mysqli_fetch_assoc($route_result);
        $bus_row = mysqli_fetch_assoc($bus_result);

        $route_id = $route_row['route_id'];
        $bus_id = $bus_row['bus_id'];

        $route_price_query = "SELECT price FROM routes WHERE route_name = '$route_name'";
        $route_price_result = mysqli_query($conn, $route_price_query);

        if ($route_price_result && mysqli_num_rows($route_price_result) > 0) {
            $route_price_row = mysqli_fetch_assoc($route_price_result);
            $route_price = $route_price_row['price'];

            $total_amount = $route_price * $ticket_quantity;

            $query = "INSERT INTO tickets (passenger_name, bus_id, route_id, price, booking_date, booking_time, ticket_quantity, total_amount) 
                      VALUES ('$passenger_name', '$bus_id', '$route_id',
                              '$route_price', CURDATE(), NOW(), '$ticket_quantity', '$total_amount')";

            $result = mysqli_query($conn, $query);

            if ($result) {

                return mysqli_insert_id($conn);
            } else {
                echo "Query: $query<br>";
                echo "Error: " . mysqli_error($conn) . "<br>";

                return false;
            }
        } else {

            return false;
        }
    } else {
        return false;
    }
}

function get_ticket_info($conn, $booking_id) {

    $booking_id = mysqli_real_escape_string($conn, $booking_id);

    $query = "SELECT tickets.ticket_id, tickets.passenger_name, routes.route_name, buses.bus_name, 
              buses.departure_time AS bus_time, tickets.booking_time, tickets.price AS amount,
              tickets.total_amount, tickets.ticket_quantity
              FROM tickets 
              INNER JOIN buses ON tickets.bus_id = buses.bus_id 
              INNER JOIN routes ON tickets.route_id = routes.route_id 
              WHERE tickets.ticket_id = '$booking_id'";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}



?>
