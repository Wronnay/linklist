<?php
error_reporting(0);
include 'config.php';
if (!isset ($DB)) { header("Location: install.php"); }
mysql_connect($HOST,$USER,$PW)or die(mysql_error());
mysql_select_db($DB)or die(mysql_error());
function nocss($nocss) {
  $nocss = mysql_real_escape_string($nocss);
  $nocss = strip_tags($nocss);
  $nocss = htmlspecialchars($nocss, ENT_NOQUOTES, "iso-8859-1");
  return $nocss;
}
    $sql = "SELECT
            id,
			titel,
			link,
			beschreibung,
			datum
        FROM
            wronnay_linkliste
        ORDER BY
            datum DESC";
    $result = mysql_query($sql) OR die("<pre>\n".$sql."</pre>\n".mysql_error());
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
<title>Linkliste</title>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="design/design.css">
</head>
<body>
<div style="font-size: 18px;"><b>Linkliste:</b></div>
<div id="links">
<?php
			if (mysql_num_rows($result) == 0) {
	    echo "Es gibt noch keine Links!";
	}
    while ($row = mysql_fetch_assoc($result)) {
    echo "<div class=\"link\"><b><a href=\"".nocss($row['link'])."\">".nocss($row['titel'])."</a></b><br>".nocss($row['beschreibung'])."</div>";
    }
?>
</div>
<div style="font-size: 14px;">
<a class="sp" href="eintragen.php">Link eintragen</a><br><br>
<!--Den Link nicht entfernen!-->
<a style="opacity: 0.5;" href="http://scripts.wronnay.net"> Zur eigenen, kostenlosen, Linkliste</a>
<!--Den Link nicht entfernen! end-->
</div>
</body>
</html>
