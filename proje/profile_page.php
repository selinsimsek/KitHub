<?php
// Veritabanı bağlantısını ve kullanıcı bilgilerini dahil et
include 'profile_users.php'; // Bu dosya, kullanıcı bilgilerini ve yorumları alacak

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Sayfası</title>
  <link rel="stylesheet" href="profile_styles.css">
</head>
<body>
  <div class="profile-container">
    <!-- Profil Sayfası -->
    <div class="profile">
      <h1>Profilim</h1>
      <div class="profile-info">
        <div class="profile-picture">
          <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profil Resmi" class="profile-img">
        </div>
        <div class="user-details">
          <p><strong>Ad:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
          <p><strong>Soyad:</strong> <?php echo htmlspecialchars($user['last_name']); ?></p>
          <p><strong>Kullanıcı Adı:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
          <!-- E-posta ve şifreyi burada göstermiyoruz -->
        </div>
      </div>
      <!-- Profil Düzenle Butonu -->
      <a href="profile_edit.php" class="edit-profile-btn">Profili Düzenle</a>
    </div>

    <!-- Profil Sayfası Altı: Yorumlar ve Okuma Listesi -->
    <div class="profile-bottom">
      <!-- Yorumlar -->
      <div class="comments-section">
        <h2>Yorumlarım</h2>
        
        <?php
        // Yorumlar var mı kontrolü
        if ($result_comments->num_rows > 0) {
            // Yorumları döngü ile ekrana yazdırıyoruz
            while ($comment = $result_comments->fetch_assoc()) {
                echo '<div class="comment">';
                echo '<h3>' . htmlspecialchars($comment['book_title']) . ' - ' . htmlspecialchars($comment['book_author']) . '</h3>'; // Kitap başlığını ve yazarını yazdırıyoruz
                echo '<p>' . htmlspecialchars($comment['review_text']) . '</p>'; // Yorum metnini yazdırıyoruz
                echo '<p><small>Yorum Tarihi: ' . htmlspecialchars($comment['created_at']) . '</small></p>';
                echo '</div>';
            }
        } else {
            echo '<p>Henüz yorum yapılmamış.</p>';
        }
        ?>
      </div>

      <!-- Okuma Listesi -->
      <div class="reading-list-section">
        <h2>Okuma Listem</h2>

        <?php
        // Okuma listelerini al
        $sql_lists = "SELECT id, list_name FROM user_reading_lists WHERE user_id = ?";
        $stmt_lists = $conn->prepare($sql_lists);
        $stmt_lists->bind_param("i", $user_id);
        $stmt_lists->execute();
        $result_lists = $stmt_lists->get_result();

        if ($result_lists->num_rows > 0) {
            // Okuma listelerini döngü ile ekrana yazdırıyoruz
            while ($list = $result_lists->fetch_assoc()) {
                echo '<div class="reading-list-item">';
                echo '<h3>' . htmlspecialchars($list['list_name']) . '</h3>';

                // Bu listeye ait kitapları getir
                $list_id = $list['id'];
                $sql_books_in_list = "
                    SELECT b.title AS book_title, b.author AS book_author
                    FROM reading_list_books rlb
                    JOIN books b ON rlb.book_id = b.id
                    WHERE rlb.reading_list_id = ?
                ";
                $stmt_books_in_list = $conn->prepare($sql_books_in_list);
                $stmt_books_in_list->bind_param("i", $list_id);
                $stmt_books_in_list->execute();
                $result_books_in_list = $stmt_books_in_list->get_result();

                if ($result_books_in_list->num_rows > 0) {
                    while ($book = $result_books_in_list->fetch_assoc()) {
                        echo '<p>' . htmlspecialchars($book['book_title']) . ' - ' . htmlspecialchars($book['book_author']) . '</p>';
                    }
                } else {
                    echo '<p>Bu listede henüz kitap yok.</p>';
                }

                echo '</div>';
            }
        } else {
            echo '<p>Henüz okuma listesi oluşturulmamış.</p>';
        }
        ?>

        <!-- Yeni Liste Butonu -->
        <a href="create_reading_list.php" class="add-list-btn">+</a>
      </div>
    </div>

    <!-- Geri Dön Butonu -->
    <button class="go-back-btn" onclick="goBack()">Geri Dön</button>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }
  </script>

  
</body>
</html>

<?php
$conn->close(); // Veritabanı bağlantısını kapatıyoruz
?>
