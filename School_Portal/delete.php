<?php
// delete.php

// Start a session if needed (optional)
 session_start();

// Include your database connection
include('config.php');

// Set header to return JSON response
header('Content-Type: application/json');

// Check if the ID is provided via POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare the DELETE SQL query
      $sql = "UPDATE tbl_class SET status = '0' WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // Bind the ID parameter to the query
    $stmt->bind_param("i", $id);

    // Execute the query
    if ($stmt->execute()) {
        // If successful, return a success response
        echo json_encode(['success' => true]);
    } else {
        // If query fails, return an error response
        echo json_encode(['success' => false, 'message' => 'Failed to delete the record.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If no ID is provided, return an error response
    echo json_encode(['success' => false, 'message' => 'No ID provided.']);
}

// Close the database connection
$conn->close();
?>
