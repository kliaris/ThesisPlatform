<?php 
include ("connect_info.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	session_start();
	require ("fpdf17/fpdf.php");

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);}
	
?>
	
	
<html>
<head>		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>toPdf</title>   
        
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
  		<link rel="stylesheet" type="text/css" media="screen" href="css/toPDF.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		
</head>
<body>
	<div><?php include 'top.php';?></div>
	
	<div id="tablediplom">
    			<form method="post">
		    		<?php 
		    			$sql="SELECT * FROM diplomatikes WHERE status = 'gia_vathmologisi' and kathigitis= '" .$_SESSION['username']."'";
						$result = mysqli_query($link,$sql) or die();
		    		
			    		echo' <b>Διπλωματικές για Βαθμολόγηση</b><br>
			    		<table  id="table" >
			    			<tr>
								<th><b>Id</b></th>
								<th><b>Titlos</b></th>
								<th><b>Epivlepwn</b></th>
								<th><b>Stoxos</b></th>
								<th><b>1oUsername</b></th>
								<th><b>2oUsername</b></th>
								<th><b>3oUsername</b></th>
							</tr>';
							while($row = mysqli_fetch_array($result)) {
							    echo "<tr>";
							    echo "<td>" . $row['id'] . "</td>";
							    echo "<td>" . $row['thema'] . "</td>";
							    echo "<td>" . $row['kathigitis'] . "</td>";
							    echo "<td style='width:700px;'>" . $row['stoxos'] . "</td>";				    
							    echo "<td>" . $row['foititis1'] . "</td>";
							    echo "<td>" . $row['foititis2'] . "</td>";
							    echo "<td>" . $row['foititis3'] . "</td>";
							    echo "</tr>";
							}
			    		echo "</table>";
	
		    		?>				
    					
				        	
		    			</form>
		    			
					<p id="keimeno">xaxaxa</p>	
    		</div>
		<script>src="https://code.jquery.com/jquery-3.2.1.min.js"</script> 
  						<script>
				        		$('#table tr').click(function() {
				        			if (confirm('Είστε σίγουρος ότι θέλετε να ολοκλήρώσετε την συγκεκριμένη διπλωματική?')) {
									    $row = $(this).closest("tr");
								    	$tds = $row.find("td");
								    	$id=$tds[0].innerHTML;	
								    	$thema=$tds[1].innerHTML;
								    	$kathigitis=$tds[2].innerHTML;	
								    	$username=$tds[4].innerHTML;		
								    	$username2=$tds[5].innerHTML;
								    	$username3=$tds[6].innerHTML;						
										console.log($username);console.log($username2);console.log($username3);
										$.post('ajax/diplotoPDF.php',{id:$id,thema:$thema,kathigitis:$kathigitis,foititis1:$username,foititis2:$username2,foititis3:$username3},function($data){
											$('#keimeno').text($data);// window.location = 'displayPDF.php';
										});
									} else {
									    // Do nothing!
									}
				        			
				        		});
				        	</script>
</body>
</html>