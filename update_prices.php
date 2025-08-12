<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "code_camp_bd_fos";

$db = mysqli_connect($servername, $username, $password, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to update prices with realistic Indian food prices
function updateDishPrices($db) {
    // Update prices for all dishes with realistic Indian food prices
    $update_query = "UPDATE dishes SET price = 
        CASE 
            WHEN price > 2000 THEN FLOOR(200 + (RAND() * 300))  /* High-end dishes: ₹200-500 */
            WHEN price > 1000 THEN FLOOR(150 + (RAND() * 200))  /* Mid-range dishes: ₹150-350 */
            WHEN price > 500 THEN FLOOR(80 + (RAND() * 120))    /* Regular dishes: ₹80-200 */
            WHEN price > 100 THEN FLOOR(40 + (RAND() * 80))     /* Small dishes: ₹40-120 */
            ELSE FLOOR(30 + (RAND() * 50))                      /* Basic items: ₹30-80 */
        END";
    
    $result = mysqli_query($db, $update_query);
    
    if ($result) {
        $affected_rows = mysqli_affected_rows($db);
        return "Successfully updated prices for $affected_rows dishes to realistic Indian prices.";
    } else {
        return "Error updating prices: " . mysqli_error($db);
    }
}

// Execute the price update
$message = updateDishPrices($db);

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Dish Prices</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
            background: #f5f5f5;
        }
        .message {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dish Price Updater</h1>
        <div class="message">
            <?php echo $message; ?>
        </div>
        <p>All dish prices have been updated to realistic Indian price ranges.</p>
        <a href="dishes.php" class="btn">View Updated Menu</a>
    </div>
</body>
</html>
