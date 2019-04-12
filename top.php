<!-- show date -->
	<SCRIPT language=JavaScript>
		function Today()
		{
			var date = new Date();
			var days = new Array("Κυριακή","Δευτέρα","Τρίτη","Τετάρτη","Πέμπτη","Παρασκευή","Σάββατο")
			var months = new Array("Ιανουαρίου","Φεβρουαρίου","Μαρτίου","Απριλίου","Μαϊου","Ιουνίου","Ιουλίου","Αυγούστου","Σεπτεμβρίου","Οκτωβρίου","Νοεμβρίου","Δεκεμβρίου")
	
			var d = date.getDay();
			var m = date.getMonth();
			var y = date.getYear().toString();
	
			var date = date.getDate();
			var day = days[d];
			var month = months[m];
	
	
			var Today = day + ", " + date + " " + month + " 20" + y.substring(y.length-2, y.length);
	
			return Today;
		}
	
		function setPoly()
		{
			document.langForm.lang.value="poly";
			document.langForm.submit();
		}
	
		function setMono()
		{
			document.langForm.lang.value="mono";
			document.langForm.submit();
		}
	</SCRIPT>

<!-- banner -->
	<div id="menu_top_bg">
	 <div style="width:1100px; margin: auto;" align="center" >
	  <div class="one-third" style="margin: 7px; float:left;margin-left: 200px;">
	   	<a href="http://www.aegean.gr/" target="_blank">
	    <img src="img/aegean.gif" alt=""></a>	   	
	   	<br>
	   	<font color="#ffffff"><b>ΠΑΝΕΠΙΣΤΗΜΙΟ ΑΙΓΑΙΟΥ</b></font>
	   	
	  </div> 
	  <div>
	  	<p class="title" ><br />Diplo <br /><br /><br /> Platform</p>
	   	<br>
	   	<tr>
	       <script language=javascript>
			document.write("<b><font size=2 color=#ff6600></b>"+"ΚΑΡΛΟΒΑΣΙ, ΣΑΜΟΣ - ");
			document.write(Today());
			document.write("</font>");
		   </script>
		   <a href="../diplo/index.php" style="float:right; color: red; font-size: 20px;">Logout</a>
	   	</tr>
	  </div>
	   	
	 </div> 
	</div> 
 
	<!--  Menu -->
	<div class="header" align="center" style="width: 1400px;">
	  <ul id="menu">
	    <li><a href="index.php">Home</a></li>
		<li ><a href="new_diplom.php">Nέα Διπλωματική</a></li>  ​
	    <li ><a href="oi_diplwmatikes_mou.php">Οι διπλωματικές μου</a></li>
	    <li><a href="analipsi.php">Ανάληψη νέας διπλωματικής <?php echo '<span style="color:red; font-size:20px;">'."$_SESSION[unreaded]".'</span>' ?> </a></li>
	    <li><a href="chat_room.php">Chat_Room</a></li>    
	    <li><a href="gantChart.php">Πρόοδος</a></li>    
	    <li><a href="statistika">Στατιστικά</a></li> 
	     <li><a href="toPDF.php">Ενημέρωση Γραμματείας</a></li> 
	     <li ><a href="diplofiles.php">Αρχεία διπλωματικών</a></li> 
	     <li><a href="chartstatistics.php">Σχετικά</a></li>    ​
	  </ul>  
	</div>