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
	    die("Connection failed: " . $conn->connect_error);
	} 	
		
		
	$now = new \DateTime('now');
	$month = $now->format('m');	
			
	// gia eleutheres diplwmatikes
	$sql="SELECT COUNT(*) AS eleutheres  FROM diplomatikes WHERE status= 'eleutheri'";
	$result = mysqli_query($link,$sql) or die();	
	$row = mysqli_fetch_assoc($result);
	$eleutheres = $row['eleutheres'];
	
	// gia ipo egkrisi diplwmatikes
	$sql="SELECT COUNT(*) AS ipo_egkrisi  FROM diplomatikes WHERE status= 'ipo_egkrisi'";
	$result = mysqli_query($link,$sql) or die();	
	$row = mysqli_fetch_assoc($result);
	$ipo_egkrisi = $row['ipo_egkrisi'];
	
	// gia anatethimenes diplwmatikes
	$sql="SELECT COUNT(*) AS anatethike  FROM diplomatikes WHERE status= 'anatethike'";
	$result = mysqli_query($link,$sql) or die();	
	$row = mysqli_fetch_assoc($result);
	$anatethike = $row['anatethike'];
	
	// gia_parousiasi diplwmatikes
	$sql="SELECT COUNT(*) AS gia_parousiasi  FROM diplomatikes WHERE status= 'gia_parousiasi'";
	$result = mysqli_query($link,$sql) or die();	
	$row = mysqli_fetch_assoc($result);
	$gia_parousiasi = $row['gia_parousiasi'];
	
	// gia_vathmologisi diplwmatikes
	$sql="SELECT COUNT(*) AS gia_vathmologisi  FROM diplomatikes WHERE status= 'gia_vathmologisi'";
	$result = mysqli_query($link,$sql) or die();	
	$row = mysqli_fetch_assoc($result);
	$gia_vathmologisi = $row['gia_vathmologisi'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Diplo</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">	
		<link rel="stylesheet" type="text/css" media="screen" href="css/statistika.css">
    </head>
    <body>   	
    	<div><?php include 'top.php';?></div>
    	<?php 
    		$sql="SELECT COUNT(*) AS num FROM diplomatikes";
			$result = mysqli_query($link,$sql) or die();	
			$row = mysqli_fetch_assoc($result);
			$count = $row['num'];
			
			$sql="SELECT * FROM diplomatikes WHERE MONTH(oloklirwsi) =  '$month'";
			$result = mysqli_query($link,$sql) or die();
    	?>
    	<div id="container">
    		<div id="sinolo" class="divs">
    			<h2>Το σύνολο των διπλωματικών που έχουν δημιουργηθεί είναι : <?php echo "$count"?></h2>
    		</div>
    		<div id="sinolo" class="divs">
    			<h2>Οι διπλωματικές που παρουσιάζονται αυτό το μήνα</h2>
    			<table id="parousiasi">
    				<tr>							
							<th><b>Τίτλος</b></th>
							<th><b>Επιβλέπων</b></th>
							<th><b>Στόχος</b></th>
							<th><b>1oΑΜ</b></th>
							<th><b>2oΑΜ</b></th>
							<th><b>3oΑΜ</b></th>
					</tr>
					<?php
					while($row = mysqli_fetch_array($result)) {
							    echo "<tr>";						
							    echo "<td>" . $row['thema'] . "</td>";
							    echo "<td>" . $row['kathigitis'] . "</td>";
							    echo "<td style='width:700px;'>" . $row['stoxos'] . "</td>";				    
							    echo "<td>" . $row['foititis1'] . "</td>";
							    echo "<td>" . $row['foititis2'] . "</td>";
							    echo "<td>" . $row['foititis3'] . "</td>";
							    echo "</tr>";
							}?>
    			</table>
    		</div>
    		<div id="chart">
    			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			    <script type="text/javascript">
			      google.charts.load('current', {'packages':['corechart']});
			      google.charts.setOnLoadCallback(drawChart);
			
			      function drawChart() {
			
			        var data = google.visualization.arrayToDataTable([
			          ['Κατάσταση', 'Διπλωματικές'],
			          ['Ελεύθερες',<?php echo $eleutheres ?>],
			          ['Ανάθεση',   <?php echo $ipo_egkrisi ?>],
			          ['Υπό Έγκριση', <?php echo $anatethike ?>],
			          ['Ολοκληρωμένες',<?php echo $gia_parousiasi ?>],
			          ['Για παρουσίαση',  <?php echo $gia_vathmologisi ?>]
			        ]);
			
			        var options = {
			          title: 'Σύνολο Διπλωματικών'
					
			        };
			
			        var chart = new google.visualization.PieChart(document.getElementById('chart'));
			
			        chart.draw(data, options);
			      }
			    </script>
    			
    		</div>
    		
    	</div>
    </body>
</html>