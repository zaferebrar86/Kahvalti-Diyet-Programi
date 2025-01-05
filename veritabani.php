<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=elma_diyet", "elma_diyet", "SelcukEbrarSude05.");
    
}
catch (PDOException $e) {
    echo $e->getMessage();
}
catch (Throwable $e) {
    echo $e->getMessage();
}
?>