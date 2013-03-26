<?php
error_reporting(0);
include 'config.php';
mysql_connect($HOST,$USER,$PW)or die(mysql_error());
mysql_select_db($DB)or die(mysql_error());
?>
<!DOCTYPE HTML>
<!--
Linklist-Script and Design by Christoph Miksche
Websites: http://celzekr.tk and http://scripts.wronnay.net
License: Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)

Dieses Werk bzw. Inhalt steht unter einer Creative Commons Namensnennung-Nicht-kommerziell-
Weitergabe unter gleichen Bedingungen 3.0 Unported Lizenz.

Sie duerfen die Links zu Celzekr.tk und Scripts.Wronnay.net nicht entfernen!

(http://creativecommons.org/licenses/by-nc-sa/3.0/)
-->
<html>
<head>
<title>Link eintragen</title>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="design/design.css">
</head>
<body>
<?php
  if(isset($_POST['submit']) AND $_POST['submit'] == "Link eintragen") {
  if(isset($_POST['email']) && $_POST['email']) {
	  echo"<div class=\"fehler\">You are an SPAM-Bot!</div>";
	  }
else {
        if(empty($_REQUEST['link']) || empty($_REQUEST['titel']) || empty($_REQUEST['beschreibung'])) {
        echo"<div class=\"fehler\">Bitte füllen Sie alle Felder aus!</div>";
      }
	  else {
	  $sql = "INSERT INTO wronnay_linkliste (titel, link, beschreibung, datum) VALUES ('".mysql_real_escape_string($_REQUEST['titel'])."','".mysql_real_escape_string($_REQUEST['link'])."','".mysql_real_escape_string($_REQUEST['beschreibung'])."',now())";
	  $result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
	  echo "<div class=\"erfolg\">Sie haben den Link eingetragen.</div>";
	  }
}
  }
?>
<b>Link eintragen:</b><br>
	  <form action="eintragen.php" method="post">
	  <table>
 <p class="hallo"><input id="email" type="text" name="email" value="" size="60" /></p>
	  <tr><td>Link</td><td><input type="text" name="link" value="http://"></td></tr>
	  <tr><td>Titel Ihrer Webseite</td><td><input type="text" name="titel"></td></tr>
	  <tr><td>Beschreibung</td><td><textarea class="li" name="beschreibung" cols="55" rows="15"></textarea></td></tr>
	  </table>
	  <input type="submit" name="submit" value="Link eintragen">
	  </form>
	  <br>
<div style="font-size: 14px;">
<!--Den Link nicht entfernen!-->
<a style="opacity: 0.5;" href="http://scripts.wronnay.net"> Zur eigenen, kostenlosen, Linkliste</a>
<!--Den Link nicht entfernen! end-->
</div>
</body>
</html>
