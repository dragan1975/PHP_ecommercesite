<?php
include_once 'core/init.php';
include_once 'core/functions/articles.php';
if(!is_admin()) header ('Location: index.php');
include 'inc/temp/master/master_top.php';
?>
      <h1>Upravljanje artiklima</h1>
      
      <?php
        $articles = articles_data();
        if($articles){
            ?>
            <table class="admin_table">
                <th>Naziv proizvoda</th>
                <th>Brend</th>
            <?php
            foreach($articles as $article){
                ?>
                
                <tr>
                    <td><?php echo $article['article_name'] ?></td>
                    <td><?php echo $article['brend_name'] ?></td>
                    <td><a class="edit" data-fancybox-type="iframe" href="article_edit.php?id=<?php echo $article['article_id'] ?>"><img src="img/edit.png"></a></td>
                    <?php
                        if($article['article_action'] == 'NE'){
                            ?>
                                <td><a class="action_on" data-fancybox-type="iframe" href="article_action_on.php?id=<?php echo $article['article_id'] ?>"><img class="reload" src="img/action_off.png"></a></td>
                            <?php
                        }else{
                            ?>
                                <td><a class="action_off" data-fancybox-type="iframe" href="article_action_off.php?id=<?php echo $article['article_id'] ?>"><img class="reload" src="img/action_on.png"></a></td>
                            <?php
                        }
                    ?>
                    <td><a class="remove" data-fancybox-type="iframe" href="article_remove.php?id=<?php echo $article['article_id'] ?>"><img class="reload" src="img/remove.png"></a></td>
                    <td><a class="info" data-fancybox-type="iframe" href="article_details.php?id=<?php echo $article['article_id'] ?>"><img src="img/info.png"></a></td>
                    <?php
                        if($article['article_lager'] == 0){
                            ?>
                            <td><a class="edit" data-fancybox-type="iframe" href="article_edit.php?id=<?php echo $article['article_id'] ?>"><img src="img/warning.png"></a></td>
                        <?php
                        }
                    ?>
                </tr>
                
                <?php
            }
             ?>
            </table>
            <?php
        }
      ?>
    
      <script>
        $(document).ready(function() {
	$(".info, .edit").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '35%',
		height		: '80%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	}),
        $(".remove, .action_on, .action_off").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '25%',
		height		: '10%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	}),
        $( ".reload" ).click(function() {
            setTimeout(function(){location.reload(true);}, 3000);
        });
});
        
      </script>
<?php include 'inc/temp/master/master_footer.php'; ?>