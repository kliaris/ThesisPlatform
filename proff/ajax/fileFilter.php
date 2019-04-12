<?php session_start();
	unset($_SESSION['indicator']);
	?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
	
	include ("../connect_info.php");
	$q = $_GET['q'];

		$sql="SELECT id,id_diplo,file_type,file_name,size,content
		    				 FROM upload_file
		    				 WHERE id_diplo='".$q."'";
							 //echo "sql";
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
							    echo "<td>" . $row['file_name'] . "</td>";
							    echo "<td style='width:700px;'>" . $row['size'] . "</td>";				    							  						    
							    echo "</tr>";
							}
			    		echo "</table>"; 
				?>		
			<form id="form2" method="post"  enctype="multipart/form-data">	
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
					header('Location: ../diplofiles.php');
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
							"VALUES ('$fileName', '$fileSize', '$fileType', '$content','$_SESSION[username]','".$_SESSION['d_id']."')";	echo "$query";				
							mysqli_query($link,$query) or die('Error, query failed '.mysql_error()); 				
							echo "<br>File $fileName uploaded<br>";
							
							
						}
					}
		}
			
	?>
	</form>   		
				
	
	
	</body>
</html>