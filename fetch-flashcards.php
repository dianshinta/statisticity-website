<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statisticity";
$email_user = $_SESSION['email'];

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch flashcards
$sql = "SELECT id, major, semester, subject, question, answer FROM flashcards WHERE email_user = '$email_user'";
$result = $conn->query($sql);

$flashcards = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $flashcards[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($flashcards);
