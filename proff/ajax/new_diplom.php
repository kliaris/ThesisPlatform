<?php
 	include ("connect_info.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	
	session_start();
	$_SESSION["message"]="";
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
		<link rel="stylesheet" type="text/css" media="screen" href="css/newDiplomStyle.css">
    </head>
    <body>   	
    	<div><?php include 'top.php';?></div>

    	<form id="container" " method="post">	
    		<ul>	<!--  Forma Neas diplomatikis -->
    			<div style="float:left;">
    				<li ><h2>Τίτλος Διπλωματικής Εργασίας</h2>			
						<textarea name="titlos" id="titlos" rows="4" cols="50" ></textarea>	
						</li>	
					<li ><h2>Επιβλέπων Καθηγητής</h2>				
						<text><?php echo $_SESSION['username']?></text>						
						</li>	
					<li><h2>Αριθμός Φοιτητών</h2>								
							<select name="dropdownArithmos" >						
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
							</select>					
						</li>
    				
    			</div>
    			<div style="float:right;">
    				<li><h2>Στόχος Διπλωματιλής Εργασίας</h2>				
						<textarea name="stoxos" rows="4" cols="50"></textarea>												
					</li>		
				<li><h2>Συνοπτική Περιγραφή Διπλωματικής Εργασίας</h2>		
						<textarea name="perigrafi" rows="4" cols="50"></textarea>												
					</li>	
				<li><h2>Προαπαιτούμενα Μαθήματα</h2>				
					<form>
						<select name="mathimata" onchange="showUser(this.value)">
							<option value="">Select semester</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>					
						</select>
						<br>
						<div id="txtHint"><b>edwwww....</b></div>
					</form>	
					</li>	
    				
    			</div>
				
				<li><h2>Προαπαιτούμενες Γνώσεις</h2>
					<textarea name="gnoseis" rows="4" cols="50"></textarea>									
					</li>
				<li><h2>Στοιχεία Φοιτητών</h2>
					<div style="float:left; >
							<table border="1" >
								<div style="float:left;">
									Στοιχεία Πρώτου Φοιτητή					
								<table border="1" >
									<tr id="row1">
										<td >Όνομα:</td>
										<td ><input type = "text" name="fname1" maxlength="15"></td>
									</tr>
									<tr>
										<td >Επίθετο</td>
										<td ><input type = "text" name="Lname1" maxlength="15"></td>
									</tr>
									<tr>
										<td >Αριθμός Μητρόου</td>
										<td ><input type = "text" name="am1" maxlength="15"></td>
									</tr>
									<tr>
										<td >Υπογραφή</td>
										<td ><input type = "text" name="sign1" maxlength="15"></td>
									</tr>
								</table>
									
									
								</div>
								
								<div style="float:left;">
									Στοιχεία Δεύτερου Φοιτητή					
								<table border="1" >
									<tr id="row1">
										<td >Όνομα:</td>
										<td ><input type = "text" name="fname2" maxlength="15"></td>
									</tr>
									<tr>
										<td >Επίθετο</td>
										<td ><input type = "text" name="Lname2" maxlength="15"></td>
									</tr>
									<tr>
										<td >Αριθμός Μητρόου</td>
										<td ><input type = "text" name="am2" maxlength="15"></td>
									</tr>
									<tr>
										<td >Υπογραφή</td>
										<td ><input type = "text" name="sign2" maxlength="15"></td>
									</tr>
								</table>	
									
								</div>
								
								<div style="float:left;">
									Στοιχεία Τρίτου Φοιτητή
									<table border="1" >
									<tr id="row1">
										<td >Όνομα:</td>
										<td ><input type = "text" name="fname3" maxlength="15"></td>
									</tr>
									<tr>
										<td >Επίθετο</td>
										<td ><input type = "text" name="Lname3" maxlength="15"></td>
									</tr>
									<tr>
										<td >Αριθμός Μητρόου</td>
										<td ><input type = "text" name="am3" maxlength="15"></td>
									</tr>
									<tr>
										<td >Υπογραφή</td>
										<td ><input type = "text" name="sign3" maxlength="15"></td>
									</tr>
								</table>
								</div>					
					</div>
					</li>	
				<li style="float:left;"><h2>Ημερομηνία Δημοσιοποίησης</h2>
					<div >													
							<input type="date" name="dimosiopoiisi">													
					</div>
					</li>
				<li style="float:center; margin-left: 350px;"><h2>Ημερομηνία Ανάληψης Θέματος</h2>
					<div >							
								<input type="date" name="analipsi">													
						</div>
						</li>
				<li><h2>Ημερομηνία Ολοκλήρωσης Πτυχιακής</h2>
					<div >
							<input type="date" name="oloklirosi">
													
					</div>
					</li>
				<li><h2>Βαθμολογία</h2>
					<div >
						<select name="vathmos">
							<option value="7">1</option>
							<option value="8">2</option>
							<option value="9">3</option>
							<option value="10">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>
					</div>
					</li>	
				<li>
					<input id="submitbutton" type="submit"  name="submit" value="Καταχώρηση" />
					
					</li>
					
    		</ul>
    		
    		<?php
    			
    			if (isset($_POST['submit']) && $_POST['submit'] == "Καταχώρηση") {
    				$titlos = $conn->real_escape_string($_POST['titlos']);
					$number = $_POST['dropdownArithmos'];
					$stoxos = $conn->real_escape_string($_POST['stoxos']);
					$perigrafi = $conn->real_escape_string($_POST['perigrafi']);
	//				$mathimata = $conn->real_escape_string($_POST['mathimata']);
					$gnoseis= $conn->real_escape_string($_POST['gnoseis']);
					$dimosiopiisi = $_POST['dimosiopoiisi'];
					$analipsi = $_POST['analipsi'];
					$oloklirosi =$_POST['oloklirosi'];
					$eleutheri="OXI";
					if (DateTime::createFromFormat('Y-m-d', $dimosiopiisi) == FALSE) {
					  $dimosiopiisi="0001-01-01";												
					}
					if (DateTime::createFromFormat('Y-m-d', $analipsi) == FALSE) {
					  $analipsi="0001-01-01";	
						$eleutheri="eleutheri";										
					}
					if (DateTime::createFromFormat('Y-m-d', $oloklirosi) == FALSE) {
					  $oloklirosi="0001-01-01";												
					}
					
    				mysqli_autocommit($link, false);
	            	$sql = "insert into diplomatikes
	                                    (thema,
	                                     kathigitis,                                   
	                                     perigrafi,
	                                     stoxos,
	                                     arithmos_foititwn,
	                                     gnwseis,
	                                     dimosieusi,
	                                     analipsi,	                                 
	                                     oloklirwsi,
	                                     status
	                                    )
	                                    values
	                                    ('$titlos',	                                     
	                                     '$_SESSION[username]',
	                                     '$perigrafi',
	                                     '$stoxos',
	                                     '$number',
	                                     '$gnoseis',
	                                     '$dimosiopiisi',
	                                     '$analipsi',
	                                     '$oloklirosi',
	                                     '$eleutheri'
	                                    )";
	                                    echo("$sql");
	                              
	            	$result = mysqli_query($link, $sql) or die();
		            if ($result) {
		                mysqli_commit($link);?>
		                <script >alert("Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!");</script><?php		              
		            } else {
		                mysqli_rollback($link);?>
		                <script>alert("Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!");</script><?php		                
		            }
    			}else{  
    				echo "";
				}
			?>
    		
    	</form>
    </body>
</html>