<?php
require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

\Tracy\Debugger::$maxDepth = 10;
\Tracy\Debugger::$maxLen = 500;

$configurator->setDebugMode('127.0.0.1'); // enable for your remote IP
$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon', \Nette\Configurator::AUTO);
$container = $configurator->createContainer();


/** Flashes */
define("FLASH_SUCCESS", "success|check");
define("FLASH_WARNING", "warning|warning");
define("FLASH_FAILED", "danger|remove");
define("FLASH_INFO", "info|info");

return $container;