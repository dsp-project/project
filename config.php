<?php


/**************************************************************************/
// YOUR DATABASE CONNECTION INFORMATION
/**************************************************************************/
// Check the adodb/drivers/ directory for support for your database
// you may choose from many (mysql is the default)
$cfg["db_type"] = "mysql";       // mysql, postgres7 view adodb/drivers/
$cfg["db_host"] = "localhost";   // DB host computer name or IP
$cfg["db_name"] = "dsp"; // Name of the Database
$cfg["db_user"] = "root";        // username for your MySQL database
$cfg["db_pass"] = "password";            // password for database
/**************************************************************************/


$cfg["pagetitle"] = "TorrentFlux";

$cfg["version"] = "2.1";

// CONSTANTS
$cfg["constants"] = array();
$cfg["constants"]["url_upload"] = "URL Upload";
$cfg["constants"]["reset_owner"] = "Reset Owner";
$cfg["constants"]["start_torrent"] = "Started Torrent";
$cfg["constants"]["queued_torrent"] = "Queued Torrent";
$cfg["constants"]["unqueued_torrent"] = "Removed from Queue";
$cfg["constants"]["QManager"] = "QManager";
$cfg["constants"]["access_denied"] = "ACCESS DENIED";
$cfg["constants"]["delete_torrent"] = "Delete Torrent";
$cfg["constants"]["fm_delete"] = "File Manager Delete";
$cfg["constants"]["fm_download"] = "File Download";
$cfg["constants"]["kill_torrent"] = "Kill Torrent";
$cfg["constants"]["file_upload"] = "File Upload";
$cfg["constants"]["error"] = "ERROR";
$cfg["constants"]["hit"] = "HIT";
$cfg["constants"]["update"] = "UPDATE";
$cfg["constants"]["admin"] = "ADMIN";

asort($cfg["constants"]);

// Add file extensions here that you will allow to be uploaded
$cfg["file_types_array"] = array("torrent");

// Capture username
$cfg["user"] = "";
// Capture ip
$cfg["ip"] = $_SERVER['REMOTE_ADDR'];

?>
