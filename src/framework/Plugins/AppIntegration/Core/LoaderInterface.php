<?php
namespace Framework\Plugins\AppIntegration\Core;

interface LoaderInterface
{
	/**
	 * Build the path where the class has to scan
	 * the files.
	 */
	public static function add();
}