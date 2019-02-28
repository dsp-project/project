<?php

class AliasFile
{
    var $theFile;

    // File Properties
    var $running = "1";
    var $percent_done = "0.0";
    var $time_left = "";
    var $down_speed = "";
    var $up_speed = "";
    var $sharing = "";
    var $torrentowner = "";
    var $seeds = "";
    var $peers = "";
    var $seedlimit = "";
    var $uptotal = "";
    var $downtotal = "";
    var $size = "";
    var $errors = array();

    function AliasFile( $inFile, $user="" )
    {
        $this->theFile = $inFile;
        
        if ($user != "")
        {
            $this->torrentowner = $user;
        }

        if(file_exists($inFile))
        {
            // read the alias file
            $arStatus = file($inFile);
            $this->running = trim($arStatus[0]);
            $this->percent_done = trim($arStatus[1]);
            $this->time_left = trim($arStatus[2]);
            $this->down_speed = trim($arStatus[3]);
            $this->up_speed = trim($arStatus[4]);
            $this->torrentowner = trim($arStatus[5]);
            $this->seeds = trim($arStatus[6]);
            $this->peers = trim($arStatus[7]);
            $this->sharing = trim($arStatus[8]);
            $this->seedlimit = trim($arStatus[9]);
            $this->uptotal = trim($arStatus[10]);
            $this->downtotal = trim($arStatus[11]);
            $this->size = trim($arStatus[12]);

            if (sizeof($arStatus) > 13)
            {
                for ($inx = 13; $inx < sizeof($arStatus); $inx++)
                {
                    array_push($this->errors, $arStatus[$inx]);
                }
            }
        }
        else
        {
            // this file does not exist (yet)
        }
    }

    //----------------------------------------------------------------
    // Call this when wanting to create a new alias and/or starting it
    function StartTorrentFile()
    {
        // Reset all the var to new state (all but torrentowner)
        $this->running = "1";
        $this->percent_done = "0.0";
        $this->time_left = "Starting...";
        $this->down_speed = "";
        $this->up_speed = "";
        $this->sharing = "";
        $this->seeds = "";
        $this->peers = "";
        $this->seedlimit = "";
        $this->uptotal = "";
        $this->downtotal = "";
        $this->errors = array();

        // Write to file
        $this->WriteFile();
    }

    //----------------------------------------------------------------
    // Call this when wanting to create a new alias and/or starting it
    function QueueTorrentFile()
    {
        // Reset all the var to new state (all but torrentowner)
        $this->running = "3";
        $this->time_left = "Waiting...";
        $this->down_speed = "";
        $this->up_speed = "";
        $this->seeds = "";
        $this->peers = "";
        $this->errors = array();

        // Write to file
        $this->WriteFile();
    }


    //----------------------------------------------------------------
    // Common WriteFile Method
    function WriteFile()
    {
        $fw    = fopen($this->theFile,"w");
        fwrite($fw, $this->BuildOutput());
        fclose($fw);
    }

    //----------------------------------------------------------------
    // Private Function to put the variables into a string for writing to file
    function BuildOutput()
    {
        $output  = $this->running."\n";
        $output .= $this->percent_done."\n";
        $output .= $this->time_left."\n";
        $output .= $this->down_speed."\n";
        $output .= $this->up_speed."\n";
        $output .= $this->torrentowner."\n";
        $output .= $this->seeds."\n";
        $output .= $this->peers."\n";
        $output .= $this->sharing."\n";
        $output .= $this->seedlimit."\n";
        $output .= $this->uptotal."\n";
        $output .= $this->downtotal."\n";
        $output .= $this->size;
        for ($inx = 0; $inx < sizeof($this->errors); $inx++)
        {
            if ($this->errors[$inx] != "")
            {
                $output .= "\n".$this->errors[$inx];
            }
        }
        return $output;
    }

    //----------------------------------------------------------------
    // Public Function to display real total download in MB
    function GetRealDownloadTotal()
    {
        return (($this->percent_done * $this->size)/100)/(1024*1024);
    }
}

?>
