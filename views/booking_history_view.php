<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/booking_history.css">
    <title>Booking History</title>
</head>
<body>
    <?php
        include('../controllers/booking_history_controller.php');
    ?>
    <header class="header">
        <span>Book Ticket</span>
        <nav>
            <a href="../views/home_view.php"><button>Home</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>

    <div class="container">
        <?php
        if ($booking_history) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Ticket ID</th>';
            echo '<th>Passenger Name</th>';
            echo '<th>Bus ID</th>';
            echo '<th>Route ID</th>';
            echo '<th>Price</th>';
            echo '<th>Ticket Quantity</th>';
            echo '<th>Total Amount</th>';
            echo '<th>Booking Date</th>';
            echo '<th>Booking Time</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            foreach ($booking_history as $ticket) {
                echo '<tr>';
                echo '<td>' . $ticket['ticket_id'] . '</td>';
                echo '<td>' . $ticket['passenger_name'] . '</td>';
                echo '<td>' . $ticket['bus_id'] . '</td>';
                echo '<td>' . $ticket['route_id'] . '</td>';
                echo '<td>' . $ticket['price'] . '</td>';
                echo '<td>' . $ticket['ticket_quantity'] . '</td>';
                echo '<td>' . $ticket['total_amount'] . '</td>';
                echo '<td>' . $ticket['booking_date'] . '</td>';
                echo '<td>' . $ticket['booking_time'] . '</td>';
                echo '<td>';
                echo '<form action="../controllers/booking_history_controller.php" method="post">';
                echo '<input type="hidden" name="ticket_id" value="' . $ticket['ticket_id'] . '">';
                echo '<button class="print-button" type="submit" name="print_ticket">Print</button>';
                echo '<button class="delete-button" type="submit" name="delete_ticket">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No booking history available.</p>';
        }
        ?>
    </div>
    <?php include "../includes/footer.php"; ?>
</body>
</html>
