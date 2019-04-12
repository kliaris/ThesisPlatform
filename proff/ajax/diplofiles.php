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
        <title>Oi diplwmatikes mou</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">	
		<link rel="stylesheet" type="text/css" media="screen" href="css/myDiploStyle.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
			function showUser(str) {
			    if (str == "") {
			        document.getElementById("txtHint").innerHTML = "";
			        return;
			    } else { 
			        if (window.XMLHttpRequest) {
			            // code for IE7+, Firefox, Chrome, Opera, Safari
			            xmlhttp = new XMLHttpRequest();
			        } else {
			            // code for IE6, IE5
			            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			        }
			        xmlhttp.onreadystatechange = function() {
			            if (this.readyState == 4 && this.status == 200) {
			                document.getElementById("txtHint").innerHTML = this.responseText;
			            }
			        };
			        xmlhttp.open("GET","ajax/fileFilter.php?q="+str,true);
			        xmlhttp.send();
			    }
			}
			</script>
    </head>
    <body>   	
    	<div><?php include 'top.php';?></div>
    	<?php  	
				echo' 
    			<div id= "container" style="width: 800; overflow: auto;">
 					<form id="menuDiplo">
						<select name="users" onchange="showUser(this.value)">
							<option value="">Διάλεξε id διπλωματικής</option>'; 
							$sql="select * from diplomatikes where kathigitis='".$_SESSION['username']."' and status!='ipo_egkrisi' and status!='eleutheri'";
    						echo $sql;$result = mysqli_query($link,$sql) or die();
							
						while($row = mysqli_fetch_array($result)) {
				 echo'  <option value="'.$row['id'].'">"'. $row['id'].'"</option>'; 
						  }
						  echo'</select>
					</form>	
					<br>
					<div id="txtHint"><b>Τα αρχεία θα εμφανιστούν παρακάτω ..</b></div>
	  					<div id="diploInfo">
	  					
	  					</div>
    			</div>';?>
					       		        
    </body>
</html>