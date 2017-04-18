<div class="widget">
                <h2>Administrator</h2>
                <div class="inner">
                    <?php
                          $user_data = user_data($_SESSION['user_id'], 'username', 'first_name', 'last_name', 'email');
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
                    <tr>
                        
                    </tr>
                    </table><h2></h2>
                    <div class="btn" onclick="location.href='edit_users.php';">Upravljanje korisnicima</div>
                    <div class="btn" onclick="location.href='edit_articles.php';">Editovanje postojećih artikala</div>
                    <div class="btn" onclick="location.href='article_add_new.php';">Dodavanje novog artikla</div>
                    <div class="btn" onclick="location.href='invoice.php';">Otvorene fakture</div>
                    <div class="btn" onclick="location.href='closed_invoice.php';">Zatvorene fakture</div>
                    <div class="btn" onclick="location.href='statistic.php';">Statistika</div>
                    <div class="btn" onclick="location.href='logout.php';">Odjava</div>
                </div>
</div>