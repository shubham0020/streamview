<?php 

namespace App\Helpers;

use Exception, File, Log, Storage, Setting, DB;

class ConvertSubtitle {
	private $file;
    private $fileContent;
    private $encode;

    function __construct($file) {

      	$this->file = $file;

      	try {

	        $handle = fopen($this->file, "r");

	        $this->fileContent = file_get_contents("/Volumes/Vidhya-HD/Repo/streamhash/streamview/streamview-backend-base-version-upgrade/public/uploads/subtitles/SV-2020-10-07-11-01-59-e616a1b1842b1afd0edb22b8a33240cfe4b43609.srt");

	        $this->encode = mb_detect_encoding($this->fileContent);

      	} catch (Exception $e) {

      		\Log::info("error_log1".$e->getMessage());

          	throw new Exception("Cannont open this file");
      	}

    }

    function setOutFormat($format) {

      	$this->outFormat = $format;

    }

    private function split($contents) {

       	$lines = explode("\n", $contents);
        if (count($lines) === 1) {
            $lines = explode("\r\n", $contents);
            if (count($lines) === 1) {
                $lines = explode("\r", $contents);
            }
        }
        return $lines;
    }

    //convert subtitles from <WEBVTT> to <SRT>
    function convert() {
		$lines = $this->split($this->fileContent);
		array_shift($lines); // removes the WEBVTT header
		$output = '';
		$i = 0;
      	
      	foreach ($lines as $line) {
	        $pattern1 = '#(\d{2}):(\d{2}):(\d{2})\.(\d{3})#'; // '00:00:00.000'
	        $pattern2 = '#(\d{2}):(\d{2})\.(\d{3})#'; // '00:00.000'
	        $m1 = preg_match($pattern1, $line);
			if (is_numeric($m1) && $m1 > 0) {
				$i++;
				$output .= $i;
				$output .= PHP_EOL;
				$line = preg_replace($pattern1, '$1:$2:$3,$4' , $line);
			} else {
          		$m2 = preg_match($pattern2, $line);
				if (is_numeric($m2) && $m2 > 0) {
					$i++;
					$output .= $i;
					$output .= PHP_EOL;
					$line = preg_replace($pattern2, '00:$1:$2,$3', $line);
				}
        	}
       		$output .= $line . PHP_EOL;
      	}
      	$this->output = $output;
    
    }

    //Create the output File
    public function save($fileName) {

    	Log::info("FileName".$fileName);
      	try {
        	if($this->encode == "UTF-8")
          		$this->output = mb_convert_encoding($this->output, 'ISO-8859-1', 'UTF-8');

	        $handle = fopen($fileName, "w");
	        fwrite($handle, $this->output);
		} catch (Exception $e) {

      		\Log::info("error_log111".$e->getMessage());

			throw new Exception("Not saved");
		}

    }
}
