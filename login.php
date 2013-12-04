<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<html>
<body>
<?php
include ("main.php");
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="codechef"; // Database name 
$tbl_name2="users";
$tbl_name1="team";
$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$uid=$_POST['uid'];
$pcode=$_POST['pcode'];
$repcode=$_POST['repcode'];
$teamsize=$_POST['team_size'];
$name1=$_POST['name1'];
$rollno1=$_POST['rollno1'];
$institute1=$_POST['institute1'];
$emailid1=$_POST['emailid1'];
$name2=$_POST['name2'];
$rollno2=$_POST['rollno2'];
$institute2=$_POST['institute2'];
$emailid2=$_POST['emailid2'];
$name3=$_POST['name3'];
$rollno3=$_POST['rollno3'];
$institute3=$_POST['institute3'];
$emailid3=$_POST['emailid3'];
$datetime=date("d/m/y h:i:s");
$l=0;
//$p="/Applications/xampp/htdocs/dbms_project/checking";
if($pcode==$repcode)
{
$sql="INSERT INTO $tbl_name1(uid,pcode,team_size,datetime)VALUES('$uid','$pcode','$teamsize','$datetime')";
$result=mysql_query($sql);
	if($result){
		//echo "Successful registration<br/>";
			  mkdir( $STORE_PATH."/".$uid ) or die( "Registration not complete, problem with user space, contact admin\n");
chmod( $STORE_PATH."/".$uid, 0777 ) or die( "Registration not complete, problem with user permission, contact admin\n");	
     
			if($teamsize== 1)
			{
			$sql1="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name1','$rollno1','$institute1','$emailid1','$uid')";
			$result1=mysql_query($sql1);
            if(!$result1)
            {
            echo "user info is wrong";
            $s="delete from team where uid='$uid'";
             rmdir( $STORE_PATH."/".$uid ) or die( "Registration not complete, problem with user space, contact admin\n");
            $r=mysql_query($s);
            $l=1;
             echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=register.html\">";
            }
			}
			else
 			{
			if($teamsize== 2)
			{	
			$sql1="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name1','$rollno1','$institute1','$emailid1','$uid')";
			$result1=mysql_query($sql1);
			$sql2="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name2','$rollno2','$institute2','$emailid2','$uid')";
			$result2=mysql_query($sql2);
            if(!$result1 || !$result2)
            {
              echo "user info is wrong";
               rmdir( $STORE_PATH."/".$uid ) or die( "Registration not complete, problem with user space, contact admin\n");
                          $s="delete from team where uid='$uid'";
            $r=mysql_query($s);
            $l=1;
            if($result1)
            {
            $ss="delete from users where emailid='$emailid1'";
            $rr=mysql_query($ss);
            }
            if($result2)
            {
            $ss="delete from users where emailid='$emailid2'";
            $rr=mysql_query($ss);
            }

             echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=register.html\">";
            }
            }
			else
			{if($teamsize== 3)
                        {$sql1="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name1','$rollno1','$institute1','$emailid1','$uid')";
			$result1=mysql_query($sql1);
			$sql2="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name2','$rollno2','$institute2','$emailid2','$uid')";
			$result2=mysql_query($sql2);
			$sql3="INSERT INTO $tbl_name2(uname,rollno,institute,emailid,tid)VALUES('$name3','$rollno3','$institute3','$emailid3','$uid')";
			$result3=mysql_query($sql3);
            if(!$result1 || !$result2 || !$result2)
            {
             echo "user info is wrong";
              rmdir( $STORE_PATH."/".$uid ) or die( "Registration not complete, problem with user space, contact admin\n");
                         $s="delete from team where uid='$uid'";
            $r=mysql_query($s);
            if($result1)
            {
            $ss="delete from users where emailid='$emailid1'";
            $rr=mysql_query($ss);
            }
          if($result2)
            {
            $ss="delete from users where emailid='$emailid2'";
            $rr=mysql_query($ss);
            }

            if($result3)
            {
            $ss="delete from users where emailid='$emailid3'";
            $rr=mysql_query($ss);
            }

            
            
            $l=1;
             echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=register.html\">";
            }
            
 			}}}
            if($l != 1)
		    echo "Successful registration<br/>";
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=index.html\">";
		}
	else
	{
	echo "team name already registered use some other name....";
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=register.html\">";}
}
else
{
echo "passwords do not match";
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=register.html\">";}
mysql_close($con);
?>

</body>
</html>
