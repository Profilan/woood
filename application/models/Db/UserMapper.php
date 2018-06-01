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

/*
 * Datamapper voor User
 * @package Site_Model_Db
 */

/**
 * Deze klasse is de verbinding tussen de User-klasse en de UserDao-klasse. Het zorgt ervoor
 * dat applicatielogica volledig wordt gescheiden van de opslag van gegevens.
 *
 * @author Wouter Tengeler
 */
class Site_Model_Db_UserMapper extends Site_Model_Db_DataMapperAbstract
{

    public function setDao($dao)
    {
        if (is_string($dao)) {
            // creeer een DAO object
            $db = Zend_Registry::get('db2');
            $dao = new $dao(array('db' => $db));
        }
        if (!$dao instanceof Zend_Db_Table_Abstract) {
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
    
	/**
	 * sla de gegevens van het gegeven modelobject op in de database
	 * @param Site_Model_User $model
	 * @throws InvalidArgumentException
	 */
	public function save($model) {
		if (!$model instanceof Site_Model_User) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		$data = array();
		$data['username'] = $model->getUserName();
		$data['email'] = $model->getEmail();
		$data['password'] = $model->getPassword();
		$data['api_key'] = $model->getApiKey();
		$data['ip_from'] = $model->getIpFrom();
		$data['ip_to'] = $model->getIpTo();
		if ($model->getId() < 0) {
			// nieuw object, doe insert
			$id = $this->getDao()->insert($data);
			$model->setId($id);

		} else {
			// bestaand object, doe update
			$where = $this->getDao()->getAdapter()->quoteInto('id = ?', $model->getId());
			$this->getDao()->update($data, $where);
		}
	}
	/**
	 * Zoek de user met het gegeven id en geef een gevuld User object terug. Als
	 * het id niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_User $model
	 * @return Site_Model_User|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_User)) {
				$model = new Site_Model_User();
			}
			// vul het model object
			$model->setId($row->id);
			$model->setUserName($row->username);
			$model->setEmail($row->email);
			$model->setPassword($row->password, false);
			$model->setApiKey($row->api_key, false);
			$model->setIpFrom($row->ip_from);
			$model->setIpTo($row->ip_to);
			$result = $model;
		}
		return $result;
	}

	/**
	 * load een gebruiker met een gegeven username
	 * @param string $username
	 * @return Site_Model_User|null
	 */
	public function findByUserName($username, $model = null) {
		$result = null;
		if (is_string($username)) {
			$select = $this->getDao()->select();
			$select->where('username = ?', $username);
			$row = $this->getDao()->fetchRow($select);
			if (null != $row) {
				if (!($model instanceof Site_Model_User)) {
					$model = new Site_Model_User();
				}
				// vul het model object
				$model->setId($row->id);
				$model->setUserName($row->username);
				$model->setEmail($row->email);
				$model->setPassword($row->password, false);
				$model->setApiKey($row->api_key, false);
				$model->setIpFrom($row->ip_from);
				$model->setIpTo($row->ip_to);
				$result = $model;
			}
		}
		return $result;
	}

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_User();
			$model->setId($row->id);
			$model->setUserName($row->username);
			$model->setEmail($row->email);
			$model->setPassword($row->password, false);
			$model->setApiKey($row->api_key, false);
			$model->setIpFrom($row->ip_from);
			$model->setIpTo($row->ip_to);
			$result[] = $model;
		}
		return $result;
	}
}