<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');
include 'inc/temp/master/master_top.php';

$foto = false;
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
        if(add_new_article($article_name, $article_price, $article_lager, $article_type, $brend_id, $article_description)){
            echo 'Artikl je uspešno unet u bazu.';
            $foto = true;
        }else{
            echo 'Unos podataka u bazu nije uspešno obavljen.';
            };
    }else{
        echo 'Sva polja moraju biti uneta.';
    }
}
if($foto){
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
            && $imageFileType != "GIF" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Dozvoljeno je kačiti samo JPG, PNG, JPEG i GIF fajlove.";
                $uploadOk = 0;
            }
            
            if ($uploadOk == 0) {
                echo "Došlo je do greške prilikom provere fajla.";
            } else {
                if (move_uploaded_file($_FILES["article_foto"]["tmp_name"], $target_dir . $pdo->lastInsertId() . "." . $imageFileType)) {
                    echo "Fotografija je uspešno uneta.";
                } else {
                    echo "Fotografija nije uspešno uneta.";
                }
            }
    }else{
        echo "<br/>Fotografija nije uneta!";
    }
}
?>
    <html>
    <head>
    </head>
    <body>
        <h3>Dodavanje novog artikla</h3>
        <form action="" method="POST" enctype="multipart/form-data" style="margin-left: 20px">
            <table>
                <tr>
                    <td>Naziv: </td>
                    <td>
                        <input name="article_name" type="text">
                    </td>
                </tr>
                <tr>
                    <td>Cena: </td>
                    <td>
                        <input name="article_price" type="text" value="">
                    </td>
                </tr>
                <tr>
                    <td>Stanje na lageru: </td>
                    <td>
                        <input name="article_lager" type="text" value="">
                    </td>
                </tr>
                <tr>
                    <td>Tip: </td>
                    <td>
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
                    <td>
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
                        <textarea name="article_description" rows=10 cols=35></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Fotografija: </td>
                    <td>
                        <input name="article_foto" type="file">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Dodaj novi artikal">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
    
<?php include 'inc/temp/master/master_footer.php'; ?>