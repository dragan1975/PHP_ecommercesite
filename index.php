<?php
include_once 'core/init.php';
include 'inc/temp/master/master_top.php';
?>
      <a class="various fancybox.iframe" href="//www.youtube.com/embed/9Kq3EzT1fok"><img src="img/index.jpg"></a>
      
      <script>
        $(document).ready(function() {
			$(".various").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		});
      </script>
<?php include 'inc/temp/master/master_footer.php'; ?>