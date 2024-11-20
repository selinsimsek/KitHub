<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kitap Yorumları</title>
  <link rel="stylesheet" href="commentPage_styles.css">
</head>
<body>
  <h1>Kitap Yorumları</h1>

  <div class="comment-container">
    <?php
    include 'veritabani/db_config.php';
    session_start();
    $user_id=$_SESSION['user_id'];
    if (!isset($_SESSION['islogin']) || $_SESSION['islogin'] !== 1) {    
      echo "Giriş yapmadınız!";
      header("Location: login_page.php");  // Giriş yapmamışsa login sayfasına yönlendir
      exit;
    }
    // Kitap ID'sini al
    $book_id = $_GET['id'];
    // Yorumları çek
    $query = "SELECT reviews.review_text, reviews.rating, users.name, users.last_name , users.username  FROM reviews JOIN users on reviews.user_id= users.id WHERE reviews.book_id = $book_id ";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="comment">';
        echo '<strong>' . $row['username'] . ':</strong>';  // Burada kullanıcı adı veya id'si yerine başka bir şey yazabilirsiniz
        echo '<p>' . $row['review_text'] . '</p>';
        echo '<p><strong>Puan:</strong> ' . $row['rating'] . '/5</p>';
        echo '</div>';
      }
    } else {
      echo '<p class="no-comments">Bu kitap için henüz yorum yok.</p>';
    }
    ?>
  </div>

  <!-- Artı Tuşu -->
  <button class="add-comment-button" onclick="openModal()">+</button>

  <!-- Modal -->
  <div class="modal" id="commentModal">
    <div class="modal-content">
      <span class="close-button" onclick="closeModal()">&times;</span>
      <h2>Yorum Yap</h2>
      <form action="commentAdd_process.php" method="POST">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

        <!-- Oturumdan alınan kullanıcı ID'si -->
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

        <label for="review_text">Yorumunuz:</label>
        <textarea id="review_text" name="review_text" rows="4" required></textarea>

        <label for="rating">Puan Ver (1-5):</label>
        <select id="rating" name="rating" required>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button type="submit" class="submit-button">Gönder</button>
      </form>
    </div>
  </div>

  <a href="homePage.php" class="back-button">Geri Dön</a>
  
  <script src="commentPage_script.js"></script>
</body>
</html>
