<?php
include 'connect_info';
$id=$_GET['id'];
$con = mysql_connect("localhost","root",""); 

if(!$con){ 
     
    die("Couldn't Connect " . mysql_error()); 
     
} 

mysql_select_db("diplo_project",$con); 
$query = "SELECT * FROM upload_file WHERE id ='". $id."'"; 
$result = mysql_query($query) or die(mysql_error()); 


$name=mysql_result($result,0,'file_name');  
$size=mysql_result($result,0,'size');  
$type=mysql_result($result,0,'file_type');  
$content=mysql_result($result,0,'content');  

header("Content-Disposition: attachment; filename=$name");  
header("Content-length: $size");  
header("Content-type: $type");  
echo $content;  

mysql_close()
 ?>