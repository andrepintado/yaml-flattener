<?php

// field separator is tab
define("FIELD_SEPARATOR", chr(9));

// first argument is input file.
if (isset($argv[1])) {
    $file = $argv[1];
} else {
    die('No input file specified.' . PHP_EOL);
}

// second argument is output file or non-existent.
// initializing global vars.
if (isset($argv[2])) {
    $outputToFile = true;
    $outputToCli = false;
    $outputFile = fopen($argv[2], 'w') or die('Error trying to write to output file.' . PHP_EOL);
} else {
    $outputToFile = false;
    $outputToCli = true;
    $outputCli = '';
}

// parsing yaml file into array.
if (function_exists('yaml_parse_file')) {
    $fileInArray = yaml_parse_file($file);
} else {
    die('YAML extension is not installed.' . PHP_EOL);
}


// iterating in the root nodes.
foreach ($fileInArray as $key => $value) {
    flatten($key, $value);
}

// iterative function.
function flatten($key, $object)
{
    if (is_array($object)) {
        foreach ($object as $objectKey => $objectValue) {
            if (is_array($objectValue)) {
                flatten($key . '.' . $objectKey, $objectValue);
            } else {
                prepareOutput($key . '.' . $objectKey, $objectValue);
            }
        }
    } else {
        prepareOutput($key, $object);
    }
}

// sending output to the output vars in the correct format.
function prepareOutput($key, $value)
{
    global $outputCli, $outputFile, $outputToCli, $outputToFile;

    if ($outputToFile) {
        $line = sprintf("%s%s%s%s", PHP_EOL, $key, FIELD_SEPARATOR, $value);
        fwrite($outputFile, $line);
    }

    if ($outputToCli) {
        $outputCli .= sprintf("%s%s%s%s", PHP_EOL, $key, FIELD_SEPARATOR, $value);
    }
}


// outputing.
if ($outputToFile) {
    fclose($outputFile);
}

if ($outputToCli) {
    echo $outputCli;
}

return;
