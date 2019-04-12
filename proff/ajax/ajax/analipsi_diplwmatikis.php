<?php 
	session_start();
	require '../connect_info.php';
	$value1=$_POST['foititis1'];
	$value2=$_POST['foititis2'];
	$value3=$_POST['foititis3'];
if(isset($_POST['id'])==true){	
	$sql = "SELECT id FROM diplomatikes WHERE diplomatikes.thema='". $_POST['thema'] ."' and diplomatikes.kathigitis='". $_POST['kathigitis'] ."'";
			    $result = mysqli_query($link, $sql) or die();
			    $count = mysqli_num_rows($result);

			    if ($count > 0) {
			    	$row = mysqli_fetch_assoc($result);
			        $id = $row['id'];					//to id apo ton pinaka twn diplwmatikwn
					$sql1 = "UPDATE diplomatikes SET status='anatethike',foititis1='". $_POST['foititis1'] ."'
					,foititis2='". $_POST['foititis2'] ."',foititis3='". $_POST['foititis3'] ."',analipsi=NOW()
					WHERE diplomatikes.id='".$id."'";
					$result = mysqli_query($link, $sql1) or die();
					
					$sql2 = "UPDATE members SET message='Εγκρίθηκε η ανάληψη μιας διπλωματικής 
							.Παρακαλώ επικοινωνήστε με τον επιβλέπων καθηγητή σας!'
							where username='" .$value1 . "' or username='" .$value2 . "' or username='" .$value3 . "'";	
					$result = mysqli_query($link, $sql2) or die();	
					
					
					$sql="SELECT id FROM diplomatikes ORDER BY id DESC LIMIT 1";echo "$sql";
					$result = mysqli_query($link, $sql) or die();
					$row1 = mysqli_fetch_assoc($result);
					$lastid=$row1['id'];
					$sql2 = "UPDATE members SET d_id='".$lastid."'
							where username='" .$value1 . "' or username='" .$value2 . "' or username='" .$value3 . "'";	
					$result = mysqli_query($link, $sql2) or die();
			
			    }else{
			    	$sql="insert into diplomatikes (thema, kathigitis, foititis1,foititis2,foititis3,analipsi,status)
			    		values ('". $_POST['thema']."','" .$_POST['kathigitis']."','".$_POST['foititis1']."','".$_POST['foititis2']."',
			    		'".$_POST['foititis3']."',NOW(),'anatethike')";
						$result = mysqli_query($link, $sql) or die();
					
					$sql2 = "UPDATE members SET message='Εγκρίθηκε η ανάληψη μιας διπλωματικής 
							.Παρακαλώ επικοινωνήστε με τον επιβλέπων καθηγητή σας!'
							where username='" .$value1 . "' or username='" .$value2 . "' or username='" .$value3 . "'";	
					$result = mysqli_query($link, $sql2) or die();	
				
				
					$sql="SELECT id FROM diplomatikes  ORDER BY id DESC LIMIT 1";echo "$sql";
					$result = mysqli_query($link, $sql) or die();
					$row1 = mysqli_fetch_assoc($result);
					$lastid=$row1['id'];
					$sql2 = "UPDATE members SET d_id='".$lastid."'
							where username='" .$value1 . "' or username='" .$value2 . "' or username='" .$value3 . "'";	
					$result = mysqli_query($link, $sql2) or die();
			    }
				$sql="DELETE FROM aithseis WHERE id='".$_POST['id']."'";
				$result = mysqli_query($link, $sql) or die();
								
}
?>