<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'test1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the search term from the form
$search_term = $_POST['search_term'];

// SQL query to search for matching property names
$sql = "SELECT * FROM pName WHERE name LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%" . $search_term . "%";
$stmt->bind_param("s", $search_term);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if any results were found
if ($result->num_rows > 0) {
    // Fetch the first matching row
    $row = $result->fetch_assoc();
    
    // Redirect based on the row name
    if ($row['name'] == 'Luxury Apartment') {
        header('Location: luxuryy.html');
        exit();
    } elseif ($row['name'] == 'Family House') {
        header('Location: family.html');
        exit();
    } elseif ($row['name'] == 'Modern Condo') {
        header('Location: modern.html');
        exit();
    }
} else {
    // If no results were found, you can redirect to a "not found" page or show a message
    echo "<p>No matching properties found.</p>";
}

// Close the connection
$stmt->close();
$conn->close();
?>
