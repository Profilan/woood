<?php

class Site_Model_SQLWooodDebOrderInfoList
{
	/**
	 * @var array De lijst met order objecten
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
	 * @return Site_Model_Db_SQLWooodDebOrderInfoMapperMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodDebOrderInfoMapper(new Site_Model_Db_SQLWooodDebOrderInfoDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Order-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met O objecten
	 */
	public function getList($type = 'all', $key = null, $page = null, $limit = null) {
		switch ($type) {
			case 'debiteur':
				$this->_orders = $this->getMapper()->fetchByDebiteur($key);
				break;
			case 'all' :
			default :
				$this->_orders = $this->getMapper()->fetchAll($page, $limit);
		}
		return $this->_orders;
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
		$this->_orders = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de orders
	 * @return array Array gevuld met Order objecten
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
				$order = new Site_Model_SQLWooodDebOrderInfo();
				// vul de Order met gegevens
				$order->populate($orderData);
				// voeg Order toe aan lijst
				$this->_orders[] = $order;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}