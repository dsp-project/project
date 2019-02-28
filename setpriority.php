<?php

function getFile($var)
{
    if ($var < 65535)
        return true;
    else
        return false;
}

//*********************************************************
// setPriority()
function setPriority($torrent)
{
    global $cfg;

    // we will use this to determine if we should create a prio file.
    // if the user passes all 1's then they want the whole thing.
    // so we don't need to create a prio file.
    // if there is a -1 in the array then they are requesting
    // to skip a file. so we will need to create the prio file.

    $okToCreate = false;

    if(!empty($torrent))
    {

        $alias = getAliasName($torrent);
        $fileName = $cfg["torrent_file_path"].$alias.".prio";

        $result = array();

        $files = array_filter($_REQUEST['files'],"getFile");

        // if there are files to get then process and create a prio file.
        if (count($files) > 0)
        {
            for($i=0;$i<getRequestVar('count');$i++)
            {
                if(in_array($i,$files))
                {
                    array_push($result,1);
                }
                else
                {
                    $okToCreate = true;
                    array_push($result,-1);
                }
            }
            $alias = getAliasName($torrent);

            if ($okToCreate)
            {
                $fp = fopen($fileName, "w");
                fwrite($fp,getRequestVar('filecount').",");
                fwrite($fp,implode($result,','));
                fclose($fp);
            }
            else
            {
                // No files to skip so must be wanting them all.
                // So we will remove the prio file.
                @unlink($fileName);
            }
        }
        else
        {
            // No files selected so must be wanting them all.
            // So we will remove the prio file.
            @unlink($fileName);
        }
    }
}

?>
