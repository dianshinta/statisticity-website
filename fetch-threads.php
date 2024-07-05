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

// SQL query to fetch threads
$sql = "SELECT id, content, author, date, subject, comments FROM threads";
$result = $conn->query($sql);

$threads = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $threads[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($threads);
