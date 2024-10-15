<?php
    // Start the session
    session_start();

    // Get username and password from form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test1');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to check if the username and password exist in the 'login' table
    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the credentials exist
    if ($result->num_rows > 0) {
        // Credentials exist, log the user in and redirect to the next page
        $_SESSION['username'] = $username;  // Set session variable
        header("Location: dashboard.php");  // Redirect to dashboard or next page
        exit();
    } else {
        // Credentials don't exist, show login error
        $error = "Invalid username or password";
        header("Location: login.html?error=" . urlencode($error));  // Redirect back to login page with error
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
?>
