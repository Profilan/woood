<?php

class Site_Model_SQLWooodPaymentReleaseList
{
	/**
	 * @var array
	 */
	private $_items;

	/**
	 * De DataMapper voor Site_Model_Db_PaymentReleaseMapper $_mapper
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
	 * @return Site_Model_Db_SQLWooodPaymentReleaseMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
		    $this->setMapper(new Site_Model_Db_SQLWooodPaymentReleaseMapper(new Site_Model_Db_SQLWooodPaymentReleaseDao()));
		}
		return $this->_mapper;
	}

	/**
	 * Retourneert een lijst met PaymentRelease-objecten
	 * 
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met PaymentRelease objecten
	 */
	public function getList($type = 'all', $key = null) {
		switch ($type) {
			case 'all' :
			default :
				$this->_items = $this->getMapper()->fetchAll();
		}
		return $this->_items;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_items = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de PaymentRelease
	 * @return array Array gevuld met PaymentRelase objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$item = null;
		foreach ($data as $itemData) {
			try {
				$item = new Site_Model_SQLWooodPaymentRelease();
				// vul de Stock met gegevens
				$item->populate($itemData);
				// voeg Debiteur toe aan lijst
				$this->_items[] = $item;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}