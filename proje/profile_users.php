<?php
// Veritabanı bağlantısını dahil et
include 'veritabani/db_config.php'; // Veritabanı bağlantısı dosyanız

session_start(); // Oturum başlatıyoruz

// Kullanıcı oturumunu kontrol et
if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== 1) {
    // Eğer kullanıcı giriş yapmamışsa, login sayfasına yönlendir
    echo "Giriş yapmadınız!";
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Giriş yapan kullanıcı ID'sini alıyoruz

// Kullanıcı bilgilerini alıyoruz
$sql_user_info = "SELECT id, username, name, last_name, profile_picture, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql_user_info);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result_user_info = $stmt->get_result();

// Eğer kullanıcı bilgisi varsa, veriyi alıyoruz
if ($result_user_info->num_rows > 0) {
    $user = $result_user_info->fetch_assoc();
} else {
    echo "Kullanıcı bilgileri alınamadı.";
    exit;
}

// Kullanıcının yorumlarını almak için, reviews tablosunu kitap ve kullanıcı bilgileriyle birlikte sorguluyoruz
$sql_comments = "
    SELECT r.review_text, r.created_at, b.title AS book_title, b.author AS book_author 
    FROM reviews r
    JOIN books b ON r.book_id = b.id
    WHERE r.user_id = ? ORDER BY r.created_at DESC
";
$stmt_comments = $conn->prepare($sql_comments);
$stmt_comments->bind_param("i", $user_id); // Kullanıcı ID'sine göre filtreliyoruz
$stmt_comments->execute();
$result_comments = $stmt_comments->get_result();
?>
