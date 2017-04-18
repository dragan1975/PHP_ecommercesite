<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
include 'inc/temp/master/master_top.php';
if(!is_admin()) header ('Location: index.php');
//ovdje skripta poziva samu sebe i proslijedjuje $_GET da bi se faktura zatvorila a ne obrisala kao sto je to slucaj kod closed_invoice.php
if(isset($_GET['cart_code'])){
    if(!cart_admin_close($_GET['cart_code'])){
        die('Greška pri zatvaranju fakture.');
    }
}

$cart_codes = get_open_cart_code();
?>
      <h1>Pregled faktura</h1>
      <?php
        if($cart_codes){
      ?>
        <h3>Otvorene fakture</h3>
            <?php
                foreach ($cart_codes as $code){
                    $carts = get_cart_by_code($code['cart_code']);
                    $x = true;
                    foreach ($carts as $cart){
                         if($x){
                            echo "Kupac: " . $cart['first_name'];
                            $x = false;
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
                        <a href="invoice.php?cart_code=<?php echo $code['cart_code'] ?>"><img style="float: right" title="Odobri fakturu" src="img/approve_invoice.png"></img></a><br/><br/><hr>
                    <?php
                }
            ?>
      <?php
        }else {
            echo 'Nema otvorenih faktura.';
        }
      ?>
<?php include 'inc/temp/master/master_footer.php'; ?>