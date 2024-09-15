<?php
session_start();
include('config.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from POST request
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $subject = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : '';
    $mark = isset($_POST['mark']) ? (int) $_POST['mark'] : 0; // Cast to integer
    $confirm_update = isset($_POST['confirm_update']) ? (bool) $_POST['confirm_update'] : false;

    // Validate data (basic validation, customize as needed)
    if (empty($name) || empty($subject) || empty($mark)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    // Check if a record with the same name and subject already exists
    $sql = "SELECT * FROM tbl_class WHERE name = ? AND subject = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $subject);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if ($confirm_update) {
            // Update marks if user confirms the update
            $update_sql = "UPDATE tbl_class SET marks = ? WHERE name = ? AND subject = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("iss", $mark, $name, $subject); // Set marks to new value

            if ($update_stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Marks updated successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error updating marks: " . $update_stmt->error]);
            }

            $update_stmt->close();
        } else {
            // Send a response to confirm the update
            echo json_encode(["status" => "confirm", "message" => "Student already exists. Do you want to update the marks?"]);
        }
    } else {
        // Record does not exist, insert a new one
        $insert_sql = "INSERT INTO tbl_class (name, subject, marks) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ssi", $name, $subject, $mark);

        if ($insert_stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Student added successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error adding record: " . $insert_stmt->error]);
        }

        $insert_stmt->close();
    }

    // Close the connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
