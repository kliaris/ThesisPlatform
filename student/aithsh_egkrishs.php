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
        <title>AITΗΣΗ ΕΓΚΡΙΣΗΣ</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/aithsh.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/simple_menu.css">
	</head>
	
	<body>
		<div><?php include 'top.php';?></div>
		<div id="container">
			<div id="neaDipl" >
			<h2>Νέα Αίτηση Έγκρισης</h2>
			<form   action="aithsh_egkrishs.php" method="post">
				
				<table>
					<tr>
						<td>Τίτλος Προτεινόμενης Διπλωματικής Εργασίας</td>
						<td><input type="text" name="thema" required></td>
					</tr>
					<tr>
						<td>Επιβλέπων καθηγητής </td>
						<td><input type="text" name="kathigitis" required=""></td>
					</tr>
					
					<tr>
						<td>Αριθμός Φοιτητών </td>
						<td>
							<select name="arithmos_foititwn">
							   <option value="1">1</option>
							   <option value="2">2</option>
							   <option value="3">3</option>
						    </select> 
						</td>
					</tr>
					<tr>
						<td> Στόχος Διπλωματικής Εργασίας</td>
						<td><textarea name="stoxos" id="t4" rows="4" cols="22" style="resize: none" required></textarea></td>
					</tr>
					<tr>
						<td>username</td>
						<td><input type="text" name="username" value="<?php echo $_SESSION['username'] ?>" readonly></td>
					<tr>
					<tr>
						<td>username 2ου συμμετέχοντα</td>
						<td><input type="text" name="username2" ></td>
					<tr>
					<tr>
						<td>username 3ου συμμετέχοντα</td>
						<td><input type="text" name="username3" ></td>
					<tr>
					
					
				</table></br>
				<input id="button" type="submit" name="submit" value="καταχωρηση" id="submit">
			</form>
			<?php	
	if (isset($_POST['submit']) && $_POST['submit'] == "καταχωρηση" ) {			
		$thema=$conn->real_escape_string($_POST['thema']);
		$kathigitis=$conn->real_escape_string($_POST['kathigitis']);
		$arithmos_foititwn=$_POST['arithmos_foititwn'];
		$stoxos=$conn->real_escape_string($_POST['stoxos']);
		$username=$conn->real_escape_string($_POST['username']);
		$username2=$conn->real_escape_string($_POST['username2']);
		$username3=$conn->real_escape_string($_POST['username3']);

				$sql="insert into aithseis(kathigitis,thema,arithmos_foititwn,stoxos,username,viografiko_id,analutiki_id,username2,username3,readed) 
					values('$kathigitis','$thema','$arithmos_foititwn','$stoxos','$username','$_SESSION[viografiko]','$_SESSION[analutiki]',
					'$username2','$username3',0)";		
				$result = mysqli_query($link, $sql) or die() ;
			   
			     		if ($result) {
			                mysqli_commit($link);?>
			                <script >alert("Η αίτηση ολοκληρώθηκε με επιτυχία!!!");</script><?php
			                			              
			            } else {
			                mysqli_rollback($link);?>
			                <script>alert("Η αίτηση δεν ολοκληρώθηκε λόγω προβλήματος!!!");</script><?php		                
				        }
									
		}
		
?>
		</div>
		<div id="etiseis">
			<h2>Οι αιτήσεις μου</h2>
			<table id="aitiseisTable">
		                <tr>
		                    <th style="border-bottom: 1px solid #ddd;"><b>Κωδικός</b></th>
		                    <th style="border-bottom: 1px solid #ddd;"><b>Καθηγητής</b></th>
		                    <th style="border-bottom: 1px solid #ddd;"><b>Τίτλος</b></th>
		                </tr>
						
						
		      		<!-- populate table from mysql database -->
		                <?php 
		                $username=$_SESSION['username'];
		                $sql = "select id, kathigitis,thema from aithseis where username='$username' ";
						$result = mysqli_query($link, $sql) or die();
		                $count = mysqli_num_rows($result);
						
		                while($row = mysqli_fetch_array($result)):?>
		                <tr style="border-bottom: 1px solid #ddd;">
		                    <td style="border-bottom: 1px solid #ddd;"><?php echo $row['id'];?></td>
		                    <td style="border-bottom: 1px solid #ddd;"><?php echo $row['kathigitis'];?></td>
		                    <td style="border-bottom: 1px solid #ddd;"><?php echo $row['thema'];?></td>
		                   	
		                </tr>
		                <?php endwhile;?>
		                
		            </table>
		</div>	
		</div>
		
		
	
	
        	
        
		
		
	</body>
	
	
	
		
        	

	
	
	
</html>