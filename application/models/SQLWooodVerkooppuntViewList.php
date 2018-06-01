<?php

class Site_Model_SQLWooodVerkooppuntViewList
{
	/**
	 * @var array De lijst met Verkooppunt objecten
	 */
	private $_selling_points;

	/**
	 * De DataMapper voor Verkooppunt-objecten
	 * @var Site_Model_Db_VerkooppuntViewMapper $_mapper
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
			$this->setMapper(new Site_Model_Db_SQLWooodVerkooppuntViewMapper(new Site_Model_Db_SQLWooodVerkooppuntViewDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Verkooppunt-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met Verkooppunt objecten
	 */
	public function getList($type = 'all', $key = null) {
		switch ($type) {
			case 'article':
				$this->_selling_points = $this->getMapper()->fetchByArticle($key);
				break;
			case 'debcode':
				$this->_selling_points = $this->getMapper()->fetchByDebiteur($key);
				break;
			case 'all' :
			default :
				$this->_selling_points = $this->getMapper()->fetchAll();
		}
		return $this->_selling_points;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_selling_points = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de verkooppunten
	 * @return array Array gevuld met Article objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$selling_point = null;
		foreach ($data as $selling_pointData) {
			try {
				$selling_point = new Site_Model_SQLWooodVerkooppuntView();
				// vul de Stock met gegevens
				$selling_point->populate($selling_pointData);
				// voeg Article toe aan lijst
				$this->_selling_points[] = $selling_point;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}