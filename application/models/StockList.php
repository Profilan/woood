<?php

class Site_Model_StockList
{
	/**
	 * @var array De lijst met Voorraad Aantal objecten
	 */
	private $_stockitems;

	/**
	 * De DataMapper voor Stock-objecten
	 * @var Site_Model_Db_StockMapper $_mapper
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
			$this->setMapper(new Site_Model_Db_StockMapper(new Site_Model_Db_StockDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Stock-objecten
	 * @param string $key De naam van de gevraagde categorie of tag
	 * @return array Array gevuld met Stock objecten
	 */
	public function getList($type = 'all') {
		switch ($type) {
			case 'all' :
			default :
				$this->_stockitems = $this->getMapper()->fetchAll();
		}
		return $this->_stockitems;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_stockitems = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de voorraad aantallen
	 * @return array Array gevuld met Stock objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$stockitem = null;
		foreach ($data as $stockData) {
			try {
				$stock = new Site_Model_Stock();
				// vul de Stock met gegevens
				$stock->populate($stockData);
				// voeg BlogPost toe aan lijst
				$this->_stockitems[] = $stockitem;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}