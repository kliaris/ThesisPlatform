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
	?>
	
	

<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Chat Roomm</title>    
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
	</head>
	
	<body>
		<div><?php include 'top.php';?></div>
		<div style="width: 700px; margin: auto; height: 700px; overflow: auto;"><?php include 'chat.php';?></div>
	</body>
	
</html>