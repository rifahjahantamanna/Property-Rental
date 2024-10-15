<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "test1"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $inputUsername = $_POST['username'];
    $inputPassword = trim($_POST['password']);


    // Prepare SQL to check if the username exists
    $sql = "SELECT * FROM sellersignup WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
        
        // Compare the input password with the stored password
        if ($inputPassword === $user['password']) {
            header("Location: seller_pro.php");
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Username not found. Please sign up.";
    }

    $stmt->close();
}

$conn->close();
?>
