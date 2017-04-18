<?php
include_once 'core/init.php';
if(!is_admin()) header ('Location: index.php');
include 'inc/temp/master/master_top.php';
?>
      <h1>Upravljanje korisnicima</h1>
      
      <?php
        $users = get_all_users();
        if($users){
            ?>
            <table class="admin_table">
                <tr>
                    <th>Ime</th>
                    <th>Prezime</th>
                </tr>
            <?php
            foreach($users as $user){
                ?>
                <tr>
                    <td><?php echo $user['first_name'] ?></td>
                    <td><?php echo $user['last_name'] ?></td>
                    <?php
                        if($user['active'] == 0){
                            ?>
                                <td><a class="activate" data-fancybox-type="iframe" href="activate_user.php?id=<?php echo $user['user_id'] ?>"><img class="reload" src="img/block.png"></a></td>
                            <?php
                        }else{
                            ?>
                                <td><a class="blocks" data-fancybox-type="iframe" href="blocks_user.php?id=<?php echo $user['user_id'] ?>"><img class="reload" src="img/approve.png"></a></td>
                            <?php
                        }
                    ?>
                    <td><a class="remove" data-fancybox-type="iframe" href="remove_user.php?id=<?php echo $user['user_id'] ?>"><img class="reload" src="img/remove.png"></a></td>
                    <td><a class="info" data-fancybox-type="iframe" href="details.php?id=<?php echo $user['user_id'] ?>"><img src="img/info.png"></a></td>
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
	$(".info").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '25%',
		height		: '35%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	}),
        $(".remove, .activate, .blocks").fancybox({
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