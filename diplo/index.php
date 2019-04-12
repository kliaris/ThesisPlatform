<?php
	unset($_SESSION);
	session_start();
 	include ("connect_info.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 	
	// gia mathimatiki erwtisi	
	$n1=(mt_rand(0,10)) ;
	$n2=(mt_rand(0,10)) ;
	$n3 = $n1+ $n2;
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title> Register </title>
	<link rel="stylesheet"  href="css/registration&login.css" />


</head>
<body>
	<div id="header" >
		<p class="title" >Diplo <br /> Platform</p>	
	</div>
	<div id="forms">
		<div id="regForm">
			<h2> Register form</h2>
			<form method="post">
				<p><label for="username">Username</label>
					<input type="text" size="29" name="username" required/></p>
				<p><label for="password">Password</label>
					<input type="password" size="29" name="password" /></p>
				<p><label for="password">Repeat Password</label>
					<input type="password" size="29" name="rpassword" /></p>
				<p><label for="Onoma">Όνομα</label>
					<input type="text" size="29" name="onoma" required/></p>
				<p><label for="Epitheto">Επίθετο</label>
					<input type="text" size="29" name="epitheto" /></p>
				<p><label for="am">Αριθμός Μητρώου</label>
					<input type="passtextword" size="29" name="am" /></p>
				<p><label for="email">eMail</label>
					<input type="text" size="29" name="email" required/></p>	
				<p><label for="bots">Make the math : <?php echo $n1; ?> + <?php echo $n2 ;?></label>
					<input type="number" size="29" name="math" required/>
					<input type="hidden" size="2" name="answermath" value="<?php echo $n3; ?>"/></p></p>
				<input class ="button" type="submit" name="submit" value="Εγγραφή"/>
				
			</form>
		
		
		<?php
	    if (isset($_POST['submit']) && $_POST['submit'] == "Εγγραφή") {
		       			
	        $error = 0;
	
	        //check username
	        if ($_POST['username'] == "") {
	        	
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε το Όνομα!<br></font>";
	            $error = 1;
	        }else{
	        	$username = $conn-> real_escape_string($_POST['username']);
	        }
	
	        //check password
	        if ($_POST['password'] == "") {
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε το Password!<br></font>";
	            $error = 1;
	        }else{ 
	        	$uppercase = preg_match('@[A-Z]@', $_POST['password']);
				$lowercase = preg_match('@[a-z]@', $_POST['password']);
				$number    = preg_match('@[0-9]@', $_POST['password']);
				// check strong password
				if(!$uppercase ) {
				  	echo "<font color=\"#ffffff\">To Password πρέπει να περιέχει τουλάχιστον ένα κεφαλαίο γράμμα!<br></font>";
			        $error = 1;
				}else if(!$lowercase){
					echo "<font color=\"#ffffff\">To Password πρέπει να περιέχει τουλάχιστον ένα πεζό γράμμα!<br></font>";
			        $error = 1;
				}else if(!$number){
					echo "<font color=\"#ffffff\">To Password πρέπει να περιέχει τουλάχιστον ένα νούμερο!<br></font>";
			        $error = 1;
				}else if(strlen($_POST['password']) < 7){
					echo "<font color=\"#ffffff\">To μήκος του Password πρέπει να είναι τουλάχιστον 8 !<br></font>";
			        $error = 1;			
				}else{	//password validation
					if ($_POST['rpassword'] == "" ) {
			            echo "<font color=\"#ffffff\">Πρέπει να επαληθεύσετε το Password!<br></font>";
			            $error = 1;
			        }else{
			        	if ($_POST['rpassword'] != $_POST['password'] ) {
				            echo "<font color=\"#ffffff\">Δεν επαληθεύσατε το Password σωστά!<br></font>";
				            $error = 1;
					     }else{			        			        	
							$enc_password=md5($_POST['password']);
				        }		        	
						
			        }						
				}        			
	        }
	
			
			//check email
	        if ($_POST['email'] == "") {
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε το email!<br></font>";
	            $error = 1;
	        }else{
	        	$email = $conn->real_escape_string($_POST['email']);
				//check role
				if(substr($email, 0,4)=="icsd")
					$role=1;		//student
				else{
					$role=2;		//proffessor
				}
	        }
			//check onoma
	        if ($_POST['onoma'] == "") {
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε το όνομα!<br></font>";
	            $error = 1;
	        }else{
	        	$onoma = $conn->real_escape_string($_POST['onoma']);
				
	        }
		
			//check epitheto
	        if ($_POST['epitheto'] == "") {
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε το επίθετο!<br></font>";
	            $error = 1;
	        }else{
	        	$epitheto = $conn->real_escape_string($_POST['epitheto']);
				
	        }
			
			//check am
	        if ($_POST['am'] == "") {
	            echo "<font color=\"#ffffff\">Πρέπει να συμπληρώσετε τοn Αριθμό Μητρόου!<br></font>";
	            $error = 1;
	        }else{
	        	$am = $conn->real_escape_string($_POST['am']);
				
	        }
			
			//check for bots
			if($_POST['math'] != $_POST['answermath']){
				echo "<font color=\"#ffffff\">Δεν έκανες σωστά τα μαθηματικά!<br></font>";
	            $error = 1;				
			}
			
			
	        if ($error) {
	            echo "<font color=\"#ffffff\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω λαθών στα στοιχεία εισόδου!!!<br></strong></font>";
	        } else {
	            //kane eisagogi tis times stin vasi
				$confirm_code=rand();
	            mysqli_autocommit($link, false);
	            $sql = "insert into members
	                                    (username,
	                                     password,                                   
	                                     email,
	                                     onoma,
	                                     epitheto,
	                                     am,
	                                     role,
	                                     confirmed,	                                 
	                                     confirm_code
	                                    )
	                                    values
	                                    ('$username',	                                     
	                                     '$enc_password',
	                                     '$email',
	                                     '$onoma',
	                                     '$epitheto',
	                                     '$am',
	                                     '$role',
	                                     0,
	                                     $confirm_code
	                                    )";
				
				$message="
					Confirm Your Email
					Click the link below to verify your account
					http://localhost:8080/diplo/emailconfirm.php?username=$username&code=$confirm_code	
				";
				
				mail($email,"Diplo Confirm Email",$message,"From: gladiatorkl@gmail.com");
				echo"<font color=\"#3300FF\"><strong><br>Registration Complete! Please confirm your email !<br></strong>";
				
	            $result = mysqli_query($link, $sql) or die();
	            if ($result) {
	                mysqli_commit($link);
	                echo "<font color=\"#3300FF\"><strong><br>Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!<br></strong>";
	            } else {
	                mysqli_rollback($link);
	                echo "<font color=\"#ffffff\"><strong><br>Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!<br></strong></font>";
	            }
	        }
	    }
	    ?>
			
		</div>	
		
		<div id= logForm>
			<h2> LogIn form</h2>
			<form method="post">
				<p><label for="username">Username</label>
					<input type="text" size="29" name="usernamelog" required/></p>
				<p><label for="password">Password</label>
					<input type="password" size="29" name="passwordlog" required/></p>			
				<input  class="button" type="submit" name="submit" value="Είσοδος"/>
			</form>
			<?php
		    if (isset($_POST['submit']) && $_POST['submit'] == "Είσοδος") {
		    	     
			    $username = mysqli_real_escape_string($link, $_POST['usernamelog']);
			    $password = mysqli_real_escape_string($link, $_POST['passwordlog']);
				$encpassword = md5($password);
		 		
		    	$sql = "select * where username='$username' and password='$encpassword'";
			    $result = mysqli_query($link, $sql) or die();
			    $count = mysqli_num_rows($result);

			    if ($count == 1) {
			        $row = mysqli_fetch_assoc($result);
			        $role = $row['role'];
					$dbpassword=$row['password'];
					
			        $_SESSION['username'] = $username;
				    $_SESSION['password'] = $password;
			        $_SESSION['id_role'] = $role;
					$_SESSION['memb_id'] = $role['memb_id'];
			        $_SESSION['onoma'] = $role['onoma'];
					$_SESSION['epitheto'] = $role['epitheto'];
			        $_SESSION['am'] = $role['am'];
					$_SESSION['message'] = $role['message'];
			        $_SESSION['d_id'] = $role['d_id'];
					$_SESSION['viografiko'] = $role['viografiko_id'];
			        $_SESSION['analutiki'] = $role['analutiki_id'];
					$_SESSION['email'] = $row['email'];
			        
			        //switch ($_SESSION['id_role']) {
				    switch ($role) {
				        case 1: //student
				            header("Location: ../student/index.php");
				            exit();
				            break;
				        case 2: //prof
				            header("Location: ../proff/index.php");
				            exit();
				            break;
				    }		
			    } else {
			    	
			        echo "<font color=\"#ffffff\"><strong><br>Λάθος Στοιχεία!<br></strong></font>";
			    }
	
			    		
		    }    
		    
		?>
		</div>
		
		
	</div>
</body>
</html>