<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LNMIIT</title>
<link href="style1.css" rel="stylesheet" type="text/css" /><!--[if IE 5]-->
</head>
<body>
<!-- begin #container -->
<div id="container">
	<!-- begin #header -->
    <div id="header">
	<div id="hpic"><input type="image" src="images/LNMIIT-logo.jpg" alt="" width="150" height="82" align="left" align="top" margin-left=5px" /></div>
	<h1>LNMIIT CODING CONTEST</h1>
		<div class="headerTop"> 
</div>
       <div class="mainMenu">
	    <a href="home.php">Problems</a>&nbsp &nbsp
	  <a href="submit.php">Submit</a>&nbsp &nbsp
	  <a href="statistics.php">Statistics</a>&nbsp &nbsp 
      <a href="status.php">My Status</a>&nbsp &nbsp 
	  <a href="score.php">Score</a>&nbsp 
	   </div>
	   
       <div id="logout">
       <?php
       echo $_SESSION['uid'];?>
       <a href="logout.php">(log-out)</a>
       </div>
      
        <div class="headerPic">
		<a>Time</a>
	   <body onLoad="show_clock()" >
	   <script language="javascript" src="liveclock.js">
</script>
        </div>
		
    </div>
    <!-- end #header -->
	<div id="mainContent">

<form method="post" action="quesupphp.php">
write the question code
<input type="text" name="qcode" size=20 maxlength=20/>
<br/>
<br/>
write question title here 
<input type"text" name="title" size=20 maxlength=20/>
<br/>
<br/>
topic
<input type="text" name="topic" size=20 maxlength=20/>
<br/>
<br/>
write question credits here 
<input type"text" name="credits" size=20 maxlength=20/>
<br/>
<br/>
write question here
<textarea rows="5" cols="80" wrap="physical" name="question">
</textarea>
<br/>
<br/>
write infile here
<textarea rows="5" cols="80" wrap="physical" name="infile1">
</textarea>
<br/>
<br/>
write sol file here
<textarea rows="5" cols="80" wrap="physical" name="solfile">
</textarea>
<br/>
<br/>
languages<br/>
<input type="checkbox"name="c1" value="qcode"> c<br/>
<input type="checkbox"name="cpp1" value="datetime"> cpp<br/>
<input type="checkbox"name="java1" value="topic"> java<br/>
<input type="checkbox"name="python1" value="credit"> python<br/>
<input type="checkbox"name="perl1" value="accepted"> perl<br/>
<input type="checkbox"name="php1" value="lang"> php<br/>



<input type="submit"  name="upload" value="upload"/>
</form>
</div>
<br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
   	  <p>
        	Copyright &copy; 2012. Designed by <br />
            <a class="footerLink"><abbr title="eXtensible HyperText Markup Language">Tanya</abbr></a>|
      <a class="footerLink"><abbrev>Rashi</abbrev></a> | <a class="footerLink"><abbrev>Vinit</abbrev></a></p>
        <div style="text-align:center;"></div> 
    </div>
    <!-- end #footer -->
</div>
<!-- end #container -->

