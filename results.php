

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/FCGC - New.dwt" codeOutsideHTMLIsLocked="false" -->



<head>







  <style type="text/css">

    @import url("http://www.google.com/uds/solutions/dynamicfeed/gfdynamicfeedcontrol.css");

  </style>







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



  <div id="top"><a href="/index.php">Home</a> | <a href="/fixtures.php">Upcoming Golf Days</a> | <a href="/results.php">Results</a> | <a href="/leaderboard.php">Leaderboard</a> | <a href="/handicaps.php">Handicaps</a> | <a href="http://gallery.fcgc.co.uk" target="_blank">Photo Gallery</a></div>



<div id="main">



  <div id="middle">







    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->

    <div id="header">

      <div align="center"><p>Results</p></div>

    </div>

   	<script language="javascript" type="text/javascript">

    function viewSeason(seasonID) {

    if (seasonID != '') {

            window.location.href = 'results.php?seasonID=' + seasonID;

        } 

    }



    </script>



    

    <div id="square">

    <?php

	include 'library/config.php';

	include 'library/opendb.php';

	//require_once 'imagegallery/library/functions.php';

	//checkLogin();

	

		if (empty($seasonID)) {

			$seasonID = "2018";

		}

	

	 	$sql = "SELECT season FROM resultstab GROUP BY season ORDER BY season";

		$result = mysql_query($sql);                    



		$seasonList = '';

		while ($row = mysql_fetch_assoc($result)) {

			$seasonList .= '<option value="' . $row['season'] . '"' ;

			if ($row['season'] == $seasonID) {

				$seasonList .= ' selected';

			}

			

			$seasonList .= '>' . $row['season'] . '</option>';	

		}



?>

    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1">

    	<tr> 

        	<td><div id="square" align="right"><span style="font-weight: bold"><span style="font-size: 14px">Select season</span></span>

        	  <select name="cboSeason" id="cboSeason" onChange="viewSeason(this.value)">

        	    <?php echo $seasonList; ?> 

      	      </select>

      	  </div></td>

    	</tr>

    </table>

<?php

			

    if (isset($_GET['compID'])) 

    {	 

        $compID = $_GET['compID'];

    

		$sql = "SELECT compname, compdate FROM comptab WHERE compID = '$compID'";

		$getcomp = mysql_query($sql);

		list ($compname, $compdate) = mysql_fetch_row($getcomp); 

		$date = date('jS F Y', strtotime($compdate)); //changes date format

		

		// $query = "SELECT golfertab.golferID, firstname, lastname, stablescore, position, points FROM resultstab LEFT JOIN golfertab ".
		//			 "ON resultstab.golferID = golfertab.golferID WHERE compID = '$compID' ORDER BY position";
				 
		$query = 	"SELECT G.golferID, G.firstname, G.lastname, R.stablescore, R.position, R.points, H.hcapchange, H.hcapact ".
					"FROM resultstab AS R ".
					"LEFT JOIN golfertab AS G ON R.golferID = G.golferID ".
					"LEFT JOIN hcaptab AS H ON (R.golferID = H.golferID AND R.compID = H.compID) ".
					"WHERE R.compID = '$compID' ".
					"ORDER BY position";

		$result = mysql_query($query);	

		

		echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

	  		 "<tr bgcolor=\"#336699\">" .

				 "<th colspan=\"6\"><div align=\"center\" style=\"color: #FFFFFF\">Results for $compname on $date</th>" .

			"</tr>" .

			"<tr bgcolor=\"#336699\">" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Position</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golfer</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Stableford Score</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Order or merit Points</th>" .
				 
				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Handicap Change</th>" .
				 
				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Actual Handicap</th>" .			

			"</tr>";

		

		while($row = mysql_fetch_row($result))

			{

				$golferID		= $row[0];

				$firstname		= $row[1];

				$lastname		= $row[2];

				$stablescore	= $row[3];

				$position		= $row[4];

				$points 		= $row[5];

				$hcapchange		= $row[6];
				
				$hcapact 		= $row[7];
			

			echo "<tr bgcolor=\"#FFFFFF\">" .

					"<td><div align=\"center\" style=\"color: #336699\">$position</td>" .
					
					"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/players.php?ID=$golferID\">$firstname $lastname</a></td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$stablescore</td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$points</td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$hcapchange</td>" .
					
					"<td><div align=\"center\" style=\"color: #336699\">$hcapact</td>" .

				 "</tr>";	

		}

		

		echo "</table>";		



		

    } else {

		if (isset($_GET['seasonID'])) {

			$seasonID = $_GET['seasonID'];

			} else {

			$seasonID = "2018";

			}



		$query = "SELECT compID, compdate, compname, clubname, firstname, lastname, season FROM comptab LEFT JOIN golfertab ".
				 "ON comptab.host = golfertab.golferID WHERE season = $seasonID ORDER BY compdate";
		

		$result = mysql_query($query);

		

		echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

	  		 "<tr bgcolor=\"#336699\">" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Date</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golf club</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Description</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Results?</th>" .

			"</tr>";



		while($row = mysql_fetch_row($result))

		{

			$compID		= $row[0];

			$compdate	= $row[1];

			$compname	= $row[2];

			$clubname	= $row[3];

			$firstname	= $row[4];

			$lastname	= $row[5];

		

			$date = date('jS F Y', strtotime($compdate)); //changes date format

			$realdate = date('ymd', strtotime($compdate));

			$today = date('ymd');

			

			if ($realdate <= $today) {

				$played = "<a href=\"/results.php?compID=$compID\"><img border=\"0\" src=\"/images/golfball.png\" /></a>";

			} else {

				$played = "No";

			}



			echo "<tr bgcolor=\"#FFFFFF\">" .

				"<td><div align=\"center\" style=\"color: #336699\">$date</td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$clubname</td>" .

				"<td><div align=\"center\" style=\"color: #336699\"><b>$compname</b> hosted by $firstname $lastname</td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$played</td>" .

				"</tr>";

		}

		

		echo "</table>";

    } //end if



	?>

    </div>

	<p><a href="/results.php">Click here to see results from other golf days<br /><br /></a></p>

    <!-- InstanceEndEditable --></div>







  </div>







  </div>







<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>



  | <a href="/admin.php">Site Admin</a></div>



</div>



</body>



<!-- InstanceEnd --></html>

