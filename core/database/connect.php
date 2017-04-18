<?php
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ecommerce;charset=utf8','root','');
}catch(PDOException $e){
    echo $e->getMessage();
}
?>