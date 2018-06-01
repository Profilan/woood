<?php

class Site_Model_SQLWooodVerkooppuntView
{

	/**
	 * @var string ARTIKELCODE
	 */
	private $_artikelcode;
	/**
	 * @var string FACTUURDEBITEURNR
	 */
	private $_factuurDebiteurNr;
	/**
	 * @var string FACTUURDEBITEURNAAM
	 */
	private $_factuurDebiteurNaam;
	/**
	 * @var string FACTUURDEBITEUR NAAM ALIAS
	 */
	private $_factuurDebiteurNaamAlias;
	/**
	 * @var string FACTUURDEBITEURWEB
	 */
	private $_factuurDebiteurWeb;
	/**
	 * @var string FACTUURDEBITEUR WEB ALIAS
	 */
	private $_factuurDebiteurWebAlias;
	/**
	 * @var string FACTUURDEBITEURLAND
	 */
	private $_factuurDebiteurLand;
	
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
		$this->_artikelcode = '';
		$this->_factuurDebiteurNr = '';
		$this->_factuurDebiteurWeb = '';
		$this->_factuurDebiteurWebAlias = '';
		$this->_factuurDebiteurWeb = '';
		$this->_factuurDebiteurWebAlias = '';
		$this->_factuurDebiteurLand = '';
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_WOOOD_SELLINGPOINTS');
		$select->where('ARTIKELCODE = ?', $id);
		
		$row = $db1->fetchRow($select);
		$this->setArtikelcode($row['ARTIKELCODE']);
		$this->setFactuurDebiteurNr($row['FACTUURDEBITEURNR']);
		$this->setFactuurDebiteurNaam($row['FACTUURDEBITEURNAAM']);
		$this->setFactuurDebiteurNaamAlias($row['FACTUURDEBITEUR NAAM ALIAS']);	
		$this->setFactuurDebiteurWeb($row['FACTUURDEBITEURWEB']);
		$this->setFactuurDebiteurWebAlias($row['FACTUURDEBITEUR WEB ALIAS']);
		$this->setFactuurDebiteurLand($row['FACTUURDEBITEURLAND']);
	}

	/**
	 * setter voor _artikelcode
	 * @param string $artikelcode
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setArtikelcode($artikelcode) {
		if (is_string($artikelcode) || $artikelcode == null) {
			$this->_artikelcode = $artikelcode;
		} else {
			throw new InvalidArgumentException('artikelcode should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _artikelcode
	 * @return string
	 */
	public function getArtikelcode() {
		return $this->_artikelcode;
	}

	/**
	 * setter voor _factuurDebiteurNr
	 * @param string $factuurDebiteurNr
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurNr($factuurDebiteurNr) {
		if (is_string($factuurDebiteurNr) || $factuurDebiteurNr == null) {
			$this->_factuurDebiteurNr = $factuurDebiteurNr;
		} else {
			throw new InvalidArgumentException('factuurDebiteurNr should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _factuurDebiteurNr
	 * @return string
	 */
	public function getFactuurDebiteurNr() {
		return $this->_factuurDebiteurNr;
	}

	/**
	 * setter voor _factuurDebiteurNaam
	 * @param string $factuurDebiteurNaam
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurNaam($factuurDebiteurNaam) {
		if (is_string($factuurDebiteurNaam) || $factuurDebiteurNaam == null) {
			$this->_factuurDebiteurNaam = $factuurDebiteurNaam;
		} else {
			throw new InvalidArgumentException('factuurDebiteurNaam should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _factuurDebiteurNaam
	 * @return string
	 */
	public function getFactuurDebiteurNaam() {
		return $this->_factuurDebiteurNaam;
	}

	/**
	 * setter voor _factuurDebiteurNaamAlias
	 * @param string $factuurDebiteurNaamAlias
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurNaamAlias($factuurDebiteurNaamAlias) {
		if (is_string($factuurDebiteurNaamAlias) || $factuurDebiteurNaamAlias == null) {
			$this->_factuurDebiteurNaamAlias = $factuurDebiteurNaamAlias;
		} else {
			throw new InvalidArgumentException('factuurDebiteurNaamAlias should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _factuurDebiteurNaamAlias
	 * @return string
	 */
	public function getFactuurDebiteurNaamAlias() {
		return $this->_factuurDebiteurNaamAlias;
	}

	/**
	 * setter voor _factuurDebiteurWeb
	 * @param string $factuurDebiteurWeb
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurWeb($factuurDebiteurWeb) {
		if (is_string($factuurDebiteurWeb) || $factuurDebiteurWeb == null) {
			$this->_factuurDebiteurWeb = $factuurDebiteurWeb;
		} else {
			throw new InvalidArgumentException('factuurDebiteurWeb should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _factuurDebiteurWeb
	 * @return string
	 */
	public function getFactuurDebiteurWeb() {
		return $this->_factuurDebiteurWeb;
	}
	
	/**
	 * setter voor _factuurDebiteurWebAlias
	 * @param string $factuurDebiteurWebAlias
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurWebAlias($factuurDebiteurWebAlias) {
		if (is_string($factuurDebiteurWebAlias) || $factuurDebiteurWebAlias == null) {
			$this->_factuurDebiteurWebAlias = $factuurDebiteurWebAlias;
		} else {
			throw new InvalidArgumentException('factuurDebiteurWebAlias should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _factuurDebiteurWebAlias
	 * @return string
	 */
	public function getFactuurDebiteurWebAlias() {
		return $this->_factuurDebiteurWebAlias;
	}

	/**
	 * setter voor _factuurDebiteurLand
	 * @param string $factuurDebiteurLand
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFactuurDebiteurLand($factuurDebiteurLand) {
		if (is_string($factuurDebiteurLand) || $factuurDebiteurLand == null) {
			$this->_factuurDebiteurLand = $factuurDebiteurLand;
		} else {
			throw new InvalidArgumentException('factuurDebiteurLand should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _factuurDebiteurLand
	 * @return string
	 */
	public function getFactuurDebiteurLand() {
		return $this->_factuurDebiteurLand;
	}
	
	public function toArray()
	{
		$item = array();
		$item['ARTIKELCODE'] = $this->getArtikelcode();
		$item['FACTUURDEBITEURNR'] = $this->getFactuurDebiteurNr();
		$item['FACTUURDEBITEURNAAM'] = $this->getFactuurDebiteurNaam();
		$item['FACTUURDEBITEUR_NAAM_ALIAS'] = $this->getFactuurDebiteurNaamAlias();
		$item['FACTUURDEBITEURWEB'] = $this->getFactuurDebiteurWeb();
		$item['FACTUURDEBITEUR_WEB_ALIAS'] = $this->getFactuurDebiteurWebAlias();
		$item['FACTUURDEBITEURLAND'] = $this->getFactuurDebiteurLand();
		
		return $item;
	}
}