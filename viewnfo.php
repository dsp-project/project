<?php


include_once("config.php");
include_once("functions.php");

DisplayHead("View NFO");

$file = $_GET["path"];
$folder = htmlspecialchars( substr( $file, 0, strrpos( $file, "/" ) ) );

if( ( $output = @file_get_contents( $cfg["path"] . $file ) ) === false )
    $output = "Error opening NFO File.";
?>
<div align="center" style="width: 740px;">
<a href="<?php echo "viewnfo.php?path=$file&dos=1"; ?>">DOS Format</a> :-:
<a href="<?php echo "viewnfo.php?path=$file&win=1"; ?>">WIN Format</a> :-:
<a href="dir.php?dir=<?=$folder;?>">Back</a>
</div>
<pre style="font-size: 10pt; font-family: 'Courier New', monospace;">
<?php
    if( ( empty( $_GET["dos"] ) && empty( $_GET["win"] ) ) || !empty( $_GET["dos"] ) )
        echo htmlentities( $output, ENT_COMPAT, "cp866" );
    else
        echo htmlentities( $output );
?>
</pre>
<?php
DisplayFoot();
?>