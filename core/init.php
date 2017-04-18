<?php
session_start();
//error_reporting(0);
require_once 'database/connect.php';
require_once 'functions/users.php';
$errors = array();
//ovdje se obezbjedjujemo od toga da blokirani korisnik ne moze da pristupi dijelu sajta koji mu ne treba biti dozvoljen
//omogucva adminu da onog trenutka kada on blokira korisnika, da se sa osvjezenjem stranice taj korisnik izbaci iz sistema
if(isset($_SESSION['user_id'])){
    $status = user_data($_SESSION['user_id'], 'active');
    if($status['active'] == 0){
        header('Location: logout.php');
        };
}
?>