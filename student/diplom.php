<?php
 	include ("connect_info.php");
	$servername = "localhost";
	$username = "root";
	$password = "";
	session_start();
	
	$_Session['itemSelected']="";
	
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
		<link rel="stylesheet" type="text/css" media="screen" href="css/diplomatikes.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		 
    </head>
    <body>
    	<div><?php include 'top.php';?></div>
    	<center>
    		
    	
    		<div id="stili">
    			<form method="post">
 				<input type="text" name="valueToSearch" placeholder="Αναζήτηση">
		        <input type="submit" name="search" value="Filter"><br><br>
 				<?php		
						if(isset($_POST['search'])&& $_POST['search'] == "Filter")
						{
						    $valueToSearch = $_POST['valueToSearch'];
						    // search in all table columns
						    // using concat mysql function
						    $sql = "SELECT * FROM `diplomatikes` WHERE CONCAT(`kathigitis`,`thema`) LIKE '%".$valueToSearch."%'";
						    $search_result = filterTable($link,$sql);
						    
						}
						 else {
						    $sql = "SELECT * FROM `diplomatikes`";
						    $search_result = filterTable($link,$sql);
						}
						
						
						function filterTable($link,$query)
						{
						   
						    $filter_Result = mysqli_query($link, $query) or die();
						    return $filter_Result;
						}
						?>
 				<table id="diploTable">
		                <tr>
		                    <th><b>Καθηγητής</b></th>
		                    <th><b>Θέμα</b></th>
 		                    <th><b>Κατάσταση</b></th>
		                </tr>
						
						
		      		<!-- populate table from mysql database -->
		                <?php 
		                $count = mysqli_num_rows($search_result);
						
		                while($row = mysqli_fetch_array($search_result)):?>
		                <tr>
		                    <td><?php echo $row['kathigitis'];?></td>
		                    <td><?php echo $row['thema'];?></td>
		                    <td><?php echo $row['status'];?></td>
		                   	
		                </tr>
		                <?php endwhile;?>
		                
		            </table>
		            
 					<input method="post" type="submit" name="submit" value="Αποστολή Αίτησης Καταχώρησης"></input>
		    		<input type="text" id="kathigitisSel" name="kathigitisSel" value="" style="display: none;"></input>
	    			<input type="text" id="themaSel" name="themaSel" value="" style="display: none;"></input>
    			
	    		<!--  click on a row -->
		            
		       		<script>src="https://code.jquery.com/jquery-3.2.1.min.js"</script>
		        	<script>
		        		$('#diploTable tr').click(function() {
		        			var selected = $(this).hasClass("highlight");
						    $('#diploTable tr').removeClass("highlight");
						    if(!selected){
						    	$(this).addClass("highlight");
						    	$row = $(this).closest("tr");
						    	$tds = $row.find("td");
						    	$kathigitis=$tds[0].innerHTML;
								$thema=$tds[1].innerHTML;
								document.getElementById("kathigitisSel").value=$tds[0].innerHTML;
								document.getElementById("themaSel").value=$tds[1].innerHTML;
						    	document.getElementById("keimeno").innerHTML=$.post('ajax/ekfwnisi.php',{kathigitis:$kathigitis,thema:$thema},function($data){
						    		$('#keimeno').text($data);
						    		
						    		
						    	});
		        				
								}
		        		});
		        	</script>
	    	</form>
	   </div>
	 
	   	<div id="keimenoDiplwmatikis">
    		<textarea id="keimeno" name="stoxos" rows="4" cols="50"  style="width: 500px; height: 499px; resize: none; "></textarea>   		
	 	</div>
	   
 			
    			
 			
    	<?php 
    		if (isset($_POST['submit']) && $_POST['submit'] == "Αποστολή Αίτησης Καταχώρησης") {
    				$kathigitis=$conn-> real_escape_string($_POST['kathigitisSel']);
					$thema=$conn-> real_escape_string($_POST['themaSel']);
					$username=$_SESSION['username'];
					
					$sql = "select stoxos, status from diplomatikes where thema='$thema' and kathigitis='$kathigitis'";
					
					$result = mysqli_query($link, $sql) or die();
			    	$count = mysqli_num_rows($result);

			    	if ($count >0) {
				        $row = mysqli_fetch_assoc($result);
				        $stoxos = $row['stoxos'];
						$status=$row['status'];	
								
					}
						if($status=="eleutheri" || $status=="ipo_egkrisi"){
							$sql = "insert into aithseis
		                                    (thema,
		                                     kathigitis,                                   	                                     
		                                     stoxos,
		                                     username,
		                                     arithmos_foititwn,
		                                     viografiko_id,
		                                     analutiki_id ,readed                                  
		                                    )
		                                    values
		                                    ('$thema',	                                     
		                                     '$kathigitis',	                        
		                                     '$stoxos',
		                                     '$username',
		                                     1,
		                                     '$_SESSION[viografiko]',
		                                     '$_SESSION[analutiki]'	,0	                                                                    
		                                    )";
		                        
		            	$result = mysqli_query($link, $sql) or die();
		            	$sql="update diplomatikes set status=`ipo_egkrisi` where thema='$thema' and kathigitis='$kathigitis'";
		            	$result = mysqli_query($link, $sql) or die();
			            if ($result) {
			                mysqli_commit($link);?>
			                <script >alert("Η εισαγωγή ολοκληρώθηκε με επιτυχία!!!");</script><?php		              
			            } else {
			                mysqli_rollback($link);?>
			                <script>alert("Η εισαγωγή δεν ολοκληρώθηκε λόγω προβλήματος!!!");</script><?php		                
				            }
							
						}else{?>
							<script>alert("Η εισαγωγή δεν ολοκληρώθηκε καθώς η διπλωματική έχει ήδη ανατεθεί!!");</script><?php		  
						}
		
	    	}
		?>	
        </center>
    </body>
</html>