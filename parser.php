#!/usr/bin/php
<?php
function parser_autoloader($class) {
    include 'parser/' . $class . '.class.php';
}

spl_autoload_register('parser_autoloader');

$short_options = "f:u::";
$long_options = ["filename:", "unique-combinations::"];
$options = getopt($short_options, $long_options);

if(isset($options['f']))
    $options['filename'] = $options['f'];
if( !isset($options['filename'] ) && !isset($options['f'] ) ){
    throw new Exception('Error: filename is not set');
}

if(isset($options['u']))
    $options['unique-combinations'] = $options['u'];
if( !isset($options['unique-combinations'] ) && !isset($options['u'] ) ){
    $options['unique-combinations'] = null;
}

$path_info = pathinfo($options['filename']);
 
$parserClass = strtoupper($path_info['extension']);

$parser = new $parserClass($options['filename'], $options['unique-combinations']);
 
$parser->process();