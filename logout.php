<!-- Made by Vinit Agarwal, Tanya Agarwal and Rashi Gupta -->
<?php
session_start();
unset($_SESSION['uid']);
echo "logged out!!!";
session_destroy();
echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=index.html\">";
?>
