<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = "";     // default password is empty in XAMPP
$dbname = "test1";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $P_id = $_POST['P_id'];
    $Payment_id = $_POST['Payment_id'];
    $Amount = $_POST['Amount'];
    $Method_type = $_POST['Method_type'];
    $Status = $_POST['Status'];
    $s_id = $_POST['s_id'];
    $b_id = $_POST['b_id'];

    // Prepare and bind the SQL query
    $stmt = $conn->prepare("INSERT INTO payment (Payment_id, P_id, Amount, Method_type, Status, s_id, b_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iidssii", $Payment_id, $P_id, $Amount, $Method_type, $Status, $s_id, $b_id);

    // Execute the query and handle the result
    if ($stmt->execute()) {
        // Redirect to final.html upon success
        header("Location: final.html");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
