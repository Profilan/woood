<?php

class Site_Model_SQLWooodAssortimentenViewList
{
	/**
	 * @var array De lijst met Assortiment objecten
	 */
	private $_assortments;

	/**
	 * De DataMapper voor Assortiment-objecten
	 * @var Site_Model_Db_AssortimentenViewMapper $_mapper
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
	 * @return Site_Model_Db_SQLWooodAssortimentenViewMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodAssortimentenViewMapper(new Site_Model_Db_SQLWooodAssortimentenViewDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Assortiment-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met Assortiment objecten
	 */
	public function getList($type = 'all', $assId) {
		switch ($type) {
			case 'assortment':
				$this->_assortments = $this->getMapper()->fetchByAssortment($assId); 
				break;
			case 'all' :
			default :
				$this->_assortments = $this->getMapper()->fetchAll();
				break;
		}
		return $this->_assortments;
	}

	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_assortments = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de artikelen
	 * @return array Array gevuld met Assortment objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$assortment = null;
		foreach ($assortment as $assortmentData) {
			try {
				$assortment = new Site_Model_SQLWooodAssortimentenView();
				// vul de Stock met gegevens
				$assortment->populate($assortmentData);
				// voeg Article toe aan lijst
				$this->_assortments[] = $assortment;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}