<?php

require_once (IBSINC."csv.php");
require_once (IBSINC."generator/header_generator.php");

/**
 * used to crate CSV output
 */
class OutputCSVGenerator extends Generator
{
    /**
     * @var CSVGenerator
     */
    protected $csv;

    /**
     * OutputCSVGenerator constructor.
     *
     * @param string $csv
     * @param string $file_name
     */
    public function __construct($csv, $file_name)
    {
        HeaderGenerator::assignHeader("TEXT", $file_name);
        $this->csv = new CSVGenerator($csv);
    }

    /**
     * @param array $array
     */
    public function doArray($array)
    {
        $this->csv->doArray($array);
    }
}

