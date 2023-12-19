<!-- routes_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bus.css"> 
    <title>Routes</title>
</head>
<body>
    <?php
        include('../controllers/routes_controller.php');
    ?>
    <header class="header">
        <span>Manage Routes</span>
        <nav>
            <a href="../views/home_view.php"><button>Home</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>



    <div class="container">
        <?php
        if ($routes) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Route ID</th>';
            echo '<th>Route Name</th>';
            echo '<th>Price</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            foreach ($routes as $route) {
                echo '<tr>';
                echo '<td>' . $route['route_id'] . '</td>';
                echo '<td>' . $route['route_name'] . '</td>';
                echo '<td>' . $route['price'] . '</td>';
                echo '<td>';
                echo '<form action="../controllers/routes_controller.php" method="post">';
                echo '<input type="hidden" name="route_id" value="' . $route['route_id'] . '">';
                echo '<button class="delete-button" type="submit" name="delete_route">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No routes available.</p>';
        }
        ?>
    
    <div class="form-container">
        <h2>Add Route</h2>
        <form action="../controllers/routes_controller.php" method="post">
            <input type="text" id="route_name" name="route_name" placeholder="Enter Route Name" required>
            <input type="number" id="price" name="price" placeholder="Enter Price" required>

            <button type="submit" name="add_route">Add Route</button>
        </form>
    </div>
    </div>

    <?php include "../includes/footer.php"; ?>
</body>
</html>
