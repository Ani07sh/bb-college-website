<?php
$conn = mysqli_connect("localhost", "root", "", "bbcollege",3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO inquiries (name, email, message) 
        VALUES ('$name', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Message sent successfully!'); 
    window.location.href='index.html';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>