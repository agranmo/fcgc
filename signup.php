<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$name = $_POST["name"];
$member = $_POST["member"];
$nomemeber = $_POST["nomember"];
$hcap = $_POST["hcap"];
$comp = $_POST["comp"];
$mail = $_POST["mail"];
$phone = $_POST["phone"];
$headers = 'From: ' . "$mail\r\n" .
    'Reply-To: ' . "$mail\r\n" .
    'X-Mailer: PHP/' . phpversion();
$ip = $_SERVER['REMOTE_ADDR']; 

?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/FCGC.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="verify-v1" content="0vatETAjQmrEV8XeXDaI7F3fHJnHqwjUyn5FP/BCYt0=" />
<title>The Fat Cat Golf Club</title>
<link href="/layout.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {color: #000000}
-->
</style>
</head>
<body style="background-color: #FFFFFF">
<div id="site">
  <div id="banner"><a href="/index.html">Home</a> | <a href="/profiles.html">Player Profiles </a> | <a href="/fixtures.html">Fixtures</a> | <a href="/leaderboard.html">Order of Merit </a> | <a href="/handicaps.html">Hcaps</a> | <a href="/image_gallery.html">Gallery</a> | <a href="/contact.html">Contact</a></div>
<div id="main">
  <div id="left">
    <div id="left_top"></div>
    <div id="left_middle">
      <div id="header_left"><img src="/images/headings/fat_cat_club_menu.png" width="200" height="30" /></div>
      <p class="leftbar2"><a href="/index.html">Home<br />
      </a><a href="/profiles.html">Player Profiles<br />
      </a><a href="/fixtures.html">Fixtures<br />
      </a><a href="/leaderboard.html">Order of Merit<br />
      </a><a href="/handicaps.html">Handicaps<br />
      </a><a href="/image_gallery.html">Gallery<br />
      </a><a href="/contact.html">Contact Our Club</a><br />
      <a href="/newsletter.html">Newsletter</a><br />
      <br />
        </a><b><a href="http://fcgc.co.uk/forum" target="_blank">News board/Forum</a></b></strong><br />
      </p>
      <div id="header_left"><img src="/images/headings/club_store.png" width="200" height="30" /></div>
      <p class="leftbar2"><a href="/clothes_store.html">Clothing<br />
      </a>
      <a href="/accessories_store.html">Clubs / Accessories</a></p>

      <div id="header_left"><img src="/images/headings/fat_cat_pub.png" width="200" height="30" /></div>
      <p class="leftbar2"><a href="/thepub.html">About Our Pub</a><br />
      <a href="/location.html">Location</a><br />
      </a></p>
      <div style='width: 180px; height: 150px; background-image: url( http://vortex.accuweather.com/adcbin/netweather_v2/backgrounds/spring1_180x150_bg.jpg ); background-repeat: no-repeat; background-color: #607041;' ><div style='height: 138px;' ><script src='http://netweather.accuweather.com/adcbin/netweather_v2/netweatherV2.asp?partner=netweather&tStyle=normal&logo=1&zipcode=EUR|UK|UK141|Colchester|&lang=uke&size=8&theme=spring1&metric=1&target=_self'></script></div><div style='text-align: center; font-family: arial, helvetica, verdana, sans-serif; font-size: 10px; line-height: 12px; color: #FDEA11;' ><a style='color: #FDEA11' href='http://www.accuweather.com/world-index-forecast.asp?partner=netweather&locCode=EUR|UK|UK141|Colchester|&metric=1' >Weather Forecast</a> | <a style='color: #FDEA11' href='http://www.accuweather.com/maps-satellite.asp' >Weather Maps</a></div></div>
    </div>

  </div>
  <div id="middle">

    <div id="middle_middle"><!-- InstanceBeginEditable name="Body" -->
    <div id="header"><img src="images/headings/bookings.png" /></div>

<?    
if (isset($name)) {
	
	//if (isset($name) and isset($mail) and isset($phone) and isset($comp) and isset($comp)) { 
	//		$allfields = "OK"; 
	//} else {
	//	echo "<p>Please fill in all required fields</p>";
	//}
		
	//	if ($allfields = "OK") {	
		$myFile = "bookings.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		$stringData = "$name, $ip, $hcap, $comp, $mail, $member, $nomember\n";
		fwrite($fh, $stringData);
		fclose($fh);
		// The message
		$message = "$name would like to play on $comp. His email address is $mail and his ip-addres is $ip";
		// In case any of our lines are larger than 70 characters, we should use wordwrap()
		$message = wordwrap($message, 100);
		$subject = "$name is playing $comp";
		// Send
		mail('andreas@fcgc.co.uk', $subject, $message, $headers);
		mail($mail, $subject, $message, $headers);

		$confirmation = "You have been booked to play $comp.<br /> We have recorded the following details: <br /> Name: $name <br /> Handicap: $hcap <br /> 
					Mail: $mail	<br /> Phone: $phone <br />Ip-address: $ip" ;
		echo $confirmation;
	//	}
		
} else {

?>

<script type='text/javascript'>

function isEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return true;
	}
	return false;
}

function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function isAlphabet(elem, helperMsg){
	var alphaExp = /^[a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function isAlphanumeric(elem, helperMsg){
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function lengthRestriction(elem, min, max){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		alert("Please enter between " +min+ " and " +max+ " characters");
		elem.focus();
		return false;
	}
}

function madeSelection(elem, helperMsg){
	if(elem.value == "Please Choose"){
		alert(helperMsg);
		elem.focus();
		return false;
	}else{
		return true;
	}
}

function emailValidator(elem, helperMsg){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if(elem.value.match(emailExp)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
</script>

    <form method="post" action="<?php echo $PHP_SELF;?>">
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td><div align="left">Golfers name *</div></td>
          <td><input type="text" name="name" id="name" onchange="isAlphabeth(document.getElementById('name'), 'Please Enter a Value')" /></td>
        </tr>
        <tr>
          <td><div align="left">Email address *</div></td>
          <td><input type="text" name="mail" id="mail" onchange="emailValidator(document.getElementById('mail'), 'Please Enter a valid email address')"/></td>
        </tr>
        <tr>
          <td><div align="left">Contact phone number *</div></td>
          <td><input type="text" name="phone" id="phone"  onchange="isNumeric(document.getElementById('phone'), 'Please Enter a valid phone number)"/></td>
        </tr>
        <tr>
          <td><div align="left">Are you an FCGC member?</div></td>
          <td><input type="radio" name="radio" id="member" value="member" />Yes<input name="radio" type="radio" id="nomember" value="nomember" checked="checked" />
          No</td>
        </tr>
        <tr>
          <td><div align="left">What is your handicap? *</div></td>
          <td><input name="hcap" type="text" id="hcap" size="4" maxlength="2" /></td>
        </tr>
        <tr>
          <td><label>
          <div align="left">Which competition do you want to sign up for? *</div>
          </label></td>
          <td><select name="comp" id="comp">
            <option value="December 14th @ Crettingham Golf Club">December 14th @ Crettingham Golf Club</option>
          </select></td>
        </tr>
      </table>

        <label>Send mail <input type="submit" name="Send" id="Send" value="Submit" />
        <br />
        <span style="font-weight: bold; font-style: italic">* = Required fields</span></label>
        </p>
      </form>
<?
}
?>

    <!-- InstanceEndEditable --></div>

  </div>
  <div id="right">
    <div id="right_top"></div>
    <div id="right_middle">
		<div id="headlines">
          <div id="header_right"><img src="/images/headings/latest_news.png" width="200" height="30" /></div>
		  <marquee onmouseover="this.stop()" onmouseout="this.start()" id="recent_topics" behavior="scroll" direction="up" height="200" scrolldelay="125" scrollamount="2"><p align="center"><script language="JavaScript" src="http://convert.rss-to-javascript.com/?simple_chan=1&desc=1&src=http%3A%2F%2Fnewsrss.bbc.co.uk%2Frss%2Fsportonline_uk_edition%2Fgolf%2Frss.xml&target=_blank">
        </script><noscript>Your browser does not support JavaScript. <a title='RSS-to-JavaScript.com: Free RSS to JavaScript Converter' href=http://www.rss-to-javascript.com/?p=151,381&simple_chan=1&desc=1&src=http%3A%2F%2Fnewsrss.bbc.co.uk%2Frss%2Fsportonline_uk_edition%2Fgolf%2Frss.xml&target=_blank&as_html=1>Click to read the latest news</a>.</noscript>
         <a href=http://www.rss-to-javascript.com target=_blank title='RSS-to-JavaScript.com: Free RSS to JavaScript Converter'><img src=http://www.rss-to-javascript.com/images/rss-to-jss-small.gif alt='RSS to JavaScript' border=0></a>
         </p>
         <p align="center">Order of Merit 2008 <a href="/newsletter.html">the story so far</a></p>
  		</marquee>
  <div id="advert">
    <p align="center"><a href="/index.html"><img src="/images/fcgc-advert.gif" alt="Fat Cat Golf Club!" border="0" /></a></p>
    <p align="center">Please visit our sponsor</p>
    <p><a href="http://www.sparks.org.uk/" target="_blank"><img src="/images/image_gallery/sparkslogo.jpg" width="180" height="76" border="0" /></a></p>
    <p><a href="http://www.maintenancesupply.co.uk/Welcome.html" target="_blank"><img src="/images/image_gallery/maintsupplies.jpg" width="180" height="84" border="0" /></a><br />
    </p>
    <p>&nbsp;</p>
  </div>
</div>
    </div>
     
  </div>
    <div id="bottom">&nbsp;</div>
   </div>

<div id="footer"><a href="/profiles.html">About Us</a> | <a href="/contact.html">Contact Us</a> | <a href="#">©2008 FCGC</a>
      </div>
</div>
</body>
<!-- InstanceEnd --></html>
