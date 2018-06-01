<?php

class Site_Model_SQLWooodDebinfoList
{
	/**
	 * @var array De lijst met Debibeur objecten
	 */
	private $_debs;

	/**
	 * De DataMapper voor Debiteur ViewMapper $_mapper
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
	 * @return Site_Model_Db_StockMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodDebinfoMapper(new Site_Model_Db_SQLWooodDebinfoDao()));
		}
		return $this->_mapper;
	}
	
	/**
	 * retourneert een lijst met Debiteur-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met Debiteur objecten
	 */
	public function getList($type = 'all', $key = null, $page = null, $limit = null) {
		switch ($type) {
			case 'debiteur':
				$this->_debs = $this->getMapper()->fetchByDebiteur($key);
				break;
			case 'all' :
			default :
				$this->_debs = $this->getMapper()->fetchAll($page, $limit);
		}
		return $this->_debs;
	}
	
	public function getTotalCount()
	{
	    return $this->getMapper()->getTotalCount();
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_debs = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de artikelen
	 * @return array Array gevuld met Debiteur objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$deb = null;
		foreach ($data as $debData) {
			try {
				$deb = new Site_Model_SQLWooodDebinfo();
				// vul de Stock met gegevens
				$deb->populate($debData);
				// voeg Debiteur toe aan lijst
				$this->_debs[] = $deb;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}