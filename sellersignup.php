<?php
session_start();

$username = trim($_POST['username']);
$password = trim($_POST['password']); 
$email = trim($_POST['mail']);
$phone = trim($_POST['phone']);

// Validate input
if (empty($username) || empty($password) || empty($email) || empty($phone)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: seller_sign_up.html");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: seller_sign_up.html");
    exit();
}

if (!preg_match('/^[0-9]{11}$/', $phone)) {
    $_SESSION['error'] = "Invalid phone number format. Please enter an 11-digit phone number.";
    header("Location: seller_sign_up.html");
    exit();
}

// Create a connection
$conn = new mysqli('localhost', 'root', '', 'test1');

// Check connection
if ($conn->connect_error) {
    $_SESSION['error'] = "Database connection failed. Please try again later.";
    header("Location: seller_sign_up.html");
    exit();
}

// Check if the username already exists
$check_query = $conn->prepare("SELECT * FROM sellersignup WHERE username = ?");
$check_query->bind_param("s", $username);
$check_query->execute();
$check_query->store_result();

if ($check_query->num_rows > 0) {
    $_SESSION['error'] = "Username already exists. Please choose a different username.";
    header("Location: seller_sign_up.html");
    exit();
} else {
    // Hash the password for secure storage (consider using password_hash)
    $hashedPassword = $password;

    // Prepare to insert data
    $stmt = $conn->prepare("INSERT INTO sellersignup (username, password, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $hashedPassword, $email, $phone);

    // Execute the statement
    if ($stmt->execute()) {
        // Get the last inserted ID
        $S_id = $stmt->insert_id;
        $_SESSION['success'] = "Sign Up Successful. Your seller ID is $S_id.";
        echo"Sign Up Successful. Your seller ID is $S_id ";
        // header("Location: seller.html");
        exit();
    } else {
        $_SESSION['error'] = "An error occurred: " . $stmt->error;
        header("Location: seller_sign_up.html");
        exit();
    }
}

// Close the statement and connection
$stmt->close();
$check_query->close();
$conn->close();
?>
