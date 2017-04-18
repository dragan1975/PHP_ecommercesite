<?php
include_once 'core/init.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(remove_user($id)){
        echo "<img src='img/remove.png'>Korisnik je trajno izbrisan iz baze.";
    }else{
        echo "Došlo je do greške prilikom brisanja korisnika iz baze. Obratite se tehničkoj podršci.";
    }
}
?>