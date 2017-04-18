<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(remove_article($id)){
        echo "<img src='img/remove.png'>Artikl je trajno izbrisan iz baze.";
    }else{
        echo "Došlo je do greške prilikom brisanja artikla iz baze. Obratite se tehničkoj podršci.";
    }
}
?>