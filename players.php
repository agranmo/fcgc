
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

  <div id="top"><a href="/index.php">Home</a> | <a href="/fixtures.php">Upcoming Golf Days</a> | <a href="/results.php">Results</a> | <a href="/leaderboard.php">Leaderboard</a> | <a href="/handicaps.php">Handicaps</a></div>

<div id="main">

  <div id="middle">



    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->
    <div id="header">
      <div align="centre"><p>The Players</p></div>
    </div>
    <div id="square">
    <?php
        include 'library/config.php';
        include 'library/opendb.php';
		
		if (isset($_GET['ID'])) 
		{	 
			$playerID = $_GET['ID'];
		} else {
			echo "<script>window.location.href='/index.php';</script>";
		}
		
        $query = "SELECT * FROM golfertab WHERE golferID = '$playerID'";
			$result = mysql_query($query);
    
	    while($row = mysql_fetch_row($result))
		{
			$golferID		= $row[0];
			$firstname		= $row[1];
			$lastname		= $row[2];
			$nickname		= $row[3];
			$age			= $row[4];
			$handicap		= $row[5];
			$profilethumb	= $row[6];
			$photo1			= $row[7];
			$photo2			= $row[8];
			$photo3			= $row[9];
			$favfood		= $row[10];
			$favdrink		= $row[11];
			$favgolfer		= $row[12];
			$info			= $row[13];
			$username		= $row[14];
			$password		= $row[15];
			$homeclub		= $row[16];
			$homeclublink	= $row[17];
			$email			= $row[18];
			$active			= $row[19];
			
			$sql = "SELECT hcapact FROM hcaptab WHERE golferID='$golferID' ORDER BY timeofchange DESC";
			$gethcap = mysql_query($sql);
			list ($hcapact) = mysql_fetch_row($gethcap);
			
			$hcap = round($hcapact);
			
			echo "<table style=\"vertical-align:top\" width=\"100%\" border=\"3\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#FFFFFF\">".
		  		 "<tr>" .
					 "<th><img src=\"$profilethumb\" width=\"50\" height=\"75\" /></th>" .
					 "<th>$firstname $lastname, aka $nickname</th>" .
				 "</tr>";
  	
			echo "<tr>" .
				 "<th colspan=\"2\" width=\"100%\"><div align=\"left\" style=\"color: #FFFFFF; background-color: #999999\">" .
					 "&nbsp; Golf day results</th>" .
				 "</tr>" ;
			echo "</table>";
			
			$query1 = "SELECT compname, stablescore, strokescore, position, points, comptab.season " .
					  "FROM resultstab LEFT JOIN comptab ON resultstab.compID = comptab.compID " .
					  "WHERE golferID = '$playerID' ORDER BY comptab.season DESC, resultstab.compID DESC";
			$resultstab = mysql_query($query1);

			//echo $query1;
			echo "<table width=\"100%\" border=\"3\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#FFFFFF\">";
			echo "<tr>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Golf day</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Stableford Score</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Stroke Score</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Position</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Points</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>season</b></th>" .
				 "</tr>" ;

		    while($row = mysql_fetch_row($resultstab))
			{
				$compname		= $row[0];
				$stablescore	= $row[1];
				$strokescore	= $row[2];
				$position		= $row[3];
				$points			= $row[4];
				$season			= $row[5];

				echo "<tr bgcolor=\"#FFFFFF\">" .
						"<td><div align=\"center\" style=\"color: #666633\">$compname</td>" .
						"<td><div align=\"center\" style=\"color: #666633\">$stablescore</td>" .
						"<td><div align=\"center\" style=\"color: #666633\">$strokescore</td>" .
						"<td><div align=\"center\" style=\"color: #666633\">$position</td>" .
						"<td><div align=\"center\" style=\"color: #666633\">$points</td>" .
						"<td><div align=\"center\" style=\"color: #666633\">$season</td>" .
					"</tr>";
			}
			
			$sql = "SELECT AVG(stablescore), AVG(strokescore), AVG(position), SUM(points), season FROM ".
			       "resultstab WHERE golferID = '$playerID' ".
				   "GROUP BY golferID, season ORDER BY COUNT(points) DESC" ;
		
	
			$totals = mysql_query($sql);
			
			list($avgstable, $avgstroke, $avgposition, $sumpoints, $season) = mysql_fetch_row($totals);
			
			$avgstable = round($avgstable, 1);
			$avgstroke = round($avgstroke, 1);
			$avgposition = round($avgposition);
			
			echo "<tr bgcolor=\"#FFFFFF\">" .
					"<td><div align=\"center\" style=\"color: #666633\"><b>Averages and Total points</b></td>" .
					"<td><div align=\"center\" style=\"color: #666633\"><b>$avgstable</b></td>" .
					"<td><div align=\"center\" style=\"color: #666633\"><b>$avgstroke</b></td>" .
					"<td><div align=\"center\" style=\"color: #666633\"><b>$avgposition</b></td>" .
					"<td><div align=\"center\" style=\"color: #666633\"><b>$sumpoints</b></td>" .
	 				"<td><div align=\"center\" style=\"color: #666633\"><b> </b></td>" .
	   			"</tr>";
  				  
			echo "</table>";
		
			echo "<table width=\"100%\" border=\"3\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#FFFFFF\">";
			echo "<tr>" .
				 "<th colspan=\"4\" width=\"100%\"><div align=\"left\" style=\"color: #FFFFFF; background-color: #999999\">" .
					 "&nbsp; Handicap record</th>" .
				 "</tr>" ;

			echo "<tr>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Golf day</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Handicap Change</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>New Handicap</b></th>" .
					 "<th><div align=\"center\" style=\"color: #666633; background-color: #FFFFFF\"><b>Playing Handicap</b></th>" .
				 "</tr>" ;

			$sql = "SELECT compname, hcapchange, hcapact FROM hcaptab RIGHT JOIN comptab ".
				    "ON comptab.compID = hcaptab.compID WHERE golferID = '$golferID' ORDER BY timeofchange";
			$hcaprec = mysql_query($sql);
			
			while($row = mysql_fetch_row($hcaprec))
			{
				$compname		= $row[0];
				$hcapchange		= $row[1];
				$hcapact		= $row[2];
				
				$hcap = round($hcapact);

				echo "<tr bgcolor=\"#FFFFFF\">" .
					"<td><div align=\"center\" style=\"color: #666633\">$compname</td>" .
					"<td><div align=\"center\" style=\"color: #666633\">$hcapchange</td>" .
					"<td><div align=\"center\" style=\"color: #666633\">$hcapact</td>" .
					"<td><div align=\"center\" style=\"color: #666633\">$hcap</td>" .
					"</tr>";

			}
		
		} 
		
		echo "</table>";

	    echo "<img src=\"creategraph.php?ID=$golferID\" />";
		
        include 'library/closedb.php';
    ?>

    </div>

    <!-- InstanceEndEditable --></div>



  </div>



  </div>



<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>

  | <a href="/admin.php">Site Admin</a></div>



</body>

<!-- InstanceEnd --></html>
