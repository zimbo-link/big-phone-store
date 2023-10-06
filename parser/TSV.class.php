<?php
class TSV extends Parser {

    function __construct($file_in, $file_out = null) {
        parent::__construct($file_in, $file_out);
        $this->handle = fopen($this->file_in, "r") or die("Couldn't get handle");
    }

    function __destruct() {
        fclose($this->handle);
    }

    function header() {
        $this->config_header = new Header; 
        if($this->handle){
            $first_line = fgetcsv($this->handle);
            
            $this->file_header = str_getcsv($first_line[0], "\t", "\"");
            
            foreach($this->config_header->required_columns as $required){
                if( !in_array( $required, $this->file_header ) ){
                    print_r($this->config_header->required_columns);
                    throw new Exception('Required column does not exist:' . $required);
                }
            }
        }
    }

    function read() {
        if ($this->handle) {
            while (!feof($this->handle)) {
                $line = fgets($this->handle);

                if(empty($line))
                    continue; 

                $arr = str_getcsv($line, "\t", "\"");

                $md5 = md5($line);

                if (array_key_exists($md5, $this->unique)) {
                    $this->unique[$md5][count($arr)]++;
                } else {
                    $arr[count($arr)] = 1;
                    $this->unique[$md5] = $arr;
                }
            }
        }
    }
 
    function process() {
        $this->header();
        $this->read();
        $this->write();
    }
}