<?php
include 'veritabani/db_config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $book_id = $_POST['book_id'];
  $user_id = $_POST['user_id'];
  $review_text = $_POST['review_text'];
  $rating = $_POST['rating'];

  // Yorum eklemek için SQL sorgusu
  $query = "INSERT INTO reviews (book_id, user_id, review_text, rating) VALUES ($book_id, $user_id, '$review_text', $rating)";

  if ($conn->query($query) === TRUE) {
    // Başarıyla yorum eklendikten sonra books tablosundaki rating sütununu güncelle
    $update_query = "
      UPDATE books
      SET rating = (
        SELECT COALESCE(AVG(rating), 0)
        FROM reviews
        WHERE reviews.book_id = books.id
      )
      WHERE id = $book_id
    ";

    if ($conn->query($update_query) === TRUE) {
      // Her şey başarılı olursa yönlendirme yap
      header("Location: commentPage.php?id=" . $book_id);
      exit;
    } else {
      echo "Books tablosundaki rating güncellenirken bir hata oluştu: " . $conn->error;
    }
  } else {
    echo "Yorum eklenirken bir hata oluştu: " . $conn->error;
  }

  $conn->close();
}
?>
