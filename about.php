<?php
include_once 'core/init.php';
include 'inc/temp/master/master_top.php';
?>
<h3>O nama</h3>
<p>Telefon: 011/111-222</p>
<p>Adresa: Cara Dušana 34 Beograd</p>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><div style="overflow:hidden;height:350px;width:600px;"><div id="gmap_canvas" style="height:350px;width:600px;"></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style><a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">trivoo.net</a></div><script type="text/javascript"> function init_map(){var myOptions = {zoom:16,center:new google.maps.LatLng(44.84817913626528,20.40537719534302),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(44.84817913626528, 20.40537719534302)});infowindow = new google.maps.InfoWindow({content:"<b>Zemun</b><br/>Cara Dusana 34<br/> Belgrade" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
<?php include 'inc/temp/master/master_footer.php'; ?>