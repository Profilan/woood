<?php

class Site_Model_FMPKadobon
{
	private $_registratienummer;
	private $_status;
	
	private $_mapper;
	
	public function __construct()
	{
		$this->_registratienummer = '';
		$this->_status = '';
		$this->_mapper = null;
	}

	public function load($id)
	{
		if (is_string($id)) {
			$this->getMapper()->find($id, $this);
		} else {
			throw new InvalidArgumentException('id must be numeric');
		}
	}
	
	public function loadByRegistratienummer($registratienummer)
	{
		if (is_string($registratienummer)) {
			$this->getMapper()->findByRegistratienummer($registratienummer, $this);
		} else {
			throw new InvalidArgumentException('registratienummer must be string');
		}
	}
	
	public function setRegistratienummer($val)
	{
		if (is_string($val)) {
			$this->_registratienummer = $val;
		} else {
			throw new InvalidArgumentException('Registratienummer should be of type string');
		}
		return $this;
	}
	
	public function getRegistratienummer()
	{
		return $this->_registratienummer;
	}

	public function setStatus($val)
	{
		if (is_string($val)) {
			$this->_status = $val;
		} else {
			throw new InvalidArgumentException('Status should be of type string');
		}
		return $this;
	}
	
	public function getStatus()
	{
		return $this->_status;
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
	 * @return Site_Model_Db_FMPKadobonMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_FMPKadobonMapper());
		}
		return $this->_mapper;
	}

	public function save() {
		$this->getMapper()->save($this);
	}

	public static function delete($id) {
		$mapper = new Site_Model_Db_FMPKadobonMapper();
		return $mapper->delete($id);
	}
	
	public function toArray()
	{
		$item = array();
		$item['Registratienummer'] = $this->getRegistratienummer();
		$item['Status'] = $this->getStatus();
		
		return $item;
	}
}