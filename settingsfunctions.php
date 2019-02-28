<?php

function getRequestVar($varName)
{
    if (array_key_exists($varName,$_REQUEST))
    {
	return trim($_REQUEST[$varName]);
    }
    else
    {
        return '';
    }
}


//*********************************************************
// AuditAction
function AuditAction($action, $file="")
{
    global $_SERVER, $cfg, $db;

    $host_resolved = gethostbyaddr($cfg['ip']);
    $create_time = time();

    $rec = array(
                    'user_id' => $cfg['user'],
                    'file' => $file,
                    'action' => $action,
                    'ip' => $cfg['ip'],
                    'ip_resolved' => $host_resolved,
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'time' => $create_time
                );

    $sTable = 'tf_log';
    $sql = $db->GetInsertSql($sTable, $rec);

    // add record to the log
    $result = $db->Execute($sql);
    showError($db,$sql);
}

//*********************************************************
function loadSettings()
{
    global $cfg, $db;

    // pull the config params out of the db
    $sql = "SELECT tf_key, tf_value FROM tf_settings";
    $recordset = $db->Execute($sql);
    showError($db, $sql);

    while(list($key, $value) = $recordset->FetchRow())
    {
        $tmpValue = '';
	    if(strpos($key,"Filter")>0)
        {
	        $tmpValue = unserialize($value);
	    }
	    elseif($key == 'searchEngineLinks')
	    {
	        $tmpValue = unserialize($value);
	    }
	    if(is_array($tmpValue))
        {
            $value = $tmpValue;
        }
        $cfg[$key] = $value;
    }
}

//*********************************************************
function insertSetting($key,$value)
{
    global $cfg, $db;

    $update_value = $value;
    if (is_array($value))
    {
        $update_value = serialize($value);
    }

    $sql = "INSERT INTO tf_settings VALUES ('".$key."', '".$update_value."')";

    if ( $sql != "" )
    {
        $result = $db->Execute($sql);
        showError($db,$sql);
        // update the Config.
        $cfg[$key] = $value;
    }
}

//*********************************************************
function updateSetting($key,$value)
{
    global $cfg, $db;
    $update_value = $value;
	if (is_array($value))
    {
        $update_value = serialize($value);
    }

    $sql = "UPDATE tf_settings SET tf_value = '".$update_value."' WHERE tf_key = '".$key."'";

    if ( $sql != "" )
    {
        $result = $db->Execute($sql);
        showError($db,$sql);
        // update the Config.
        $cfg[$key] = $value;
    }
}

//*********************************************************
function saveSettings($settings)
{
    global $cfg, $db;

    foreach ($settings as $key => $value)
    {
        if (array_key_exists($key, $cfg))
        {
            if(is_array($cfg[$key]) || is_array($value))
            {
                if(serialize($cfg[$key]) != serialize($value))
                {
                    updateSetting($key, $value);
                }

            }elseif ($cfg[$key] != $value)
            {
                updateSetting($key, $value);
            }
            else
            {
                // Nothing has Changed..
            }
        }else{
            insertSetting($key,$value);
        }
    }
}

//*********************************************************
function isFile($file)
{
    $rtnValue = False;

    if (is_file($file))
    {
        $rtnValue = True;
    }
    else
    {
        if ($file == trim(shell_exec("ls ".$file)))
        {
            $rtnValue = True;
        }
    }
    return $rtnValue;
}

?>