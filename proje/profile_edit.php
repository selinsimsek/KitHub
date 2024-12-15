<?php
include 'profile_users.php' 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Düzenle</title>
  <link rel="stylesheet" href="profile_edit_styles.css">
</head>
<body>
  <div class="profile-container">
    <h1>Profilimi Düzenle</h1>
    <form action="profile_update_process.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Ad:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Soyad:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
      </div>

      <div class="form-group">
        <label for="username">Kullanıcı Adı:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
      </div>

      <div class="form-group">
        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
      </div>

      <div class="form-group">
        <label for="password">Şifre (Yeni Şifre):</label>
        <input type="password" id="password" name="password" placeholder="Yeni şifreyi girin (isteğe bağlı)">
      </div>

      <div class="form-group">
        <label for="profile_picture">Profil Fotoğrafı:</label>
        <input type="file" id="profile_picture" name="profile_picture">
      </div>

      <button type="submit">Profilimi Güncelle</button>
    </form>
  </div>
</body>
</html>
