<?php
session_start();
if(isset($_SESSION['email'])) {
    echo '<li><a href="logout.php">LOGOUT</a></li>';
} else {
    echo '<li><a href="login.html">LOGIN</a></li>';
}
?>