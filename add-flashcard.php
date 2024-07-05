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

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    die("User not logged in");
}

// Mendapatkan data dari form
$email_user = $_SESSION['email'];  // Get the email from the session
$major = $_POST['major'];
$semester = $_POST['semester'];
$subject = $_POST['subject'];
$question = $_POST['question'];
$answer = $_POST['answer'];

// Memeriksa apakah semua data telah diisi
if (empty($major) || empty($semester) || empty($subject) || empty($question) || empty($answer)) {
    die("All fields are required");
}

// Mempersiapkan statement SQL
$stmt = $conn->prepare("INSERT INTO flashcards (email_user, major, semester, subject, question, answer) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssss", $email_user, $major, $semester, $subject, $question, $answer);

// Execute statement
if (!$stmt->execute()) {
    die("Insertion failed: " . $stmt->error);
}

$stmt->close();
$conn->close();

// Redirect back to the-flashcards page
header("Location: the-flashcards.php");
exit();
