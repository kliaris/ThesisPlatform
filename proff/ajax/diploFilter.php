
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
	session_start();
	include ("../connect_info.php");
	$q = $_GET['q'];

	if($q=="ipo_egkrisi"){
		$sql="SELECT * FROM aithseis WHERE kathigitis= '" .$_SESSION['username']."'";
		$result = mysqli_query($link,$sql) or die();
		echo "<table>
			<tr>
				<th>Id</th>
				<th>Titlos</th>
				<th>Epivlepwn</th>			
				<th>Stoxos</th>
			</tr>";
			while($row = mysqli_fetch_array($result)) {
			    echo "<tr>";
			    echo "<td>" . $row['id'] . "</td>";
			    echo "<td>" . $row['thema'] . "</td>";
			    echo "<td>" . $row['kathigitis'] . "</td>";
			    echo "<td>" . $row['stoxos'] . "</td>";
			    echo "</tr>";
			}
			echo "</table>";
			//mysqli_close($con);
		
	}else{
			$sql="SELECT * FROM diplomatikes WHERE status = '".$q."' and kathigitis= '" .$_SESSION['username']."'";
			$result = mysqli_query($link,$sql) or die();
		
			echo "<table>
			<tr>
				<th>Id</th>
				<th>Titlos</th>
				<th>Epivlepwn</th>
				<th>Perigrafi</th>
				<th>Stoxos</th>
			</tr>";
			while($row = mysqli_fetch_array($result)) {
			    echo "<tr>";
			    echo "<td>" . $row['id'] . "</td>";
			    echo "<td>" . $row['thema'] . "</td>";
			    echo "<td>" . $row['kathigitis'] . "</td>";
			    echo '<td style="width:200px;">' . $row['perigrafi'] . "</td>";
			    echo "<td>" . $row['stoxos'] . "</td>";
			    echo "</tr>";
			}
			echo "</table>";
			//mysqli_close($con);
		
	}
	
	?>
	</body>
</html>