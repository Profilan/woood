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
 * LeerJezelf_Model_Acl is een wrapper om Zend_Acl. Het leest de rechtenregels en vult het Zend_Acl
 * object. De rechten zijn gebaseerd op de module.controller.action structuur. Het vertaalt
 * een deze structuur naar de interne resources structuur van Zend_Acl
 *
 * @author Wouter Tengeler
 */
class LeerJezelf_Model_Acl
{

	private static $_instance = null;

	/**
	 * Het Zend_Acl object dat de rechten regelt
	 * @var Zend_Acl $_acl
	 */
	private $_acl;

	/**
	 * lijst met gedefinieerde rollen
	 * @var array
	 */
	private $_roles;
	/**
	 * Lijst met gedefinieerde regels
	 * @var array
	 */
	private $_rules;
	/**
	 * Lijst met gedefinieerde assertion regels
	 * @var array
	 */
	private $_assertions;

	/**
	 *
	 * @var LeerJezelf_Model_Db_AclMapper
	 */
	private $_mapper;

	/**
	 * singleton implementatie van de Acl-wrapper
	 * @return LeerJezelf_Model_Acl
	 */
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	protected function __construct() {
		$this->_acl = new Zend_Acl();
		$this->_roles = null;
		$this->_rules = null;
		$this->_assertions = null;
		$this->load();
	}

	/**
	 *
	 * @param LeerJezelf_Model_Db_AclConfigMapper $mapper
	 */
	public function setMapper($mapper) {
		$this->_mapper = $mapper;
		return $this;
	}

	/**
	 * geef het ingestelde DataMapper object terug. Als deze nog niet bestaat wordt het aangemaakt
	 * @return LeerJezelf_Model_Db_AclConfigMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new LeerJezelf_Model_Db_AclMapper('LeerJezelf_Model_Db_AclDao'));
		}
		return $this->_mapper;
	}

	/**
	 * Lees de rechten configuratie in
	 */
	public function load() {
		$this->getAssertions();
		$this->initRoles($this->getRoles());
		$this->initRules($this->getRules());
		$this->initAssertions($this->getAssertions());
	}

	/**
	 * Zet alle gedefinieerde rollen in het ACL-object
	 *
	 * @access protected
	 * @param array $roles
	 * @return void
	 */
	protected function initRoles($roles)
	{
		if (is_array($roles)) {
			foreach ($roles as $name => $parents) {
				if (!$this->_acl->hasRole($name)) {
					$this->_acl->addRole(new Zend_Acl_Role($name), $parents);
				}
			}
		}
	}

	/**
	 * Vul het ACL-object met alle gedefinieerde resources en rechten
	 * formaat:
	 * acl.rules.allow.module.controller.action = role[, role] (rollen hebben rechten om action te uit te voeren)
	 * acl.rules.deny.module.controller.action = role[, role] ( rollen hebben geen rechten om action uit te voeren)
	 * acl.rules.allow.module.controller.all = role[, role] ( rollen hebben rechten om alle actions van controller uit te voeren)
	 * acl.assertions.module.controller.action = AssertClass (gegeven Assert-klasse wordt uitgevoerd op action)
	 * acl.rules.allow.module.all = role[, role] ( rollen hebben rechten om alle actions van alle controllers van deze module uit te voeren)
	 * acl.assertions.module.all = AssertClass (gegeven Assert-klasse wordt uitgevoerd op alle controllers van de module)
	 *
	 * Het Zend_Acl systeem ondersteunt geen modules of controllers in de rechtenstructuur. We lossen dit op
	 * door de module en controller als resource toe te voegen en de rechten van de action te zetten.
	 * @access protected
	 * @param array $rules array of StdClass objects containing the rules
	 * @return void
	 * @throws Exception
	 */
	public function initRules($rules)
	{
		if (is_array($rules)) {
			// voeg de allows en deny's toe aan het Acl
			foreach($rules as $rule) {
				// handel alleen geldige permissies af (allow, deny)
				if ((LeerJezelf_Model_Db_AclDao::PERMISSION_DENY == $rule->permission) || (LeerJezelf_Model_Db_AclDao::PERMISSION_ALLOW == $rule->permission)) {
					if ( ($rule->module == LeerJezelf_Model_Db_AclDao::TYPE_ALL) && ($rule->controller == LeerJezelf_Model_Db_AclDao::TYPE_ALL)){
						// module en controller zijn beide 'all'. Resource blijft leeg
						$resource = null;
					} else {
						// maak een resource van de combinatie van module en controller
						$resource = $rule->module.'_'.$rule->controller;
					}
					if (!$this->_acl->has($resource)) {
						$this->_acl->add(new Zend_Acl_Resource($resource));
					}

					// zoek assertion bij deze rule
					$assertionClass = $this->getAssertion($rule->module, $rule->controller, $rule->action);
					$assertion = $this->createAssertionObject($assertionClass);
					
					// als de action 'all' is, krijgt deze de waarde null voor de acl rule
					if ($rule->action == LeerJezelf_Model_Db_AclDao::TYPE_ALL) {
						$rule->action = null;
					}

					if (LeerJezelf_Model_Db_AclDao::PERMISSION_ALLOW == $rule->permission) {
						$this->_acl->allow($rule->role, $resource, $rule->action, $assertion);
						//Zend_Registry::get('logger')->debug(__METHOD__ . ' - added allow: '. $rule->role . ', '.$resource. ', '.$rule->action. ', '.$assertionClass);
					} else {
						$this->_acl->deny($rule->role, $resource, $rule->action, $assertion);
						//Zend_Registry::get('logger')->debug(__METHOD__ . ' - added deny: '. $rule->role . ', '.$resource. ', '.$rule->action. ', '.$assertionClass);
					}
				}
			}
		}
	}

	/**
	 * voeg de assertions toe als aparte allow rules in het Acl-object
	 * Deze methode voegt alleen assertions toe die nog niet in een allow of deny voorkwamen
	 * @param array $assertions
	 */
	public function initAssertions($assertions)
	{
		if (is_array($assertions)) {
			// voeg de allows en deny's toe aan het Acl
			foreach($assertions as $assertion) {
				if ( ($assertion->module == LeerJezelf_Model_Db_AclDao::TYPE_ALL) && ($assertion->controller == LeerJezelf_Model_Db_AclDao::TYPE_ALL)){
					// module en controller zijn beide 'all'. Resource blijft leeg
					$resource = null;
				} else {
					// maak een resource van de combinatie van module en controller
					$resource = $assertion->module.'_'.$assertion->controller;
				}
				// als de action 'all' is, krijgt deze de waarde null voor de acl rule
				if ($assertion->action == LeerJezelf_Model_Db_AclDao::TYPE_ALL) {
					$assertion->action = null;
				}
				//Zend_Registry::get('logger')->debug(__METHOD__ . ' - checking assertion: '.$resource. ', '.(($assertion->action)?$assertion->action:'null'). ', '.$assertion->assertion);
				if (!$this->_acl->has($resource)) {
					$this->_acl->add(new Zend_Acl_Resource($resource));
					// zoek assertion bij deze rule
					$assertionObject = $this->createAssertionObject($assertion->assertion);
					// voeg de assertion toe als allow voor de specifieke resource
					$this->_acl->allow(null, $resource, $assertion->action, $assertionObject);
					//Zend_Registry::get('logger')->debug(__METHOD__ . ' - added assertion: null, '.$resource. ', '.(($assertion->action)?$assertion->action:'null'). ', '.$assertion->assertion);
				}
			}
		}
	}

	/**
	 * retourneert een lijst met alle rollen die zijn gedefinieerd
	 * @return array Array gevuld met StdClass objecten
	 */
	public function getRoles() {
		if (null == $this->_roles) {
			$this->_roles = $this->getMapper()->fetchRoles();
		}
		return $this->_roles;
	}

	/**
	 * retourneert een lijst met alle rules die zijn gedefinieerd
	 * @return array Array gevuld met StdClass objecten
	 */
	public function getRules() {
		if (null == $this->_rules) {
			$this->_rules = $this->getMapper()->fetchResources();
		}
		return $this->_rules;
	}

	/**
	 * retourneert een lijst met assertions
	 * @return array Array gevuld met StdClass objecten
	 */
	public function getAssertions() {
		if (null == $this->_assertions) {
			$this->_assertions = $this->getMapper()->fetchAssertions();
		}
		return $this->_assertions;
	}

	/**
	 * geeft het onderliggende Zend_Acl-object terug
	 * @return Zend_Acl;
	 */
	public function getAcl() {
		return $this->_acl;
	}

	/**
	 * retourneert de naam van de assertion-klasse voor de gegeven module, controller en action
	 * Er wordt een match gezocht in de lijst met assertions. (all matcht op alles)
	 * @param string $module
	 * @param string $controller
	 * @param string $action
	 * @return string De naam van de Assertion-klasse of een lege string als er geen match is
	 */
	public function getAssertion($module, $controller, $action) {
		if (null == $this->_assertions) {
			$this->_assertions = $this->getMapper()->fetchAssertions();
		}
		$assertion = '';
		foreach($this->_assertions as $rule) {
			if (($rule->module != $module) && 
				($rule->module != LeerJezelf_Model_Db_AclDao::TYPE_ALL)) {
				continue;
			}
			if (($rule->controller != $controller) && 
				($rule->controller != LeerJezelf_Model_Db_AclDao::TYPE_ALL)) {
				continue;
			}
			if (($rule->action != $action) && 
				($rule->action != LeerJezelf_Model_Db_AclDao::TYPE_ALL)) {
				continue;
			}
			// we hebben dit punt bereikt, dus de match is correct, stop met verder zoeken
			$assertion = $rule->assertion;
			//Zend_Registry::get('logger')->debug(__METHOD__.  ' match: '. $module. ' = ' .$rule->module. ',  '. $controller. ' = ' .$rule->controller. ',  '. $action. ' = ' .$rule->action. ' => '.$assertion);
			break;

		}
		return $assertion;
	}


	/**
	 * Accessor voor Zend_Acl::has
	 * @param string $resource
	 * @return boolean
	 */
	public function has($resource) {
		return $this->_acl->has($resource);
	}

	/**
	 * Wrapper om Zend_Acl::isAllowed
	 * @param string $role
	 * @param string $module
	 * @param string $controller
	 * @param string $action
	 * @return boolean
	 */
	public function isAllowed($role, $module, $controller, $action) {
		// We bepalen verschillende combinaties van module en controller
		// regels kunnen gedefinieerd zijn als all.controller.action of module.all.action
		$result = false;
		$resource = $module.'_'.$controller;
		if ($this->has($resource)) {
			$result = $this->_acl->isAllowed($role, $resource, $action);
			//Zend_Registry::get('logger')->debug(__METHOD__. ' - '. $resource. ' => '. (($result)?'yes':'no'));
		}
		$resource = 'all_'.$controller;
		if ($this->has($resource)) {
			$result = $this->_acl->isAllowed($role, $resource, $action) || $result;
			//Zend_Registry::get('logger')->debug(__METHOD__. ' - '. $resource. ' => '. (($result)?'yes':'no'));
		}
		$resource = $module.'_all';
		if ($this->has($resource)) {
			$result = $this->_acl->isAllowed($role, $resource, $action) || $result;
			//Zend_Registry::get('logger')->debug(__METHOD__. ' - '. $resource. ' => '. (($result)?'yes':'no'));
		}
		//Zend_Registry::get('logger')->debug(__METHOD__. ' - Final: '. $role. ', '. $module. ', '. $controller. ', '. $action. ' => '. (($result)?'yes':'no'));
		return $result;
	}


	/**
	 * methode om assertionobjecten te cachen en correct te instantieren
	 * @param string $className
	 * @return Zend_Acl_Assert_Interface|null
	 */
	protected function createAssertionObject($className) {
		if (!empty($className)) {
			if (!isset($this->_assertionObjects[$className])) {
				// nieuw, probeer een object te instantieren
				if (Zend_Loader_AutoLoader::autoload($className)) {
					// maak een instantie van de assertion klasse
					$assertion = new $className();
					$this->_assertionObjects[$className] = $assertion;
				} else {
					// instantieren niet gelukt, onthoudt dit voor eventuele volgende aanvragen
					$this->_assertionObjects[$className] = null;
					//Zend_Registry::get('logger')->err(__METHOD__ . ' - Assertion: '.$className. ' not found');
				}
			}
			return $this->_assertionObjects[$className];
		} else {
			return null;
		}
	}

}