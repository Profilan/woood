<?php

class Site_Model_SQLWooodWebAvailability
{
	/**
	 * @var string fakdebnr
	 */
	private $_fakdebnr;
	/**
	 * @var string ItemCode
	 */
	private $_itemcode;
	/**
	 * @var string TOELICHTING_NL
	 */
	private $_toelichting_nl;
	/**
	 * @var bool TOELICHTING_EN
	 */
	private $_toelichting_en;
	/**
	 * @var bool TOELICHTING_DE
	 */
	private $_toelichting_de;
	/**
	 * @var bool TOELICHTING_FR
	 */
	private $_toelichting_fr;
	/**
	 * @var int LEVERWEEK
	 */
	private $_leverweek;
	/**
	 * @var int LEVERWEEK_JJJJ-WW
	 */
	private $_leverweek_jjjj_ww;
	/**
	 * @var string Omschrijving_NL
	 */
	private $_omschrijving_nl;
	/**
	 * @var bool Omschrijving_EN
	 */
	private $_omschrijving_en;
	/**
	 * @var bool Omschrijving_DE
	 */
	private $_omschrijving_de;
	/**
	 * @var bool Omschrijving_FR
	 */
	private $_omschrijving_fr;
	/**
	 * @var string BRAND
	 */
	private $_brand;
	/**
	 * @var string EXCLUSIVE 
	 */
	private $_exclusive;
	/**
	 * @var string EANCode
	 */
	private $_eancode;
	/**
	 * @var datetime SYSCREATED
	 */
	private $_syscreated;
	/**
	 * @var datetime sysmodified
	 */
	private $_sysmodified;
	
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
		$this->_fakdebnr = '';
		$this->_itemcode = '';
		$this->_referentie = '';
		$this->_toelichting_nl = '';
		$this->_toelichting_en = '';
		$this->_toelichting_de = '';
		$this->_leverweek = 0;
		$this->_leverweek_jjjj_ww = '';
		$this->_omschrijving_nl = '';
		$this->_omschrijving_en = '';
		$this->_omschrijving_de = '';
		$this->_brand = '';
		$this->_exclusive = '';
		$this->_eancode = '';
		$this->_syscreated = new DateTime('0000-00-00 00:00:00');
		$this->_sysmodified = new DateTime('0000-00-00 00:00:00');
			
		$this->_mapper = null;
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
	 * @return the $_toelichting_nl
	 */
	public function getToelichting_nl() {
		return utf8_encode($this->_toelichting_nl);
	}

	/**
	 * @param string $_toelichting_nl
	 */
	public function setToelichting_nl($_toelichting_nl) {
		$this->_toelichting_nl = $_toelichting_nl;
	}

	/**
	 * @return the $_toelichting_en
	 */
	public function getToelichting_en() {
		return utf8_encode($this->_toelichting_en);
	}

	/**
	 * @param boolean $_toelichting_en
	 */
	public function setToelichting_en($_toelichting_en) {
		$this->_toelichting_en = $_toelichting_en;
	}

	/**
	 * @return the $_toelichting_de
	 */
	public function getToelichting_de() {
		return utf8_encode($this->_toelichting_de);
	}

	/**
	 * @param boolean $_toelichting_de
	 */
	public function setToelichting_de($_toelichting_de) {
		$this->_toelichting_de = $_toelichting_de;
	}

	/**
	 * @return the $_toelichting_fr
	 */
	public function getToelichting_fr() {
		return utf8_encode($this->_toelichting_fr);
	}

	/**
	 * @param boolean $_toelichting_fr
	 */
	public function setToelichting_fr($_toelichting_fr) {
		$this->_toelichting_fr = $_toelichting_fr;
	}

	/**
	 * @return the $_leverweek
	 */
	public function getLeverweek() {
		return $this->_leverweek;
	}

	/**
	 * @param number $_leverweek
	 */
	public function setLeverweek($_leverweek) {
		$this->_leverweek = $_leverweek;
	}

	/**
	 * @return the $_leverweek_jjjj_ww
	 */
	public function getLeverweekJW() {
		return $this->_leverweek_jjjj_ww;
	}
	
	/**
	 * @param string $_leverweek_jjjj_ww
	 */
	public function setLeverweekJW($_leverweek_jjjj_ww) {
		$this->_leverweek_jjjj_ww = $_leverweek_jjjj_ww;
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
	 * @return the $_omschrijving_fr
	 */
	public function getOmschrijving_fr() {
		return utf8_encode($this->_omschrijving_fr);
	}

	/**
	 * @param boolean $_omschrijving_fr
	 */
	public function setOmschrijving_fr($_omschrijving_fr) {
		$this->_omschrijving_fr = $_omschrijving_fr;
	}

	/**
	 * @return the $_brand
	 */
	public function getBrand() {
		return $this->_brand;
	}

	/**
	 * @param string $_brand
	 */
	public function setBrand($_brand) {
		$this->_brand = $_brand;
	}

	/**
	 * @return the $_exclusive
	 */
	public function getExclusive() {
		return $this->_exclusive;
	}

	/**
	 * @param string $_exclusive
	 */
	public function setExclusive($_exclusive) {
		$this->_exclusive = $_exclusive;
	}

	/**
	 * @return the $_eancode
	 */
	public function getEancode() {
		return $this->_eancode;
	}

	/**
	 * @param string $_eancode
	 */
	public function setEancode($_eancode) {
		$this->_eancode = $_eancode;
	}

	/**
     * @return the $_syscreated
     */
    public function getSyscreated()
    {
        return $this->_syscreated->format('Y-m-d H:i:s');
    }

    /**
     * @return the $_syscreated
     */
    public function getSyscreatedObject()
    {
        return $this->_syscreated;
    }
    
	/**
     * @param datetime $_syscreated
     */
    public function setSyscreated($_syscreated)
    {
        $this->_syscreated = $_syscreated;
    }

	/**
     * @return the $_sysmodified
     */
    public function getSysmodified()
    {
        return $this->_sysmodified->format('Y-m-d H:i:s');
    }

    /**
     * @return the $_sysmodified
     */
    public function getSysmodifiedObject()
    {
        return $this->_sysmodified;
    }
    
	/**
     * @param datetime $_sysmodified
     */
    public function setSysmodified($_sysmodified)
    {
        $this->_sysmodified = $_sysmodified;
    }

	/**
	 * @return the $_mapper
	 */
	public function getMapper() {
		return $this->_mapper;
	}

	/**
	 * @param Site_Model_Db_DataMapperAbstract $_mapper
	 */
	public function setMapper($_mapper) {
		$this->_mapper = $_mapper;
	}

	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_WEB_AVAILABILITY');
		$select->where('fakdebnr = ?', $id);
		
		$row = $db1->fetchRow($select);
		
		$this->setFakdebnr($row['fakdebnr']);
		$this->setItemcode($row['ItemCode']);
		$this->setToelichting_nl($row['TOELICHTING_NL']);
		$this->setToelichting_en($row['TOELICHTING_EN']);
		$this->setToelichting_de($row['TOELICHTING_DE']);
		$this->setToelichting_fr($row['TOELICHTING_FR']);
		$this->setLeverweek($row['LEVERWEEK']);
		$this->setLeverweekJW($row['LEVERWEEK_JJJJWW']);
		$this->setOmschrijving_nl($row['Omschrijving_NL']);
		$this->setOmschrijving_en($row['Omschrijving_EN']);
		$this->setOmschrijving_de($row['Omschrijving_DE']);
		$this->setOmschrijving_fr($row['Omschrijving_FR']);
		$this->setBrand($row['BRAND']);
		$this->setExclusive($row['EXCLUSIVE']);
		$this->setEancode($row['EANCode']);
		$this->setSyscreated($row['SYSCREATED']);
		$this->setSysmodified($row['sysmodified']);
	}

	public function toArray()
	{
		$item = array();
		$item['FAKDEBNR'] = $this->getFakdebnr();
		$item['ITEMCODE'] = $this->getItemcode();
		$item['TOELICHTING_NL'] = $this->getToelichting_nl();
		$item['TOELICHTING_EN'] = $this->getToelichting_en();
		$item['TOELICHTING_DE'] = $this->getToelichting_de();
		$item['TOELICHTING_FR'] = $this->getToelichting_fr();
		$item['LEVERWEEK'] = $this->getLeverweek();
		$item['LEVERWEEK_JJJJWW'] = $this->getLeverweekJW();
		$item['OMSCHRIJVING_NL'] = $this->getOmschrijving_nl();
		$item['OMSCHRIJVING_EN'] = $this->getOmschrijving_en();
		$item['OMSCHRIJVING_DE'] = $this->getOmschrijving_de();
		$item['OMSCHRIJVING_FR'] = $this->getOmschrijving_fr();
		$item['BRAND'] = $this->getBrand();
		$item['EXCLUSIVE'] = $this->getExclusive();	
		$item['EANCode'] = $this->getEancode();
		$item['SYSCREATED'] = $this->getSyscreated();
		$item['SYSMODIFIED'] = $this->getSysmodified();

		return $item;
	}
}