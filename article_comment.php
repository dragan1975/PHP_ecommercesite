<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';

if(is_admin() and isset($_GET['delete_comment_id'])){
    $id = (int)$_GET['delete_comment_id'];
    if(!delete_comment($id)) die('Greška pri brisanju komentara.');
}
if(!is_loggedin()) exit('Morate biti ulogovani da biste komentarisali proizvode i videli komentare.');
if(isset($_POST['comment']) AND isset($_GET['article_id']) AND isset($_GET['user_id'])){
    $comment = htmlentities($_POST['comment'], ENT_QUOTES); 
    if(!insert_comment($_GET['user_id'], $_GET['article_id'], $comment)){
        echo "<b>Greška pri unosu komentara u bazu.</b>";
    }
}
if(isset($_GET['article_id'])){
    $article_id = (int)$_GET['article_id'];
    $comments = comments($article_id);
    if($comments){
        ?>
        <h3>Komentari o proizvodu</h3>
        <?php
        foreach ($comments as $comment){
            ?>
                <h4><?php echo $comment['first_name'] ?></h4>
                <small><?php echo $comment['time'] ?></small>
                <p><?php echo $comment['comment'] ?></p>
                <?php if(is_admin()){ ?>
                <a href="article_comment.php?article_id=<?php echo $article_id ?>&delete_comment_id=<?php echo $comment['comment_id'] ?>">Ukloni komentar</a>
                <?php }?>
                <hr>
            <?php
        }
    }else{
        echo 'Nema komentara za ovaj proizvod.';
    }
    ?>
    
        <form action="article_comment.php?article_id=<?php echo $article_id ?>&user_id=<?php echo $_SESSION['user_id'] ?>" method="POST">
            <label for="comment">Vaš komentar</label></br>
            <textarea cols=40 rows=5 name="comment"></textarea></br>
            <input type="submit" value="Pošalji">
        </form>
    
    <?php
}
?>