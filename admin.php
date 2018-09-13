
  <style type="text/css">

    @import url("http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.css");

  </style>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/FCGC - New.dwt" codeOutsideHTMLIsLocked="false" -->



<head>







<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta name="verify-v1" content="0vatETAjQmrEV8XeXDaI7F3fHJnHqwjUyn5FP/BCYt0=" />



<title>The Fat Cats Golf Club</title>



<link href="/layout_new.css" rel="stylesheet" type="text/css" />

</head>



<body style="background-color: #FFFFFF">



<div id="site">



  <div id="banner">



    <p>&nbsp;</p>



  </div>



  <div id="top"><a href="/index.php">Home</a> | <a href="/fixtures.php">Upcoming Golf Days</a> | <a href="/results.php">Results</a> | <a href="/leaderboard.php">Leaderboard</a> | <a href="/handicaps.php">Handicaps</a> | <a href="http://fcgc.co.uk/forum" target="_blank">Forum</a> | <a href="http://gallery.fcgc.co.uk" target="_blank">Photo Gallery</a></div>



<div id="main">



  <div id="middle">







    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->

    <div id="header"><p>Admin</p></div>

	<script language="javascript" type="text/javascript">

	    function viewComp(compID) {

	    if (compID != '') {

	            window.location.href = 'addresults.php?compID=' + compID;

	        } 

	    }

	

	    function viewMember(compID,mem) {

	            window.location.href = 'addresults.php?compID=' + compID;

	    }

	

	    function showHide(elem)

	    {

	      if (document.getElementById(elem).style.display == 'none')

	      { document.getElementById(elem).style.display = 'block' }

	      else

	      { document.getElementById(elem).style.display = 'none' }

	    }



  	 </script>



    <div id="square">

    <?php

        include 'library/config.php';

    	include 'library/opendb.php';

    	require_once 'imagegallery/library/functions.php';
    	
    	$user = $_POST['user'];
		$pass = $_POST['pass'];
		
		if(empty($_POST['user']))
			{
			
			       echo" <form method=\"POST\" action=\"admin.php\"> ".
			        "User <input type=\"TEXT\" name=\"user\" /> ".
			        "Pass <input type=\"password\" name=\"pass\" />  ".
			        "<input type=\"submit\" name=\"submit\" /> ".
			        "</form> ";
			} 
			
			elseif($user == "admin" && $pass == "2018golf")
						
			{

				$today = getdate();
				
				//settype($dateconv,"string");
				
				$d = $today['mday'];
				$m = $today['mon']-1;
				$y = $today['year'];
				
				$convdate = "$y-$m-$d";
	
	
				$sql = "SELECT compID, compname, compdate
	
					FROM comptab
					
					WHERE compdate >= '$convdate'
	
					ORDER BY compdate";
	
				$result = mysql_query($sql);                    
		
		
		
		
				$compList = '';

					while ($row = mysql_fetch_assoc($result)) {
			
						$compList .= '<option value="' . $row['compID'] . '"' ;
			
						if ($row['compID'] == $compID) {
			
							$compList .= ' selected';
			
						}
			
					
			
						$compList .= '>' . $row['compname'] . ' - ' . $row['compdate'] . '</option>';	
			
					}
					
				?>
					
					<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
			
			    	<tr> 
			
			        	<td>Select competition to add results : 
			
			                <select name="cboComp" id="cboComp" onChange="viewComp(this.value)">
			                
			                   <option value="default">Select a competition</option>
			
			                  <?php echo $compList; ?> 
			
			              </select>
			
						</td>
			
			         </tr>
							
					</table>

				<?php
				} else {
					echo "Wrong password";
				}
					

			
			
			?>
	



    </div>



    <!-- InstanceEndEditable --></div>







  </div>







  </div>







<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>



  | <a href="/admin.php">Site Admin</a></div>



</div>



</body>



<!-- InstanceEnd --></html>

