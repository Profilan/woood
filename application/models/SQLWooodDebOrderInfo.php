<?php

class Site_Model_SQLWooodDebOrderInfo
{
	/**
	 * @var string ordernr
	 */
	private $_ordernr;
	/**
	 * @var string debnr
	 */
	private $_debnr;
	/**
	 * @var string fakdebnr
	 */
	private $_fakdebnr;
	/**
	 * @var string REFERENTIE
	 */
	private $_referentie;
	/**
	 * @var string OMSCHRIJVING
	 */
	private $_omschrijving;
	/**
	 * @var DateTime orddat
	 */
	private $_orddat;
	/**
	 * @var float AANTAL_BESTELD
	 */
	private $_aantal_besteld;
	/**
	 * @var string ItemCode
	 */
	private $_itemcode;
	/**
	 * @var DateTime AFLEVERDATUM
	 */
	private $_afleverdatum;
	/**
	 * @var string OMSCHRIJVING_NL
	 */
	private $_omschrijving_nl;
	/**
	 * @var bool OMSCHRIJVING_EN
	 */
	private $_omschrijving_en;
	/**
	 * @var bool OMSCHRIJVING_DE
	 */
	private $_omschrijving_de;
	/**
	 * @var float aant_gelev
	 */
	private $_aant_gelev;
	/**
	 * @var int STATUS
	 */
	private $_status;
	/**
	 * @var string del_landcode
	 */
	private $_del_landcode;
	/**
	 * @var string selcode 
	 */
	private $_selcode;
	/**
	 * @var float PRIJS_PER_STUK
	 */
	private $_prijs_per_stuk;
	/**
	 * @var float SUBTOTAAL
	 */
	private $_subtotaal;
	
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
		$this->_ordernr = '';
		$this->_debnr = '';
		$this->_fakdebnr = '';
		$this->_referentie = '';
		$this->_omschrijving = '';
		$this->_orddat = new DateTime('0000-00-00 00:00:00');
		$this->_aantal_besteld = 0;
		$this->_itemcode = '';
		$this->_afleverdatum = new DateTime('0000-00-00 00:00:00');
		$this->_omschrijving_nl = '';
		$this->_omschrijving_en = '';
		$this->_omschrijving_de = '';
		$this->_aant_gelev = 0;
		$this->_status = 0;
		$this->_del_landcode = '';
		$this->_selcode = '';
		$this->_prijs_per_stuk = 0.00;
		$this->_subtotaal = 0.00;
			
		$this->_mapper = null;
	}
	
	/**
	 * @return the $_ordernr
	 */
	public function getOrdernr() {
		return $this->_ordernr;
	}

	/**
	 * @param string $_ordernr
	 */
	public function setOrdernr($_ordernr) {
		$this->_ordernr = $_ordernr;
	}

	/**
	 * @return the $_debnr
	 */
	public function getDebnr() {
		return $this->_debnr;
	}

	/**
	 * @param string $_debnr
	 */
	public function setDebnr($_debnr) {
		$this->_debnr = $_debnr;
	}

	/**
	 * @return the $_fakdebnr
	 */
	public function getFakdebnr() {
		return $this->_fakdebnr;
	}

	/**
	 * @param string $_fakdebnr
	 */
	public function setFakdebnr($_fakdebnr) {
		$this->_fakdebnr = $_fakdebnr;
	}

	/**
	 * @return the $_referentie
	 */
	public function getReferentie() {
		return utf8_encode($this->_referentie);
	}

	/**
	 * @param string $_referentie
	 */
	public function setReferentie($_referentie) {
		$this->_referentie = $_referentie;
	}

	/**
	 * @return the $_omschrijving
	 */
	public function getOmschrijving() {
		return utf8_encode($this->_omschrijving);
	}

	/**
	 * @param string $_omschrijving
	 */
	public function setOmschrijving($_omschrijving) {
		$this->_omschrijving = $_omschrijving;
	}

	/**
	 * @return string $_orddat
	 */
	public function getOrddat() {
		return $this->_orddat->format('Y-m-d H:i:s');
	}

	/**
	 * @return DateTime $_orddat
	 */
	public function getOrddatObject() {
		return $this->_orddat;
	}
	
	/**
	 * @param datetime $_orddat
	 */
	public function setOrddat($_orddat) {
		$this->_orddat = $_orddat;
	}

	/**
	 * @return the $_aantal_besteld
	 */
	public function getAantal_besteld() {
		return $this->_aantal_besteld;
	}

	/**
	 * @param number $_aantal_besteld
	 */
	public function setAantal_besteld($_aantal_besteld) {
		$this->_aantal_besteld = $_aantal_besteld;
	}

	/**
	 * @return the $_itemcode
	 */
	public function getItemcode() {
		return $this->_itemcode;
	}

	/**
	 * @param string $_itemcode
	 */
	public function setItemcode($_itemcode) {
		$this->_itemcode = $_itemcode;
	}

	/**
	 * @return string $_afleverdatum
	 */
	public function getAfleverdatum() {
		return $this->_afleverdatum->format('Y-m-d H:i:s');
	}

	/**
	 * @return DateTime $_afleverdatum
	 */
	public function getAfleverdatumObject() {
		return $this->_afleverdatum;
	}
	
	/**
	 * @param datetime $_afleverdatum
	 */
	public function setAfleverdatum($_afleverdatum) {
		$this->_afleverdatum = $_afleverdatum;
	}

	/**
	 * @return the $_omschrijving_nl
	 */
	public function getOmschrijving_nl() {
		return utf8_encode($this->_omschrijving_nl);
	}

	/**
	 * @param string $_omschrijving_nl
	 */
	public function setOmschrijving_nl($_omschrijving_nl) {
		$this->_omschrijving_nl = $_omschrijving_nl;
	}

	/**
	 * @return the $_omschrijving_en
	 */
	public function getOmschrijving_en() {
		return utf8_encode($this->_omschrijving_en);
	}

	/**
	 * @param boolean $_omschrijving_en
	 */
	public function setOmschrijving_en($_omschrijving_en) {
		$this->_omschrijving_en = $_omschrijving_en;
	}

	/**
	 * @return the $_omschrijving_de
	 */
	public function getOmschrijving_de() {
		return utf8_encode($this->_omschrijving_de);
	}

	/**
	 * @param boolean $_omschrijving_de
	 */
	public function setOmschrijving_de($_omschrijving_de) {
		$this->_omschrijving_de = $_omschrijving_de;
	}

	/**
	 * @return the $_aant_gelev
	 */
	public function getAant_gelev() {
		return $this->_aant_gelev;
	}

	/**
	 * @param number $_aant_gelev
	 */
	public function setAant_gelev($_aant_gelev) {
		$this->_aant_gelev = $_aant_gelev;
	}

	/**
	 * @return the $_status
	 */
	public function getStatus() {
		return $this->_status;
	}

	/**
	 * @param number $_status
	 */
	public function setStatus($_status) {
		$this->_status = $_status;
	}

	/**
	 * @return the $_del_landcode
	 */
	public function getDel_landcode() {
		return $this->_del_landcode;
	}

	/**
	 * @param string $_del_landcode
	 */
	public function setDel_landcode($_del_landcode) {
		$this->_del_landcode = $_del_landcode;
	}

	/**
	 * @return the $_selcode
	 */
	public function getSelcode() {
		return $this->_selcode;
	}

	/**
	 * @param string $_selcode
	 */
	public function setSelcode($_selcode) {
		$this->_selcode = $_selcode;
	}

	/**
	 * @return the $_prijs_per_stuk
	 */
	public function getPrijs_per_stuk() {
		return $this->_prijs_per_stuk;
	}

	/**
	 * @param number $_prijs_per_stuk
	 */
	public function setPrijs_per_stuk($_prijs_per_stuk) {
		$this->_prijs_per_stuk = $_prijs_per_stuk;
	}

	/**
	 * @return the $_subtotaal
	 */
	public function getSubtotaal() {
		return $this->_subtotaal;
	}

	/**
	 * @param number $_subtotaal
	 */
	public function setSubtotaal($_subtotaal) {
		$this->_subtotaal = $_subtotaal;
	}

	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORDERINFO');
		$select->where('debnr = ?', $id);
		
		$row = $db1->fetchRow($select);
		
		$this->setOrdernr($row['ordernr']);
		$this->setDebnr($row['debnr']);
		$this->setFakdebnr($row['fakdebnr']);
		$this->setReferentie($row['REFERENTIE']);
		$this->setOmschrijving($row['OMSCHRIJVING']);
		$this->setOrddat($row['orddat']);
		$this->setAantal_besteld($row['AANTAL_BESTELD']);
		$this->setItemcode($row['ItemCode']);
		$this->setAfleverdatum($row['AFLEVERDATUM']);
		$this->setOmschrijving_nl($row['OMSCHRIJVING_NL']);
		$this->setOmschrijving_en($row['OMSCHRIJVING_EN']);
		$this->setOmschrijving_de($row['OMSCHRIJVING_DE']);
		$this->setAant_gelev($row['aant_gelev']);
		$this->setStatus($row['STATUS']);
		$this->setDel_landcode($row['del_landcode']);
		$this->setSelcode($row['selcode']);
		$this->setPrijs_per_stuk($row['PRIJS_PER_STUK']);
		$this->setSubtotaal($row['SUBTOTAAL']);
	}

	public function toArray()
	{
		$item = array();
		$item['ORDERNR'] = $this->getOrdernr();
		$item['DEBNR'] = $this->getDebnr();
		$item['FAKDEBNR'] = $this->getFakdebnr();
		$item['REFERENTIE'] = $this->getReferentie();
		$item['OMSCHRIJVING'] = $this->getOmschrijving();
		$item['ORDDAT'] = $this->getOrddat();
		$item['AANTAL_BESTELD'] = $this->getAantal_besteld();
		$item['ITEMCODE'] = $this->getItemcode();
		$item['AFLEVERDATUM'] = $this->getAfleverdatum();
		$item['OMSCHRIJVING_NL'] = $this->getOmschrijving_nl();
		$item['OMSCHRIJVING_EN'] = $this->getOmschrijving_en();
		$item['OMSCHRIJVING_DE'] = $this->getOmschrijving_de();
		$item['AANTAL_GELEV'] = $this->getAant_gelev();
		$item['STATUS'] = $this->getStatus();	
		$item['DEL_LANDCODE'] = $this->getDel_landcode();
		$item['SELCODE'] = $this->getSelcode();
		$item['PRIJS_PER_STUK'] = $this->getPrijs_per_stuk();
		$item['SUBTOTAAL'] = $this->getSubtotaal();	

		return $item;
	}
}