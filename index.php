<?php
error_reporting(0);
include 'config.php';
if (!isset ($DB)) { header("Location: install.php"); }
$dbc = new PDO(''.$DBTYPE.':host='.$HOST.';dbname='.$DB.'', ''.$USER.'', ''.$PW.'');
function nocss($nocss) {
  $nocss = strip_tags($nocss);
  $nocss = htmlspecialchars($nocss, ENT_QUOTES, "iso-8859-1");
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
    $dbpre = $dbc->prepare($sql);
    $dbpre->execute();
?>
<!DOCTYPE HTML>
<!--
Linklist-Script and Design by Christoph Miksche
Websites: http://celzekr.webpage4.me and http://scripts.wronnay.net
License: Attribution-NonCommercial-ShareAlike 3.0 Unported (CC BY-NC-SA 3.0)

Dieses Werk bzw. Inhalt steht unter einer Creative Commons Namensnennung-Nicht-kommerziell-
Weitergabe unter gleichen Bedingungen 3.0 Unported Lizenz.

Sie duerfen die Links zu celzekr.webpage4.me und Scripts.Wronnay.net nicht entfernen!

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
			if ($dbpre->rowCount() < 1) {
	    echo "Es gibt noch keine Links!";
	}
    while ($row = $dbpre->fetch(PDO::FETCH_ASSOC)) {
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
