
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/FCGC - New.dwt" codeOutsideHTMLIsLocked="false" -->



<head>







<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<meta name="verify-v1" content="0vatETAjQmrEV8XeXDaI7F3fHJnHqwjUyn5FP/BCYt0=" />



<title>The Fat Cat Golf Club</title>



<link href="/layout_new.css" rel="stylesheet" type="text/css" />

</head>



<body style="background-color: #FFFFFF">



<div id="site">



  <div id="banner">



    <p>&nbsp;</p>



  </div> <!-- End Div banner -->



  <div id="top"><a href="/index.php">Home</a> | <a href="/fixtures.php">Upcoming Golf Days</a> | <a href="/results.php">Results</a> | <a href="/leaderboard.php">The Fat Cat Race</a> | <a href="/handicaps.php">Handicaps</a> | <a href="http://fcgc.co.uk/forum" target="_blank">Forum</a> | <a href="http://gallery.fcgc.co.uk" target="_blank">Photo Gallery</a></div>



<div id="main">

  <div id="middle">

    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->

    <div id="header"><p>Add results</p></div>

	<script language="javascript" type="text/javascript">

	    function viewComp(compID) {

	    if (compID != '') {

	            window.location.href = 'addresults.php?compID=' + compID;

	        } 

	    }

	

	    function viewMember(compID,mem) {

	            window.location.href = 'addresults.php?compID=' + compID + '&member=' + mem;

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
    

	
	    if (isset($_GET['compID'])) 
	
	    {	 
	
	        $compID = $_GET['compID'];
	
	    } else {


		       echo "<script>window.location.href='/admin.php';</script>";
		
		}		
			
/*			    
			
				// get competition list
				
				//$date = getdate();
				//echo $date;
				
			//	console.log("today's day " $date);
			
			//	$sql = "SELECT compID, compname, compdate FROM comptab WHERE compdate >= '$date' ORDER BY compdate";
			
				$sql = "SELECT compID, compname, compdate FROM comptab ORDER BY compdate";
		
				$result = mysql_query($sql);                    
			
			
			
				$compList = '';
			
				while ($row = mysql_fetch_assoc($result)) {
			
					$compList .= '<option value="' . $row['compID'] . '"' ;
			
					if ($row['compID'] == $compID) {
			
						$compList .= ' selected';
			
					} //end if
			
					
						$compList .= '>' . $row['compname'] . ' - ' . $row['compdate'] . '</option>';	
				} //end while
			
			} //end else COMPID
			
			
			
					 "<tr>" .
			
						"<th colspan=\"6\" align=\"left\">Add results for     " .
			
			                "<select name=\"cboComp\" id=\"cboComp\" onChange=\"viewComp(this.value)\">" .
			
			                  "$compList" .
			
			              "</select>".
			
						"</th>".
			
			    	 "</tr>";
			

	*/
	
	
		if(isset($_POST['submit']))
	
		   {		
	
			// Get post information
	
			$total = $_POST["total"];
	
	
	
			//echo "you pressed submit and there are $total fields";
	
			echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">" .
	
				 "<tr>" .
	
					"<th align=\"left\">You have added the following reults</th>".
	
				 "</tr>";
	
			
	
			for ($i = 0; $i <= $total; $i++) {
	
				$golferID = $_POST["golfer$i"];
	
				$stable = $_POST["stable$i"];
	
				$stroke = $_POST["stroke$i"];
	
				$position = $_POST["position$i"];
	
				$points = $_POST["points$i"];
	
				$golfername = $_POST["golfername$i"];
	
				$hcapchange = $_POST["hcap$i"];
	
				
	
				if (!$stable) {$stable = "0";} //zero vars
	
				if (!$stroke) {$stroke = "0";}
	
				if (!$points) {$points = "0";}
	
							
	
				if ($position) {
	
							$year = date('Y');
	
							
	
							$sqlinsert = "INSERT INTO resultstab (compID, golferID, stablescore, strokescore, position, points, season) ".
	
					 		 			 "VALUES ('$compID','$golferID','$stable','$stroke','$position','$points','$year')";			
	
							//echo $sqlinsert;
	
							mysql_query($sqlinsert) or die('Error, Results insert query failed');
	
							
	
							//$sqlget = "SELECT hcapact FROM hcaptab WHERE golferID = '$golferID'";
	
							$sqlget = "SELECT hcapact FROM hcaptab WHERE golferID = '$golferID' ".
	
									  "AND hcapID = (SELECT MAX(hcapID) FROM hcaptab WHERE golferID = '$golferID')";
	
							$row = mysql_query($sqlget); 
	
							
	
							list ($currenthcap) = mysql_fetch_row($row);
	
							//echo "Current handicap" + $currenthcap;
	
							if ($currenthcap < '28') {
	
								$newhcap = $currenthcap + $hcapchange;
	
							} elseif (!$currenthcap) {
	
								$newhcap = '0' + $hcapchange;
	
							} else {
	
								$newhcap = '28.0';
	
							}
	
							
	
							$datetime = date('Y-m-d H:i:s');
	
										
	
							$sqlinsert = "INSERT INTO hcaptab (compID, golferID, hcapchange, hcapact, timeofchange) ".
	
										 "VALUES ('$compID','$golferID','$hcapchange','$newhcap','$datetime')";
	
										 
	
							//echo $sqlinsert;
	
							mysql_query($sqlinsert) or die('Error, Handicap insert query failed');
					}
	
				} // end for loop
	
				
	
				 "<tr>" .
	
					"<td align=\"left\"><a href=\"/index.php\">You have added the reults. Click here to return to the homepage</a></td>".
	
			 "</tr>";
			 
				echo "</table>";	

			} else { //end if post check
			

			echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">" ;
			
			echo "<tr>" .
			
							"<th align=\"left\">#</th>".
			
							"<th align=\"left\">Golfer</th>".
			
							"<th align=\"left\">Stableford Score</th>".
			
							"<th align=\"left\">Handicap Change</th>".
			
							"<th align=\"left\">Position</th>".
			
							"<th align=\"left\">Order of merit points</th>".
			
						"</tr>";
			
				
			
				$sql = "SELECT signuptab.golferID, golfertab.firstname, golfertab.lastname FROM signuptab LEFT ".
			
						"JOIN golfertab ON signuptab.golferID = golfertab.golferID ".
			
						"WHERE signuptab.compID = '$compID' ORDER BY lastname";
			
				$golfers = mysql_query($sql);
			
				
			
				$counter="0";
			
				$rowid="1";
			
				
			
				echo "<form method=\"post\" name=\"insertform\" target=\"_self\" id=\"insertform\">";
			
				while ($row = mysql_fetch_assoc($golfers)) {
			
					 $golferID = $row['golferID'];
			
					 $firstname = $row['firstname'];
			
					 $lastname = $row['lastname'];
			
					 
			
					 if (!empty($golferID)) {
			
					 echo 	"<tr>" .
			
						   		"<td align=\"left\">$rowid</td>".
			
								"<td align=\"left\"><input name=\"golfer$counter\" type=\"hidden\" id=\"golfer$counter\" value=\"$golferID\" />".
			
								"<input name=\"golfername$counter\" type=\"hidden\" id=\"golfername$counter\" value=\"$firstname $lastname\" />".
			
								"$firstname $lastname</td>".
			
			    	 	   		"<td align=\"left\"><input name=\"stable$counter\" type=\"insert\" id=\"stable$counter\" size=\"5\" maxlength=\"2\" /></td>".
			
								"<td align=\"left\"><input name=\"hcap$counter\" type=\"insert\" id=\"hcap$counter\" size=\"5\" maxlength=\"5\" value=\"+0.2\" /></td>".
			
								"<td align=\"left\"><input name=\"position$counter\" type=\"insert\" id=\"position$counter\" size=\"5\" maxlength=\"2\" /></td>".
			
								"<td align=\"left\"><input name=\"points$counter\" type=\"insert\" id=\"points$counter\" size=\"5\" maxlength=\"2\" /></td>".
			
			    	 		"</tr>";
			
			
			
							
			
					$counter++;
			
					$rowid++;
			
					} //end if
			
				} //end while
			
			
			
				echo 	"<tr>" .
			
							"<td align=\"left\">Submit</td>".
			
							"<td colspan=\"5\" align=\"left\"><input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Submit\" /></td>".
			
						"</tr>";				
			
				echo "<input name=\"total\" type=\"hidden\" id=\"total\" value=\"$counter\" />";
			
				echo "</form>";
				
				echo "</table>";	
				
				} //end else	

	
	    // } //end elseif
	
	
	


	?>

    </div>

    

    <p> 

      



</p>

    <!-- InstanceEndEditable --></div>







  </div> <!-- End Div middle -->


  </div> <!-- End Div main -->




<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>

  | <a href="/admin.php">Site Admin</a>
  
</div>

  </div>


</body>



<!-- InstanceEnd --></html>