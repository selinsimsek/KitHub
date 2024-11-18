<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login_styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="depositphotos_63590179-stock-illustration-book-and-sun-logo.jpg" alt="Kitap Logo" class="logo">
        </div>
        <h1>KitHub</h1>
    
        <form action="/login" method="POST">
            <label for="email">Kullanıcı Adı:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Giriş Yap</button>
            <p>Hesabınız yok mu? <a href="signUp_page.php">Kaydol</a></p>
        </form>
    </div>
</body>
</html>
