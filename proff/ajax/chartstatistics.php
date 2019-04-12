<?php 
include ("connect_info.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	session_start();

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);}
	
	$sql0="SELECT `kathigitis` AS `kathigitis`,
             COUNT(`kathigitis`) AS `value_occurrence`         
		    FROM     `diplomatikes`
		   	GROUP BY `kathigitis`
		    ORDER BY `kathigitis` DESC
            LIMIT 1";
	$result0 = mysqli_query($link,$sql0) or die();
	$sql="SELECT `kathigitis` AS `kathigitis`,
             COUNT(`kathigitis`) AS `value_occurrence` ,
             YEAR(`oloklirwsi`) AS `oloklirwsi`
		    FROM     `diplomatikes`
		   	GROUP BY `kathigitis`,`oloklirwsi`
		    ORDER BY `oloklirwsi` ASC
		    ";
		$result = mysqli_query($link,$sql) or die();	
		
		$sql1=' SELECT `kathigitis` AS `kathigitis`,
             ROUND(AVG(`vathmologia`),1) AS `avg`
		    FROM     `diplomatikes`
		    WHERE `vathmologia`>0 
		   	GROUP BY `kathigitis`
		    ORDER BY `kathigitis` ';
			$result1 = mysqli_query($link,$sql1) or die();
			
		$sql2='select `kathigitis` AS `kathigitis`,
				 ROUND(AVG(DATEDIFF( oloklirwsi, analipsi)/7),1) AS `diastima oloklirwsis`
			     from diplomatikes
			     GROUP BY `kathigitis`
			     ORDER by `kathigitis`';
		$result2 = mysqli_query($link,$sql2) or die();	
		
		$sql3="select status AS `status`,
			COUNT(status)	 AS `sinolo`
		    from diplomatikes
		    GROUP BY `status` ";
		$result3 = mysqli_query($link,$sql3) or die();    
	?>
	
	
<html>
<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gant Chart</title>    
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	 <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
  	var data = google.visualization.arrayToDataTable([
         ['Καθηγητής', 'Αρ.Διπλωματικών', { role: 'annotation' } ],      		
         <?php 
     // echo '[\'' . $row0['kathigitis'] . '\',' . $row0['value_occurrence'] . ',\'Συνολικά\'],\'';
			while($row = mysqli_fetch_assoc($result)){
			  echo '[';
			  /*foreach($row as $item){
				 echo '\''. $item . '\',';
			  }*/
			  echo '\'' . $row['kathigitis'] . '\',' . $row['value_occurrence'] . ',\'' . $row['oloklirwsi'];
			  echo '\'],';
			}
		?>
         
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Χρονιές καθηγητών",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
  
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        <?php 
			while($row1 = mysqli_fetch_assoc($result1)){
			  echo '[';
			  /*foreach($row as $item){
				 echo '\''. $item . '\',';
			  }*/
			  echo '\'' . $row1['kathigitis'] . '\',' . $row1['avg'] . ',\'' . $row1['avg'];
			  echo '\'],';
			}
		?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Mέσο όρος βαθμών ανά καθηγητή",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
	 <script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
  	var data = google.visualization.arrayToDataTable([
         ['Καθηγητής', 'Εβδομάδες για την ολοκλήρωση', { role: 'style' } ],      		
         <?php 
			while($row2 = mysqli_fetch_assoc($result2)){
			  echo '[';
			  /*foreach($row as $item){
				 echo '\''. $item . '\',';
			  }*/
			  echo '\'' . $row2['kathigitis'] . '\',' . $row2['diastima oloklirwsis'] . ',\'silver ';
			  echo '\'],';
			}
		?>
         
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Mέσο διάστημα ολοκλήρωσης μιας πτυχιακής (σε εβδομάδες)",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values_evdomades"));
      chart.draw(view, options);
  }
  </script>
  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status διπλωματικής', 'Ποσοστό'],
          <?php 
			while($row3 = mysqli_fetch_assoc($result3)){
			  echo '[';
			  /*foreach($row as $item){
				 echo '\''. $item . '\',';
			  }*/
			  echo '\'' . $row3['status'] . '\',' . $row3['sinolo'] ;
			  echo '],';
			}
		?>
        ]);

        var options = {
          title: 'Καταστάστεις σημερινών διπλωματικών',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
	<div><?php include 'top.php';?></div>
	<center>
		<table id="chart" style="width: 900px;">
  		<tr style="margin: 50px; " >
  			<th><div id="barchart_values" style="width: 600px; height: 300px; "></div></th>
  			<th><div id="columnchart_values" style="width: 600px; height: 300px; "></div></th>
  			
  		</tr>
  		<tr>
  			<th><div id="barchart_values_evdomades" style="width: 600px; height: 300px; "></div></th>
  			<th><div id="piechart_3d" style="width: 600px; height: 300px; "></div></th>	
  		</tr>
  		
  	</table>
	</center>
  	
</body>
</html>