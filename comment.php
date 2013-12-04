<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
?>

<?php 
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name 
$tbl_name1="comments"; 
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$uid=$_SESSION[uid];
$comment=$_GET['comment'];
$qid=$_GET['qcode'];
//echo "$qid";
//echo "eeeeeeeeeeee";
$sql1="INSERT INTO comments(quescode,team_id,comment) VALUES ('$qid','$uid','$comment')";
$result=mysql_query($sql1);
$sql="SELECT * FROM comments where quescode='$qid' and team_id='$uid' and comment='$comment'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
  while($info = mysql_fetch_array( $result)) 
  { 
  echo " team:".$info['team_id'];
  echo "<br/>"; 
  echo $info['comment'];
  echo"<br/>"; 
  } 
  //echo $res; 
  mysql_close($con);
?>
