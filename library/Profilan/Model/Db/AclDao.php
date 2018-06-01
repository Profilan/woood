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
 * Data Access klasse voor toegangsrechten (Acl)
 *
 * @author Wouter Tengeler
 */
class LeerJezelf_Model_Db_AclDao {
	const TYPE_ALL = 'all';
	const TYPE_ASSERTIONS = 'assertions';
	const TYPE_ROLES = 'roles';
	const TYPE_RULES = 'rules';

	const PERMISSION_DENY = 'deny';
	const PERMISSION_ALLOW = 'allow';
	const PERMISSION_ASSERT = 'assert';

	const LEVEL_PERMISSION = 'permission';
	const LEVEL_MODULE = 'module';
	const LEVEL_CONTROLLER = 'controller';
	const LEVEL_ACTION = 'action';
	/**
	 * De naam van het bestand van de configuratie
	 * @var string
	 */
	protected $_name;
	
	/**
	 * bevat de ingelezen en geparsde Acl gegevens 
	 * @var array
	 */
	protected $_data;
	
	/**
	 * constructor
	 */
	public function __construct() {
		// Zet het pad naar het configuratiebestand van de Acl
		$this->_name = APPLICATION_PATH . '/configs/acl.ini';
		$this->_data = null;
	}

	/**
	 * Haal alle Acl gegevens op, eventueel gefilterd op type
	 */
	public function fetchAll($type = null) {
		if (null == $this->_data) {
			$this->readIni();
		}
		switch ($type) {
			case self::TYPE_ROLES :
				return $this->_data[self::TYPE_ROLES];
				break;
			case self::TYPE_RULES :
				return $this->_data[self::TYPE_RULES];
				break;
			case self::TYPE_ASSERTIONS :
				return $this->_data[self::TYPE_ASSERTIONS];
				break;
			default : return $this->_data;
		}

	}

	/**
	 * Leest het ini-bestand en maakt een array van de gegevens
	 * formaat:
	 * rules.allow.module.controller.action = role[, role] (rollen hebben rechten om action te uit te voeren)
	 * rules.deny.module.controller.action = role[, role] ( rollen hebben geen rechten om action uit te voeren)
	 * rules.allow.module.controller.all = role[, role] ( rollen hebben rechten om alle actions van controller uit te voeren)
	 * assertions.module.controller.action = AssertClass (gegeven Assert-klasse wordt uitgevoerd op action)
	 * rules.allow.module.all = role[, role] ( rollen hebben rechten om alle actions van alle controllers van deze module uit te voeren)
	 * assertions.module.all = AssertClass (gegeven Assert-klasse wordt uitgevoerd op alle controllers van de module)
	 * @return array
	 */
	protected function readIni() {
		$this->_data = array(self::TYPE_ROLES => array(), self::TYPE_RULES => array(), self::TYPE_ASSERTIONS => array());

		$config = new Zend_Config_Ini($this->_name);
		if ($config instanceof Zend_Config) {
			$property = self::TYPE_ROLES;
			$roles = $config->acl->$property;
			$property = self::TYPE_RULES;
			$rules = $config->acl->$property;
			$property = self::TYPE_ASSERTIONS;
			$assertions = $config->acl->$property;
			// lees de roles uit de configuratie en plaats deze in de data-array
			foreach ($roles as $name => $parents) {
				if (!isset($this->_data[self::TYPE_ROLES][$name])) {
					if (empty($parents)) {
						$parents = null;
					} else {
						$parents = explode(',', $parents);
					}
					$this->_data[self::TYPE_ROLES][$name] = $parents;
				}
			}
			// lees de rules uit de configuratie en plaats deze in de data-array als losse records
			foreach ($rules as $permission => $modules) {
				$row = $this->createRuleObject(new StdClass());
				$this->handleConfig(self::LEVEL_PERMISSION, $permission, $modules, $row);
			}
			foreach($assertions as $module => $controllers) {
				$row = $this->createRuleObject(new StdClass());
				$row->permission = self::PERMISSION_ASSERT;
				$this->handleConfig(self::LEVEL_MODULE, $module, $controllers, $row);
			}
			//Zend_Registry::get('logger')->debug(__METHOD__. ' - config: '.print_r($this->_data, true));
		}
	}
	
	/**
	 * Recursieve methode voor het afhandelen van configuratie elementen
	 *
	 * @param string $level
	 * @param string $name
	 * @param Zend_Config|string $config
	 * @param StdClass $row
	 */
	protected function handleConfig($level, $name, $config, StdClass $row) {
		if (is_string($config)) {
			//Zend_Registry::get('logger')->debug(__METHOD__.' - level: '.$level. ', name: '. $name. ', config: '.$config);
			// config is een string, $name is laatste element in de configuratie bv (.deny.module.all = role)
			$roles = explode(',', $config);
			foreach ($roles as $role) {
				$role = trim($role);
				switch ($level) {
					case self::LEVEL_PERMISSION :
						// permission mag niet het laatste element zijn ( .deny = role)
						// negeer deze entry
						continue;
						break;
					case self::LEVEL_MODULE :
						$row->module = $name;
						break;
					case self::LEVEL_CONTROLLER :
						$row->controller = $name;
						break;
					case self::LEVEL_ACTION :
						$row->action = $name;
						break;
				}
				// kloon het row object
				$newRow = $this->createRuleObject($row);
				switch ($newRow->permission) {
					case self::PERMISSION_ALLOW :
					case self::PERMISSION_DENY :
						$newRow->role = $role;
						// voeg het object toe aan de lijst
						$this->_data[self::TYPE_RULES][] = $newRow;
						break;
					case self::PERMISSION_ASSERT :
						$newRow->assertion = $role;
						// voeg het object toe aan de lijst met assertions
						$this->_data[self::TYPE_ASSERTIONS][] = $newRow;
						break;
					default :
						// ongeldige permissie, negeer deze entry
				}
			}
		} else {
			//Zend_Registry::get('logger')->debug(__METHOD__.' - level: '.$level. ', name: '. $name);
			// $name bevat naam van element
			switch ($level) {
				case self::LEVEL_PERMISSION :
					$row->permission = $name;
					foreach ($config as $module => $controllers) {
						$this->handleConfig(self::LEVEL_MODULE, $module, $controllers, $row);
					}
					break;
				case self::LEVEL_MODULE :
					$row->module = $name;
					foreach ($config as $controller => $actions) {
						$this->handleConfig(self::LEVEL_CONTROLLER, $controller, $actions, $row);
					}
					break;
				case self::LEVEL_CONTROLLER :
					$row->controller = $name;
					foreach ($config as $action => $roles) {
						$this->handleConfig(self::LEVEL_ACTION, $action, $roles, $row);
					}
					break;
				case self::LEVEL_ACTION :
					// action moet het laatste level zijn, $config moet een string zijn
					// negeer deze entry
					break;
			}
		}
	}

	/**
	 * creeer een container object van het type StdClass, kopieer alle waarden in het gegeven basis-object
	 * @param StdClass $base
	 * @return StdClass
	 */
	protected function createRuleObject(StdClass $base) {
		$new = new StdClass();
		if (isset($base->permission)) {
			$new->permission = $base->permission;
		} else {
			$new->permission = '';
		}
		if (isset($base->module)) {
			$new->module = $base->module;
		} else {
			$new->module = self::TYPE_ALL;
		}
		if (isset($base->controller)) {
			$new->controller = $base->controller;
		} else {
			$new->controller = self::TYPE_ALL;
		}
		if (isset($base->action)) {
			$new->action = $base->action;
		} else {
			$new->action = self::TYPE_ALL;
		}
		if (isset($base->role)) {
			$new->role = $base->role;
		} else {
			$new->role = null;
		}
		if (isset($base->assertion)) {
			$new->assertion = $base->assertion;
		} else {
			$new->assertion = null;
		}
		return $new;
	}
}
