<?php

class Site_Model_Test
{
	private $_ARTIKELNR;
	private $_OMSCHRIJVING;
	private $_VOORRAAD;
	
	private $_mapper;
	
	public function __construct()
	{
		$this->_ARTIKELNR = -1;
		$this->_OMSCHRIJVING = '';
		$this->_VOORRAAD = 0;
		$this->_mapper = null;
	}

	public function load($id)
	{
		if (is_int($id) || (is_string($id) && ctype_digit($id))) {
			$this->getMapper()->find($id, $this);
		} else {
			throw new InvalidArgumentException('id must be numeric');
		}
	}
	
	public function setArtikelnr($val)
	{
		$this->_ARTIKELNR = $val;
	}
	
	public function getArtikelnr()
	{
		return $this->_ARTIKELNR;
	}

	public function setOmschrijving($val)
	{
		$this->_OMSCHRIJVING = $val;
	}
	
	public function getOmschrijving()
	{
		return $this->_OMSCHRIJVING;
	}
	
	public function setVoorraad($val)
	{
		$this->_VOORRAAD = $val;
	}
	
	public function getVoorraad()
	{
		return $this->_VOORRAAD;
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
	 * @return Site_Model_Db_TestMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_TestMapper());
		}
		return $this->_mapper;
	}

	public function save() {
		$this->getMapper()->save($this);
	}

	public static function delete($id) {
		$mapper = new Site_Model_Db_TestMapper();
		return $mapper->delete($id);
	}
	
	public function toArray()
	{
		$item = array();
		$item['ARTIKELNR'] = $this->getArtikelnr();
		$item['OMSCHRIJVING'] = $this->getOmschrijving();
		$item['VOORRAAD'] = $this->getVoorraad();
		
		return $item;
	}
}