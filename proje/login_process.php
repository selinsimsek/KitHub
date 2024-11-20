<?php
session_start();
$_SESSION['islogin']= 0;
include 'veritabani/db_config.php'; // Veritabanı bağlantısı
// Kullanıcıdan gelen veriler
$username = $_POST['username'];
$password = $_POST['password'];

// Veritabanından kullanıcıyı sorgulama
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Kullanıcı var mı kontrolü
if ($result->num_rows > 0) {
    // Kullanıcıyı al
    $user = $result->fetch_assoc();

    // Şifreyi doğrulama
    if (password_verify($password, $user['password'])) {
        // Giriş başarılıysa oturum başlat
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; // İsterseniz kullanıcı adı da saklayabilirsiniz
        $_SESSION['islogin']= 1;
        // Ana sayfaya yönlendirme
        header("Location: homePage.php");
        exit;
    } else {
        // Hatalı şifre
        echo "Şifre yanlış!";
    }
} else {
    // Kullanıcı bulunamadı
    echo "Kullanıcı bulunamadı!";
}

// Veritabanı bağlantısını kapat
$stmt->close();
$conn->close();
?>
