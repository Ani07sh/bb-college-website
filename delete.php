<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header('Location: login.php');
  exit();
}

$conn = mysqli_connect("localhost", "root", "", "bbcollege", 3307);
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM inquiries WHERE id = $id");
header('Location: admin.php');
exit();
?>