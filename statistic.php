<?php
include_once 'core/init.php';
include 'inc/temp/master/master_top.php';
if(!is_admin()) header ('Location: index.php');
//FUNKCIJE START
    $status_korisnika = array(0, 1, 2);
    $rez = array();
    foreach($status_korisnika as $status){
        $query = $pdo->query("SELECT * FROM users WHERE active = $status");
        $rez[] = $query->rowCount();
    }
//FUNKCIJE END
?>
 <!--Div that will hold the pie chart-->
    <div id="chart_div" style="float: left"></div>

<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Aktivni', <?php echo $rez[1] ?>],
          ['Blokirani', <?php echo $rez[0] ?>],
          ['Administratori', <?php echo $rez[2] ?>]
        ]);

        // Set chart options
        var options = {'title':'Statistika korsnika prema statusu',
                       'width':600,
                       'height':500};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<?php include 'inc/temp/master/master_footer.php'; ?>