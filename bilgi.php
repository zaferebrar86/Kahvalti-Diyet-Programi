<?php

//Veritabanı bağlantı bilgileri
$servername = "78.135.111.174";
$username = "elma_diyet";
$password = "SelcukEbrarSude05.";
$dbname = "elma_diyet";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Hata durumunu çalıştırın
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bir hata oluştu: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad']; 
    $soyad = $_POST['soyad'];
    $yas = $_POST['yas'];
    $boy = $_POST['boy'];
    $kilo = $_POST['kilo'];
     // Verileri kaydetme işlemi burada
      try {
        $sql = "INSERT INTO diyet (ad, soyad, yas, boy, kilo) VALUES (:ad, :soyad, :yas, :boy, :kilo)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ad', $ad); 
        $stmt->bindParam(':soyad', $soyad); 
        $stmt->bindParam(':yas', $yas);
        $stmt->bindParam(':boy', $boy);
        $stmt->bindParam(':kilo', $kilo); 
  
        $stmt->execute();
      } catch(PDOException $e) {
          echo "Bir hata oluştu: " . $e->getMessage();
      }
     // Formu temizler. 
    
  }
  
  ?>