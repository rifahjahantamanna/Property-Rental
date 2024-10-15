<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'test1');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve search criteria from POST request
$location = $_POST['location'];
$apartment_type = $_POST['apartment_type'];
$rent = $_POST['rent'];

// Build SQL query with filters
$query = "SELECT * FROM filtering WHERE 1 = 1";

if (!empty($location)) {
    $query .= " AND location LIKE '%" . $conn->real_escape_string($location) . "%'";
}

if (!empty($apartment_type)) {
    $query .= " AND apartment_type = '" . $conn->real_escape_string($apartment_type) . "'";
}

if (!empty($rent)) {
    $query .= " AND rent <= " . intval($rent);
}

// Execute the query
$result = $conn->query($query);

// Check if any properties are found
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Redirect to the respective page based on apartment type
        if ($row['apartment_type'] == 'Luxury Apartment') {
            header("Location: luxuryy.html");
            exit();
        } elseif ($row['apartment_type'] == 'Family House') {
            header("Location: family.html");
            exit();
        } elseif ($row['apartment_type'] == 'Modern Condo') {
            header("Location: modern.html");
            exit();
        } else {
            // Optional: handle case where apartment type does not match expected values
            echo "<p>Apartment type not recognized.</p>";
        }
    }
} else {
    echo "<p>No results found for the selected filters.</p>";
}



// Close the connection
$conn->close();
?>
