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
  ?>

  <div class="sidebar">
    <div class="profile">
      <div class="profile-picture"></div>
      <ul class="menu">
        <li>Profil</li>
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
      <button class="add-book">+</button>
      <input type="text" placeholder="Ara..." class="search-bar">
    </header>

    <div class="books">
      <?php
        // Kitapları veritabanından çekme
        $sql = "SELECT * FROM books";  // Veritabanındaki tüm kitapları seçiyoruz
        $result = $conn->query($sql); // SQL sorgusunu çalıştır

        if ($result->num_rows > 0) {
          // Veritabanında kitap varsa, her kitabı HTML içinde görüntüle
          while($row = $result->fetch_assoc()) {
            echo '<div class="book">';
            echo '<div class="thumbnail"><img src="images/' . $row["thumbnail"] . '" alt="' . $row["title"] . '"></div>';// Kitap resmini göster
            echo '<div class="rating">★' . str_repeat('★', floor($row["rating"])) . '☆' . str_repeat('☆', 5 - floor($row["rating"])) . '</div>'; // Kitap puanını göster
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
      // Burada oturumu kapatma işlemi yapılabilir (örneğin, oturum bilgisini silmek)
      
      // Login sayfasına yönlendirme
      window.location.href = "login_page.php";  // Burada login sayfanızın doğru adresini kullanın
    }
  </script>
</body>
</html>
