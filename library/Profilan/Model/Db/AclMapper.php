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
 * Datamapper voor de LeerJezelf_Model_Db_Acl-klasse
 *
 * @author Wouter Tengeler
 */
class LeerJezelf_Model_Db_AclMapper
{
	/**
	 * Het object dat toegang tot de data geeft
	 * @var $_dao
	 */
	private $_dao;

	/**
	 * constructor
	 */
	public function __construct($dao) {
		$this->setDao($dao);
	}
	/**
	 * zet het object dat de database acties uitvoert. Krijgt of een DAO object of een string
	 * @param Zend_Db_Table_Abstract|string $dao
	 * @throws InvalidArgumentException
	 */
	public function setDao($dao) {
		if (is_string($dao)) {
		// creeer een DAO object
			$dao = new $dao();
		}
		if (!$dao instanceof LeerJezelf_Model_Db_AclDao) {
			throw new InvalidArgumentException('DAO is nog correct type');
		}
		$this->_dao = $dao;
	}

	/**
	 * @return Zend_Db_Table_Abstract
	 */
	public function getDao() {
		return $this->_dao;
	}

	public function save($model) {
		// niet geimplementeerd
	}

	public function find($id, $model) {
		// niet geimplementeerd
		return null;
	}

	public function fetchAll() {
		return $this->getDao()->fetchAll();
	}

	public function fetchFiltered($where = null, $order = null, $count = null, $offset = null) {
		// niet geimplementeerd
		return null;
	}

	public function fetchRoles() {
		return $this->getDao()->fetchAll(LeerJezelf_Model_Db_AclDao::TYPE_ROLES);
	}

	public function fetchResources() {
		return $this->getDao()->fetchAll(LeerJezelf_Model_Db_AclDao::TYPE_RULES);
	}

	public function fetchAssertions() {
		return $this->getDao()->fetchAll(LeerJezelf_Model_Db_AclDao::TYPE_ASSERTIONS);
	}

}