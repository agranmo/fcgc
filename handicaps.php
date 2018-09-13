

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

      <div align="center"><p>Handicaps</p></div>

    </div>

    <div id="square">

    <?php

        include 'library/config.php';

        include 'library/opendb.php';

        

        $query = "SELECT hcapID, hcaptab.golferID, firstname, lastname, hcapchange, hcapact, active FROM hcaptab ".

				  "INNER JOIN (SELECT MAX(hcapID) AS id FROM hcaptab GROUP BY golferID) ids ON hcapID = id ".

				  "LEFT JOIN golfertab ON hcaptab.golferID = golfertab.golferID WHERE active = 1 ORDER BY firstname";

		$result = mysql_query($query);

    

		echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

	  		 "<tr bgcolor=\"#336699\">" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golfers name</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Last Change</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Actual Handicap</th>" .

 				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Playing Handicap</th>" .

			"</tr>";

  	

	    while($row = mysql_fetch_row($result))
	    
	    if ($row[6]=1) { //check if active

		{

			$hcapID			= $row[0];

			$golferID		= $row[1];

			$firstname		= $row[2];			

			$lastname		= $row[3];

			$hcapchange		= $row[4];

			$hcapact		= $row[5];
			

			

			

			$playinghcap	= round($hcapact);

		

			echo "<tr bgcolor=\"#FFFFFF\">" .

				"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/players.php?ID=$golferID\"><b>$firstname $lastname &nbsp;</b></a></td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$hcapchange<br></td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$hcapact<br></td>" .

				"<td><div align=\"center\" style=\"color: #336699\">$playinghcap<br></td>" .

				"</tr>";
				
			} // end if

		} // end while

		

		echo "</table>";

		

        include 'library/closedb.php';

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

