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
		
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Diplo</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">	
		<link rel="stylesheet" type="text/css" media="screen" href="css/analipsi.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body> 
    	<?php 
			$_SESSION['unreaded']="";
		?>  	
    	<div><?php include 'top.php'; ?></div>
    	
    	<div id="container">
    		<div id="table1">
    			<form method="post">
		    		<?php 
		    		
		    			$sql="SELECT * FROM aithseis WHERE readed = '0' and kathigitis= '" .$_SESSION['username']."'";
						$result = mysqli_query($link,$sql) or die();
		    		
			    		echo' <b>Αδιάβαστες Αιτήσεις</b><br>
			    		<table  class="tables" >
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
							    echo "<td>" . $row['username'] . "</td>";
							    echo "<td>" . $row['username2'] . "</td>";
							    echo "<td>" . $row['username3'] . "</td>";
							    echo "</tr>";
							}
			    		echo "</table>";
			    		
			    		
			    		
		    		?>				
    					<script>src="https://code.jquery.com/jquery-3.2.1.min.js"</script>
				        	<script>
				        		$('#table1 tr').click(function() {
				        			if (confirm('Είστε σίγουρος ότι θέλετε να αναλάβετε την συγκεκριμένη διπλωματική?')) {
									    $row = $(this).closest("tr");
								    	$tds = $row.find("td");
								    	$id=$tds[0].innerHTML;	
								    	$thema=$tds[1].innerHTML;
								    	$kathigitis=$tds[2].innerHTML;	
								    	$username=$tds[4].innerHTML;		
								    	$username2=$tds[5].innerHTML;
								    	$username3=$tds[6].innerHTML;						
										console.log($username);console.log($username2);console.log($username3);
										$.post('ajax/analipsi_diplwmatikis.php',{id:$id,thema:$thema,kathigitis:$kathigitis,foititis1:$username,foititis2:$username2,foititis3:$username3},function($data){
											$('#keimeno').text($data); 
										});location.reload();
									} else {
									    // Do nothing!
									}
				        			
				        		});
				        	</script>
		    			</form>
						
    		</div>
    		<div id="table2">
    			<?php 
    			$sql="SELECT * FROM aithseis WHERE readed = '1' and kathigitis= '" .$_SESSION['username']."'";
				$result = mysqli_query($link,$sql) or die();;
    		
	    		echo' <b>Διαβασμένες Αιτήσεις</b><br>
	    		<table  class="tables" >
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
					    echo "<td>" . $row['username'] . "</td>";
					    echo "<td>" . $row['username2'] . "</td>";
					    echo "<td>" . $row['username3'] . "</td>";
					    echo "</tr>";
					}
	    		echo "</table>";
				$sql1 = "UPDATE aithseis SET readed='1'
					WHERE kathigitis='$_SESSION[username]'";
					$result = mysqli_query($link, $sql1) or die();
				
					
    		?>
    			<script>src="https://code.jquery.com/jquery-3.2.1.min.js"</script>
				        	<script>
				        		$('#table2 tr').click(function() {
				        			if (confirm('Θέλετε να αναλάβετε την συγκεκριμένη διπλωματική?')) {
									    $row = $(this).closest("tr");
								    	$tds = $row.find("td");
								    	$id=$tds[0].innerHTML;	
								    	$thema=$tds[1].innerHTML;
								    	$kathigitis=$tds[2].innerHTML;	
								    	$username=$tds[4].innerHTML;		
								    	$username2=$tds[5].innerHTML;
								    	$username3=$tds[6].innerHTML;						
										console.log($username);console.log($username2);console.log($username3);
										$.post('ajax/analipsi_diplwmatikis.php',{id:$id,thema:$thema,kathigitis:$kathigitis,foititis1:$username,foititis2:$username2,foititis3:$username3},function($data){
											$('#keimeno').text($data);
										});location.reload();
									} else {
									    // Do nothing!
									}
				        			
				        		});
				        	</script>
    		</div>
    	
    	</div>
		
   	</body>
  
</html>