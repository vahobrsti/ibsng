<?php

/**
 *
 * creator.php
 *
 * */
class Creator
{
    /** @var Controller|null */
    protected $controller;

    /**
     * Initializes variables.
     */
    public function init()
    {
        $this->controller = null;
    }


    public function registerController( &$controller)
    {
        $this->controller = &$controller;
    }

    /**
     * This method will be called at the end of generation.
     * You can override this in subclasses.
     */
    public function dispose()
    {
        // Implementation in subclasses if needed.
    }
}
