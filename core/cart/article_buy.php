<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_loggedin()) header ('Location: index.php');
if(isset($_GET['article_id'])){
    $article_id = (int)$_GET['article_id'];
    $user_id = (int)$_SESSION['user_id'];
    if(article_buy($article_id, $user_id)){
        echo "Proizvod je u korpi.";
    }else{
        echo "Greska pri kupovini.";
    }
}
?>