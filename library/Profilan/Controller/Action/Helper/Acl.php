<?php
/**
 * weblog-12.0
 * 
 * Deze broncode is onderdeel van het weblog-voorbeeld uit het boek 
 * "Leer jezelf Professioneel werken met het Zend Framework".
 * U mag deze broncode gebruiken voor uw eigen projecten onder de voorwaarde
 * dat dit commentaarblock gehandhaafd blijft. U bent vrij de broncode aan
 * te passen en uit te breiden voor uw eigen doeleinden
 * De auteurs bieden geen garantie voor de correcte werking van de broncode.
 * 
 * @copyright Copyright (c) 2010 Leer Jezelf Professioneel Zend Framework
 * @license http://framework.zend.com/license/new-bsd New BSD License
 * @author Wouter Tengeler <wouter@leerjezelf-zendframework.nl>
 * @author Matthijs van den Bos <matthijs@leerjezelf-zendframework.nl>
 * @link http://www.leerjezelf-zendframework.nl
 * @category LeerJezelf
 * @version weblog-12.0
 */


/**
 * action helper om de gebruikerrechten te configureren
 * @package LeerJezelf_Controller_Action_Helper
 * @author Wouter Tengeler
 *
 */
class LeerJezelf_Controller_Action_Helper_Acl extends Zend_Controller_Action_Helper_Abstract {
	/**
	 * Model object dat de rechten configuratie bevat
	 * @var LeerJezelf_Model_Acl
	 */
	protected $_acl;
	/**
	 * Start de configuratie van de rechten van gebruikers
	 *
	 * @access public
	 * @return void
	 */
	public function init()
	{
		$this->_acl = LeerJezelf_Model_Acl::getInstance();
	}

	/**
	 * De predispatch van de action helper wordt als eerste uitgevoerd. Hierdoor worden
	 * alle rechten gezet voordat de Controller-Action wordt uitgevoerd
	 *
	 * @access public
	 * @return void
	 */
	 /*
	public function preDispatch()
	{
		// start de autentication van een ingelogde gebruiker
		$auth = Site_Model_Authentication::getInstance();

		// Haal de gegevens van de ingelogde gebruiker op
		if ($auth->isLoggedIn()) {
			$role = $auth->getUser()->getRole();
		} else {
			// zet de standaard rol is (guest)
			$role = Site_Model_Authentication::DEFAULT_ROLE;
		}

		// We halen de huidige Controller en Action op
		$module = $this->getFrontController()->getRequest()->getModuleName();
		$controller = $this->getFrontController()->getRequest()->getControllerName();
		$action = $this->getFrontController()->getRequest()->getActionName();

		// heeft de huidige gebruiker met zijn rol rechten om de gevraagde action uit te voeren
		if (!$this->_acl->isAllowed($role, $module, $controller, $action)) {
			Zend_Registry::get('logger')->debug(__METHOD__. ' - not allowed: '.$role .',  '.$module .',  '.$controller .',  '.$action);
			// geen rechten, redirect naar 'not allowed' pagina
			//$this->getActionController()->_forward('not-allowed', 'authentication', 'admin');
			$this->getActionController()->getHelper('Redirector')->gotoSimple('not-allowed', 'authentication', 'admin');
		}
		
	}
	*/
	
	/**
	 * Nadat alle acties zijn uitgevoerd, zet de inlog status en de huidige gebruiker in het View-object
	 */
	public function postDispatch() {
		$auth = Site_Model_Authentication::getInstance();
		$this->getActionController()->view->loggedIn = $auth->isLoggedIn();
		if ($auth->isLoggedIn()) {
			$this->getActionController()->view->user = $auth->getUser();
		}
	}
}