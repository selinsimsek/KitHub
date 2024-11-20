<?php
$servername = "localhost";
$username = "root"; // MySQL kullanıcı adı
$password = "";     // MySQL şifresi
$database = "KitHub";

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
