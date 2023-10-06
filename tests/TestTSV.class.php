<?php
class TestTSV
{
    public $tsv;


    public function __construct()
    {
        $this->tsv = new TSV('tests/samples/products_tab_separated.tsv');
    }

    public function testHeader($config_count)
    {
        $this->tsv->header();

        $header_columns = count($this->tsv->config_header->header_columns);
        if($header_columns !== $config_count){
            throw new Exception('Assert Error: columns in other config') ;
        } else {
            print( $header_columns . ' columns in config' . PHP_EOL);
        }
        
    }

    public function testRead($unique_count)
    {
        $this->tsv->read();
        $unique = count($this->tsv->unique);

        if($unique !== $unique_count){
            throw new Exception('Assert Error: unique rows read from sample file') ;
        } else {
            print( $unique . ' unique rows read from sample file' . PHP_EOL);
        }
    }

    public function testWrite($line_count)
    {
        $this->tsv->write();

        $lines = $this->getLines();
        if($lines !== $line_count){
            throw new Exception('Assert Error: unique rows read from sample file');
        } else {
            print( $lines . ' lines written' . PHP_EOL);
        }
    }

    private function getLines()
    {
        $f = fopen($this->tsv->file_out, 'rb');
        $lines = 0;

        while (!feof($f)) {
            $lines += substr_count(fread($f, 8192), "\n");
        }

        fclose($f);

        return $lines;
    }

    private function getHeader($file)
    {
        $handle = fopen($file, "r") or die("Couldn't get handle");
        if ($handle) {
            $header = fgetcsv($handle);
            
            fclose($handle);
        }
        return $header;
    }

    public function assertColumnOrder($headerIn)
    {
        $headerOut = $this->getHeader($this->tsv->file_out);

        if($headerIn === $headerOut){
            print( 'Column order matches' . PHP_EOL);
        } else {
            throw new Exception('Assert Error: Column order do not match');
        }
    }

}