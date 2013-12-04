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
	<!--<div class="mainMenu">
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
?>

	<onLoad="show_clock()">
	</div>-->
	<div id="mainContent">
<p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<b>Search by </b>
<br/>
<input type="checkbox"name="qcode" value="qcode"> Question code<br/>
<input type="checkbox"name="date" value="datetime"> Date of the contest<br/>
<input type="checkbox"name="topic" value="topic"> Topic of the question<br/>
<input type="checkbox"name="credit" value="credit"> Credits of the question<br/>
<input type="checkbox"name="accepted" value="accepted"> Maximum accepted questions<br/>
<input type="checkbox"name="lang" value="lang"> Language of the question<br/>
<br/>
<label>Question code</label>
<input type="text" name="qcodet" size="30" maxlength="50"  class="tb5"/>
<br/>
<br/>
<label>Date</label>

<input type="text" name="datet" size="10" maxlength="10" class="tb5"/>
<br/>
&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp*please specify in form yyyy-mm-dd
<br/>
<br/>   
<label>Topic</label>
<input type="text" name="topict" size="30" maxlength="50" class="tb5"/>
<br/>
<br/>
<label>Credits</label>
<input type="text" name="creditt" size="10" maxlength="10" class="tb5"/>
<br/>
&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp*please enter credits of form 100,150,200,250,300 only
<br/>
<br/>
<label>Language</label>
<input type="text" name="langt" size="20" maxlength="20" class="tb5"/>
<br/>
<br/>
<input type="submit" value="Search" />  
<br/>
<br/> 
</body>
</html>
<?php
$c=0;
$Accepted="Accepted\n";
$date="unchecked";
$qcode="unchecked";
$lang="unchecked";
$topic="unchecked";
$accepted="unchecked";
$credit="unchecked";
$date=$_POST['date'];
$qcode=$_POST['qcode'];
$lang=$_POST['lang'];
$topic=$_POST['topic'];
$accepted=$_POST['accepted'];
$credit=$_POST['credit'];
if($qcode=='qcode')
{
$qcodet=$_POST['qcodet'];
$c=1;
$sql="select title,qcode,question,credits,topic from problems where qcode='$qcodet'";
$result=mysql_query($sql);
}
else{ 
if($date=='datetime')
$datet=$_POST['datet'];
if($topic=='topic')
$topict=$_POST['topict'];
if($lang=='lang')
$langt=$_POST['langt'];
if($credit=='credit')
$creditt=$_POST['creditt'];
if($date && !$topic && !$lang && !$accepted && !$credit )
{
$sql="select title,qcode,question,credits,topic from problems where datetime='$datet'";
$result=mysql_query($sql);
$c=1;
}
if($topic && !$date && !$lang && !$accepted && !$credit )
{
$c=1;
$sql="select title,qcode,question,credits,topic from problems where topic='$topict'";
$result=mysql_query($sql);
}
if($lang && !$date && !$topic && !$accepted && !$credit )
{
$c=1;
$sql="select title,qcode,question,credits,topic from problems where qcode in(select qcode from languages where lang='$langt')";
$result=mysql_query($sql);
}
if(!$lang && !$date && !$topic && !$accepted && $credit )
{
$c=1;
$sql="select title,qcode,question,credits,topic from problems where credits='$creditt'";
$result=mysql_query($sql);
}
if($date && $topic && !$lang && !$accepted  && !$credit )
{
$c=1;
$sql="select title,qcode,question,credits,topic from (select * from problems where datetime='$datet') x where x.topic='$topict'";
$result=mysql_query($sql);
}
if($date && $lang && !$topic && !$accepted  && !$credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND datetime =  '$datet'";
//$sql="select title,qcode,question,credits,topic from (select * from problems where datetime='$datet') x where x.lang='$langt'";
$result=mysql_query($sql);
}
if($date && $credit && !$topic && !$accepted  && !$lang )
{
$c=1;
$sql="select title,qcode,question,credits,topic from (select * from problems where datetime='$datet') x where x.credits='$creditt'";
$result=mysql_query($sql);
}
if($topic && $credit && !$date && !$accepted  && !$lang )
{
$c=1;
$sql="select title,qcode,question,credits,topic from (select * from problems where topic='$topict') x where x.credits='$creditt'";
$result=mysql_query($sql);
}
if($lang && $credit && !$topic && !$accepted  && !$date)
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND credits =  '$creditt'";
//$sql="select title,qcode,question,credits,topic from (select * from problems where lang='$langt') x where x.credits='$creditt'";
$result=mysql_query($sql);
}

if( !$date && $topic && $lang && !$accepted  && !$credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND topic =  '$topict'";
//$sql="select title,qcode,question,credits,topic from (select * from problems where topic='$topict') x where x.lang='$langt'";
$result=mysql_query($sql);
}
if($date && $topic && $lang && !$accepted  && !$credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND datetime =  '$datet' and topic='$topict'";
//$sql="select title,qcode,question,credits,topic from problems where topic='$topict' and lang='$langt' and datetime='$datet'";
$result=mysql_query($sql);
}
if($date && $topic && !$lang && !$accepted  && $credit )
{
$c=1;
$sql="select title,qcode,question,credits,topic from problems where topic='$topict' and credits='$creditt' and datetime='$datet'";
$result=mysql_query($sql);
}
if($date && !$topic && $lang && !$accepted  && $credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND datetime =  '$datet' and credits='$creditt'";
//$sql="select title,qcode,question,credits,topic from problems where credits='$creditt' and lang='$langt' and datetime='$datet'";
$result=mysql_query($sql);
}
if(!$date && $topic && $lang && !$accepted  && $credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND topic='$topict' and credits='$creditt'";

//$sql="select title,qcode,question,credits,topic from problems where topic='$topict' and lang='$langt' and credits='$creditt'";
$result=mysql_query($sql);
}

if($accepted && !$date && !$topic && !$lang  && !$credit )
{
$c=1;
//$sql="select title,qcode,question,credits,topic from problems where qcode in (select quescode from (select quescode,count(quescode) from answers where ans_status="Accepted") x group by x.quescode order by x.count(quescode) desc)";
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status = '$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode";
$result=mysql_query($sql);
}
if($accepted && $date && !$topic && !$lang  && !$credit )
{
$c=1;
//$sql="select title,qcode,question,credits,topic from problems,(select quescode from (select quescode,count(quescode) from answers where ans_status="Accepted") x group by x.quescode order by x.count(quescode) desc) y where y.quescode=problems.qcode and datetime='$datet'";
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status = '$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet'";
$result=mysql_query($sql);
}
if($accepted && $topic && !$date && !$lang  && !$credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status = '$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and topic='$topict'";
$result=mysql_query($sql);
}
if($accepted && !$topic && !$date && !$lang  && $credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and credits='$creditt'";
$result=mysql_query($sql);
}

if($accepted && $lang && !$date && !$topic  && !$credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and lang='$langt'";
$result=mysql_query($sql);
}
if($accepted && $lang && $date && !$topic  && !$credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.datetime='$datet'";
$result=mysql_query($sql);
}
if($accepted && !$lang && $date && !$topic  && $credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and credits='creditt' and datetime='$datet'";
$result=mysql_query($sql);
}
if($accepted && !$lang && !$date && $topic  && $credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and topic='$topict' and credits='creditt'";
$result=mysql_query($sql);
}
if($accepted && $lang && !$date && !$topic  && $credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.credits='$creditt'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and lang='$langt' and credits='$creditt'";
$result=mysql_query($sql);
}
if($accepted && $lang && $topic && !$date  && !$credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.topic='$topict'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and lang='$langt' and topic='$topict'";
$result=mysql_query($sql);
}
if($accepted && $date && $topic && !$lang  && !$credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet' and topic='$topict'";
$result=mysql_query($sql);
}
if($accepted && $date && $topic && $lang  && !$credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.datetime='$datet' and m.topic='$topict'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet' and topic='$topict' and lang='$langt'";
$result=mysql_query($sql);
}
if($date && $topic && $lang && !$accepted  && $credit )
{
$c=1;
$sql="SELECT title FROM problems, (SELECT qcode FROM languages WHERE lang ='$langt')x WHERE x.qcode = problems.qcode AND topic='$topict' and credits='$creditt' and datetime='$datet'";
//$sql="select title,qcode,question,credits,topic from problems where topic='$topict' and lang='$langt' and credits='$creditt' and datetime='$datet'";
$result=mysql_query($sql);
}
if($accepted && $date && $topic && !$lang  && $credit )
{
$c=1;
$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet' and topic='$topict' and credits='$creditt'";
$result=mysql_query($sql);
}
if($accepted && !$date && $topic && $lang  && $credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.credits='$creditt' and m.topic='$topict'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and lang='$langt' and topic='$topict' and credits='$creditt'";
$result=mysql_query($sql);
}
if($accepted && $date && !$topic && $lang  && $credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.datetime='$datet' and m.credits='$creditt'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet' and lang='$langt' and credits='$creditt'";
$result=mysql_query($sql);
}
if($accepted && $date && $topic && $lang  && $credit )
{
$c=1;
$sql="SELECT title, qcode, question, credits, topic FROM (SELECT * FROM problems WHERE qcode IN ( SELECT qcode FROM languages WHERE lang ='$langt'))m, (SELECT quescode, COUNT( ans_status ) FROM ( SELECT * FROM answers WHERE ans_status = '$Accepted' )x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = m.qcode and m.datetime='$datet' and m.topic='$topict' and m.credits='$creditt'";
//$sql="SELECT title, qcode,question,credits,topic FROM problems, (SELECT quescode, COUNT( ans_status ) FROM (SELECT * FROM  answers WHERE ans_status ='$Accepted')x GROUP BY x.quescode ORDER BY COUNT( ans_status ) DESC )y WHERE y.quescode = qcode and datetime='$datet' and lang='$langt' and credits='$creditt' and topic='$topict'";
$result=mysql_query($sql);
}
}
echo "<br/>";
if($c==1)
{
$count=mysql_num_rows($result);
if($count ==0)
echo "no results found";
else
{
?>
<table border="1">
<tr>
<th>        Title       </th>
<th>     Question code  </th>
<th>       Credits      </th>
<th>        Topic       </th>
</tr>
<?php
while($info=mysql_fetch_array($result))
{
?>
<tr>
<td width="150"><?php echo $info['title'];  ?></td>
<td width="150"><?php echo "<a href='queryques.php?qcode=$info[qcode]'>$info[qcode]</a>"; ?></td>
<td width="150"><?php echo $info['credits'];  ?></td>
<td width="150"><?php echo $info['topic'];  ?></td>
</tr>
<?php
}
}
}
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
