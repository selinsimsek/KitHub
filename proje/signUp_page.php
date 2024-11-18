<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaydol - KitHub</title>
    <link rel="stylesheet" href="login_styles.css">
</head>
<body>
    <div class="signup-container">
        <!-- Logo ve başlık -->
        <div class="logo-container">
            <img src="depositphotos_63590179-stock-illustration-book-and-sun-logo.jpg" alt="Kitap Logo" class="logo">
            <h1>KitHub</h1>
        </div>

        <!-- Kaydol formu -->
        <form action="/signup" method="POST">
            <label for="first-name">Ad:</label>
            <input type="text" id="first-name" name="first-name" required> 

            <label for="last-name">Soyad:</label>
            <input type="text" id="last-name" name="last-name" required> 

            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Şifreyi Onayla:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Kaydol</button>
            <p>Zaten hesabınız var mı? <a href="login_page.php">Giriş Yap</a></p>
        </form>
    </div>
</body>
</html>
