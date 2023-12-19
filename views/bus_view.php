<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/bus.css"> 
    <title>Bus Management</title>
</head>
<body>
    <?php
        include('../controllers/bus_controller.php');
    ?>
    <header class="header">
        <span>Bus Management</span>
        <nav>
            <a href="../views/home_view.php"><button>Home</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>

    <div class="container">

        <h2>Bus List</h2>
        <?php
        if ($bus_list) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Bus ID</th>';
            echo '<th>Bus Name</th>';
            echo '<th>Capacity</th>';
            echo '<th>Departure Time</th>';
            echo '<th>Action</th>';
            echo '</tr>';

            foreach ($bus_list as $bus) {
                echo '<tr>';
                echo '<td>' . $bus['bus_id'] . '</td>';
                echo '<td>' . $bus['bus_name'] . '</td>';
                echo '<td>' . $bus['capacity'] . '</td>';
                echo '<td>' . $bus['departure_time'] . '</td>';
                echo '<td>';
                echo '<form action="../controllers/bus_controller.php" method="post">';
                echo '<input type="hidden" name="bus_id" value="' . $bus['bus_id'] . '">';
                echo '<button type="submit" name="delete_bus">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No buses available.</p>';
        }
        ?>


            <div class="form-container">
                <h2>Add Bus</h2>
                <form action="../controllers/bus_controller.php" method="post">
                    <input type="text" id="bus_name" name="bus_name" placeholder="Enter Bus Name" required>
                    <input type="number" id="capacity" name="capacity" placeholder="Enter Capacity" required>

                    <label for="departure_time">Departure Time:</label>
                    <input type="time" id="departure_time" name="departure_time" placeholder="Departure Time:" required>

                    <button type="submit" name="add_bus">Add Bus</button>
                </form>
            </div>
    </div>
    <?php include "../includes/footer.php"; ?>
</body>
</html>
