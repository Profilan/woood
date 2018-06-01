<?php

class Site_Model_SQLWooodOrderLine
{
	/**
	 * @var integer ID
	 */
	private $_id;
	/**
	 * @var string REFERENTIE
	 */
	private $_referentie;
	/**
	 * @var string DEBITEURNR
	 */
	private $_debiteurnr;
	/**
	 * @var string ITEMCODE
	 */
	private $_itemcode;
	/**
	 * @var float AANTAL
	 */
	private $_aantal;
	/**
	 * @var integer STATUS
	 */
	private $_status;
	/**
	 * @var Zend_Date SYSCREATED
	 */
	private $_syscreated;
	/**
	 * @var Zend_Date SYSMODIFIED
	 */
	private $_sysmodified;
	/**
	 * @var string ORDERNR
	 */
	private $_ordernr;
	/**
	 * @var string SYSMSG
	 */
	private $_sysmsg;
	/**
	 * 
	 * @var string VERZENDWEEK
	 */
	private $_verzendweek;
	
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
		$this->_id = -1;
		$this->_referentie = '';
		$this->_debiteurnr = '';
		$this->_itemcode = '';
		$this->_aantal = '';
		$this->_status = 0;
		$this->_syscreated = new Zend_Date('0000-00-00 00:00:00');
		$this->_sysmodified = new Zend_Date('0000-00-00 00:00:00');
		$this->_ordernr = '';
		$this->_sysmsg = '';
		$this->_verzendweek = '';
		
		$this->_mapper = null;
	}
	
	
	public function load($id) 
	{
		$this->getMapper()->find($id, $this);
	}
	
	/**
	 * schrijf de gegevens van de huidige comment in de database.
	 * @return void
	 */
	public function save() 
	{
		$this->getMapper()->save($this);
	}
		
	/**
	 * @return the $_id
	 */
	public function getId() {
		return $this->_id;
	}

	/**
	 * @param number $_id
	 */
	public function setId($_id) {
		$this->_id = $_id;
	}

	/**
	 * @return the $_referentie
	 */
	public function getReferentie() {
		return utf8_decode($this->_referentie);
	}

	/**
	 * @param string $_referentie
	 */
	public function setReferentie($_referentie) {
		$this->_referentie = $_referentie;
	}

	/**
     * @return the $_debiteurnr
     */
    public function getDebiteurnr()
    {
        return $this->_debiteurnr;
    }

	/**
     * @param string $_debiteurnr
     */
    public function setDebiteurnr($_debiteurnr)
    {
        $this->_debiteurnr = $_debiteurnr;
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
	 * @return the $_aantal
	 */
	public function getAantal() {
		return $this->_aantal;
	}

	/**
	 * @param number $_aantal
	 */
	public function setAantal($_aantal) {
		$this->_aantal = $_aantal;
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
	 * @return the $_syscreated
	 */
	public function getSyscreated() {
		return $this->_syscreated->toString('Y-M-d H:m:s');
	}
	
	/**
	 * @return the $_syscreated
	 */
	public function getSyscreatedObject() {
		return $this->_syscreated;
	}

	/**
	 * @param datetime $_syscreated
	 */
	public function setSyscreated($_syscreated) {
		$this->_syscreated = new Zend_Date($_syscreated);
	}

	/**
	 * @return the $_sysmodified
	 */
	public function getSysmodified() {
		return $this->_sysmodified->toString('Y-M-d H:m:s');
	}
	
	/**
	 * @return the $_sysmodified
	 */
	public function getSysmodifiedObject() {
		return $this->_sysmodified;
	}

	/**
	 * @param datetime $_sysmodified
	 */
	public function setSysmodified($_sysmodified) {
		$this->_sysmodified = new Zend_Date($_sysmodified);
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
	 * @return the $_sysmsg
	 */
	public function getSysmsg() {
		return $this->_sysmsg;
	}

	/**
	 * @param string $_sysmsg
	 */
	public function setSysmsg($_sysmsg) {
		$this->_sysmsg = $_sysmsg;
	}

    /**
     *
     * @return the string
     */
    public function getVerzendweek()
    {
        return $this->_verzendweek;
    }

    /**
     *
     * @param
     *            $_verzendweek
     */
    public function setVerzendweek($_verzendweek)
    {
        $this->_verzendweek = $_verzendweek;
        return $this;
    }
 

	public function getTableInfo() {
	    return $this->getMapper()->getInfo();
	}
	
	/**
	 * @return the $_mapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodOrderLineMapper('Site_Model_Db_SQLWooodOrderLineDao'));
		}
		return $this->_mapper;
	}
	
	/**
	 * @param Site_Model_Db_DataMapperAbstract $_mapper
	 */
	public function setMapper($_mapper) {
		$this->_mapper = $_mapper;
	}

	public function toArray()
	{
		$item = array();
		$item['ID'] = $this->getId();
		$item['REFERENTIE'] = $this->getReferentie();
		$item['DEBITEURNR'] = $this->getDebiteurnr();
		$item['ITEMCODE'] = $this->getItemcode();
		$item['AANTAL'] = $this->getAantal();
		$item['STATUS'] = $this->getStatus();
		$item['SYSCREATED'] = $this->getSyscreated();
		$item['SYSMODIFIED'] = $this->getSysmodified();
		$item['ORDERNR'] = $this->getOrdernr();
		$item['SYSMSG'] = $this->getSysmsg();
		$item['VERZENDWEEK'] = $this->getVerzendweek();
		
		return $item;
	}
} 