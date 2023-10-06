<?php
class Parser {

    public $file_in;
    public $file_out;
    public array $unique;
    public array $file_header;
    public object $config_header;

    function __construct($file_in, $file_out = null) {
        $this->file_in = $file_in;
        $this->file_out = $file_out ?? 'output.csv';
        $this->unique = [];
        
    }

    /*
        Ensure the correct order of columns
    */
    function column_order($column){
        foreach($this->config_header->header_columns as $key => $value){
            if($column == $value){
                return $key;
            }
        }
        throw new Exception('Invalid Configuration:' . $column);
    }
    
    function write() {
  
        $fp = fopen($this->file_out, 'w');
 
        foreach($this->file_header as $column){  
            fwrite($fp, $this->column_order($column) . ',');
        }

        fwrite($fp, 'count');
        fwrite($fp, "\r\n"); 

        foreach ($this->unique as $fields) { 
            fwrite($fp, implode(',', $fields) . "\r\n");
        }
        fclose($fp);
    }
}