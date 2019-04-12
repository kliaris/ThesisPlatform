<?php 
	include ("connect_info.php");
		session_start();		
		
		
		
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Diplo-Students</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/home.css">


</head>

<body>

	<?php 
			unset($_SESSION['indicator']);
			include 'top.php';
			$sql = "SELECT message FROM members WHERE username='$_SESSION[username]'";
			
			$result = mysqli_query($link, $sql) or die();
			$row = mysqli_fetch_assoc($result);
			$message = $row['message'];		?>
			<p align=center><b><?php echo "$message"?></b></p><?php
			
			$sql2 = "UPDATE members SET message=''
							where username='$_SESSION[username]'";	
					$result = mysqli_query($link, $sql2) or die();							
	?>
	
	<form id="form" method="post" action="index.php" enctype="multipart/form-data">
		<table id="infoTable">
		<tr>
			<th > Username : </th>
			<td> <?php echo $_SESSION['id'] ?></td>
		</tr>	
		<tr>
			<th > Role : </th>
			<td> <?php echo $_SESSION['role'] ?></td>
		</tr>
		<tr>
			<th> Name : </th>
			<td> <?php echo $_SESSION['onoma'] ?></td>
		</tr>	
		<tr>
			<th> Surname : </th>
			<td> <?php echo $_SESSION['epitheto'] ?></td>
		</tr>
		<tr><?php 								// vrisko to onoma tis diplwmatikis
				$sql="SELECT filename FROM upload,members where members.memb_id='$_SESSION[id]' && members.viografiko_id=upload.id";
				$result=mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
				$count = mysqli_num_rows($result);

			    if ($count == 1) {
			        $row = mysqli_fetch_assoc($result);
			        $_SESSION['viografiko_filename']= $row['filename'];
				}
			?>
			<th> Viografiko : </th>			
			<td> <?php echo "$_SESSION[viografiko_filename]" ?></td>			
			<th><input type="hidden" name="MAX_FILE_SIZE" value="1500000">
				<input name="biofile" type="file" id="biofile">
				</th>
		</tr>
		<tr><?php 								// vrisko to onoma tis diplwmatikis
				$sql="SELECT filename FROM upload,members where members.memb_id='$_SESSION[id]' && members.analutiki_id=upload.id";
				$result=mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
				$count = mysqli_num_rows($result);

			    if ($count == 1) {
			        $row = mysqli_fetch_assoc($result);
			        $_SESSION['analutiki_filename']= $row['filename'];
				}
			?>
			<th> Analutiki : </th>
			<td> <?php echo "$_SESSION[analutiki_filename]" ?></td>
			<th><input type="hidden" name="MAX_FILE_SIZE" value="1500000">
				<input name="analfile" type="file" id="analfile">
				</th>
		</tr>
		
	</table>
		<input id="button" type="submit" name="submit" value="Save Changes" id="submit">
		<?php
		if (isset($_POST['submit']) && $_POST['submit'] == "Save Changes" ) {
		
		if(isset($_SESSION['indicator'])){		// apofeugw to form resubmission
			?><script> alert("Redirection to prevent from resubmission");"</script><?php
			header('Location: index.php');
		}else{
			$_SESSION['indicator'] = "processed";
			if($_FILES['biofile']['size'] > 0){		// upload file gia viografiko
				
					
					$fileName = $_FILES['biofile']['name'];
					$tmpName  = $_FILES['biofile']['tmp_name'];
					$fileSize = $_FILES['biofile']['size'];
					$fileType = $_FILES['biofile']['type'];
					
					$fp      = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					
					if(!get_magic_quotes_gpc()){
					    $fileName = addslashes($fileName);
					}
				
					$query = "INSERT INTO upload (filename, size, filetype, content ,stud_id) ".
					"VALUES ('$fileName', '$fileSize', '$fileType', '$content','$_SESSION[id]')";					
					mysqli_query($link,$query) or die('Error, query failed '.mysql_error()); 				
					echo "<br>File $fileName uploaded<br>";
					
					$sql="SELECT id FROM upload ORDER BY id DESC LIMIT 1";
					$result=mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
					$count = mysqli_num_rows($result);

			    if ($count == 1) {
			        $row = mysqli_fetch_assoc($result);
			        $_SESSION['viografiko']= $row['id'];
					echo "$_SESSION[viografiko]";
					$sql = "UPDATE members SET viografiko_id='$_SESSION[viografiko]' WHERE username='$_SESSION[username]'";								
					mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
				}
		
			}
			if($_FILES['analfile']['size'] > 0){// upload file gia analutiki
				$fileName = $_FILES['analfile']['name'];
					$tmpName  = $_FILES['analfile']['tmp_name'];
					$fileSize = $_FILES['analfile']['size'];
					$fileType = $_FILES['analfile']['type'];
					
					$fp      = fopen($tmpName, 'r');
					$content = fread($fp, filesize($tmpName));
					$content = addslashes($content);
					fclose($fp);
					
					if(!get_magic_quotes_gpc()){
					    $fileName = addslashes($fileName);
					}
				
					$query = "INSERT INTO upload (filename, size, filetype, content ,stud_id) ".
					"VALUES ('$fileName', '$fileSize', '$fileType', '$content','$_SESSION[id]')";	
					mysqli_query($link,$query) or die('Error, query failed '.mysql_error()); 			
					echo "<br>File $fileName uploaded<br>";
				
					$sql="SELECT id FROM upload ORDER BY id DESC LIMIT 1";
					$result=mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
					$count = mysqli_num_rows($result);

				    if ($count == 1) {
				        $row = mysqli_fetch_assoc($result);
				        $_SESSION['analutiki']= $row['id'];
						echo "$_SESSION[analutiki]";
						$sql = "UPDATE members SET analutiki_id='$_SESSION[analutiki]' WHERE username='$_SESSION[username]'";								
						mysqli_query($link,$sql) or die('Error, query failed '.mysql_error());
					}
			}			
		
		
		
						
		}
			header("Location: redir.php");
		}
?>	
	</form>
	
</body>
</html>