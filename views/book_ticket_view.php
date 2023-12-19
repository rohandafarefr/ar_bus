<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/book-ticket.css">
    <title>Book Ticket</title>
</head>
<body>
    <header class="header">
        <span>Book Ticket</span>
        <nav>
            <a href="../views/home_view.php"><button>Home</button></a>
            <a href="../logout.php"><button>Logout</button></a>
        </nav>
    </header>
    <div class="container">
        <?php
            include('../includes/db.php');

            $routePricesQuery = "SELECT route_name, price FROM routes";
            $routePricesResult = mysqli_query($conn, $routePricesQuery);

            $routePrices = array();

            if ($routePricesResult && mysqli_num_rows($routePricesResult) > 0) {
                while ($row = mysqli_fetch_assoc($routePricesResult)) {
                    $routePrices[$row['route_name']] = $row['price'];
                }
            }
        ?>
        <form action="../controllers/book_ticket_controller.php" method="post" id="bookTicketForm">
            <label for="route">Route:</label>
            <select id="route" name="route_name" required>
                <option value="Select Route" default>Select Route</option>
                <?php
                    $routeQuery = "SELECT * FROM routes";
                    $routeResult = mysqli_query($conn, $routeQuery);

                    if ($routeResult && mysqli_num_rows($routeResult) > 0) {
                        while ($routeRow = mysqli_fetch_assoc($routeResult)) {
                            echo "<option value='{$routeRow['route_name']}'>{$routeRow['route_name']}</option>";
                        }
                    }
                ?>
            </select>

            <label for="bus">Bus:</label>
            <select id="bus" name="bus_name" required>
            <option value="Select Bus" default>Select Bus</option>
                <?php
                    $busQuery = "SELECT * FROM buses";
                    $busResult = mysqli_query($conn, $busQuery);

                    if ($busResult && mysqli_num_rows($busResult) > 0) {
                        while ($busRow = mysqli_fetch_assoc($busResult)) {
                            echo "<option value='{$busRow['bus_name']}'>{$busRow['bus_name']}</option>";
                        }
                    }
                ?>
            </select>

            <label for="quantity">Ticket Quantity (Max 30 per bus):</label>
            <div class="quantity-container">
                <button type="button" id="decrement" onclick="decrementQuantity()" class="btn">-</button>
                <input type="number" id="quantity" name="quantity" min="1" max="30" value="1" class="qut" required>
                <button type="button" id="increment" onclick="incrementQuantity()" class="btn">+</button>
            </div>

            <label for="passenger_name">Booker Name:</label>
            <input type="text" id="passenger_name" name="passenger_name" required>

            <div id="total-price">
                <?php
                    $initialRoute = reset($routePrices);
                    echo "<p>Total Price: {$initialRoute}</p>";
                ?>
            </div>

            <button type="submit" name="book_ticket">Book Ticket</button>
        </form>
    </div>

    <?php 
        include "../includes/footer.php";
     ?>
    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue < 30) {
                quantityInput.value = currentValue + 1;
                updateTotalPrice();
            }
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                updateTotalPrice();
            }
        }

        document.getElementById('quantity').addEventListener('input', updateTotalPrice);

        document.getElementById('route').addEventListener('change', updateTotalPrice);

        updateTotalPrice();

        function updateTotalPrice() {
            var routeSelect = document.getElementById('route');
            var quantityInput = document.getElementById('quantity');
            var totalPriceDiv = document.getElementById('total-price');

            var selectedRoute = routeSelect.value;
            var selectedQuantity = quantityInput.value;

            <?php
                $routePricesQuery = "SELECT route_name, price FROM routes";
                $routePricesResult = mysqli_query($conn, $routePricesQuery);

                $routePrices = array();

                if ($routePricesResult && mysqli_num_rows($routePricesResult) > 0) {
                    while ($row = mysqli_fetch_assoc($routePricesResult)) {
                        $routePrices[$row['route_name']] = $row['price'];
                    }
                }

                echo "var routePrices = " . json_encode($routePrices) . ";";
            ?>

            var totalPrice = routePrices[selectedRoute] * selectedQuantity;
            totalPriceDiv.innerHTML = "<p>Total Price: " + totalPrice.toFixed(2) + "</p>";
        }
    </script>
</body>
</html>
