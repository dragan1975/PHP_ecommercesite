<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
include 'inc/temp/master/master_top.php';
if(!is_admin()) header ('Location: index.php');

//ako je poslat $_GET to znaci da ova scripta poziva samu sebe
//i brise korpu
if(isset($_GET['cart_code'])){
    if(!cart_delete($_GET['cart_code'])){
        die('Greška pri brisanju fakture.');
    }
}
$cart_codes = get_closed_cart_code();
?>
      <h1>Pregled faktura</h1>
      <?php
        if($cart_codes){
      ?>
        <h3>Zatvorene fakture</h3>
            <?php
                foreach ($cart_codes as $code){
                    $carts = get_cart_by_code($code['cart_code']);
                    $x = true;//kada prolazimo kroz svakia artikal u korpi, ne zelimo da se svaki put ispisuje ko je kupac, nego samo jednom a onda onda da ispisemo sve artikle  
                    foreach ($carts as $cart){
                         if($x){
                            echo "Kupac: " . $cart['first_name'];
                            $x = false;//ovdje  mjenjamo u false da ovaj uslov vise nije ispunjen tako da se vise ne moze ispisivati ime kupca
                         }
                        ?>
                            <table>
                                <tr>
                                    <td>Naziv proizvoda: <?php echo $cart['article_name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Cena: <?php echo $cart['article_price'] ?> din</td>
                                </tr>
                            </table>
                        <?php
                    }
                    ?>
                        <a href="closed_invoice.php?cart_code=<?php echo $code['cart_code'] ?>"><img style="float: right" title="Obriši fakturu" src="img/remove_invoice.png"></img></a><br/><br/><hr>
                    <?php
                }
            ?>
      <?php
        }else {
            echo 'Nema zatvorenih faktura.';
        }
      ?>
<?php include 'inc/temp/master/master_footer.php'; ?>