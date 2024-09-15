<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $marks = $_POST['mark'];

    $stmt = $conn->prepare("UPDATE tbl_class SET name = ?, subject = ?, marks = ? WHERE id = ?");
    $stmt->bind_param('ssii', $name, $subject, $marks, $id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
