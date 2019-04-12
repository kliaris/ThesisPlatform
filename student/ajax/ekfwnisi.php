<?php 
$value1 = $_POST['kathigitis'];
$value2 = $_POST['thema'];
if(isset($_POST['kathigitis'])==true && isset($_POST['kathigitis'])==true){
	require '../connect_info.php';
	
	$sql = "SELECT perigrafi FROM `diplomatikes` WHERE kathigitis='". $_POST['kathigitis'] ."' and thema='". $_POST['thema'] ."'";
			    $result = mysqli_query($link, $sql) or die();
			    $count = mysqli_num_rows($result);

			    if ($count == 1) {
			    	$row = mysqli_fetch_assoc($result);
			        $ekfwnisi = $row['perigrafi'];
					echo $ekfwnisi;
			    }
}

?>