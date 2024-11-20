<?php
// Veritabanı bağlantısını dahil et
include 'veritabani/db_config.php';

// Form gönderildiğinde çalışacak kod
if (isset($_POST['title'])) {
    // Formdan gelen verileri al
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    
    // Resmin dosya yolunu al
    $thumbnail = $_FILES['thumbnail']['name'];
    $thumbnail_tmp = $_FILES['thumbnail']['tmp_name'];
    

    // Resmin kaydedileceği hedef dizin
    $target_dir = "images/"; // Resimlerin kaydedileceği dizin
    $target_file =  $target_dir . basename($thumbnail);
    
    



    // Resmi yükle
    if (move_uploaded_file($thumbnail_tmp, $target_file)) {
        // SQL sorgusuyla kitap ekle
        $query = "INSERT INTO books (title, author,genre, thumbnail) 
                  VALUES ('$title', '$author','$genre', '$thumbnail')";
                


        if (mysqli_query($conn, $query)) {
            echo "Kitap başarıyla eklendi.";
            header("Location: homePage.php"); // Kitap başarıyla eklendikten sonra anasayfaya yönlendirebilirsiniz.
        } else {
            echo "Hata: " . mysqli_error($conn);
        }
    }
     else {
        echo "Resim yükleme hatası!";
    }
}


// Veritabanı bağlantısını kapat
mysqli_close($conn);
?>