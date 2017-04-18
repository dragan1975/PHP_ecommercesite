<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    if(change_article_action($id, 'DA')){
        echo "<img src='img/approve.png'>Ovaj artikl je sada na akciji.";
    }else{
        echo "Došlo je do greške prilikom aktiviranja akcije za proizvod. Obratite se tehničkoj podršci.";
    }
}
?>