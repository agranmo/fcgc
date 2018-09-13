

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

      <div align="center"><p>Leaderboard</p></div>

    </div>

   	<script language="javascript" type="text/javascript">

    function viewSeason(seasonID) {

    if (seasonID != '') {

            window.location.href = 'leaderboard.php?seasonID=' + seasonID;

        } 

    }



    </script>



	<div id="square">

	<?php

	include 'library/config.php';

	include 'library/opendb.php';

	



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

		

			

		//leaderboard start	

		// $sql = "SELECT firstname, lastname, AVG(stablescore) AS stable, AVG(position), SUM(points) AS totalp, resultstab.golferID, COUNT(resultstab.golferID) AS rounds ".

		//	   "FROM resultstab LEFT JOIN golfertab ON resultstab.golferID = golfertab.golferID ".

		//	   "WHERE season=$seasonID ".

		//	   "GROUP BY resultstab.golferID ORDER BY totalp DESC, stable DESC";

		
		$sql = "SELECT firstname, lastname, AVG(stablescore) AS stable, AVG(position), SUM(points) AS totalp, resultstab.golferID, COUNT(resultstab.golferID) AS rounds ".

			   "FROM resultstab LEFT JOIN golfertab ON resultstab.golferID = golfertab.golferID ".

			   "WHERE season=$seasonID ".

			   "GROUP BY resultstab.golferID ORDER BY totalp DESC, AVG(position) ASC, stable DESC";

	   

			   // Use this SQL for leaderboard.



		$result = mysql_query($sql);	



			echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

	  		 "<tr bgcolor=\"#336699\">" .

				 "<th colspan=\"6\"><div align=\"center\" style=\"color: #FFFFFF\">The Fat Cat Race Standings</th>" .

			"</tr>" .

			"<tr bgcolor=\"#336699\">" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Position</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golfer</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Avg Stableford Score</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Avg Position</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Fat Cat Race points</th>" .

				 "<th><div align=\"center\" style=\"color: #FFFFFF\">Rounds played</th>" .

			"</tr>";

		$count=1;

		while($row = mysql_fetch_row($result))
		{
		if ($row[4]>0)

			{

				$firstname		= $row[0];

				$lastname		= $row[1];

				$stablescore	= $row[2];

				$position		= $row[3];

				$points 		= $row[4];

				$golferID 		= $row[5];

				$rounds 		= $row[6];

			

				$position = number_format($position,1);

				$stablescore = number_format($stablescore,1);

			echo "<tr bgcolor=\"#FFFFFF\">" .

					"<td><div align=\"center\" style=\"color: #336699\">$count</td>" .

					"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/players.php?ID=$golferID\">$firstname $lastname</a></td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$stablescore</td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$position</td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$points</td>" .

					"<td><div align=\"center\" style=\"color: #336699\">$rounds</td>" .

				 "</tr>";	

			$count++;
		} // endif
		} // endwhile

		

		echo "</table>";		

	?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td valign="top"><?php 

		

				//longest drive start

				$sql = 	"SELECT Firstname, Lastname, COUNT(ldtab.golferID) AS total, golfertab.golferID ".

						"FROM `ldtab` INNER JOIN golfertab ON ldtab.golferID = golfertab.golferID ".
						
						"INNER JOIN comptab ON ldtab.compID = comptab.compID ".

					   "WHERE season=$seasonID ".
		
						"GROUP BY ldtab.golferID ".

						"ORDER BY total DESC";

					   

					   // Use this SQL for leaderboard.

		

				$result = mysql_query($sql);	

		

					echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

					 "<tr bgcolor=\"#336699\">" .

						 "<th colspan=\"3\"><div align=\"center\" style=\"color: #FFFFFF\">Longest drives/Nearest in 2</th>" .

					"</tr>" .

					"<tr bgcolor=\"#336699\">" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\">Position</th>" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golfer</th>" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\"># of longest drives</th>" .

					"</tr>";

		

				$count=1;

				while($row = mysql_fetch_row($result))

					{

						$firstname		= $row[0];

						$lastname		= $row[1];

						$total	 		= $row[2];

						$golferID		= $row[3];

					

					echo "<tr bgcolor=\"#FFFFFF\">" .

							"<td><div align=\"center\" style=\"color: #336699\">$count</td>" .

							"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/players.php?ID=$golferID\">$firstname $lastname</a></td>" .

							"<td><div align=\"center\" style=\"color: #336699\">$total</td>" .

						 "</tr>";	

					$count++;

				}

		

		

				echo "</table>";		

				  

		  ?></td>

          <td valign="top"><?php 

				// nearest pin start

		

				$sql = 	"SELECT Firstname, Lastname, COUNT(nptab.golferID) AS total, golfertab.golferID ".

						"FROM `nptab` INNER JOIN golfertab ON nptab.golferID = golfertab.golferID ".
			
						"INNER JOIN comptab ON nptab.compID = comptab.compID ".

			  		   "WHERE season=$seasonID ".
			   
						"GROUP BY nptab.golferID ".

						"ORDER BY total DESC";

					   

					   // Use this SQL for leaderboard.

		

				$result = mysql_query($sql);	

		

					echo "<table width=\"100%\" border=\"1\" cellpadding=\"1\" cellspacing=\"0\" bordercolor=\"#336699\">".

					 "<tr bgcolor=\"#336699\">" .

						 "<th colspan=\"3\"><div align=\"center\" style=\"color: #FFFFFF\">Nearest to pins</th>" .

					"</tr>" .

					"<tr bgcolor=\"#336699\">" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\">Position</th>" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\">Golfer</th>" .

						 "<th><div align=\"center\" style=\"color: #FFFFFF\"># of nearest pins</th>" .
					 
			
					"</tr>";

		

				$count=1;

				while($row = mysql_fetch_row($result))

					{

						$firstname		= $row[0];

						$lastname		= $row[1];

						$total	 		= $row[2];

						$golferID		= $row[3];
						
								

					echo "<tr bgcolor=\"#FFFFFF\">" .

							"<td><div align=\"center\" style=\"color: #336699\">$count</td>" .

							"<td><div align=\"center\" style=\"color: #336699\"><a href=\"/players.php?ID=$golferID\">$firstname $lastname</a></td>" .

							"<td><div align=\"center\" style=\"color: #336699\">$total</td>" .
							
						 "</tr>";	

					$count++;

				}

		

				echo "</table>";			

		  

		  ?></td>

        </tr>

      </table>

	</div>



    <!-- InstanceEndEditable --></div>







  </div>







  </div>







<div id="footer"><a href="/profiles.php">About Us</a> | <a href="mailto:andreas@fcgc.co.uk">Contact Us</a> | <a href="#">©2010 FCGC</a>



  | <a href="/admin.php">Site Admin</a></div>



</div>



</body>



<!-- InstanceEnd --></html>

