<?php

class Site_Model_SQLWooodOrderList
{
	/**
	 * @var array De lijst met Debibeur objecten
	 */
	private $_orders;

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
				$this->_orders = $this->getMapper()->fetchByOrdernr($key);
				break;
			case 'reference':
			    $this->_orders = $this->getMapper()->fetchByDebiteurnrReference($key);
			    break;
			case 'all' :
			default :
				$this->_orders = $this->getMapper()->fetchAll();
		}
		return $this->_orders;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_orders = array();
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
		$order = null;
		foreach ($data as $orderData) {
			try {
				$order = new Site_Model_SQLWooodOrder();
				// vul de Stock met gegevens
				$order->populate($orderData);
				// voeg Debiteur toe aan lijst
				$this->_orders[] = $order;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}