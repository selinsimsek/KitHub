<?php
include 'veritabani/db_config.php';
session_start();

// Kullanıcı oturumunu kontrol et
if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== 1) {
    echo "Giriş yapmadınız!";
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id']; // Giriş yapan kullanıcı ID'si

// Kitapları al
$sql_books = "SELECT id, title, author FROM books";
$stmt_books = $conn->prepare($sql_books);
$stmt_books->execute();
$result_books = $stmt_books->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $list_name = $_POST['list_name'];
    
    // Yeni okuma listesi oluştur
    $sql_create_list = "INSERT INTO user_reading_lists (user_id, list_name) VALUES (?, ?)";
    $stmt_create_list = $conn->prepare($sql_create_list);
    $stmt_create_list->bind_param("is", $user_id, $list_name);
    $stmt_create_list->execute();
    $list_id = $stmt_create_list->insert_id;

    // Seçilen kitapları listeye ekle
    if (isset($_POST['books'])) {
        foreach ($_POST['books'] as $book_id) {
            $sql_add_book = "INSERT INTO reading_list_books (reading_list_id, book_id) VALUES (?, ?)";
            $stmt_add_book = $conn->prepare($sql_add_book);
            $stmt_add_book->bind_param("ii", $list_id, $book_id);
            $stmt_add_book->execute();
        }
    }

    // Başarıyla oluşturulduktan sonra profil sayfasına yönlendir
    header("Location: profile_page.php");
    exit;
}
?>