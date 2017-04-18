<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
include 'inc/temp/master/master_top.php';
?>
      <h1>Brendovi</h1>
      <nav>
            <ul>
	    <!--DOMACI ZADATAK - ucitavanje liste iz baze-->
		<?php 
		/*
		$brendz = select_brends();
		foreach($brendz as $brend){
			echo "<li><a href=brends.php?brend={$brend->brend_id}>{$brend->brend_name}</a></li>";
		}
		*/
		$brandz = select_brends_names_and_ids();
		foreach($brandz as $id=>$name){
			echo "<li><a href=brends.php?brend={$id}>{$name}</a></li>";
		}
		?>
		<!--
                <li><a href="brends.php?brend=1">ARMANI EXCHANGE</a></li>
                <li><a href="brends.php?brend=2">CASIO</a></li>
                <li><a href="brends.php?brend=3">DIESEL</a></li>
                <li><a href="brends.php?brend=4">FOSSIL</a></li>
                <li><a href="brends.php?brend=5">HUGO BOSS</a></li>
		-->
            </ul>
	</nav><br/><br/>
      <?php
            if(isset($_GET['brend'])){
                  $brend = (int)$_GET['brend'];
                  $articles = articles_data($brend, 'article_id', 'article_name', 'article_price', 'article_action');
                  if($articles){
                        foreach ($articles as $article){
                              ?>
                                    <div class="article">
                                    <img class="background" onerror="this.src = 'article_img/default.jpg'" src="article_img/<?php echo $article['article_id'] ?>.jpg">
                                    <p id="name"><?php echo $article['article_name']; ?></p>
                                    <a class="info" data-fancybox-type="iframe" href="article_info.php?article_id=<?php echo $article['article_id']; ?>"><img id="article_info" src="img/article_info.png"></a>
                                    <?php
                                          if($article['article_action'] == 'DA'){
                                                ?><img id="special_offer" src="img/special_offer.png"></a><?php
                                          }
                                    ?>
                                     <a class="info" data-fancybox-type="iframe" href="article_comment.php?article_id=<?php echo $article['article_id']; ?>"><img id="comment" src="img/comment.png"></a>
                                    <a href="article_buy.php?article_id=<?php echo $article['article_id']; ?>"><img id="buy" src="img/buy.png"></a>
                                    <p id="price"><?php echo $article['article_price']; ?> din</p>
                                    </div>
                              <?php
                        }
                  }else{
                        echo 'Trenutno nema proizvoda ovog brenda. Posetite nas za nekoliko dana ponovo.';
                  }
            }else{
                  $articles = articles_data();
                  if($articles){
                        $limit = 0;
                        foreach ($articles as $article){
                              if($limit == 6) break;
                              $limit++;
                              ?>
                                    <div class="article">
                                    <img class="background" onerror="this.src = 'article_img/default.jpg'" src="article_img/<?php echo $article['article_id'] ?>.jpg">
                                    <p id="name"><?php echo $article['article_name']; ?></p>
                                    <a class="info" data-fancybox-type="iframe" href="article_info.php?article_id=<?php echo $article['article_id']; ?>"><img id="article_info" src="img/article_info.png"></a>
                                    <?php
                                          if($article['article_action'] == 'DA'){
                                                ?><img id="special_offer" src="img/special_offer.png"></a><?php
                                          }
                                    ?>
                                    <a class="info" data-fancybox-type="iframe" href="article_comment.php?article_id=<?php echo $article['article_id']; ?>"><img id="comment" src="img/comment.png"></a>
                                    <a href="article_buy.php?article_id=<?php echo $article['article_id']; ?>"><img id="buy" src="img/buy.png"></a>
                                    <p id="price"><?php echo $article['article_price']; ?> din</p>
                                    </div>
                              <?php
                        }
                  }else{
                        echo 'Trenutno nema proizvoda u nasoj prodavnici.';
                  }
            }
      ?>
      
       <script>
        $(document).ready(function() {
	$(".info").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '30%',
		height		: '50%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	})
});
        
      </script>
      
<?php include 'inc/temp/master/master_footer.php'; ?>