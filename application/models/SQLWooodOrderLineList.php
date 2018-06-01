<?php

class Site_Model_SQLWooodOrderList
{
	/**
	 * @var array De lijst met Debibeur objecten
	 */
	private $_orderlines;

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
			$this->setMapper(new Site_Model_Db_SQLWooodOrderMapper(new Site_Model_Db_SQLWooodOrderDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Order-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met Order objecten
	 */
	public function getList($type = 'all', $key = null) {
		switch ($type) {
			case 'ordernr':
				$this->_orderlines = $this->getMapper()->fetchByOrdernr($key);
				break;
			case 'all' :
			default :
				$this->_orderlines = $this->getMapper()->fetchAll();
		}
		return $this->_orderlines;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_orderlines = array();
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
		$orderline = null;
		foreach ($data as $orderlineData) {
			try {
				$orderline = new Site_Model_SQLWooodOrderLine();
				// vul de Stock met gegevens
				$orderline->populate($orderlineData);
				// voeg Debiteur toe aan lijst
				$this->_orderlines[] = $orderline;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}