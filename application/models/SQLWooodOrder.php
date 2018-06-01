<?php

class Site_Model_SQLWooodOrder
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
	 * @var string OMSCHRIJVING
	 */
	private $_omschrijving;
	/**
	 * @var string DEBITEURNR
	 */
	private $_debiteurnr;
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
	 * @var string SELECTIECODE
	 */
	private $_selectiecode;
	/**
	 * @var string ORDERTOELICHTING
	 */
	private $_ordertoelichting;
	/**
	 * @var bool ACCEPTATIE_VERZAMELEN
	 */
	private $_acceptatieVerzamelen;
	/**
	 * @var bool ACCEPTATIE_ORDERKOSTEN
	 */
	private $_acceptatieOrderkosten;
	/**
	 * @var string DS_NAAM
	 */
	private $_dsNaam;
	/**
	 * @var string DS_AANSPREEKTITEL
	 */
	private $_dsAanspreektitel;
	/**
	 * @var string DS_ADRES1
	 */
	private $_dsAdres1;
	/**
	 * @var string DS_POSTCODE
	 */
	private $_dsPostcode;
	/**
	 * @var string DS_PLAATS
	 */
	private $_dsPlaats;
	/**
	 * @var string DS_LAND
	 */
	private $_dsLand;
	/**
	 * @var string DS_TELEFOON
	 */
	private $_dsTelefoon;
	/**
	 * @var string DS_EMAIL
	 */
	private $_dsEmail;
	/**
	 * @var string AUTHENTICATED_USER
	 */
	private $_authenticatedUser;
	/**
	 * @var bool ACCEPTATIE_ORDERSPLITSING
	 */
	private $_acceptatieOrdersplitsing;
	
	/**
	 * 
	 * @var bool PAYMENT_RELEASE_REQUIRED
	 */
	private $_paymentReleaseRequired;
	/**
	 * De datamapper voor dit object
	 * @var Site_Model_Db_DataMapperAbstract
	 */
	private $_mapper;

	/**
     * @return the $_selectiecode
     */
    public function getSelectiecode()
    {
        return $this->_selectiecode;
    }

	/**
     * @param string $_selectiecode
     */
    public function setSelectiecode($_selectiecode)
    {
        $this->_selectiecode = $_selectiecode;
    }

	/**
     * @return the $_ordertoelichting
     */
    public function getOrdertoelichting()
    {
        return utf8_decode($this->_ordertoelichting);
    }

	/**
     * @param string $_ordertoelichting
     */
    public function setOrdertoelichting($_ordertoelichting)
    {
        $this->_ordertoelichting = $_ordertoelichting;
    }

	/**
     * @return the $_acceptatieVerzamelen
     */
    public function getAcceptatieVerzamelen()
    {
        return $this->_acceptatieVerzamelen;
    }

	/**
     * @param boolean $_acceptatieVerzamelen
     */
    public function setAcceptatieVerzamelen($_acceptatieVerzamelen)
    {
        $this->_acceptatieVerzamelen = $_acceptatieVerzamelen;
    }

	/**
     * @return the $_acceptatieOrderkosten
     */
    public function getAcceptatieOrderkosten()
    {
        return $this->_acceptatieOrderkosten;
    }

	/**
     * @param boolean $_acceptatieOrderkosten
     */
    public function setAcceptatieOrderkosten($_acceptatieOrderkosten)
    {
        $this->_acceptatieOrderkosten = $_acceptatieOrderkosten;
    }

	/**
     * @return the $_dsNaam
     */
    public function getDsNaam()
    {
        return utf8_decode($this->_dsNaam);
    }

	/**
     * @param string $_dsNaam
     */
    public function setDsNaam($_dsNaam)
    {
        $this->_dsNaam = $_dsNaam;
    }

	/**
     * @return the $_dsAanspreektitel
     */
    public function getDsAanspreektitel()
    {
        return utf8_decode($this->_dsAanspreektitel);
    }

	/**
     * @param string $_dsAanspreektitel
     */
    public function setDsAanspreektitel($_dsAanspreektitel)
    {
        $this->_dsAanspreektitel = $_dsAanspreektitel;
    }

	/**
     * @return the $_dsAdres1
     */
    public function getDsAdres1()
    {
        return utf8_decode($this->_dsAdres1);
    }

	/**
     * @param string $_dsAdres1
     */
    public function setDsAdres1($_dsAdres1)
    {
        $this->_dsAdres1 = $_dsAdres1;
    }

	/**
     * @return the $_dsPostcode
     */
    public function getDsPostcode()
    {
        return $this->_dsPostcode;
    }

	/**
     * @param string $_dsPostcode
     */
    public function setDsPostcode($_dsPostcode)
    {
        $this->_dsPostcode = $_dsPostcode;
    }

	/**
     * @return the $_dsPlaats
     */
    public function getDsPlaats()
    {
        return utf8_decode($this->_dsPlaats);
    }

	/**
     * @param string $_dsPlaats
     */
    public function setDsPlaats($_dsPlaats)
    {
        $this->_dsPlaats = $_dsPlaats;
    }

	/**
     * @return the $_dsLand
     */
    public function getDsLand()
    {
        return utf8_decode($this->_dsLand);
    }

	/**
     * @param string $_dsLand
     */
    public function setDsLand($_dsLand)
    {
        $this->_dsLand = $_dsLand;
    }

	/**
     * @return the $_dsTelefoon
     */
    public function getDsTelefoon()
    {
        return $this->_dsTelefoon;
    }

	/**
     * @param string $_dsTelefoon
     */
    public function setDsTelefoon($_dsTelefoon)
    {
        $this->_dsTelefoon = $_dsTelefoon;
    }

	/**
     * @return the $_dsEmail
     */
    public function getDsEmail()
    {
        return utf8_decode($this->_dsEmail);
    }

	/**
     * @param string $_dsEmail
     */
    public function setDsEmail($_dsEmail)
    {
        $this->_dsEmail = $_dsEmail;
    }

	/**
     * @return the $_authenticatedUser
     */
    public function getAuthenticatedUser()
    {
        return $this->_authenticatedUser;
    }

	/**
     * @param string $_authenticatedUser
     */
    public function setAuthenticatedUser($_authenticatedUser)
    {
        $this->_authenticatedUser = $_authenticatedUser;
    }

    /**
     *
     * @return the bool
     */
    public function getAcceptatieOrdersplitsing()
    {
        return $this->_acceptatieOrdersplitsing;
    }

    /**
     *
     * @param
     *            $_acceptatieOrdersplitsing
     */
    public function setAcceptatieOrdersplitsing($_acceptatieOrdersplitsing)
    {
        $this->_acceptatieOrdersplitsing = $_acceptatieOrdersplitsing;
        return $this;
    }
 

	/**
     * @return bool $_paymentReleaseRequired
     */
    public function getPaymentReleaseRequired()
    {
        return $this->_paymentReleaseRequired;
    }

    /**
     * @param bool $_paymentReleaseRequired
     */
    public function setPaymentReleaseRequired($_paymentReleaseRequired)
    {
        $this->_paymentReleaseRequired = $_paymentReleaseRequired;
    }

    /**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		$this->_id = -1;
		$this->_referentie = '';
		$this->_omschrijving = '';
		$this->_debiteurnr = '';
		$this->_status = 0;
		$this->_syscreated = new Zend_Date('0000-00-00 00:00:00');
		$this->_sysmodified = new Zend_Date('0000-00-00 00:00:00');
		$this->_ordernr = '';
		$this->_sysmsg = '';
		$this->_selectiecode = '';
		$this->_ordertoelichting = '';
		$this->_acceptatieVerzamelen = 0;
		$this->_acceptatieOrderkosten = 0;
		$this->_dsNaam = '';
		$this->_dsAanspreektitel = '';
		$this->_dsAdres1 = '';
		$this->_dsPostcode = '';
		$this->_dsPlaats = '';
		$this->_dsLand = '';
		$this->_dsTelefoon = '';
		$this->_dsEmail = '';
		$this->_authenticatedUser = '';
		$this->_acceptatieOrdersplitsing = 0;
		$this->_paymentReleaseRequired = 0;
		
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
	 * @return the $_omschrijving
	 */
	public function getOmschrijving() {
		return utf8_decode($this->_omschrijving);
	}

	/**
	 * @param string $_omschrijving
	 */
	public function setOmschrijving($_omschrijving) {
		$this->_omschrijving = $_omschrijving;
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
		return $this->_syscreated->toString('YYYY-MM-dd HH:mm:ss');
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
	    if ($_syscreated instanceof DateTime) {
	      $this->_syscreated = $_syscreated;
	    } else {
		  $this->_syscreated = new Zend_Date($_syscreated);
	    }
	}

	/**
	 * @return the $_sysmodified
	 */
	public function getSysmodified() {
		return $this->_sysmodified->toString('YYYY-MM-dd HH:mm:ss');
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
	    if ($_sysmodified instanceof DateTime) {
	        $this->_sysmodified = $_sysmodified;
	    } else {
		  $this->_sysmodified = new Zend_Date($_sysmodified);
	    }
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
	 * @return the $_mapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodOrderMapper('Site_Model_Db_SQLWooodOrderDao'));
		}
		return $this->_mapper;
	}
	
	public function getTableInfo() {
	    return $this->getMapper()->getInfo();
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
		$item['OMSCHRIJVING'] = $this->getOmschrijving();
		$item['DEBITEURNR'] = $this->getDebiteurnr();
		$item['STATUS'] = $this->getStatus();
		$item['SYSCREATED'] = $this->getSyscreated();
		$item['SYSMODIFIED'] = $this->getSysmodified();
		$item['ORDERNR'] = $this->getOrdernr();
		$item['SYSMSG'] = $this->getSysmsg();
		$item['SELECTIECODE'] = $this->getSelectiecode();
		$item['ORDERTOELICHTING'] = $this->getOrdertoelichting();
		$item['ACCEPTATIE_VERZAMELEN'] = $this->getAcceptatieVerzamelen();
		$item['ACCEPTATIE_ORDERKOSTEN'] = $this->getAcceptatieOrderkosten();
		$item['DS_NAAM'] = $this->getDsNaam();
		$item['DS_AANSPREEKTITEL'] = $this->getDsAanspreektitel();
		$item['DS_ADRES1'] = $this->getDsAdres1();
		$item['DS_POSTCODE'] = $this->getDsPostcode();
		$item['DS_PLAATS'] = $this->getDsPlaats();
		$item['DS_LAND'] = $this->getDsLand();
		$item['DS_TELEFOON'] = $this->getDsTelefoon();
		$item['DS_EMAIL']= $this->getDsEmail();
		$item['AUTHENTICATED_USER'] = $this->getAuthenticatedUser();
		$item['ACCEPTATIE_ORDERSPLITSING'] = $this->getAcceptatieOrdersplitsing();
		$item['PAYMENT_RELEASE_REQUIRED'] = $this->getPaymentReleaseRequired();
		
		return $item;
	}
} 