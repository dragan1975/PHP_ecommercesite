<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_loggedin()) header ('Location: index.php');
if(isset($_SESSION['user_id'])){
    $user_id = (int)$_SESSION['user_id'];
    if(cart_close($user_id)){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        echo "Greska pri zatvaranju korpe.";
    }
}
?>