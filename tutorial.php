<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
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
	  <a href="index.html">Home</a>&nbsp &nbsp &nbsp 
	  <a href="query1.php">Previous Questions</a>&nbsp &nbsp &nbsp 
	  <a href="tutorialmain.php">Tutorials</a> &nbsp &nbsp &nbsp 
	  <a href="contact_us.php">Contact us</a>&nbsp &nbsp
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
<?php 
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name 
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
//echo $count;
$topic=$_GET['topic'];
  $sql="SELECT * FROM tutorial where topic='$topic'";
  $result=mysql_query($sql);
  $count=mysql_num_rows($result);
  if($count==0)
  echo "Sorry!!No tutorial available.";
  else
  {
  while($info = mysql_fetch_array($result)) 
  { 
  echo "<b> Topic: </b>".$info['topic'];
  echo "<br/>"; 
  ?>
  <table border="1">
  <tr>
  <td><?php echo $info['file']; ?></td>
  </tr>
  <?php
  }
  }
  mysql_close($con);
?>
</table>
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
