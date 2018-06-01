<?php
class Site_Model_TestList
{
	private $_items;
	
	/**
	 * De DataMapper voor Stock-objecten
	 * @var Site_Model_Db_StockMapper $_mapper
	 */
	private $_mapper;
	
	public function __construct() {
		$this->clear();
		$this->_mapper = null;
	}

	public function setMapper($mapper) {
		$this->_mapper = $mapper;
		return $this;
	}
	
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_TestMapper());
		}
		return $this->_mapper;
	}
	
	/**
	 * retourneert een lijst met objecten
	 * @return array Array gevuld met objecten
	 */
	public function getList()
	{
		$this->_items = $this->getMapper()->fetchAll();
		
		return $this->_items;
	}
	
	public function clear() {
		$this->_items = array();
	}
	
	
}