<?php

/**
 * Class GeneratorController
 */
class GeneratorController
{
    protected $smarty;
    protected $creator;
    protected $generator;
    protected $__generators = [];

    /**
     * GeneratorController constructor.
     */
    public function __construct()
    {
        $this->init();
        $this->smarty = new IBSSmarty();
        $this->creator = $this->getCreator();
        $this->creator->registerController($this);
        $this->generator = $this->getGenerator();
    }

    /**
     * Initialize generators array.
     */
    protected function init()
    {
        $this->__generators = [];
    }

    /**
     * Display output view.
     */
    public function display()
    {
        $this->creator->create();
    }

    /**
     * Get report result and needed variables from it.
     *
     * @param array $results
     */
    public function extractVarsFromResults(&$results)
    {
    }

    /**
     * Abstract function to get Creator.
     *
     * @return Creator|null
     */
    protected function getCreator()
    {
        return null;
    }

    /**
     * Abstract function to get Generator.
     *
     * @return Generator|null
     */
    protected function getGenerator()
    {
        return null;
    }

    /**
     * Get report selectors.
     *
     * @param string $beginExpression
     * @return array
     */
    public function getReportSelectors($beginExpression = "show__")
    {
        $selectors = [];
        $searchReplace = ["_" => " ", "SLASH" => "/"];

        foreach ($_REQUEST as $fieldName => $fieldFormula) {
            if (preg_match("/^" . $beginExpression . ".*/", $fieldFormula)) {
                $selectors[str_replace(array_keys($searchReplace), array_values($searchReplace), $fieldName)] = $fieldFormula;
            }
        }

        return $selectors;
    }

    /**
     * Register a generator.
     *
     * @param string $generatorName
     * @param string $generatorFunction
     */
    public function registerGenerator($generatorName, $generatorFunction)
    {
        $this->__generators = array_merge([$generatorName => $generatorFunction], $this->__generators);
    }

    /**
     * Get registered generators.
     *
     * @return array
     */
    public function getGenerators()
    {
        return $this->__generators;
    }
}
