
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

  </div>

  <div id="top"><a href="/index.php">Home</a> | <a href="/fixtures.php">Upcoming Golf Days</a> | <a href="/results.php">Results</a> | <a href="/leaderboard.php">The Fat Cat Race</a> | <a href="/handicaps.php">Handicaps</a> | <a href="http://gallery.fcgc.co.uk" target="_blank">Photo Gallery</a></div>

<div id="main">

  <div id="middle">



    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->
    <div id="header">

      <div align="center"><p>Golf Day Signup</p></div>

      </div>
		<script language="javascript" type="text/javascript">
        function viewComp(compID) {
        if (compID != '') {
                window.location.href = 'signup_new.php?ID=' + compID;
            } 
        }
    
        function viewMember(compID,mem) {
                window.location.href = 'signup_new.php?ID=' + compID + '&member=' + mem;
        }
    
        function showHide(elem)
        {
          if (document.getElementById(elem).style.display == 'none')
          { document.getElementById(elem).style.display = 'block' }
          else
          { document.getElementById(elem).style.display = 'none' }
        }
    
        </script>
    
    <?php
    include 'library/config.php';
    include 'library/opendb.php';
  
	if (isset($_GET['ID'])) 
	{ 
		$compID = $_GET['ID'];
	} else {
		echo "<script>window.location.href='/index.php';</script>";
	}
	

	if (isset($_GET['member'])) 
	{ 
		$member = $_GET['member'];
	}
   
       if(isset($_POST['signup']))
	   {	
		// Get post information
		$pfname = $_POST["firstname"];
		$plname = $_POST["lastname"];
		$phcap = $_POST["handicap"];
		$pcomp = $_POST["comp"];
		$pmail = $_POST["email"];
		$pphone = $_POST["phone"];
		$pclub = $_POST["homeclub"];
		$headers = 'From: ' . "$pmail\r\n" .
			'Reply-To: ' . "$pmail\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$ip = $_SERVER['REMOTE_ADDR']; 
		
			
			$selected_radio = $_POST["Member"];
			
			//echo  "this shows that member has been selected $selected_radio";
			
			if ($selected_radio == 'Yes') {
			$member_status = 'checked';
			}
			else if ($selected_radio == 'No') {
			$member_status = 'unchecked';
			}


			if ($member_status == 'checked') {
				if ($_POST['password'] == 'dave') {
					$golferID = $_POST["cboGolfer"];
					//echo "GolferID: $golferID";
					
					$getgolfer = "SELECT firstname, lastname, email, handicap, homeclub FROM golfertab WHERE golferID = $golferID";
					$golfer = mysql_query($getgolfer);	
					
					while($row = mysql_fetch_row($golfer))
					{
					$pfname		= $row[0];
					$plname 	= $row[1];
					$pmail		= $row[2];
					$phcap		= $row[3];
					$pclub		= $row[4];
					$phcap		= round($phcap);
				
					if(!$pclub){
						$pclub = "None";
						}	
					if(!$pmail){
						$pmail = "Not registered";
						}	
					$pphone	= "Not Registered";
					
					$regcheck = "SELECT firstname FROM signuptab WHERE golferID = $golferID AND compID = $compID";
					$checkquery = mysql_query($regcheck);
							
					list($namecheck) = mysql_fetch_row($checkquery);
					
					if (!$namecheck) {
											
						$query = "INSERT INTO signuptab (compID, golferID, phone, email, firstname, lastname, handicap, homeclub, ipaddress) ".
								 "VALUES ('$compID','$golferID','$pphone','$pmail','$pfname','$plname','$phcap','$pclub','$ip')";
						//echo $query;
						mysql_query($query) or die('Error, insert query failed');
						
						} else {
						echo "<b>You are already signed up to play this event! </b></br></br>";
					}
					
					echo "<a href=\"/signup_new.php?ID=$compID&member=1\">Click here to sign up another golfer</a>";
					}
				} else {
					$errMsg = "Wrong Id/Password";
					echo $errMsg;
				}		
			}
			else
			{

			$regcheck = "SELECT firstname FROM signuptab WHERE ipaddress = '$ip' AND compID = $compID";
			$checkquery = mysql_query($regcheck);
					
			list($namecheck)= mysql_fetch_row($checkquery);
			
			if (!$namecheck) {
								
					$query = "INSERT INTO signuptab (compID, phone, email, firstname, lastname, handicap, homeclub, ipaddress) ".
							 "VALUES ('$compID','$pphone','$pmail','$pfname','$plname','$phcap','$pclub','$ip')";
					//echo $query;
					
					mysql_query($query) or die('Error, insert query failed');			
							
					// The message
					$message = "$pfname $plname would like to play $pcomp. His email address is $pmail and his ip-addres is $ip. Phone: $pphone";
					// In case any of our lines are larger than 70 characters, we should use wordwrap()
					$message = wordwrap($message, 100);
					$subject = "$pfname $plname is playing $pcomp";
					// Send
					mail('andreas@fcgc.co.uk', $subject, $message, $headers);
					//mail($mail, $subject, $message, $headers);
			
					$confirmation = "You have been booked to play $pcomp.<br /> We have recorded the following details: <br /> Name: $pfname $plname " .
								"Handicap: $phcap <br /> Mail: $pmail	Phone: $pphone Ip-address: $ip" ;
					echo $confirmation;
				} else {
					echo "You have already signed up a golfer from this IP address,</br> you are not allowed to sign	up more than one non-member golfer";			
				}	
				
			}

		} 
		else 
		{
		
		$getcomp = "SELECT compname, compdate, comptime, closed FROM comptab WHERE compID = $compID";
		$compname = mysql_query($getcomp);
		
		list($compname, $compdate, $comptime, $closed)= mysql_fetch_row($compname); //gets competition name from comptab
		$date = date('D jS F Y', strtotime($compdate)); //changes date format
		$time = date('h:iA', strtotime($comptime)); //changes time format
		
		if ($closed == 1) {
			echo "Signup for this competition is closed. Please contact Andreas on andreas.granmo@fcgc.co.uk for availability.";
		} else
		{
				
				// get competition list
				$sql = "SELECT compID, compname, compdate
						FROM comptab
						ORDER BY compdate";
				$result = mysql_query($sql);                    
		
				$today = date('ymd');
				$compList = '';
	
				while ($row = mysql_fetch_assoc($result)) 
				{
				$realdate = date('ymd', strtotime($row['compdate']));
				if ($realdate > $today) {	
						//echo "$date is larger than $today";
			
							$compList .= '<option value="' . $row['compID'] . '"' ;
							if ($row['compID'] == $compID) {
								$compList .= ' selected';
							}
						
							$compList .= '>' . $row['compname'] . '</option>';	
					}
				}
				?>
			
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">
				<tr> 
					<td align="right">Competition : 
						<select name="cboComp" id="cboComp" onChange="viewComp(this.value)">
						  <?php echo $compList; ?> 
					  </select>
					</td>
				</tr>
			</table>
	
			
	  <div id="square">
			<form id="comps" name="comps" method="post" action="<?php echo "$PHP_SELF?ID=$compID";?>">
			<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
				<tr> 
					<th colspan="2" align="center">Signup for <?php echo "$compname at $time on $date";?></th>
				</tr>
				<?php if ($member == 1) {
				$sql = "SELECT golferID, firstname, lastname, handicap, homeclub, active
						FROM golfertab
						ORDER BY firstname";
				$golfresult = mysql_query($sql);                    
		
				echo "<tr> " .
					"<td align=\"left\">Are you a FCGC member</td>" .
					"<td align=\"left\">" .
						  "<label>" .
						   " <input type=\"radio\" name=\"Member\" value=\"Yes\" id=\"Member_0\" " .
						   " onclick=\"viewMember($compID,'1')\" checked=\"checked\" /> " .
						   " Yes</label> " .
						   "<label>" .
							"<input type=\"radio\" name=\"Member\" value=\"No\" id=\"Member_1\" ".
							"onclick=\"viewMember($compID,'0')\" />" .
							"No</label></td>" .
				"</tr>";
				
				echo "<tr> " .
					"<td align=\"left\">Select FCGC member</td>" .
					"<td align=\"left\">";
				
					$golferList = '';
					while ($row = mysql_fetch_assoc($golfresult)) {
					if ($row['active'] == '1') {
						$golferList .= '<option value="' . $row['golferID'] . '"' ;
						if ($row['golferID'] == $golferID) {
							$compList .= ' selected';
						}
					}			
					$golferList .= '>' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';	
				}
		
				echo "<select name=\"cboGolfer\" id=\"cboGolfer\"> " .
					 "$golferList" . 
					"</select>";
							
				echo "</td></tr>";
		
				echo "<tr> " .
					"<td align=\"left\">Sign up password</td>" .
					"<td align=\"left\">" .
						   " <input name=\"password\" type=\"password\" name=\"password\" size=\"50\" maxlength=\"50\" />" .
					"</tr>";
		
				} else {
				echo "<tr> " .
					"<td align=\"left\">Are you a FCGC member</td>" .
					"<td align=\"left\">" .
						  "<label>" .
						   " <input type=\"radio\" name=\"Member\" value=\"Yes\" id=\"Member_0\" " .
						   " onclick=\"viewMember($compID,'1')\" /> " .
						   " Yes</label> " .
						   "<label>" .
							"<input type=\"radio\" name=\"Member\" value=\"No\" id=\"Member_1\" ".
							"onclick=\"viewMember($compID,'0')\" checked=\"checked\" />" .
							"No</label></td>" .
				"</tr>";
				?>
				<tr> 
					<td align="left">Firstname</td>
					<td align="left">
					  <input name="firstname" type="text" id="firstname" size="50" maxlength="50" />
					</td>
				</tr>
				<tr> 
					<td align="left">Lastname</td>
					<td align="left"><input name="lastname" type="text" id="lastname" size="50" maxlength="50" /></td>
				</tr>
				<tr> 
					<td align="left">Contact number</td>
					<td align="left"><input name="phone" type="text" id="phone" size="20" maxlength="20" /></td>
				</tr>
				<tr> 
					<td align="left">Email address</td>
					<td align="left"><input name="email" type="text" id="email" size="50" maxlength="50" /></td>
				</tr>
				<tr> 
					<td align="left">Handicap</td>
					<td align="left"><input name="handicap" type="text" id="handicap" size="4" maxlength="4" /></td>
				</tr>
				<tr> 
					<td align="left">Home golf club</td>
					<td align="left"><input name="homeclub" type="text" id="homeclub" size="50" maxlength="50" /></td>
				</tr>
			 <?php
			 }
			 ?>
				<tr> 
					<td align="left">Sign up!</td>
					<td align="left"><input type="submit" name="signup" id="signup" value="Sign Up!" /></td>
				</tr>
			 </table>
			 </form>		
			 </div>


		<?php
		}
		} //endif inital insert 
		      
        $query = "SELECT firstname, lastname, homeclub, handicap, hcapID, hcapact FROM hcaptab ".
				 "INNER JOIN (SELECT MAX(hcapID) AS id FROM hcaptab GROUP BY golferID) ids ON hcapID = id ".
				 "RIGHT JOIN signuptab ON signuptab.golferID = hcaptab.golferID WHERE signuptab.compID = '$compID' ".
				 "ORDER BY lastname";
		$result_signup = mysql_query($query);

		$getnumbers = "SELECT COUNT(*) FROM signuptab WHERE compID = '$compID'";
		$numberof = mysql_query($getnumbers);
		$numbers = mysql_result($numberof,0);
	
	//	$getnumbers = $conn->prepare("SELECT COUNT(*) FROM signuptab WHERE compID = $compID='1'");
	//	$getnumbers->bind_param('s', $numbers);
	//	$getnumbers->execute();  

	//	list ($numberof) = $getnumbers->get_result($numbers);		
		
		echo "<p>";
		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">".
	  		 "<tr>" .
				 "<th colspan=\"3\"><div align=\"center\">$numbers players have signed up to play @ $compname so far</th>" .
			"</tr>" .
			"<tr>" .
				 "<th><div align=\"center\">Golfer</th>" .
				 "<th><div align=\"center\">Handicap</th>" .
				 "<th><div align=\"center\">Home Club</th>" .
			"</tr>";
			
			
		while($row = mysql_fetch_row($result_signup))
		{
			$firstname	= $row[0];
			$lastname	= $row[1];		
			$homeclub	= $row[2];
			$handicap	= $row[3];
			$hcapID 	= $row[4];
			$hcapact 	= $row[5];			
			
			if (!$hcapact) {
				$handicap = round($handicap);	
			} else {
				$handicap = round($hcapact);
			}
		
			if(!$homeclub){
				$homeclub = "None";
				}
			
			echo "<tr>" .
				"<td><div align=\"center\">$firstname $lastname</td>" .
				"<td><div align=\"center\">$handicap</td>" .
				"<td><div align=\"center\">$homeclub</td>" .
				"</tr>";
		}
		echo "</table>";
	?>

	<p>&nbsp;</p>

    <!-- InstanceEndEditable --></div>



  </div>

  </div>



<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>

  | <a href="/admin.php">Site Admin</a></div>

</div>

</body>

<!-- InstanceEnd --></html>
