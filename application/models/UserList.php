<?php

class Site_Model_UserList {
	/**
	 * @var array De lijst met User objecten
	 */
	private $_users;

	/**
	 *
	 * @var Site_Model_Db_UserMapper
	 */
	private $_mapper;

	/**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		$this->clear();
		$this->_mapper = null;
	}

	/**
	 *
	 * @param Site_Model_Db_DataMapperAbstract $mapper
	 */
	public function setMapper($mapper) {
		$this->_mapper = $mapper;
		return $this;
	}

	/**
	 * geef het ingestelde DataMapper object terug. Als deze nog niet bestaat wordt het aangemaakt
	 * @return Site_Model_Db_UserMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_UserMapper('Site_Model_Db_UserDao'));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met User-objecten van het gegeven type
	 * @param string $type Het type van de opgegeven key (role, all)
	 * @param string $key De naam van de gevraagde role
	 * @return array Array gevuld met User objecten
	 */
	public function getList($type = 'all', $key = '') {
		switch ($type) {
			case 'role' :
				$this->_users = $this->getMapper()->fetchAllForRole($key);
				break;
			case 'all' :
			default :
				$this->_users = $this->getMapper()->fetchAll();
		}
		return $this->_users;
	}
	
	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->users = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de users
	 * @return array Array gevuld met User objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$listObject = null;
		foreach ($data as $row) {
			try {
				$listObject = new Site_Model_User();
				// vul de product met gegevens
				$listObject->populate($row);
				// voeg product toe aan lijst
				$this->_users[] = $listObject;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte object over en ga verder met de rest
			}
		}
	}
}
