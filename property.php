<?php
// Include the database connection
//include 'propconnect.php';
//<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test1';

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $property_name = mysqli_real_escape_string($connection, $_POST['property_name']);
    $description = mysqli_real_escape_string($connection, $_POST['description']);
    $city = mysqli_real_escape_string($connection, $_POST['city']);
    $area = mysqli_real_escape_string($connection, $_POST['area']);
    $sellerid = mysqli_real_escape_string($connection, $_POST['sellerid']);
    $price = mysqli_real_escape_string($connection, $_POST['price']);
    $property_type = mysqli_real_escape_string($connection, $_POST['property_type']);
    
    session_start();  // Start session

    // Handle image upload
    $target_dir = "C:/xampp/htdocs/test/test/uploads/";  // Full path to directory
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a valid image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check === false) {
        die("File is not an image.");
    }

    // Move the uploaded file to the 'uploads' directory
    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

    // Insert property details into the database
    $sql = "INSERT INTO property (property_name, description, area, city, s_id, price, property_type, image)
            VALUES ('$property_name', '$description', '$area', '$city', '$sellerid', '$price', '$property_type', '$target_file')";

    if (mysqli_query($connection, $sql)) {
        // Redirect to sellerConfirmation.html on success
        header("Location: sellerConfirmation.html");
        exit();  // Ensure no further code is executed
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
