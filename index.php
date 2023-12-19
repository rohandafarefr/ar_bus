<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    <header class="header">
        <span>AR-Bus Tickets Booking System</span>
    </header>
    <div class="login-container">
        <h2>Login</h2>
        <form action="controllers/login_controller.php" method="post">
            
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <button type="submit" name="login">Login</button>
        </form>
        <span>AR-Bus Ticket Booking System</span>
        <span>If you lost your username or password contact support.</span>
    </div>
    <?php 
        include "includes/footer.php";
     ?>
</body>
</html>
