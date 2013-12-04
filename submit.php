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
	  <a href="statistics.php">Statistics</a>&nbsp &nbsp  
	  <a href="score.php">Score</a>&nbsp &nbsp
	  

	   	  
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
    <div id="mainContent">
<?php
include("main.php");
$host="localhost";
$username="root";
$password="";
$db_name="codechef";
$tbl_name2="problems";
$tbl_name1="answers";
	$con=mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
function isFileType( $str, $extention )
{
    $remaining = stristr( $str, $extention ); //returns the remaining string

    if( "$remaining" == "$extention" )
	return true;
    else
	return false;
}



function getQcodeCredit( $qcode )
	{   
	$sql="SELECT credits FROM problems WHERE qcode='$qcode'"; 
	$re=mysql_query($sql);
	//echo $re;
	$info1 = mysql_fetch_array($re);
        //$sql="select credits from $tbl_name2 where qcode='$code'";
        //$result=mysql_query($sql);
	return $info1['credits'];
        //$info=mysql_fetch_array($result);
        //return $info['credits'];
	//return 0;
}


if( !isset($_POST['qcode'])  )  //black
{
?>
<html>
<body>
<h3>Submit a Solution</h3>
<p >
<form name="solution" method="POST" action="submit.php" enctype="multipart/form-data">
<label for="file">
<b>File:</b></label>
<br>
<input name="solution_file" type="file">
<p><br>
<b>Problem Code:</b>
<br>
<input readonly="readonly" type="text" name="qcode" value="<?php echo $_GET['qcode'];?>">
<p><br>
<b>Language:</b><br>
<select name="lang" >
<option value="">---</option>

<?php
// code added for selective languages for ques. ie. only a certain
// languages to be allowed based on <lang> tag in problems.xml for
// each ques. For backward compatibility, if this tag is not found
// all available languages are allowed.
$tbl_name3="languages";
$qcode = $_GET['qcode'];
	
$sq="SELECT * FROM $tbl_name3 WHERE qcode='$qcode'"; 
$re=mysql_query($sq);
	//$info1 = mysql_fetch_array($re);
while($info1 = mysql_fetch_array($re))
{
	//echo $info1['lang'];
// selecting languages based on allowed languages in languages table
if( $info1['lang']=='c')
	echo "\n<option value=\"c\">C (.c)</option>";
if( $info1['lang']=='cpp')
	echo "\n<option value=\"cpp\">C++ (.cpp)</option>";

if( $info1['lang']=='java' )
	echo "\n<option value=\"java\">Java (.java)</option>";

if( $info1['lang']=='python' )
	echo "\n<option value=\"python\">Python (.py)</option>";

if($info1['lang']=='perl' )
	echo "\n<option value=\"perl\">Perl (.pl)</option>";

if( $info1['lang']=='php')
	echo "\n<option value=\"php\">PHP (.php)</option>";
}
	
?>
</select>
<p>
<br>
<Input type="submit" value="Submit" class="button">
<input type="reset" value="Clear" class="button">
</form>
</body>
</html>
<?php
	}
	else{
//do the processing
if( $_FILES['solution_file']['error'] > 0 )   //file not uploaded
{
    echo "<b>Error Uploading File</b><br>";
    echo "<a href=\"submit.php\" >Submit Again</a>";
    exit;
}
else
{
    if( $_FILES['solution_file']['size'] > 50000 )  //file too large
    {
	echo "<b>Uploaded File Too Large(Limit: 50 Kb)</b><br>";
	echo "<a href=\"submit.php\" >Submit Again</a>";
	exit;
    }
}

if( $_POST['qcode'] == "" )		//no ques code
{
    echo "<b>Question Code not Specified</b><br>";
    echo "<a href=\"submit.php\" >Submit Again</a>";
    exit;
 }
if( $_POST['lang'] == "" )   //no language
{
    echo "<b>Language not Specified</b><br>";
    echo "<a href=\"submit.php\" >Submit Again</a>";
    exit;
}

//imp variables
$LANG=$_POST['lang'];
$FNAME=$_FILES['solution_file']['name'];
$COMPILER="";
$QCODE=strtoupper($_POST['qcode']);
$EXTENTION="";

//checking file-types and langs
if( $LANG=="c" )
{
    $EXTENTION="c";
    //echo "compiler=gcc";
    if( !isFileType( $FNAME, ".c" ) )
    {
        echo "<b>Invalid File Name</b><br>";
	echo "*file name should be of the type -- file_name.c<br>";
	echo "You submitted \"$FNAME\"<br>";
	echo "<a href=\"submit.php\" >Submit Again</a>";
	exit;
    }

    $COMPILER="gcc -lm ";
}
else 
{
    if( $LANG=="cpp")
    {
	$EXTENTION="cpp";
	if( !isFileType( $FNAME, ".cpp" ) )
	{
	    echo "<b>Invalid File Name</b><br>";
    echo "*file name should be of the type -- file_name.cpp<br>";
	    echo "You submitted \"$FNAME\"<br>";
	    echo "<a href=\"submit.php\" >Submit Again</a>";
	     exit;
	}
	//echo "compiler=g++";
	$COMPILER="g++";
    }
    else
    {
	if( $LANG=="java")
	{
	    $EXTENTION="java";
	    if( !isFileType( $FNAME, ".java" ) )
	    {
	        echo "<b>Invalid File Name</b><br>";
	        echo "*file name should be of the type -- file_name.java<br>";
	        echo "You submitted \"$FNAME\"<br>";
	        echo "<a href=\"submit.php\" >Submit Again</a>";
	         exit;
	    }
	    //echo "compiler=javac";
	    $COMPILER="javac";
	    //$COMPILER="";
	}
	else
	{
	    if( $LANG=="python")
	    {
	    	$EXTENTION="py";
	    	if( !isFileType( $FNAME, ".py" ) )
	    	{
	        	echo "<b>Invalid File Name</b><br>";
	        	echo "*file name should be of the type -- file_name.py<br>";
	        	echo "You submitted \"$FNAME\"<br>";
	        	echo "<a href=\"submit.php\" >Submit Again</a>";
	         	exit;
	   	 }
	        //echo "compiler=javac";
	        $COMPILER="python";
	        //$COMPILER="";
	    }
	    else
	    {
	    	if( $LANG=="perl")
	    	{
	    		$EXTENTION="pl";
	    		if( !isFileType( $FNAME, ".pl" ) )
	    		{
	        		echo "<b>Invalid File Name</b><br>";
	        		echo "*file name should be of the type -- file_name.pl<br>";
	        		echo "You submitted \"$FNAME\"<br>";
	        		echo "<a href=\"submit.php\" >Submit Again</a>";
	         		exit;
	   	 	}
	        	//echo "compiler=javac";
	        	$COMPILER="perl";
	        	//$COMPILER="";
	    	}
	    	else
	    	{
			//lang php added on 30th aug, 2011	
			if( $LANG == "php" )
			{
				$EXTENTION="php";
				if( !isFileType( $FNAME, ".php" ) )
	    			{
	        			echo "<b>Invalid File Name</b><br>";
	        			echo "*file name should be of the type -- file_name.php<br>";
	        			echo "You submitted \"$FNAME\"<br>";
	        			echo "<a href=\"submit.php\" >Submit Again</a>";
	         			exit;
	   	 		}
				$COMPILER="php";
			}
			else
			{
	     			//echo "invalid language";
	    			$COMPILER="";
	    			//exit;
			}
	    	}
	    }
	}
    }
}
if( $COMPILER == "" )
{
    echo "<b>Invalid Language</b><br>";
    echo "<a href=\"submit.php\" >Submit Again</a>";
    exit;
}


include("main.php");

//check for valid qcode
echo "<h3>File Uploaded Successfully</h3><br/>";
$UID=$_SESSION[uid];

echo "<b><p>File Name:<br/></b>".$_FILES['solution_file']['name'];
echo "<b><p>Question Code:<br/></b>".$_POST['qcode'];
echo "<b><p>Points:<br/></b>".getQcodeCredit($_POST['qcode']);
echo "<b><p>Language:<br/></b>".$LANG;
echo "<b><p>Compiler:<br/></b>".$COMPILER;
echo "<b><p>Description:<br/></b>";

//$STORE_PATH="/Applications/xampp/htdocs/dbms_project/checking";
//$p="/Applications/xampp/htdocs/dbms_project";
if( !file_exists( $p."/secret_qset/$QCODE.in")  &&  !file_exists( $p."/secret_qset/$QCODE.sol")  )
{
    echo $p.$ROOT."secret_qset/$QCODE.in";
    echo "Invalid Problem Code";
    exit;
}



$credits=getQcodeCredit($_POST['qcode']);
//echo "$credits";
if( file_exists( $STORE_PATH.$UID."/".$QCODE.".done" )  )
{
    echo "Solution to this question is already accepted";
    exit;
}


//move the file to appropriate place, then check it for correctness, write report in status file
//also move files only before time ...

$DESTINATION=$STORE_PATH."/".$UID."/".$QCODE.".".$EXTENTION;
//echo "<br>".$DESTINATION."<br>";
if( file_exists( $DESTINATION ) )
{
    echo "File Already Exist ... Overwriting<br/>Please note last submission of the <br>problem will be considered.";
}

//moving to destination
//echo $DESTINATION;
move_uploaded_file( $_FILES['solution_file']['tmp_name'], $DESTINATION ) or die("File not uploaded");
echo "<p>Uploaded Sucessfully </p><br><p><i>Please Wait ... Your Program is being evaluated</i></p>";
flush();


//to the solution set checking
echo "<p><b><font color=\"#174F63\">";
//echo $STORE_PATH."chek_prg.sh"." ".$STORE_PATH.$UID."/"." ".$QCODE." .".$EXTENTION." "."gcc";
//echo `$STORE_PATH."chek_prg.sh"." ".$STORE_PATH.$UID."/"." ".$QCODE." .".$EXTENTION." "."/usr/bin/gcc"`;

//some documentation required her!!!!!!.....plz  ...
//arg 1  --->   path of user dir ( /icpc/checking )
//arg 2  --->   uid (user id of the team )
//arg 3  --->   qcode (question code, each ques has a question code
//arg 4  --->   secret path ( dir where the solution and input data sets are stored )
//arg 5  --->   compiler  ( be sure to have compiler name in "(quotes) neccasry if giving compiler options like -lm
//arg 6  --->   extention of program file eg .c, .cpp, .java

//$CHECK=$STORE_PATH."check.sh ".$STORE_PATH."".$UID."/ ".$QCODE." ".$EXTENTION." "."\"$COMPILER\" $UID /var/www".$ROOT."secret_qset $LANG";
flush();
$CHECK=$p."/test.sh ".$STORE_PATH." ".$UID." ".$QCODE." ".$p."/secret_qset/ "."\"$COMPILER\" "."$EXTENTION";
//echo $CHECK;
//echo "kk";
//echo $p;
//echo `$STORE_PATH."/check.sh ". `;

//if( $LANG == "java" )
//{
//    $C="Pending";
//}
//else
//{

//echo $STORE_PATH.$UID."/".$QCODE.".done";
if( file_exists( $STORE_PATH."/".$UID."/".$QCODE.".done" )  )
{
    echo "Solution to this question is already accepted - 1";
  
    exit;
}
//echo "ll";
$c1=$p."/test.sh";
//echo `$c1`;
    $C=`$CHECK `;
    echo $C;
//}
   //exit;
echo "</font></b></p>";
//echo $C;
//note:- $C (capital) is the the status as given by the sh script
//echo "hii";
$datetime=time();
$f="Accepted\n";
//echo $datetime;
//echo $f;
//echo "hii";
//echo $start_time;
echo "<br/>";
//$l=getMyTimeDiff($datetime,$start_time);
//echo $l;
$tmp = (int) time() - (int)$start_time;
//echo $tmp." ";
if($C == $f)
{
//echo "ll";
//echo $credits;
$t=(1 - (float)$tmp/18000);
$score=(float)$credits;
//echo $t;
$sql2="insert into answers (quescode,team_id,ans_status,lang,score)values('$QCODE','$UID','$C','$LANG',$score)";
$result2=mysql_query($sql2);
if(!($result2))
echo "couldnt write to status database....contact admin immediately,<br/>This is critical issue";
}
else
{
$score=0;
$sql2="insert into answers (quescode,team_id,ans_status,lang,score)values('$QCODE','$UID','$C','$LANG',$score)";
$re2=mysql_query($sql2);
//echo "$re2";
echo "<br/>";
if(!$re2)
echo "couldnt write to status database contact admin immediately,<br/>This is critical issue";
}
$sql4="delimiter ;;
    create trigger tscore
      after insert on answers
      for each row
      begin
      update team set total_score=total_score + new.score where team.uid=new.team_id;
      end;;
      delimeter ;";//this query is run on the phpmyadmin
//echo "$sql4";
//$con1=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect"); 
//$re=mysql_query($sql4);
//echo $re;
//if(!$re)
//echo "could not update score";
echo "<a href='status.php'>Status</a>";
	}
	mysql_close($con);?>
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
