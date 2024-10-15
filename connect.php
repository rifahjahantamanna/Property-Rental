<?php
    $name = $_POST['username'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];
    $phone = $_POST['phone'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test1');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        // Check if the username already exists
        $check_query = $conn->prepare("SELECT * FROM login WHERE username = ?");
        $check_query->bind_param("s", $name);
        $check_query->execute();
        $check_query->store_result();

        // If username exists, prompt the user to choose another one
        if ($check_query->num_rows > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Generate a new Buyer ID (B_id)
            $result = $conn->query("SELECT B_id FROM login ORDER BY B_id DESC LIMIT 1");
            $last_id = $result->fetch_assoc();

            if ($last_id) {
                // Extract the number from the last B_id and increment it
                $last_number = intval(str_replace("Buyer_", "", $last_id['B_id']));
                $new_buyer_id = 'Buyer_' . ($last_number + 1);
            } else {
                // If no Buyer ID exists, start with Buyer_1
                $new_buyer_id = 'Buyer_1';
            }

            // Prepared statement to insert username, password, email, phone, and B_id
            $stmt = $conn->prepare("INSERT INTO login (B_id, username, password, mail, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $new_buyer_id, $name, $password, $mail, $phone);

            // Execute the query
            if ($stmt->execute()) {
                echo "Sign Up Successful. Your Buyer ID is: " . $new_buyer_id;
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $check_query->close();
        $conn->close();
    }
?>
