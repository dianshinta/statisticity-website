<!-- add-thread.php -->
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

// Mendapatkan data dari form
$content = $_POST['content'];
$author = $_POST['author'];
$subject = $_POST['subject'];
$comments = json_encode([]);  // Initial empty comments array

// Mempersiapkan statement SQL
$stmt = $conn->prepare("INSERT INTO threads (content, author, subject, comments) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}
$stmt->bind_param("ssss", $content, $author, $subject, $comments);
$stmt->execute();

$stmt->close();
$conn->close();

// Redirect back to forum page
header("Location: forum.php");
exit();
?>
