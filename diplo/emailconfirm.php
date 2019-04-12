<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Email Confirm </title>
</head>
<body>
	<?php 
		include ("connect_info.php");
		$username=$_GET['username'];
		$code=$_GET['code'];
		$sql = "insert into s_members(name)values('$username')";
		$result = mysqli_query($link, $sql) or die();
		
		mysqli_autocommit($link, false);
	    $sql = "SELECT * FROM members WHERE username='$username'";		
		$result = mysqli_query($link, $sql) or die();
		
		
		while($row=mysqli_fetch_array($result) ){
			$db_code=$row['confirm_code'];
			if($code==$db_code){
				$sql="insert into s_members (name) values '$username'";
				$result = mysqli_query($link, $sql) or die();
				
				$sql="UPDATE members SET confirmed='1' , confirm_code='0' WHERE username='$username'";
				$result = mysqli_query($link, $sql) or die();
				if ($result) {
	                mysqli_commit($link);
	                echo "<font color=\"#3300FF\"><strong><br>Thank you $username !Your email has been confirmed and you may now login!<br></strong>";
	            } else {
	                mysqli_rollback($link);
	                echo "<font color=\"#FF0000\"><strong><br>Username and code don't match<br></strong></font>";
	            }
				break;	
			}
		}
		
	?>

</body>
</html>