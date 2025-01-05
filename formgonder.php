<?php
include "veritabani.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad = $_POST['ad']; 
    $soyad = $_POST['soyad'];
    $yas = $_POST['yas'];
    $boy = $_POST['boy'];
    $kilo = $_POST['kilo'];
    
    $endeks = round(($kilo / ($boy * $boy)) * 10000, 2);
     // Verileri kaydetme işlemi burada
      try {
        $sql = "INSERT INTO diyet (ad, soyad, yas, boy, kilo, endeks) VALUES (:ad, :soyad, :yas, :boy, :kilo, :endeks)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ad', $ad); 
        $stmt->bindParam(':soyad', $soyad); 
        $stmt->bindParam(':yas', $yas);
        $stmt->bindParam(':boy', $boy);
        $stmt->bindParam(':kilo', $kilo);
        $stmt->bindParam(':endeks', $endeks); 
  
        $stmt->execute();
        
        //echo "Başarılı";
        if($endeks<18.5) {
            header("location: zayif.html");
            exit;
        }
        if($endeks>=18.5 & $endeks<=24.9) {
            header("location: normal.html");
            exit;
        }
        if($endeks>=25 & $endeks<=29.9) {
            header("location: kilolu.html");
            exit;
        }
        if($endeks>30) {
            header("location: kilolu.html");
            exit;
        }
        
        
      } catch(PDOException $e) {
          echo "Bir hata oluştu: " . $e->getMessage();
      }
     // Formu temizler. 
    
  }
?>