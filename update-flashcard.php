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

// Get flashcard data from the request
$id = $_POST['id'];
$major = $_POST['major'];
$semester = $_POST['semester'];
$subject = $_POST['subject'];
$question = $_POST['question'];
$answer = $_POST['answer'];

// SQL query to update the flashcard
$sql = "UPDATE flashcards SET major = ?, semester = ?, subject = ?, question = ?, answer = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssi", $major, $semester, $subject, $question, $answer, $id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

$stmt->close();
$conn->close();
