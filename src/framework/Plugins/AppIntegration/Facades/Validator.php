<?php
namespace Framework\Plugins\AppIntegration\Facades;

class Validator extends Facade {

    /**
     * Each facade must define their igniter service
     * class key name.
     *
     * @throws \RuntimeException
     * @return string
     */
    protected static function getFacadeKey()
    {
        return 'validation';
    }

} 