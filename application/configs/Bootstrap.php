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
	
	/**
	 * Initialiseer het View-object met de gegevens in de resources.view uit de application.ini
	 * @return void
	 */
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
		// controleer de browser
		$this->bootstrap('browser');
		$browser = $this->getResource('browser');
		
		if (array_key_exists('ie6', $browser) || array_key_exists('ie7', $browser) || array_key_exists('ie8', $browser)) {
			if ($browser['ie6'] || $browser['ie7'] || $browser['ie8']) {
				// geen html5
		        $view->doctype('XHTML1_STRICT');
			}
		}
	}

	/**
	 * initialiseer de CSS-stylesheets
	 * @return void
	 */
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
	
    /**
     * initialiseer de Javascript bestanden
     * @return void
     */
    protected function _initJavascript()
    {
        // we bootstrappen de view. Dit is een dependency.
        // Als hij al gebootstrapt is gebeurt er niks
        $this->bootstrap('view');

        // We halen de view uit de bootstrap container.
        // Is hetzelfde object als in de viewrenderer
        $view = $this->getResource('view');
		
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
                
        // voeg de JQuery javascript toe aan de view resource
        $view->headScript()->appendFile(
        	'/js/jquery-1.6.4.js'
        );

        // voeg de JQuery javascript toe aan de view resource
        $view->headScript()->appendFile(
        	'/js/jquery-ui-1.8.13.custom.min.js'
        );
        $view->headScript()->appendFile(
        	'/js/jquery.cooki.js'
        );
        $view->headScript()->appendFile(
        	'/js/plugins/jquery.hoverIntent.minified.js'
        );
        $view->headScript()->appendFile(
        	'/js/callApi.js'
        );
    	$view->headScript()->appendFile(
        	'/js/site.js'
        );
    }
	
	protected function _initDbAdapter()
	{
		$this->bootstrap('db');
		
		$db = $this->getResource('db');
		if ($db != null) {
			Zend_Registry::set('db', $db);
		} else {
			throw new Exception('cannot create database adapter');
		}
		
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
	}
	
	
	/**
	 * registreer Action Helpers zodat deze worden uitgevoerd
	 */
	protected function _initActionHelpers() {
		// zorg dat de logger is geinitialiseerd voordat de helper wordt aangeroepen.
		// Dan kunnen we log informatie opnemen in de helper
		$this->bootstrap('logger');
		Zend_Controller_Action_HelperBroker::addHelper(new Profilan_Controller_Action_Helper_Configuration());
		Zend_Controller_Action_HelperBroker::addHelper(new Profilan_Controller_Action_Helper_Acl());
		Zend_Controller_Action_HelperBroker::addHelper(new Profilan_Controller_Action_Helper_Navigation());
		Zend_Controller_Action_HelperBroker::addHelper(new Profilan_Controller_Action_Helper_Submenu());
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
	
	protected function _initTranslationShortcut()
	{
		$this->bootstrap('locale');
		$this->bootstrap('translate');
		
	}

}

