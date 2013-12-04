<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
?>

<?php
$host="localhost";
$username="root";
$password="";
$db_name="codechef";
$tbl1_name="problems";
$tbl2_name="answers";
$tbl3_name="languages";
$con=mysql_connect("$host","$username","$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
$topic=$_POST['topic'];
$tutorial1=$_POST['tutorial1'];
$sql="insert into tutorial(topic,file)values('$topic','$tutorial1')";
$result=mysql_query($sql);
if($result)
echo "succesful";
else
echo "could not write";
mysql_close($con);
?>
