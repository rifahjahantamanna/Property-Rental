<?php
// Database connection
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = "";     // default password for XAMPP is usually empty
$dbname = "test1";  // your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $property_id = $_POST['property_id'];
    $B_id = $_POST['B_id'];  // Assuming B_id is Buyer ID
    $S_id = $_POST['S_id'];  // Assuming S_id is Seller ID
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    // $monthly_rent = $_POST['monthly_rent'];  // Add this line if required later

    // Insert query
    $sql = "INSERT INTO rental_agreement (property_id, B_id, S_id, start_date, end_date) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiss", $property_id, $B_id, $S_id, $start_date, $end_date);

    // Execute statement and check success
    if ($stmt->execute()) {
        echo "Rental agreement has been successfully submitted.";
        // Optionally, redirect to a success page
        header("Location: payment.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
