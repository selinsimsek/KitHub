<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KitHub</title>
  <link rel="stylesheet" href="homePage_styles.css">
</head>
<body>
  <?php
    include 'veritabani/db_config.php'; // Veritabanı bağlantısı
    include 'veritabani/selectQuery.php'; // Select * From
    session_start();
    if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== 1) {    
        echo "Giriş yapmadınız!";
        header("Location: login_page.php");  // Giriş yapmamışsa login sayfasına yönlendir
        exit;
    }
    $user_id = $_SESSION['user_id']; // Kullanıcı ID'sini alıyoruz
  ?>

  <div class="sidebar">
    <div class="profile">
      <div class="profile-picture"></div>
      <ul class="menu">
        <li><a href="profile_page.php">Profil</a></li>
        <li>Listeler</li>
        <li>Takipçiler</li>
        <li>Takip Edilen</li>
        <li>Hedefler</li>
        <li>Değerlendirmeler</li>
      </ul>
      <button class="logout" onclick="logout()">Oturumu Kapat</button>
    </div>
  </div>

  <div class="main">
    <header>
      <a href="add_book.php">
      <button class="add-book">+</button>
      </a>
      <input type="text" placeholder="Ara..." class="search-bar">
    </header>

    <div class="books">
      <?php
        if ($result->num_rows > 0) {
          // Veritabanında kitap varsa, her kitabı HTML içinde görüntüle
          while($row = $result->fetch_assoc()) {
            $book_id = $row["id"]; // Kitap id'si
            echo '<div class="book" onclick="goToComments(' . $row['id'] . ')">'; // Sadece kitap ID'sini gönderiyoruz
            echo '<div class="thumbnail"><img src="images/' . $row["thumbnail"] . '" alt="' . $row["title"] . '"></div>';  // Kitap resmini göster
            echo '<div class="rating">' . str_repeat('★', floor($row["rating"])) . '☆' . str_repeat('☆', 5 - floor($row["rating"])) . '</div>';
            echo '<h3>' . $row["title"] . '</h3>';
            echo '<p>' . $row["author"] . '</p>';
            echo '</div>';
          }
        } else {
          echo "Kitap bulunamadı.";
        }
        // Bağlantıyı kapatma
        $conn->close();
      ?>
    </div>
  </div>

  <script>
    // Oturumu kapatma fonksiyonu
    function logout() {
      window.location.href = "log_out.php";  // Oturum kapama sayfasına yönlendir
    }

    // Kitap kutusuna tıklanıldığında yorum sayfasına yönlendiren fonksiyon
    function goToComments(bookId, userId) {
      window.location.href = "commentPage.php?id=" + bookId  // Yorum sayfasına yönlendir
    }

  </script>
</body>
</html>
