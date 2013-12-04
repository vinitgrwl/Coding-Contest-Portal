<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
	<!-- begin #header -->
    <div id="header">
	<div id="hpic"><input type="image" src="images/LNMIIT-logo.jpg" alt="" width="150" height="82" align="left" align="top" margin-left=5px" /></div>
	<h1>LNMIIT CODING CONTEST</h1>
		<div class="headerTop"> 
</div>
       <div class="mainMenu">
	  <a href="home.php">Problems</a>&nbsp &nbsp
	  <a href="submit.php">Submit</a>&nbsp &nbsp
	  <a href="statistics.php">Statistics</a>&nbsp &nbsp 
      <a href="status.php">My Status</a>&nbsp &nbsp 
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
