<?php 
	session_start();
	include ("../connect_info.php");
	require ("fpdf17/fpdf.php");
	if(isset($_POST['id'])==true){
		$id=$_POST['id'];
		$kathigitis=$_POST['kathigitis'];
		$thema=$_POST['thema'];
		$foititis1=$_POST['foititis1'];
		$foititis2=$_POST['foititis2'];
		$foititis3=$_POST['foititis3'];
		$query = "SELECT sign1,sign2,sign3 FROM `diplomatikes` where kathigitis='".$kathigitis."' and  status='gia_vathmologisi' and id='".$id."' ";
		echo "$query";
		$search_result = mysqli_query($link, $query);
	    while($row1 = mysqli_fetch_array($search_result)){
	    	$pdf=new FPDF();
				$pdf->AddPage();
				$pdf->SetFont("Arial", "B","16");
				$pdf->Cell(0,10,"PDF PAGE",0,1);
				$pdf->Cell(80,10,"ID Diplwmatikis",1,0);
				$pdf->Cell(80,10,$id,1,1);
				$pdf->Cell(80,10,"Titlos Diplwmatikis",1,0);
				$pdf->Cell(80,10,$thema,1,1);
				$pdf->Cell(80,10,"Epivlepwn",1,0);
				$pdf->Cell(80,10,$kathigitis,1,1);
				
				
				$pdf->Cell(80,10,"Eponumo 1ou Foititi",1,0);
				$pdf->Cell(80,10,$foititis1,1,1);
				if ($foititis2 !=NULL && $foititis2 !=""){
				$pdf->Cell(80,10,"Eponumo 2ou Foititi",1,0);
				$pdf->Cell(80,10,$foititis2,1,1);
				}
				if ($foititis3 !=NULL && $foititis3 !=""){
				$pdf->Cell(80,10,"Eponumo 3ou Foititi",1,0);
				$pdf->Cell(80,10,$foititis3,1,1);
				}
				$pdf->Cell(80,30,"Ypografi 1: ",1,1);
				$pdf->Image($row1['sign1'],50,87,20);
				$pdf->Cell(80,30,"Ypografi 2: ",1,1);
				$pdf->Image($row1['sign2'],50,120,20);
				$pdf->Cell(80,30,"Ypografi 3: ",1,1);
				$pdf->Image($row1['sign3'],50,150,20);


				$pdf->Output('test.pdf', 'F');
				
				/*-------------------------------mail sti sxoli -----------------------------*/
				$random_hash = md5(time());
				$file1 = "test.pdf";
				
				$file_size = filesize($file1);
				 $handle = fopen($file1, "r");
				 $content = fread($handle, $file_size);
				 fclose($handle);
				 $content = chunk_split(base64_encode($content));
				
				$mailto="icsd11066@icsd.aegean.gr";
				$subject="Oloklirwsi diplwmatikis";
				$message="---";
				$uid = md5(uniqid(time()));
				 $header = 'From: gladiatorkl@gmail.com' . "\r\n" ;
				 $header .= 'Reply-To: gladiatorkl@gmail.com'."\r\n";
				 $header .= "MIME-Version: 1.0\r\n";
				 $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
				 $message = "Sas episinaptoume tin oloklirwmeni Diplwmatiki.\r\n";
				 $message .= "--".$uid."\r\n";
				 $message .= "Content-type:text/plain; charset=iso-8859-1\r\n";
				 $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
				 $message .= $message."\r\n\r\n";
				 $message .= "--".$uid."\r\n";
				 $message .= "Content-Type: application/octet-stream; name=\"".$file1."\"\r\n"; // use different content types here
				 $message .= "Content-Transfer-Encoding: base64\r\n";
				 $message .= "Content-Disposition: attachment; filename=\"".$file1."\"\r\n\r\n";
				 $message .= $content."\r\n\r\n";
				 $message .= "--".$uid."--";
				 if (mail($mailto, $subject, $message, $header)) {
				 	echo "mail send ... OK"; // or use booleans here
				 } else {
				 	echo "mail send ... ERROR!";
				 }
	}							
	}
?>