<?php

class Site_Model_SQLWooodAssortimentenView
{

	/**
	 * @var integer ASS
	 */
	private $_ass;
	/**
	 * @var string CODE
	 */
	private $_code;
	/**
	 * @var string OMSCHRIJVING
	 */
	private $_omschrijving;

	/**
	 * De datamapper voor dit object
	 * @var Site_Model_Db_DataMapperAbstract
	 */
	private $_mapper;

	/**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		$this->_ass = 0;
		$this->_code = '';
		$this->_omschrijving = '';

		$this->_mapper = null;
	}
	
	/**
	 * @return the $_ass
	 */
	public function getAss() {
		return $this->_ass;
	}

	/**
	 * @param number $_ass
	 */
	public function setAss($_ass) {
		$this->_ass = $_ass;
	}

	/**
	 * @return the $_code
	 */
	public function getCode() {
		return $this->_code;
	}

	/**
	 * @param string $_code
	 */
	public function setCode($_code) {
		$this->_code = $_code;
	}

	/**
	 * @return the $_omschrijving
	 */
	public function getOmschrijving() {
		return $this->_omschrijving;
	}

	/**
	 * @param string $_omschrijving
	 */
	public function setOmschrijving($_omschrijving) {
		$this->_omschrijving = $_omschrijving;
	}

	public function toArray()
	{
		$item = array();
		$item['ASS'] = $this->getAss();
		$item['CODE'] = $this->getCode();
		$item['OMSCHRIJVING'] = $this->getOmschrijving();
		
		return $item;
	}
}