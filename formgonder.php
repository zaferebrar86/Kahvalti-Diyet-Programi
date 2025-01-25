<?php
session_start();
include "veritabani.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adsoyad = $_POST['adsoyad']; 
    $yas = $_POST['yas'];
    $cinsiyet = $_POST['cinsiyet'];
    $boy = $_POST['boy'];
    $kilo = $_POST['kilo'];
    
    $endeks = round(($kilo / ($boy * $boy)) * 10000, 2);
     // Verileri kaydetme işlemi burada
      try {
        $sql = "INSERT INTO diyet (adsoyad, yas, cinsiyet, boy, kilo, endeks) VALUES (:adsoyad, :yas, :cinsiyet, :boy, :kilo, :endeks)"; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':adsoyad', $adsoyad); 
        $stmt->bindParam(':yas', $yas); 
        $stmt->bindParam(':cinsiyet', $cinsiyet);
        $stmt->bindParam(':boy', $boy);
        $stmt->bindParam(':kilo', $kilo);
        $stmt->bindParam(':endeks', $endeks); 
  
        $stmt->execute();
        
        //echo "Başarılı";
        
        $_SESSION["adsoyad"] = $adsoyad;
        $_SESSION["cinsiyet"] = $cinsiyet;
        //if($endeks<18.5) {
        //    header("location: zayif.html");
        //    exit;
        //}
        //if($endeks>=18.5 & $endeks<=24.9) {
        //    header("location: normal.html");
        //    exit;
        //}
        //if($endeks>=25 & $endeks<=29.9) {
        //    header("location: kilolu.html");
        //    exit;
        //}
        //if($endeks>30) {
        //    header("location: kilolu.html");
        //    exit;
        //}
        header("location: kalori-listesi.php");
        
        
      } catch(PDOException $e) {
          echo "Bir hata oluştu: " . $e->getMessage();
      }
     // Formu temizler. 
    
  }
?>