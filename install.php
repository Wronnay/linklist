<?php
error_reporting(0);
ob_start();
?>
<!DOCTYPE HTML>
<html>
 <head>
 <title>Installation | Linklisten Script</title>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="design/install.css">
 </head>
 <body>
 <div id="logo"><img src="images/logo.png" alt=""></div>
 <div id="seite">
<div class="title">Linkliste - Installation:</div>
<?php
switch($_GET["install"]){
  case "":
?>
<div class="title2">(Schritt 1/2)</div><br>
<b>MySQL-Daten angeben:</b><br>
	  <form action="?install=1-2" method="post">
	  <table>
	  <tr><td>Host (oft: "localhost")</td><td><input type="text" name="host" value="localhost"></td></tr>
	  <tr><td>Datenbank-Name</td><td><input type="text" name="database"></td></tr>
	  <tr><td>Benutzername</td><td><input type="text" name="user"></td></tr>
	  <tr><td>Passwort</td><td><input type="password" name="pass"></td></tr>
	  <tr><td>Passwort (Wiederholung)</td><td><input type="password" name="pass2"></td></tr>
	  </table>
	  <input type="submit" value="Weiter">
	  </form>
<?php
  break;
 case "1-2":
?>
<div class="title2">(Schritt 1/2)</div><br>
<?php
if($_POST["pass"] != $_POST["pass2"])
	  {
	    echo "Die Passwörter stimmen nicht überein.<br><br>
		<a href=\"?install=\">Zurück zu Schritt 1</a><br><br>";
	  }
else {
	  $fp = fopen("config.php","w+");
      $HOST = '$HOST';
      $USER = '$USER';
      $PW = '$PW';
      $DB = '$DB';
      $daten = "<?php
      $HOST = '$_POST[host]'; 
      $USER = '$_POST[user]'; 
      $PW = '$_POST[pass]'; 
      $DB = '$_POST[database]'; 
      ?>";
      fwrite($fp,$daten);
	  include("config.php");
      mysql_connect($HOST,$USER,$PW)or die(mysql_error());
      mysql_select_db($DB)or die(mysql_error());
	  mysql_query("CREATE TABLE IF NOT EXISTS wronnay_linkliste (
      id INT(22) NOT NULL auto_increment,
      titel varchar(220) NOT NULL,
	  link varchar(220) NOT NULL,
	  beschreibung text NOT NULL,
	  datum datetime NOT NULL,
      PRIMARY KEY (id) );
      ");
header("Location: ?install=2");
}
  break;
 case "2":
?>
<div class="title2">(Schritt 2/2)</div><br>
<b>Die Installation ist fertig!:</b><br>
Wenn Sie noch Fragen, Probleme oder Wünsche haben oder wenn Sie einen Fehler gefunden haben, dann können Sie mir unter: <a href="http://wronnay.net/kontakt">http://wronnay.net/kontakt</a> eine Nachricht senden.
<br><br><a href="index.php">> OK!</a><br><br>
<?php
break;
}
?>
 </div>
 <div id="footer">
<div class="text">&copy; <a href="http://scripts.wronnay.net">Scripts.Wronnay.net</a><br><br>
 </div></div>
 </body>
</html>
<?php
ob_end_flush();
?>