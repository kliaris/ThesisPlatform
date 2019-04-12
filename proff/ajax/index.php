<!DOCTYPE HTML>
<html>
<head>
	<title>Diplo-Students</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
	<link rel="stylesheet" type="text/css" media="screen" href="css/home.css">
	<?php 
		include ("connect_info.php");
		session_start();
		
		//$sql = "select email, role, onoma,epitheto from members where username='$_SESSION[username]' and password='$_SESSION[password]'";
		$sql = "select email, onoma,epitheto from members where username='$_SESSION[username]' ";
		$result = mysqli_query($link, $sql) or die();
		$count = mysqli_num_rows($result);
		
		if ($count == 1) {
		    $row = mysqli_fetch_assoc($result);
		   	$_SESSION['email'] = $row['email'];
			
			$_SESSION['onoma']=$row['onoma'];
			$_SESSION['epitheto']=$row['epitheto'];
			
				
			$q = "select * from aithseis where readed='0' and kathigitis='$_SESSION[username]'";	// 0(miden) gia adiavastes aithseis
			
			$result = mysqli_query($link, $q) or die();
			$count = mysqli_num_rows($result);
			while($row = mysqli_fetch_array($result)){
			    echo "";
			}
			$_SESSION['unreaded'] = $count;
			echo "$count";
		}
			
		
	?>


</head>

<body>
	<?php include 'top.php';?>
	
	<table id="infoTable">
		<tr>
			<th > Username : </th>
			<td> <?php echo $_SESSION['username'] ?></td>
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
		
	</table>
</body>
</html>