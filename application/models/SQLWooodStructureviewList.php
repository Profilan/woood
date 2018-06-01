<?php

class Site_Model_SQLWooodStructureviewList
{
	/**
	 * @var array De lijst met product objecten
	 */
	private $_products;

	/**
	 * De DataMapper voor ViewMapper $_mapper
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
	 * @return Site_Model_Db_SQLWooodStructureviewMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodStructureviewMapper(new Site_Model_Db_SQLWooodStructureviewDao()));
		}
		
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met product-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met O objecten
	 */
	public function getList($type = 'all', $key = null, $page = null, $limit = null) {
		switch ($type) {
			case 'prodnr':
				$this->_items = $this->getMapper()->fetchByProdnr($key, $page, $limit);
				break;
			case 'all' :
			default :
				$this->_items = $this->getMapper()->fetchAll($page, $limit);
		}
		return $this->_items;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_products = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de products
	 * @return array Array gevuld met product objecten
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
				$item = new Site_Model_SQLWooodStructureview();
				// vul de Item met gegevens
				$item->populate($itemData);
				// voeg Item toe aan lijst
				$this->_items[] = $item;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}