<?php
include 'create_reading_list_process.php';
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yeni Okuma Listesi Oluştur</title>
  <link rel="stylesheet" href="create_reading_list_styles.css">
</head>
<body>
  <h1>Yeni Okuma Listesi Oluştur</h1>

  <form method="POST">
    <label for="list_name">Liste Adı:</label>
    <input type="text" id="list_name" name="list_name" required>

    <h3>Kitaplar:</h3>
    <?php
    if ($result_books->num_rows > 0) {
        while ($book = $result_books->fetch_assoc()) {
            echo '<label>';
            echo '<input type="checkbox" name="books[]" value="' . $book['id'] . '"> ';
            echo htmlspecialchars($book['title']) . ' - ' . htmlspecialchars($book['author']);
            echo '</label><br>';
        }
    } else {
        echo '<p>Henüz kitap bulunmuyor.</p>';
    }
    ?>

    <button type="submit">Listeyi Oluştur</button>
  </form>
</body>
</html>
