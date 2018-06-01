<?php

class Site_Model_SQLWooodPricelistView
{

	/**
	 * @var string debiteurnr
	 */
	private $_debiteurnr;
	/**
	 * @var string faktuurdebiteurnr
	 */
	private $_faktuurdebiteurnr;
	/**
	 * @var string artikelnr
	 */
	private $_artikelnr;
	/**
	 * @var float salesprice
	 */
	private $_salesprice;
	/**
	 * @var string prijslijst
	 */
	private $_prijslijst;
	/**
	 * @var float korting
	 */
	private $_korting;
	/**
	 * @var float aantal0
	 */
	private $_aantal0;
	/**
	 * @var float prijs0
	 */
	private $_prijs0;
	/**
	 * @var float aantal1
	 */
	private $_aantal1;
	/**
	 * @var float prijs1
	 */
	private $_prijs1;
	/**
	 * @var float aantal2
	 */
	private $_aantal2;
	/**
	 * @var float prijs2
	 */
	private $_prijs2;
	/**
	 * @var float aantal3
	 */
	private $_aantal3;
	/**
	 * @var float prijs3
	 */
	private $_prijs3;
	/**
	 * @var float aantal4
	 */
	private $_aantal4;
	/**
	 * @var float prijs4
	 */
	private $_prijs4;
	/**
	 * @var float aantal5
	 */
	private $_aantal5;
	/**
	 * @var float prijs5
	 */
	private $_prijs5;
	/**
	 * @var float aantal6
	 */
	private $_aantal6;
	/**
	 * @var float prijs6
	 */
	private $_prijs6;
	/**
	 * @var float aantal7
	 */
	private $_aantal7;
	/**
	 * @var float prijs7
	 */
	private $_prijs7;
	/**
	 * @var float aantal8
	 */
	private $_aantal8;
	/**
	 * @var float prijs8
	 */
	private $_prijs8;
	/**
	 * @var float aantal9
	 */
	private $_aantal9;
	/**
	 * @var float prijs9
	 */
	private $_prijs9;
	/**
	 * @var float aantal10
	 */
	private $_aantal10;
	/**
	 * @var float prijs10
	 */
	private $_prijs10;
	/**
	 * @var string valcode
	 */
	private $_valcode;
	/**
	 * @var float standaard_salesprice
	 */
	private $_standaard_salesprice;
	/**
	 * @var string kortingtype
	 */
	private $_kortingtype;
	/**
	 * @var string prijssoort
	 */
	private $_prijssoort;
	
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
		$this->_debiteurnr = '';
		$this->_faktuurdebiteurnr = '';
		$this->_artikelnr = '';
		$this->_salesprice = 0.00;
		$this->_prijslijst = '';
		$this->_korting = 0.00;
		$this->_aantal0 = 0.00;
		$this->_prijs0 = 0.00;
		$this->_aantal1 = 0.00;
		$this->_prijs1 = 0.00;
		$this->_aantal2 = 0.00;
		$this->_prijs2 = 0.00;
		$this->_aantal3 = 0.00;
		$this->_prijs3 = 0.00;
		$this->_aantal4 = 0.00;
		$this->_prijs4 = 0.00;
		$this->_aantal5 = 0.00;
		$this->_prijs5 = 0.00;
		$this->_aantal6 = 0.00;
		$this->_prijs6 = 0.00;
		$this->_aantal7 = 0.00;
		$this->_prijs7 = 0.00;
		$this->_aantal8 = 0.00;
		$this->_prijs8 = 0.00;
		$this->_aantal9 = 0.00;
		$this->_prijs9 = 0.00;
		$this->_aantal10 = 0.00;
		$this->_prijs10 = 0.00;
		$this->_valcode = '';
		$this->_standaard_salesprice = 0.00;
		$this->_kortingtype = '';
		$this->_prijssoort = '';
		
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_Prijzen_Webshop');
		$select->where('artikelnr = ?', $id);
		
		$row = $db1->fetchRow($select);
		$this->setDebiteurnr($row['debiteurnr']);
		$this->setFaktuurdebiteurnr($row['faktuurdebiteurnr']);		
		$this->setArtikelcode($row['artikelnr']);
		$this->setSalesprice($row['salesprice']);
		$this->setPrijslijst($row['prijslijst']);
		$this->setKorting($row['korting']);
		$this->setAantal0($row['aantal0']);
		$this->setPrijs0($row['prijs0']);
		$this->setAantal1($row['aantal1']);
		$this->setPrijs1($row['prijs1']);
		$this->setAantal2($row['aantal2']);
		$this->setPrijs2($row['prijs2']);
		$this->setAantal3($row['aantal3']);
		$this->setPrijs3($row['prijs3']);
		$this->setAantal4($row['aantal4']);
		$this->setPrijs4($row['prijs4']);
		$this->setAantal5($row['aantal5']);
		$this->setPrijs5($row['prijs5']);
		$this->setAantal6($row['aantal6']);
		$this->setPrijs6($row['prijs6']);
		$this->setAantal7($row['aantal7']);
		$this->setPrijs7($row['prijs7']);
		$this->setAantal8($row['aantal8']);
		$this->setPrijs8($row['prijs8']);
		$this->setAantal9($row['aantal9']);
		$this->setPrijs9($row['prijs9']);
		$this->setAantal10($row['aantal10']);
		$this->setPrijs10($row['prijs10']);
		$this->setValcode($row['valcode']);
		$this->setStandaard_salesprice($row['standaard_salesprice']);
		$this->setKortingtype($row['kortingtype']);
		$this->setPrijssoort($row['prijssoort']);
	}

	
	/**
	 * @return the $_debiteurnr
	 */
	public function getDebiteurnr() {
		return $this->_debiteurnr;
	}

	/**
	 * @param string $_debiteurnr
	 */
	public function setDebiteurnr($_debiteurnr) {
		$this->_debiteurnr = $_debiteurnr;
	}

	/**
	 * @return the $_faktuurdebiteurnr
	 */
	public function getFaktuurdebiteurnr() {
		return $this->_faktuurdebiteurnr;
	}

	/**
	 * @param string $_faktuurdebiteurnr
	 */
	public function setFaktuurdebiteurnr($_faktuurdebiteurnr) {
		$this->_faktuurdebiteurnr = $_faktuurdebiteurnr;
	}

	/**
	 * @return the $_artikelnr
	 */
	public function getArtikelnr() {
		return $this->_artikelnr;
	}

	/**
	 * @param string $_artikelnr
	 */
	public function setArtikelnr($_artikelnr) {
		$this->_artikelnr = $_artikelnr;
	}

	/**
	 * @return the $_salesprice
	 */
	public function getSalesprice() {
		return $this->_salesprice;
	}

	/**
	 * @param number $_salesprice
	 */
	public function setSalesprice($_salesprice) {
		$this->_salesprice = $_salesprice;
	}

	/**
	 * @return the $_prijslijst
	 */
	public function getPrijslijst() {
		return $this->_prijslijst;
	}

	/**
	 * @param string $_prijslijst
	 */
	public function setPrijslijst($_prijslijst) {
		$this->_prijslijst = $_prijslijst;
	}

	/**
	 * @return the $_korting
	 */
	public function getKorting() {
		return $this->_korting;
	}

	/**
	 * @param number $_korting
	 */
	public function setKorting($_korting) {
		$this->_korting = $_korting;
	}

	/**
	 * @return the $_aantal0
	 */
	public function getAantal0() {
		return $this->_aantal0;
	}

	/**
	 * @param number $_aantal0
	 */
	public function setAantal0($_aantal0) {
		$this->_aantal0 = $_aantal0;
	}

	/**
	 * @return the $_prijs0
	 */
	public function getPrijs0() {
		return $this->_prijs0;
	}

	/**
	 * @param number $_prijs0
	 */
	public function setPrijs0($_prijs0) {
		$this->_prijs0 = $_prijs0;
	}

	/**
	 * @return the $_aantal1
	 */
	public function getAantal1() {
		return $this->_aantal1;
	}

	/**
	 * @param number $_aantal1
	 */
	public function setAantal1($_aantal1) {
		$this->_aantal1 = $_aantal1;
	}

	/**
	 * @return the $_prijs1
	 */
	public function getPrijs1() {
		return $this->_prijs1;
	}

	/**
	 * @param number $_prijs1
	 */
	public function setPrijs1($_prijs1) {
		$this->_prijs1 = $_prijs1;
	}

	/**
	 * @return the $_aantal2
	 */
	public function getAantal2() {
		return $this->_aantal2;
	}

	/**
	 * @param number $_aantal2
	 */
	public function setAantal2($_aantal2) {
		$this->_aantal2 = $_aantal2;
	}

	/**
	 * @return the $_prijs2
	 */
	public function getPrijs2() {
		return $this->_prijs2;
	}

	/**
	 * @param number $_prijs2
	 */
	public function setPrijs2($_prijs2) {
		$this->_prijs2 = $_prijs2;
	}

	/**
	 * @return the $_aantal3
	 */
	public function getAantal3() {
		return $this->_aantal3;
	}

	/**
	 * @param number $_aantal3
	 */
	public function setAantal3($_aantal3) {
		$this->_aantal3 = $_aantal3;
	}

	/**
	 * @return the $_prijs3
	 */
	public function getPrijs3() {
		return $this->_prijs3;
	}

	/**
	 * @param number $_prijs3
	 */
	public function setPrijs3($_prijs3) {
		$this->_prijs3 = $_prijs3;
	}

	/**
	 * @return the $_aantal4
	 */
	public function getAantal4() {
		return $this->_aantal4;
	}

	/**
	 * @param number $_aantal4
	 */
	public function setAantal4($_aantal4) {
		$this->_aantal4 = $_aantal4;
	}

	/**
	 * @return the $_prijs4
	 */
	public function getPrijs4() {
		return $this->_prijs4;
	}

	/**
	 * @param number $_prijs4
	 */
	public function setPrijs4($_prijs4) {
		$this->_prijs4 = $_prijs4;
	}

	/**
	 * @return the $_aantal5
	 */
	public function getAantal5() {
		return $this->_aantal5;
	}

	/**
	 * @param number $_aantal5
	 */
	public function setAantal5($_aantal5) {
		$this->_aantal5 = $_aantal5;
	}

	/**
	 * @return the $_prijs5
	 */
	public function getPrijs5() {
		return $this->_prijs5;
	}

	/**
	 * @param number $_prijs5
	 */
	public function setPrijs5($_prijs5) {
		$this->_prijs5 = $_prijs5;
	}

	/**
	 * @return the $_aantal6
	 */
	public function getAantal6() {
		return $this->_aantal6;
	}

	/**
	 * @param number $_aantal6
	 */
	public function setAantal6($_aantal6) {
		$this->_aantal6 = $_aantal6;
	}

	/**
	 * @return the $_prijs6
	 */
	public function getPrijs6() {
		return $this->_prijs6;
	}

	/**
	 * @param number $_prijs6
	 */
	public function setPrijs6($_prijs6) {
		$this->_prijs6 = $_prijs6;
	}

	/**
	 * @return the $_aantal7
	 */
	public function getAantal7() {
		return $this->_aantal7;
	}

	/**
	 * @param number $_aantal7
	 */
	public function setAantal7($_aantal7) {
		$this->_aantal7 = $_aantal7;
	}

	/**
	 * @return the $_prijs7
	 */
	public function getPrijs7() {
		return $this->_prijs7;
	}

	/**
	 * @param number $_prijs7
	 */
	public function setPrijs7($_prijs7) {
		$this->_prijs7 = $_prijs7;
	}

	/**
	 * @return the $_aantal8
	 */
	public function getAantal8() {
		return $this->_aantal8;
	}

	/**
	 * @param number $_aantal8
	 */
	public function setAantal8($_aantal8) {
		$this->_aantal8 = $_aantal8;
	}

	/**
	 * @return the $_prijs8
	 */
	public function getPrijs8() {
		return $this->_prijs8;
	}

	/**
	 * @param number $_prijs8
	 */
	public function setPrijs8($_prijs8) {
		$this->_prijs8 = $_prijs8;
	}

	/**
	 * @return the $_aantal9
	 */
	public function getAantal9() {
		return $this->_aantal9;
	}

	/**
	 * @param number $_aantal9
	 */
	public function setAantal9($_aantal9) {
		$this->_aantal9 = $_aantal9;
	}

	/**
	 * @return the $_prijs9
	 */
	public function getPrijs9() {
		return $this->_prijs9;
	}

	/**
	 * @param number $_prijs9
	 */
	public function setPrijs9($_prijs9) {
		$this->_prijs9 = $_prijs9;
	}

	/**
	 * @return the $_aantal10
	 */
	public function getAantal10() {
		return $this->_aantal10;
	}

	/**
	 * @param number $_aantal10
	 */
	public function setAantal10($_aantal10) {
		$this->_aantal10 = $_aantal10;
	}

	/**
	 * @return the $_prijs10
	 */
	public function getPrijs10() {
		return $this->_prijs10;
	}

	/**
	 * @param number $_prijs10
	 */
	public function setPrijs10($_prijs10) {
		$this->_prijs10 = $_prijs10;
	}

	/**
	 * @return the $_valcode
	 */
	public function getValcode() {
		return $this->_valcode;
	}

	/**
	 * @param string $_valcode
	 */
	public function setValcode($_valcode) {
		$this->_valcode = $_valcode;
	}

	/**
	 * @return the $_standaard_salesprice
	 */
	public function getStandaard_salesprice() {
		return $this->_standaard_salesprice;
	}

	/**
	 * @param number $_standaard_salesprice
	 */
	public function setStandaard_salesprice($_standaard_salesprice) {
		$this->_standaard_salesprice = $_standaard_salesprice;
	}

	/**
	 * @return the $_kortingtype
	 */
	public function getKortingtype() {
		return $this->_kortingtype;
	}

	/**
	 * @param string $_kortingtype
	 */
	public function setKortingtype($_kortingtype) {
		$this->_kortingtype = $_kortingtype;
	}

	/**
	 * @return the $_prijssoort
	 */
	public function getPrijssoort() {
		return $this->_prijssoort;
	}

	/**
	 * @param string $_prijssoort
	 */
	public function setPrijssoort($_prijssoort) {
		$this->_prijssoort = $_prijssoort;
	}

	public function toArray()
	{
		$item = array();
		$item['DEBITEURNR']  = $this->getDebiteurnr();
		$item['FAKTUURDEBITEURNR']  = $this->getFaktuurdebiteurnr();
		$item['ARTIKELCODE']  = $this->getArtikelnr();
		$item['SALESPRICE']  = $this->getSalesprice();
		$item['PRIJSLIJST']  = $this->getPrijslijst();
		$item['KORTING']  = $this->getKorting();
		$item['AANTAL0']  = $this->getAantal0();
		$item['PRIJS0']  = $this->getPrijs0();
		$item['AANTAL1']  = $this->getAantal1();
		$item['PRIJS1']  = $this->getPrijs1();
		$item['AANTAL2']  = $this->getAantal2();
		$item['PRIJS2']  = $this->getPrijs2();
		$item['AANTAL3']  = $this->getAantal3();
		$item['PRIJS3']  = $this->getPrijs3();
		$item['AANTAL4']  = $this->getAantal4();
		$item['PRIJS4']  = $this->getPrijs4();
		$item['AANTAL5']  = $this->getAantal5();
		$item['PRIJS5']  = $this->getPrijs5();
		$item['AANTAL6']  = $this->getAantal6();
		$item['PRIJS6']  = $this->getPrijs6();
		$item['AANTAL7']  = $this->getAantal7();
		$item['PRIJS7']  = $this->getPrijs7();
		$item['AANTAL8']  = $this->getAantal8();
		$item['PRIJS8']  = $this->getPrijs8();
		$item['AANTAL9']  = $this->getAantal9();
		$item['PRIJS9']  = $this->getPrijs9();
		$item['AANTAL10']  = $this->getAantal10();
		$item['PRIJS10']  = $this->getPrijs10();
		$item['VALCODE']  = $this->getValcode();
		$item['STANDAARD_SALESPRICE']  = $this->getStandaard_salesprice();
		$item['KORTINGTYPE']  = $this->getKortingtype();
		$item['PRIJSSOORT']  = $this->getPrijssoort();
		
		return $item;
	}
}