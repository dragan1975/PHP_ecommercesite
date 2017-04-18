<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
include 'inc/temp/master/master_top.php';
?>
      <?php
                  $type = $_GET['type'];
		  echo "<h1>". $type ." satovi</h1>";
		  $articles = articles_data_type($type);
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
                        echo 'Trenutno nema proizvoda za ovaj tip. Posetite nas za nekoliko dana ponovo.';
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