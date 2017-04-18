<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');

if(!empty($_POST)){
    $key = true;
    $fields = array('article_name', 'article_price', 'article_lager', 'article_type', 'brend_id', 'article_description');
    foreach($fields as $field){
        if(!isset($_POST[$field]) || trim($_POST[$field]) == false){
            $key = false;
        }else{
            $$field = trim($_POST[$field]);
        }
    }
    
    if($key){
        $article_id = (int)$_GET['id'];
        if(update_article($article_id, $article_name, $article_price, $article_lager, $article_type, $brend_id, $article_description)){
            echo 'Izmene su uspešno unete.';
        };
    }else{
        echo 'Sva polja moraju biti uneta.';
    }
}

if(isset($_FILES['article_foto']) && $_FILES['article_foto']['error']== UPLOAD_ERR_OK){
    $target_dir = "article_img/";
    $target_file = $target_dir . basename($_FILES["article_foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
     $check = getimagesize($_FILES["article_foto"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Izabrani fajl nije fotografija.";
        $uploadOk = 0;
    }
        
        if ($_FILES["article_foto"]["size"] > 500000) {
            echo "Fotografije mogu imati maksimalno 0.5 MB .";
            $uploadOk = 0;
        }
        
        if($imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
        && $imageFileType != "GIF" ) {
            echo "Dozvoljeno je kačiti samo JPG, PNG, JPEG i GIF fajlove.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            echo "Došlo je do greške prilikom provere fajla.";
        } else {
            if (move_uploaded_file($_FILES["article_foto"]["tmp_name"], $target_dir . $_GET['id'] . "." . $imageFileType)) {
                echo "Fotografija je uspešno izmenjena.";
            } else {
                echo "Fotografija nije uspešno izmenjena.";
            }
        }
}

$brends = select_brends();
if(isset($_GET['id']) and $brends){
    $id = (int)$_GET['id'];
    $article = article_data($id);
    if($article){
        ?>
    <html>
    <head>
    </head>
    <body>
        <h3>Editovanje artikla</h3>
        <form action="#?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data" style="margin-left: 20px">
            <table>
                <tr>
                    <td>Naziv proizvoda: </td>
                    <td>
                        <input name="article_name" type="text" value="<?php echo $article['article_name']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Cena: </td>
                    <td>
                        <input name="article_price" type="text" value="<?php echo $article['article_price']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Stanje na lageru: </td>
                    <td>
                        <input name="article_lager" type="text" value="<?php echo $article['article_lager']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Tip: </td>
                    <td><?php echo $article['article_type']; ?>
                        <select name="article_type">
                            <option value="Muški">Muški</option>
                            <option value="Ženski">Ženski</option>
                            <option value="Dečji">Dečji</option>
                            <option value="Unisex">Unisex</option>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Brend: </td>
                    <td><?php echo $article['brend_name']; ?>
                        <select name="brend_id">
                            <option value="1">ARMANI EXCHANGE</option>
                            <option value="2">CASIO</option>
                            <option value="3">DIESEL</option>
                            <option value="4">FOSSIL</option>
                            <option value="5">HUGO BOSS</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Opis: </td>
                    <td>
                        <textarea name="article_description" rows=10 cols=35><?php echo $article['article_description']; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Fotografija: </td>
                    <td>
                        <img onerror="this.src = 'article_img/default.jpg'" src="article_img/<?php echo $article['article_id'] ?>.jpg">
                    </td>
                </tr>
                <tr>
                    <td>Izmeni fotografiju: </td>
                    <td>
                        <input name="article_foto" type="file">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Izmeni">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
    
    
    
        <?php
    }else{
        echo "Došlo je do greške prilikom aktiviranja editovanja artikla. Obratite se tehničkoj podršci.";
    }
}
?>
