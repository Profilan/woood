<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoloader()
	{
		// namespace '' voegen we toe zodat we voor onze model classes geen modulenaam in de prefix hoeven op te nemen
		// helaas kunnen we geen lege namespace in application.ini plaatsen
		$autoloader = new Zend_Application_Module_Autoloader(array(
				'namespace' => 'Site_',
				'basePath' => APPLICATION_PATH,
		));
	}
	protected function _initBrowser()
	{
		// ie browser
		$browser = array();
		if (array_key_exists('HTTP_USER_AGENT', $_SERVER) && preg_match('/(MSIE\\s?([\\d\\.]+))/', $_SERVER['HTTP_USER_AGENT'], $matches)) {
			$browser['ie8'] = intval($matches[2]) == 8;
			$browser['ie7'] = intval($matches[2]) == 7;
			$browser['ie6'] = intval($matches[2]) == 6;
		}
		return $browser;
	}
	
	protected function _initDatabase()
	{
		$resource = $this->getPluginResource('multidb');
		$resource->init();
	
		// Zend_Registry::set('db', $resource->getDb('db'));
		Zend_Registry::set('db1', $resource->getDb('db1'));
		$db2 = $resource->getDb('db2');
		Zend_Registry::set('db2', $resource->getDb('db2'));
		Zend_Registry::set('db3', $resource->getDb('db3'));
	}
	
	protected function _initHtml()
	{
		// we bootstrappen de view. Dit is een dependency.
		// Als hij al gebootstrapt is gebeurt er niks
		$this->bootstrap('view');
		$view = $this->getResource('view');
	
		// haal de opties uit application.ini op
		$options = $this->getOptions();
		if (isset($options['resources']['view']['doctype'])) {
			$view->doctype($options['resources']['view']['doctype']);
		}
		if (isset($options['resources']['view']['encoding'])) {
			$view->setEncoding($options['resources']['view']['encoding']);
		}
		if (isset($options['resources']['view']['contentType'])) {
			$view->headMeta()->appendHttpEquiv('Content-Type',
					$options['resources']['view']['contentType']);
		}
		if (isset($options['resources']['view']['keywords'])) {
			$view->headMeta()->appendName('keywords', $options['resources']['view']['keywords']);
		}
	}	
	
	protected function _initCss()
	{
		// we bootstrappen de view. Dit is een dependency.
		// Als hij al gebootstrapt is gebeurt er niks
		$this->bootstrap('view');
		// We halen de view uit de bootstrap container. Is hetzelfde object als in de viewrenderer
		$view = $this->getResource('view');
	
		// voeg de stylesheet toe aan de view resource
		$view->headLink()->appendStylesheet('/css/template.css');
	}
	
	protected function _initJavascript()
	{
		// we bootstrappen de view. Dit is een dependency.
		// Als hij al gebootstrapt is gebeurt er niks
		$this->bootstrap('view');
	
		// We halen de view uit de bootstrap container.
		// Is hetzelfde object als in de viewrenderer
		$view = $this->getResource('view');
	
		// Gebruik Bootstrap template (http://twitter.github.com/bootstrap
		$view->headScript()->appendFile('/js/jquery/jquery-1.9.0.min.js');
		$view->headScript()->appendFile('/js/bootstrap.min.js');
		
		// controleer de browser
		$this->bootstrap('browser');
		$browser = $this->getResource('browser');
	
		if (array_key_exists('ie6', $browser) || array_key_exists('ie7', $browser) || array_key_exists('ie8', $browser)) {
			if ($browser['ie6'] || $browser['ie7'] || $browser['ie8']) {
				// geen html5
				$view->headScript()->appendFile(
						'http://html5shim.googlecode.com/svn/trunk/html5.js'
				);
			}
		}
	
		// $view->headScript()->appendFile('/js/common.js');
	
	}	
	/**
	 * We willen sessions gaan gebruiken voor tijdelijke opslag.
	 * We starten altijd het session mechanisme.
	 */
	protected function _initAutoStartSession() {
		// zorg dat de session-sectie uit de application.ini eerst wordt geinitialiseerd
		$this->bootstrap('session');
		Zend_Session::start();
	}
	

}

