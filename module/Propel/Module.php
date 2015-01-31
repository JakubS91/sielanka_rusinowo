<?php
namespace Propel;

use Zend\ModuleManager\ModuleManager;

class Module
{
	public function init(ModuleManager $moduleManager) {
		\Propel::init(__DIR__ . '/config/sielanka_rusinowo-conf.php');
		$con = \Propel::getConnection();
		$con->useDebug(true);
		set_include_path(__DIR__ . '/src/Propel/Models' . PATH_SEPARATOR . get_include_path());
	}

	public function getAutoloaderConfig() {
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
		);
	}
}