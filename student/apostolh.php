<?php
    include ("connect_info.php");
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/home.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/upload.css">
	</head>
	
	<body>
		<div><?php
			unset($_SESSION['indicator']);
			 include 'top.php';?></div>
		<form method="post">
		    		<?php 
		    			$sql="SELECT id,id_diplo,file_type,file_name,size,content
		    				 FROM upload_file,members
		    				 WHERE members.memb_id=".$_SESSION['memb_id']." and members.d_id=upload_file.id_diplo ";
						$result = mysqli_query($link,$sql) or die();
		    		
			    		echo' <center><b>Τα αρχεία της διπλωματικής</b><br></center>
			    		<table  id="table" >
			    			<tr>
								<th><b></b></th>
								<th><b>Τύπος Αρχείου</b></th>
								<th><b>Αρχείο</b></th>
								<th><b>Μέγεθος</b></th>		
							</tr>';
							while($row = mysqli_fetch_array($result)) {
							    echo "<tr>";
							    echo "<td>"?> <a href="download.php?id= <?php echo $row['id'];?> "> Download </a><?php "</td>";
							    echo "<td>" . $row['file_type'] . "</td>";
								echo "<td>". $row['file_name']. "</td>";
							    echo "<td>" . $row['file_name'] . "</td>";
							    echo "<td style='width:700px;'>" . $row['size'] . "</td>";				    							  						    
							    echo "</tr>";
							}
			    		echo "</table>";    		
		    		?>		
		</form>
		
		<form id="form2" method="post" action="apostolh.php" enctype="multipart/form-data">	
			<center><table id="apostolhTable">		
					<tr>Arxeio :				
						<th><input type="hidden" name="MAX_FILE_SIZE" value="1500000">
						
					</tr> 
					<tr><input name="arxeiofile" type="file" id="arxeiofile"></th>
						<input id="submit" type="submit" name="submit" value="upload" id="submit">
					</tr>			
			</table>
				</center>		
		
		<?php 

			if (isset($_POST['submit']) && $_POST['submit'] == "upload" ) {
				
				if(isset($_SESSION['indicator'])){		// apofeugw to form resubmission
					?><script> alert("Redirection to prevent from resubmission");"</script><?php
					header('Location: apostolh.php');
				}else{
					$_SESSION['indicator'] = "processed";
					if($_FILES['arxeiofile']['size'] > 0){		// upload file gia viografiko
						
							
							$fileName = $_FILES['arxeiofile']['name'];
							$tmpName  = $_FILES['arxeiofile']['tmp_name'];
							$fileSize = $_FILES['arxeiofile']['size'];
							$fileType = $_FILES['arxeiofile']['type'];
							
							$fp      = fopen($tmpName, 'r');
							$content = fread($fp, filesize($tmpName));
							$content = addslashes($content);
							fclose($fp);
							
							if(!get_magic_quotes_gpc()){
							    $fileName = addslashes($fileName);
							}
							
						
							$query = "INSERT INTO upload_file (file_name,size, file_type, content ,username,id_diplo) ".
							"VALUES ('$fileName', '$fileSize', '$fileType', '$content','$_SESSION[username]','".$_SESSION['d_id']."')";					
							mysqli_query($link,$query) or die('Error, query failed '.mysql_error()); 				
							echo "<br>File $fileName uploaded<br>";
							
							
						}
					}
		}
			
	?>
	</form>
 </body>
</html>
