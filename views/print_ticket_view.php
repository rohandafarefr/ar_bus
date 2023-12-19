<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/print.css">
    <title>Print Ticket</title>
</head>
<body>
    <header class="header">
        <span>Print Ticket</span>
        <nav>
            <a href="../views/home_view.php"><button>Home</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>
    <div class="container">
        <?php
        include('../includes/db.php');
        include('../models/book_ticket_model.php');

        $booking_id = isset($_GET['booking_id']) ? (int)$_GET['booking_id'] : 0;

        $ticket_info = get_ticket_info($conn, $booking_id);

        if ($ticket_info) {
            echo '<h2>Booking Successful!</h2>';
            echo '<h3>Ticket Information</h3>';
            echo '<p><strong>Booking ID:</strong> ' . $ticket_info['ticket_id'] . '</p>';
            echo '<p><strong>Passenger Name:</strong> ' . $ticket_info['passenger_name'] . '</p>';
            echo '<p><strong>Route Name:</strong> ' . $ticket_info['route_name'] . '</p>';
            echo '<p><strong>Bus Name:</strong> ' . $ticket_info['bus_name'] . '</p>';
            echo '<p><strong>Bus Time:</strong> ' . $ticket_info['bus_time'] . '</p>';
            echo '<p><strong>Total Amount:</strong> ' . $ticket_info['total_amount'] . '</p>';
            echo '<p><strong>Ticket Quantity:</strong> ' . $ticket_info['ticket_quantity'] . '</p>';
            echo '<p><strong>Booking Time:</strong> ' . $ticket_info['booking_time'] . '</p>';
            echo '<a href="../views/book_ticket_view.php">Book Another Ticket</a>';
        } else {
            echo '<p>Unable to fetch ticket information. Please contact support.</p>';
        }

        mysqli_close($conn);
        ?>

        <button id="printButton">Print Ticket</button>

        <script>
    document.getElementById('printButton').addEventListener('click', function() {
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print Ticket</title>');

        printWindow.document.write('<link rel="stylesheet" type="text/css" href="../css/print-preview.css">');
        
        printWindow.document.write('</head><body>');
        printWindow.document.write(document.querySelector('.container').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    });
</script>
    </div>
</body>
</html>
