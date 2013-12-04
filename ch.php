<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
?>

<?php 
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="test"; // Database name 
$tbl_name1="question"; 
$tbl_name2="answer";
$tbl_name3="login";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$userid=$_SESSION[email];
$quest=$_GET['quest'];
$qid=$_GET['qid'];
$answ=$_GET['answ'];
$datetime1=date("d/m/y h:i:s");
if($quest != '')
{$sql1="INSERT INTO question(user_id,ques,datetime) VALUES ('$userid','$quest','$datetime1')";
$result=mysql_query($sql1);
}
if($answ != '')
{$sql2="INSERT INTO answer(user_id,ques_id,ans,datetime) VALUES ( '$userid','$qid','$answ','$datetime1')";
$result=mysql_query($sql2);
}
echo "name ".$_SESSION[email];
echo "<br/>";
$sql="SELECT * FROM question";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
//echo $count;
for ($i=$count; $i>=1; $i--)
  {
  $print1="SELECT * FROM $tbl_name1 where ques_id=$i";
  $re=mysql_query($print1);
  while($info = mysql_fetch_array( $re)) 
  { 
  echo " ques id:".$info['ques_id']; 
  echo " question:".$info['ques'];
  echo"<br/>"; 
  } 
  $print2="SELECT * FROM $tbl_name2 where ques_id=$i";
  $res=mysql_query($print2);
  while($info = mysql_fetch_array( $res)) 
  { 
  //echo " Name:".$info['user_id']; 
  echo " ques id:".$info['ques_id']; 
  echo " answer:".$info['ans'];
  echo "<br/>"; 
  } 
  //echo $res; 
  }
  mysql_close($con);
?>
