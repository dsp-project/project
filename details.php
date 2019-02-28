<?php



include_once("config.php");
include_once("functions.php");
require_once("metaInfo.php");

global $cfg;

$torrent = getRequestVar('torrent');

DisplayHead(_TORRENTDETAILS);

echo "<table width=\"740\" border=0 cellpadding=0 cellspacing=0><tr><td>";

echo displayDriveSpaceBar(getDriveSpace($cfg["path"]));

echo "</td></tr></table>";
echo "<br>";
echo "<div align=\"left\" id=\"BodyLayer\" name=\"BodyLayer\" style=\"border: thin solid ";
echo $cfg["main_bgcolor"];
echo "; position:relative; width:740; height:500; padding-left: 5px; padding-right: 5px; z-index:1; overflow: scroll; visibility: visible\">";

$als = getRequestVar('als');
if($als == "false")
{
       showMetaInfo($torrent,false);
}
else
{
    showMetaInfo($torrent,true);
}

echo "</div>";

DisplayFoot();

?>