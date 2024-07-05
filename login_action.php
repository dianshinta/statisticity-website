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
$post_email = $_POST['email'];
$post_password = $_POST['password'];

// Mempersiapkan statement SQL
$stmt = $conn->prepare("SELECT email, password FROM user WHERE email = ?");
if (!$stmt) {
    die("Statement preparation failed: " . $conn->error);
}
$stmt->bind_param("s", $post_email);
$stmt->execute();
$stmt->bind_result($db_email, $db_password);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($db_password && $post_password === $db_password) {
    // Login berhasil
    $_SESSION['email'] = $post_email;
    if (isset($_POST['rememberme'])) {
        setcookie('user_email', $_POST['email'], time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
    }
    header("Location: home.php");
    exit();
} else {
    // Login gagal
    $_SESSION['error'] = "Email atau password salah!";
    header("Location: login.html");
    echo '<p style="color:red;">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);
    exit();
}
