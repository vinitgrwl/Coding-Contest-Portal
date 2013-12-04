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
      <a href="status.php">My Status</a>&nbsp &nbsp
	  <a href="statistics.php">Statistics</a>&nbsp  
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
	<!--<div class="mainMenu"> -->
<?php 
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name  
$tbl_name1="answers";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$uid=$_SESSION[uid];
$date=date("Y/m/d");
$sql="SELECT qcode FROM problems";
$result=mysql_query($sql);
?>
<div id="table">
<table border="1">
<tr>
<th width="170">Qcode</th>
<th width="170">Answer Status</th>
<th width="170">Count</th>
</tr>
<?php
while($info1=mysql_fetch_array($result))
{
?>
<tr>

<?php
$sql1="SELECT ans_status, COUNT( ans_status ) c FROM answers WHERE team_id='$uid' and quescode='$info1[qcode]' GROUP BY (ans_status)";
$result1=mysql_query($sql1);
if(! $result1)
echo "failed to show";
else
{
  while($info = mysql_fetch_array( $result1)) 
  { 
  ?>
  <td><?php echo "$info1[qcode]"; ?></td>
 <td><?php echo $info['ans_status']; ?></td> 
  <td><?php echo $info['c']; ?></td>
  </tr>
  <?php
  } 
}
  //echo $res; 
  echo "<br/>";
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
