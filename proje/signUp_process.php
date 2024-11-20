<?php
include 'veritabani/db_config.php'; // Veritabanı bağlantısı

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formdan gelen veriler
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // Şifre doğrulama
    if ($password !== $confirm_password) {
        echo "Şifreler eşleşmiyor!";
        exit;
    }

    // Şifreyi hashle
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Veritabanına kaydetmek için SQL sorgusunu hazırla
    $query = "INSERT INTO users (name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";
    
    // Sorguyu hazırla
    $stmt = $conn->prepare($query);
    
    // Parametreleri bağla (s: string, s: string, s: string, s: string, s: string)
    $stmt->bind_param("sssss", $first_name, $last_name, $username, $email, $password_hash);

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        echo "Kayıt başarılı! Şimdi giriş yapabilirsiniz.";
        header("Location: login_page.php");
        exit;
    } else {
        echo "Bir hata oluştu: " . $stmt->error;
    }

    // Bağlantıyı kapat
    $stmt->close();
    $conn->close();
}
?>
