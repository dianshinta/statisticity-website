<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statisticity";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get flashcard ID from the request
$id = $_POST['id'];

// SQL query to delete the flashcard
$sql = "DELETE FROM flashcards WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
