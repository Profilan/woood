<?php
class Site_Model_FMPKadobonList
{
	private $_items;
	
	/**
	 * De DataMapper voor Kadobon-objecten
	 * @var Site_Model_Db_FMPKadobonMapper $_mapper
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
			$this->setMapper(new Site_Model_Db_FMPKadobonMapper());
		}
		return $this->_mapper;
	}
	
	/**
	 * retourneert een lijst met objecten
	 * @return array Array gevuld met objecten
	 */
	public function getList($type = 'all', $pageNumber = 1, $pageCount = 25)
	{
		switch ($type) {
			case 'page':
				$this->_items = $this->getMapper()->fetchPage($pageNumber, $pageCount);
				break;
			case 'all' :
			default :
				$this->_items = $this->getMapper()->fetchAll();
		}
		return $this->_items;
	}
	
	public function clear() {
		$this->_items = array();
	}
	
	
}