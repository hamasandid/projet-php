<?php
require 'config1.php';

$data = array(
    'id_blog' => $_POST['id_blog'],
    'id_user' => $_POST['id_user'],
    'message' => $_POST['message'],
    'date' => $_POST['date'],
);

// Check if the id_blog and id_user values exist in their respective tables






// If the values exist in their respective tables, prepare the INSERT statement
$stmt = $pdo->prepare("INSERT INTO commentaire (id_blog, message, id_user, date) VALUES (:id_blog, :message, :id_user, :date)");

// Bind the values from the $data array to the placeholders in the query
$stmt->bindParam(':id_blog', $data['id_blog']);
$stmt->bindParam(':message', $data['message']);
$stmt->bindParam(':id_user', $data['id_user']);
$stmt->bindParam(':date', $data['date']);

// Execute the query
if ($stmt->execute()) {
     
     echo "good";
    exit();
} else {
    echo "Error inserting data: " . $stmt->errorInfo()[2];
}
