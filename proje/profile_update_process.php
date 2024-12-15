<?php
// Veritabanı bağlantısını dahil et
include 'veritabani/db_config.php';
include 'profile_users.php';

session_start(); // Oturum başlatıyoruz

// Kullanıcı oturumunu kontrol et
if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== 1) {
    echo "Giriş yapmadınız!";
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Giriş yapan kullanıcı ID'sini alıyoruz

// Veritabanından kullanıcı bilgilerini alıyoruz
$sql_user_info = "SELECT id, username, name, last_name, email, password, profile_picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql_user_info);
$stmt->bind_param("i", $user_id); // ID'yi parametre olarak bağlıyoruz
$stmt->execute();
$result_user_info = $stmt->get_result();

if ($result_user_info->num_rows > 0) {
    $user = $result_user_info->fetch_assoc();
} else {
    echo "Kullanıcı bilgileri alınamadı.";
    exit;
}

// Profil bilgilerini düzenlemek için işlem yapılacaksa:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Profil fotoğrafı yükleme işlemi
    $profile_picture = $user['profile_picture']; // Varsayılan olarak eski fotoğrafı kullan

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        // Fotoğraf yüklendiğinde, yeni bir dosya adı oluşturuluyor ve dosya kaydediliyor
        $profile_picture = 'images/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture); // Dosyayı kaydediyoruz
    }
    
    // Şifreyi kontrol et ve hashle
    $password = $_POST['password'];
    if (!empty($password)) {
        // Eğer yeni bir şifre girildiyse, şifreyi hash'liyoruz
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        // Şifre değiştirilmemişse, eski şifreyi kullanıyoruz
        $hashed_password = $user['password']; // Eski şifreyi veritabanından alıyoruz
    }

    // E-posta adresinin benzersiz olup olmadığını kontrol edelim
    $sql_email_check = "SELECT * FROM users WHERE email = ? AND id != ?";
    $stmt_check_email = $conn->prepare($sql_email_check);
    $stmt_check_email->bind_param("si", $email, $user_id);
    $stmt_check_email->execute();
    $result_email_check = $stmt_check_email->get_result();
    if ($result_email_check->num_rows > 0) {
        echo "Bu e-posta adresi zaten kullanımda.";
        exit;
    }

    // Veritabanını güncelleme sorgusu
    $sql_update_user = "UPDATE users SET name = ?, last_name = ?, username = ?, email = ?, password = ?, profile_picture = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update_user);
    $stmt_update->bind_param("ssssssi", $name, $last_name, $username, $email, $hashed_password, $profile_picture, $user_id);
    
    if ($stmt_update->execute()) {
        echo "Profil başarıyla güncellendi.";
        header("Location: profile_page.php"); // Başarılı güncelleme sonrası profil sayfasına yönlendir
        exit;
    } else {
        echo "Profil güncellenemedi: " . $stmt_update->error; // Hata mesajını göster
    }
}

?>