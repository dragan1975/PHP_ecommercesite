<?php
include_once 'core/init.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(change_user_active($id, 1)){
        echo "<img src='img/approve.png'>Nalog korisnika je uspešno aktiviran.";
    }else{
        echo "Došlo je do greške prilikom aktivacije korisnika. Obratite se tehničkoj podršci.";
    }
}
?>