<?php


include_once("config.php");
include_once("functions.php");

$result = shell_exec("df -h ".$cfg["path"]);
$result2 = shell_exec("du -sh ".$cfg["path"]."*");
$result4 = shell_exec("w");
$result5 = shell_exec("free -mo");

DisplayHead(_ALL);
echo "<table width=\"740\" border=0 cellpadding=0 cellspacing=0><tr><td>";
echo displayDriveSpaceBar(getDriveSpace($cfg["path"]));
echo "</td></tr></table>";
?>

<br>
<div align="left" id="BodyLayer" name="BodyLayer" style="border: thin solid <?php echo $cfg["main_bgcolor"] ?>; position:relative; width:740; height:500; padding-left: 5px; padding-right: 5px; z-index:1; overflow: scroll; visibility: visible">

<?php
echo "<pre>";
echo "<strong>"._DRIVESPACE."</strong>\n\n";

echo $result;
echo "<br><hr><br>";
echo $result2;

echo "<br><hr><br>";

echo "<strong>"._SERVERSTATS."</strong>\n\n";

echo $result4;
echo "<br><hr><br>";
echo $result5;
echo "</pre>";
echo "</div>";

DisplayFoot(); 

?>
