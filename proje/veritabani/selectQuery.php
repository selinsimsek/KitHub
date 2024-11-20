<?php
        // Kitapları veritabanından çekme
        $sql = "SELECT * FROM books";  // Veritabanındaki tüm kitapları seçiyoruz
        $result = $conn->query($sql); // SQL sorgusunu çalıştır ?>