<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_loggedin()) header ('Location: index.php');
if(isset($_GET['article_id'])){
    $article_id = (int)$_GET['article_id'];
    $user_id = (int)$_SESSION['user_id'];
    if(cart_article_drop($article_id, $user_id)){
		//ako je sve u redu, vraticemo se na onu lokaciju sa koje smo dosli
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        echo "Greska pri izbacivanju artikla iz korpe.";
    }
}
?>