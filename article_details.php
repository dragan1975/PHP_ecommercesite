<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');
if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $article = article_data($id);
    if(!$article){
        die('GREŠKA! Artikl ne postoji u bazi.');
    }
}
?>

<h3><img src="img/info.png">Informacioni karton za artikal</h3><hr>
<table>
    <?php
        foreach ($article as $key=>$value){
            echo "<tr><td align='right'>" . strtoupper($key) . "::</td><td>" . $value . "</td></tr>";
        }
    ?>
    <tr>
        <td>Fotografija::</td>
        <td><img onerror="this.src = 'article_img/default.jpg'" src="article_img/<?php echo $article['article_id'] ?>.jpg"></td>
    </tr>
</table>