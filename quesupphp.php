<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
?>
<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name 
$tbl_name="problems";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$uid=$_SESSION[uid];
$submit=$_POST['submit'];
if($uid=="Admin")
{
$qcode=$_POST['qcode'];
$title=$_POST['title'];
$topic=$_POST['topic'];
$credits=$_POST['credits'];
$question=$_POST['question'];

$infile1=$_POST['infile1'];

$solfile=$_POST['solfile'];
$c1="unchecked";
$cpp1="unchecked";
$java1="unchecked";
$python1="unchecked";
$perl1="unchecked";
$php1="unchecked";
$c1=$_POST['c1'];
$cpp1=$_POST['cpp1'];
$java1=$_POST['java1'];
$perl1=$_POST['perl1'];
$php1=$_POST['php1'];
$python1=$_POST['python1'];
//$tutorial1=$_POST['tutorial'];
//echo "$infile";
//echo "<br/>";
$datetime=date("Y/m/d");
//echo "$datetime";

$sql="INSERT INTO $tbl_name(qcode,title,credits,question,in_file,solfile,datetime,topic) VALUES ('$qcode','$title','$credits','$question','$infile1','$solfile','$datetime','$topic')";
$result=mysql_query($sql);
if(!$result)
{
echo "failed";
exit;}
//$sql="SELECT title FROM $tbl_name where datetime='$datetime'";
//$result=mysql_query($sql);
//$count=mysql_num_rows($result);
//echo $count;
  //while($info = mysql_fetch_array( $result)) 
  //{ 
  //echo " questions".$info['title']; 
  //echo"<br/>"; 
  //}
  if($c1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','c')";
  $re=mysql_query($sql1);
  }
  if($cpp1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','cpp')";
  $re=mysql_query($sql1);
  }
  if($java1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','java')";
  $re=mysql_query($sql1);
  }
if($python1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','python')";
  $re=mysql_query($sql1);
  }
if($perl1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','perl')";
  $re=mysql_query($sql1);
  }
if($php1)
  {
  $sql1="insert into languages(qcode,lang) values ('$qcode','php')";
  $re=mysql_query($sql1);
  }
 if($result || $re)
{
echo "name ".$_SESSION[uid];
echo "<br/>";
echo "successful upload";
}
   
     
}
else
{
echo "permission denied ";
}
  mysql_close($con);
?>
