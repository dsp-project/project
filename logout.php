<?php

include_once("config.php");

// Start Session and grab user
session_start("TorrentFlux");
$cfg["user"] = strtolower($_SESSION['user']);

// 2004-12-09 PFM
include_once('db.php');

// Create Connection.
$db = getdb();

logoutUser();
session_destroy();
header('location: login.php');

// Remove history for user so they are logged off from screen
function logoutUser()
{
    global $cfg, $db;

    $sql = "DELETE FROM tf_log WHERE user_id=".$db->qstr($cfg["user"])." and action=".$db->qstr($cfg["constants"]["hit"]);

    // do the SQL
    $result = $db->Execute($sql);
    showError($db, $sql);
}
?>