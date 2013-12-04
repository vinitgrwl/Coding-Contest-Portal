<?php
session_start();
?>

<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name 
$tbl_name="team"; 
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$uid=$_POST['uid'];
$pcode=$_POST['pcode'];
$sql="SELECT * FROM $tbl_name WHERE uid='$uid' AND pcode='$pcode'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
//echo $count;
if($count==1){
//header('Location:http://localhost/login_success.php');
$_SESSION['uid'] = $uid;
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=home.php\">";
//echo "<a href='home.php'>Login success</a>";
//mysql_close($con);
//header("Location:home.php");
}
else {
echo "Wrong Team name or Password ";
unset($_SESSION['uid']);
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=index.html\">";
//unset($_SESSION['uid']);
}
mysql_close($con);
?>
