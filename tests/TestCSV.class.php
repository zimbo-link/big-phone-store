<?php
class TestCSV
{
    public $csv;


    public function __construct()
    {
        $this->csv = new CSV('tests/samples/products_comma_separated.csv');
    }

    public function testHeader($config_count)
    {
        $this->csv->header();

        $header_columns = count($this->csv->config_header->header_columns);
        if($header_columns !== $config_count){
            throw new Exception('Assert Error: columns in other config') ;
        } else {
            print( $header_columns . ' columns in config' . PHP_EOL);
        }
        
    }

    public function testRead($unique_count)
    {
        $this->csv->read();
        $unique = count($this->csv->unique);

        if($unique !== $unique_count){
            throw new Exception('Assert Error: unique rows read from sample file') ;
        } else {
            print( $unique . ' unique rows read from sample file' . PHP_EOL);
        }
    }

    public function testWrite($line_count)
    {
        $this->csv->write();

        $lines = $this->getLines();
        if($lines !== $line_count){
            throw new Exception('Assert Error: unique rows read from sample file');
        } else {
            print( $lines . ' lines written' . PHP_EOL);
        }
    }

    private function getLines()
    {
        $f = fopen($this->csv->file_out, 'rb');
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
        $headerOut = $this->getHeader($this->csv->file_out);

        if($headerIn === $headerOut){
            print( 'Column order matches' . PHP_EOL);
        } else {
            throw new Exception('Assert Error: Column order do not match');
        }
    }

}