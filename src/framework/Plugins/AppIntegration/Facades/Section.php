<?php
namespace Framework\Plugins\AppIntegration\Facades;

class Section extends Facade{

    /**
     * Return the igniter service key responsible for the Section class.
     * The key must be the same as the one used in the assigned
     * igniter service.
     *
     * @return string
     */
    protected static function getFacadeKey()
    {
        return 'sections';
    }

} 