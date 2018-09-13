

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

      <div align="center">
		  <p>Upcoming Golf Days</p></div>

    </div>

    <div id="square">

	 <?php

        include 'library/config.php';

        include 'library/opendb.php';

        

        $query = "SELECT * FROM comptab ORDER BY compdate";

		$result = mysql_query($query);

   

		echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

	  		 "<tr bgcolor=\"#336699\">" .

				 "<th width=\"15%\"><div align=\"center\" style=\"color: #FFFFFF\">Date/Time</th>" .

				 "<th colspan=\"2\"><div align=\"center\" style=\"color: #FFFFFF\">Golf club</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Description</th>" .

				 "<th width=\"15%\><div align=\"center\" style=\"color: #FFFFFF\">Sign Up!</th>" .

			"</tr>";

  	

	    while($row = mysql_fetch_row($result))

		{

			unset($price2);

			unset($prizes);

			

			$compID		= $row[0];

			$compname	= $row[1];

			$compdate	= $row[2];

			$comptime	= $row[3];

			$location	= $row[4];

			$clubname	= $row[5];

			$clublink	= $row[6];

			$compinfo	= $row[7];

			$price		= $row[8];

			$price2		= $row[9];

			$host		= $row[10];

			$clubphoto	= $row[11];

			

			$date = date('D j M', strtotime($compdate)); //changes date format

			$time = date('g:ia', strtotime($comptime)); //changes time format

			

			$realdate = date('ymd', strtotime($compdate));

			$today = date('ymd');

			

			if ($realdate > $today) {	

					//echo "$date is larger than $today";

					

			$gethost = "SELECT firstname, lastname FROM golfertab WHERE golferID = $host";

			$hostfullname = mysql_query($gethost);

			

			list($firstname, $lastname)= mysql_fetch_row($hostfullname); //gets name of host from golfertab

			$prizes = "";

			

			if (isset($price2)) {

						$prizes = "and £$price2 for prizes";

					}

			

			echo "<tr bgcolor=\"#FFFFFF\">" .

				"<td width=\"15%\"><div align=\"center\" style=\"color: #336699\">$date $time</td>" .

				"<td><div align=\"center\" style=\"color: #336699\"><a href=\"$clublink\" target=\"_blank\">" .

				"<img src=\"$clubphoto\" border=\"0\" width=\"65\" /></a></td>" .

				"<td><div align=\"center\" style=\"color: #336699\"><a href=\"$clublink\" target=\"_blank\">" .

				" $clubname<br>$location<br></a></td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$compname hosted by $firstname $lastname ".

					"<b>£$price $prizes</b><br>" .

					"$compinfo</td>" .

				"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/signup_new.php?ID=$compID&member=1\">Sign up<td>" .

				"</tr>";

			} //Check if the event is in the future

		} 

		

		echo "</table>";		

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

