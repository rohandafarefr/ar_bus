<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Home</title>
</head>
<body>
    
    <header class="header">
        <span>Welcome, Admin</span>
        <nav>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>

    <div class="container">
        <div class="btns">
            <a href="../views/book_ticket_view.php">Book New Ticket</a>
            <a href="../views/booking_history_view.php">Booking History</a>
            <a href="../views/bus_view.php">View Buses</a>
            <a href="../views/routes_view.php">View Routes</a>
        </div>
    </div>

    <?php 
        include "../includes/footer.php";
     ?>
</body>
</html>
