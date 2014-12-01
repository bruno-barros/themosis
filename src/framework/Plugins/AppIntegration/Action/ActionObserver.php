<?php
namespace Framework\Plugins\AppIntegration\Action;

interface ActionObserver
{
    /**
     * Trigger method
    */
	public function update();
}