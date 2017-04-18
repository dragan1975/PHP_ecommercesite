<div class="widget">
                <h2>Ulogovani ste</h2>
                <div class="inner">
                <?php
                      include_once 'core/functions/articles.php';
                      $user_data = user_data($_SESSION['user_id'], 'username', 'first_name', 'last_name', 'email');
                      $cart = get_cart($_SESSION['user_id']);
                ?>
                <table>
                <tr>
                      <td><b>Ime:</b></td>
                      <td><?php echo $user_data['first_name'] ?></td>
                </tr>
                <tr>
                      <td><b>Prezime:</b></td>
                      <td><?php echo $user_data['last_name'] ?></td>
                </tr>
                <tr>
                      <td><b>E-mail:</b></td>
                      <td><?php echo $user_data['email'] ?></td>
                </tr>
                </table></br>
                
                <?php if($cart){
                ?>
						<hr>
                        <h3>Korpa</h3>
                            <ul>
                            <?php
                                foreach($cart as $item){
                            ?>
                            <li><?php echo $item['article_name'] . " " . $item['article_price'] . " " ?><a href="cart_article_drop.php?article_id=<?php echo $item['article_id'] ?>"><img src="img/drop.png"></a></li>
                            <?php
                                }
                                                
                            ?>
                            </ul>
                                    <div class="btn" onclick="location.href='cart_close.php';">Završi kupovinu</div>
                        <hr>
                <?php
                }
                ?>
                
                <div class="btn" onclick="location.href='logout.php';">Odjava</div>
                </div>
</div>