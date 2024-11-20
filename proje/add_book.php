<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kitap Ekle</title>
  <link rel="stylesheet" href="add_book_styles.css">
</head>
<body>
<?php
    include 'veritabani/db_config.php'; // Veritabanı bağlantısı
  ?>

  <div class="add-book-container">
    <h1>Yeni Kitap Ekle</h1>
    <form action="add_book_process.php" method="POST" enctype="multipart/form-data">
      <label for="title">Kitap Adı:</label>
      <input type="text" id="title" name="title" required>

      <label for="author">Yazar:</label>
      <input type="text" id="author" name="author" required>

      <label for="genre">Kitap Türü:</label>
      <input type="text" id="genre" name="genre"  required>

      <label for="thumbnail">Kitap Resmi:</label>
      <input type="file" id="thumbnail" name="thumbnail" accept="images/*" required>

      <button type="submit">Kitap Ekle</button>
    </form>
  </div>
</body>
</html>
