<?php

require_once (IBSINC."xml.php");
require_once (IBSINC."generator/generator.php");

/**
 */
class XmlGenerator extends Generator
{
    /**
     * @var string
     */
    protected $root;

    /**
     * @var string
     */
    protected $element;

    /**
     * XmlGenerator constructor.
     *
     * @param string $root
     * @param string $element
     */
    public function __construct($root, $element)
    {
        $this->root = $root;
        $this->element = $element;
    }

    /**
     * @param array $array
     *
     * @return string
     */
    public function doArray($array)
    {
        return "<{$this->element}>" . convDicToXML($array) . "</{$this->element}>";
    }

    /**
     * @return string
     */
    public function init()
    {
        return "<{$this->root}>";
    }

    /**
     * @return string
     */
    public function dispose()
    {
        return "</{$this->root}>";
    }
}

