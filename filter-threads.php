<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "statisticity";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get filter parameters from the request
$major = isset($_POST['major']) ? $_POST['major'] : '';
$semester = isset($_POST['semester']) ? $_POST['semester'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';

// Build the SQL query with filters
$sql = "SELECT id, content, author, date, subject, comments FROM threads WHERE 1=1";

if (!empty($major)) {
    $sql .= " AND major = '" . $conn->real_escape_string($major) . "'";
}

if (!empty($semester)) {
    $sql .= " AND semester = '" . $conn->real_escape_string($semester) . "'";
}

if (!empty($subject)) {
    $sql .= " AND subject = '" . $conn->real_escape_string($subject) . "'";
}

$result = $conn->query($sql);

$threads = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['comments'] = json_decode($row['comments'], true);
        $threads[] = $row;
    }
}

$conn->close();

// Return the filtered threads as JSON
header('Content-Type: application/json');
echo json_encode($threads);
