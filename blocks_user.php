<?php
include_once 'core/init.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(change_user_active($id, 0)){
        echo "<img src='img/block.png'>Nalog korisnika je sada blokiran.";
    }else{
        echo "Došlo je do greške prilikom blokiranja naloga. Obratite se tehničkoj podršci.";
    }
}
?>