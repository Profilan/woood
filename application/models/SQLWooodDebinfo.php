<?php

class Site_Model_SQLWooodDebinfo
{

	/**
	 * @var string debiteurnr
	 */
	private $_debiteurnr;
	/**
	 * @var string naam
	 */
	private $_naam;
	/**
	 * @var string TYPE
	 */
	private $_type;
	/**
	 * @var string FAKTUURDEBITEURNR
	 */
	private $_faktuurdebiteurnr;
	/**
	 * @var string CLASSIFICATIE
	 */
	private $_classificatie;
	/**
	 * @var string CLASS_OMS
	 */
	private $_class_oms;
	/**
	 * @var string BTWNR
	 */
	private $_btwnr;
	/**
	 * @var string BETALINGSCONDITIE
	 */
	private $_betalingsconditie;
	/**
	 * @var string BETALINGSCONDITIEOMS
	 */
	private $_betalingsconditieoms;
	/**
	 * @var string LEVERINGSWIJZE
	 */
	private $_leveringswijze;
	/**
	 * @var bool WOOOD.NL
	 */
	private $_woood_nl;
	/**
	 * @var bool PORTAL
	 */
	private $_portal;
	/**
	 * @var string FACTADRES
	 */
	private $_factadres;
	/**
	 * @var string FACTPC
	 */
	private $_factpc;
	/**
	 * @var string FACTPLAATS
	 */
	private $_factplaats;
	/**
	 * @var string FACTLANDCODE
	 */
	private $_factlandcode;
	/**
	 * @var string FACTLAND
	 */
	private $_factland;
	/**
	 * @var string BEZADRES
	 */
	private $_bezadres;
	/**
	 * @var string BEZPC
	 */
	private $_bezpc;
	/**
	 * @var string BEZPLAATS
	 */
	private $_bezplaats;
	/**
	 * @var string BEZLANDCODE
	 */
	private $_bezlandcode;
	/**
	 * @var string BEZLAND
	 */
	private $_bezland;
	/**
	 * @var string AFLADRES
	 */
	private $_afladres;
	/**
	 * @var string AFLPC
	 */
	private $_aflpc;
	/**
	 * @var string AFLPLAATS
	 */
	private $_aflplaats;
	/**
	 * @var string AFLLANDCODE
	 */
	private $_afllandcode;
	/**
	 * @var string AFLLAND
	 */
	private $_aflland;
	/**
	 * @var string POSTADRES
	 */
	private $_postadres;
	/**
	 * @var string POSTPC
	 */
	private $_postpc;
	/**
	 * @var string POSTPLAATS
	 */
	private $_postplaats;
	/**
	 * @var string POSTLANDCODE
	 */
	private $_postlandcode;
	/**
	 * @var string POSTLAND
	 */
	private $_postland;
	/**
	 * @var string cmp_name
	 */
	private $_cmp_name;
	/**
	 * @var string kvk
	 */
	private $_kvk;
	/**
	 * @var float FRANCO_LIMIET
	 */
	private $_francoLimiet;
	/**
	 * @var float MINIMUM_ORDER_LIMIET
	 */
	private $_minimumOrderLimiet;
	/**
	 * @var float ORDER_TOESLAG
	 */
	private $_orderToeslag;
	/**
	 * @var int ORDER_TOESLAG
	 */
	private $_accountmanager;
	
	/**
	 * 
	 * @var string DFF_Accesscode
	 */
	private $_dffAccesscode;

	/**
	 *
	 * @var bool OVERRIDE_LIMITS
	 */
	private $_overrideLimits;
	
	/**
	 * 
	 * @var string DEB_NAME_ALIAS
	 */
	private $_debNameAlias;
	
	/**
	 *
	 * @var string DEB_WWW_ALIAS
	 */
	private $_debWWWAlias;
	
	
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
		$this->_naam = '';
		$this->_type = '';
		$this->_debiteurnr = '';
		$this->_faktuurdebiteurnr = '';
		$this->_classificatie = '';
		$this->_class_oms = '';
		$this->_btwnr = '';
		$this->_betalingsconditie = '';
		$this->_betalingsconditieoms = '';
		$this->_leveringswijze = '';
		$this->_woood_nl = 0;
		$this->_portal = 0;
		$this->_factadres = '';
		$this->_factpc = '';
		$this->_factplaats = '';
		$this->_factlandcode = '';
		$this->_factland = '';
		$this->_bezadres = '';
		$this->_bezpc = '';
		$this->_bezplaats = '';
		$this->_bezlandcode = '';
		$this->_bezland = '';
		$this->_afladres = '';
		$this->_aflpc = '';
		$this->_aflplaats = '';
		$this->_afllandcode = '';
		$this->_aflland = '';
		$this->_postadres = '';
		$this->_postpc = '';
		$this->_postplaats = '';
		$this->_postlandcode = '';
		$this->_postland = '';
		$this->_cmp_name = '';	
		$this->_kvk = '';
		$this->_francoLimiet = 0.00;
		$this->_minimumOrderLimiet = 0.00;
		$this->_orderToeslag = 0.00;
		$this->_accountmanager = 0;
		$this->_dffAccesscode = '';
		$this->_overrideLimits = 0;
		$this->_debNameAlias = '';
		$this->_debWWWAlias = '';
		
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_DEBINFO');
		$select->where('DEBITEURNR = ?', $id);
		
		$row = $db1->fetchRow($select);
		
		$this->setNaam($row['NAAM']);
		$this->setType($row['TYPE']);
		$this->setDebiteurnr($row['DEBITEURNR']);
		$this->setFaktuurdebiteurnr($row['FAKTUURDEBITEURNR']);
		$this->setClassificatie($row['CLASSIFICATIE']);
		$this->setClass_oms($row['CLASS_OMS']);
		$this->setBtwnr($row['BTWNR']);
		$this->setBetalingsconditie($row['BETALINGSCONDITIE']);
		$this->setBetalingsconditieoms($row['BETALINGSCONDITIEOMS']);
		$this->setLeveringswijze($row['LEVERINGSWIJZE']);
		$this->setWoood_nl($row['WOOOD.NL']);
		$this->setPortal($row['PORTAL']);
		$this->setFactadres($row['FACTADRES']);
		$this->setFactpc($row['FACTPC']);
		$this->setFactplaats($row['FACTPLAATS']);
		$this->setFactlandcode($row['FACTLANDCODE']);
		$this->setFactland($row['FACTLAND']);
		$this->setBezadres($row['BEZADRES']);
		$this->setBezpc($row['BEZPC']);
		$this->setBezplaats($row['BEZPLAATS']);
		$this->setBezlandcode($row['BEZLANDCODE']);
		$this->setBezland($row['BEZLAND']);
		$this->setAfladres($row['AFLADRES']);
		$this->setAflpc($row['AFLPC']);
		$this->setAflplaats($row['AFLPLAATS']);
		$this->setAfllandcode($row['AFLLANDCODE']);
		$this->setAflland($row['AFLLAND']);
		$this->setPostadres($row['POSTADRES']);
		$this->setPostpc($row['POSTPC']);
		$this->setPostplaats($row['POSTPLAATS']);
		$this->setPostlandcode($row['POSTLANDCODE']);
		$this->setPostland($row['POSTLAND']);
		$this->setCmp_name($row['cmp_name']);
		$this->setKvk($row['KvK']);
		$this->setFrancolimiet($row['FRANCO_LIMIET']);
		$this->setMinimumorderlimiet($row['MINIMUM_ORDER_LIMIET']);
		$this->setOrdertoeslag($row['ORDER_TOESLAG']);
		$this->setAccountmanager($row['ACCOUNTMANAGER']);
		$this->setDffAccesscode($row['DFF_Accesscode']);
		$this->setOverrideLimits($row['OVERRIDE_LIMITS']);
		$this->setDebNameAlias($row['DEB_NAME_ALIAS']);
		$this->setDebWWWAlias($row['DEB_WWW_ALIAS']);
		
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
	 * @return the $_naam
	 */
	public function getNaam() {
		return utf8_encode($this->_naam);
	}

	/**
	 * @param string $_naam
	 */
	public function setNaam($_naam) {
		$this->_naam = $_naam;
	}

	/**
	 * @return the $_type
	 */
	public function getType() {
		return $this->_type;
	}

	/**
	 * @param string $_type
	 */
	public function setType($_type) {
		$this->_type = $_type;
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
	 * @return the $_classificatie
	 */
	public function getClassificatie() {
		return $this->_classificatie;
	}

	/**
	 * @param string $_classificatie
	 */
	public function setClassificatie($_classificatie) {
		$this->_classificatie = $_classificatie;
	}

	/**
	 * @return the $_class_oms
	 */
	public function getClass_oms() {
		return utf8_encode($this->_class_oms);
	}

	/**
	 * @param string $_class_oms
	 */
	public function setClass_oms($_class_oms) {
		$this->_class_oms = $_class_oms;
	}

	/**
	 * @return the $_btwnr
	 */
	public function getBtwnr() {
		return utf8_encode($this->_btwnr);
	}

	/**
	 * @param string $_btwnr
	 */
	public function setBtwnr($_btwnr) {
		$this->_btwnr = $_btwnr;
	}

	/**
	 * @return the $_betalingsconditie
	 */
	public function getBetalingsconditie() {
		return utf8_encode($this->_betalingsconditie);
	}

	/**
	 * @param string $_betalingsconditie
	 */
	public function setBetalingsconditie($_betalingsconditie) {
		$this->_betalingsconditie = $_betalingsconditie;
	}

	/**
	 * @return the $_betalingsconditieoms
	 */
	public function getBetalingsconditieoms() {
		return utf8_encode($this->_betalingsconditieoms);
	}

	/**
	 * @param string $_betalingsconditieoms
	 */
	public function setBetalingsconditieoms($_betalingsconditieoms) {
		$this->_betalingsconditieoms = $_betalingsconditieoms;
	}

	/**
     * @return the $_leveringswijze
     */
    public function getLeveringswijze()
    {
        return trim($this->_leveringswijze);
    }

    /**
     * @param string $_leveringswijze
     */
    public function setLeveringswijze($_leveringswijze)
    {
        $this->_leveringswijze = $_leveringswijze;
    }

    /**
	 * @return the $_woood_nl
	 */
	public function getWoood_nl() {
		return $this->_woood_nl;
	}

	/**
	 * @param boolean $_woood_nl
	 */
	public function setWoood_nl($_woood_nl) {
		$this->_woood_nl = $_woood_nl;
	}

	/**
	 * @return the $_portal
	 */
	public function getPortal() {
		return $this->_portal;
	}

	/**
	 * @param boolean $_portal
	 */
	public function setPortal($_portal) {
		$this->_portal = $_portal;
	}

	/**
	 * @return the $_factadres
	 */
	public function getFactadres() {
		return utf8_encode($this->_factadres);
	}

	/**
	 * @param string $_factadres
	 */
	public function setFactadres($_factadres) {
		$this->_factadres = $_factadres;
	}

	/**
	 * @return the $_factpc
	 */
	public function getFactpc() {
		return $this->_factpc;
	}

	/**
	 * @param string $_factpc
	 */
	public function setFactpc($_factpc) {
		$this->_factpc = $_factpc;
	}

	/**
	 * @return the $_factplaats
	 */
	public function getFactplaats() {
		return utf8_encode($this->_factplaats);
	}

	/**
	 * @param string $_factplaats
	 */
	public function setFactplaats($_factplaats) {
		$this->_factplaats = $_factplaats;
	}

	/**
	 * @return the $_factlandcode
	 */
	public function getFactlandcode() {
		return $this->_factlandcode;
	}

	/**
	 * @param string $_factlandcode
	 */
	public function setFactlandcode($_factlandcode) {
		$this->_factlandcode = $_factlandcode;
	}

	/**
	 * @return the $_factland
	 */
	public function getFactland() {
		return utf8_encode($this->_factland);
	}

	/**
	 * @param string $_factland
	 */
	public function setFactland($_factland) {
		$this->_factland = $_factland;
	}

	/**
	 * @return the $_bezadres
	 */
	public function getBezadres() {
		return utf8_encode($this->_bezadres);
	}

	/**
	 * @param string $_bezadres
	 */
	public function setBezadres($_bezadres) {
		$this->_bezadres = $_bezadres;
	}

	/**
	 * @return the $_bezpc
	 */
	public function getBezpc() {
		return $this->_bezpc;
	}

	/**
	 * @param string $_bezpc
	 */
	public function setBezpc($_bezpc) {
		$this->_bezpc = $_bezpc;
	}

	/**
	 * @return the $_bezplaats
	 */
	public function getBezplaats() {
		return utf8_encode($this->_bezplaats);
	}

	/**
	 * @param string $_bezplaats
	 */
	public function setBezplaats($_bezplaats) {
		$this->_bezplaats = $_bezplaats;
	}

	/**
	 * @return the $_bezlandcode
	 */
	public function getBezlandcode() {
		return $this->_bezlandcode;
	}

	/**
	 * @param string $_bezlandcode
	 */
	public function setBezlandcode($_bezlandcode) {
		$this->_bezlandcode = $_bezlandcode;
	}

	/**
	 * @return the $_bezland
	 */
	public function getBezland() {
		return utf8_encode($this->_bezland);
	}

	/**
	 * @param string $_bezland
	 */
	public function setBezland($_bezland) {
		$this->_bezland = $_bezland;
	}

	/**
	 * @return the $_afladres
	 */
	public function getAfladres() {
		return utf8_encode($this->_afladres);
	}

	/**
	 * @param string $_afladres
	 */
	public function setAfladres($_afladres) {
		$this->_afladres = $_afladres;
	}

	/**
	 * @return the $_aflpc
	 */
	public function getAflpc() {
		return $this->_aflpc;
	}

	/**
	 * @param string $_aflpc
	 */
	public function setAflpc($_aflpc) {
		$this->_aflpc = $_aflpc;
	}

	/**
	 * @return the $_aflplaats
	 */
	public function getAflplaats() {
		return utf8_encode($this->_aflplaats);
	}

	/**
	 * @param string $_aflplaats
	 */
	public function setAflplaats($_aflplaats) {
		$this->_aflplaats = $_aflplaats;
	}

	/**
	 * @return the $_afllandcode
	 */
	public function getAfllandcode() {
		return $this->_afllandcode;
	}

	/**
	 * @param string $_afllandcode
	 */
	public function setAfllandcode($_afllandcode) {
		$this->_afllandcode = $_afllandcode;
	}

	/**
	 * @return the $_aflland
	 */
	public function getAflland() {
		return utf8_encode($this->_aflland);
	}

	/**
	 * @param string $_aflland
	 */
	public function setAflland($_aflland) {
		$this->_aflland = $_aflland;
	}

	/**
	 * @return the $_postadres
	 */
	public function getPostadres() {
		return utf8_encode($this->_postadres);
	}

	/**
	 * @param string $_postadres
	 */
	public function setPostadres($_postadres) {
		$this->_postadres = $_postadres;
	}

	/**
	 * @return the $_postpc
	 */
	public function getPostpc() {
		return $this->_postpc;
	}

	/**
	 * @param string $_postpc
	 */
	public function setPostpc($_postpc) {
		$this->_postpc = $_postpc;
	}

	/**
	 * @return the $_postplaats
	 */
	public function getPostplaats() {
		return utf8_encode($this->_postplaats);
	}

	/**
	 * @param string $_postplaats
	 */
	public function setPostplaats($_postplaats) {
		$this->_postplaats = $_postplaats;
	}

	/**
	 * @return the $_postlandcode
	 */
	public function getPostlandcode() {
		return $this->_postlandcode;
	}

	/**
	 * @param string $_postlandcode
	 */
	public function setPostlandcode($_postlandcode) {
		$this->_postlandcode = $_postlandcode;
	}

	/**
	 * @return the $_postland
	 */
	public function getPostland() {
		return utf8_encode($this->_postland);
	}

	/**
	 * @param string $_postland
	 */
	public function setPostland($_postland) {
		$this->_postland = $_postland;
	}

	/**
	 * @return the $_cmp_name
	 */
	public function getCmp_name() {
		return utf8_encode($this->_cmp_name);
	}

	/**
	 * @param string $_cmp_name
	 */
	public function setCmp_name($_cmp_name) {
		$this->_cmp_name = $_cmp_name;
	}

	/**
	 * @return the $_kvk
	 */
	public function getKvk() {
		return utf8_encode($this->_kvk);
	}

	/**
	 * @param string $_kvk
	 */
	public function setKvk($_kvk) {
		$this->_kvk = $_kvk;
	}

	/**
	 *
	 * @return the float
	 */
	public function getFrancolimiet()
	{
	    return $this->_francoLimiet;
	}
	
	/**
	 *
	 * @param
	 *            $_francoLimiet
	 */
	public function setFrancolimiet($_francoLimiet)
	{
	    $this->_francoLimiet = $_francoLimiet;
	    return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getMinimumorderlimiet()
	{
	    return $this->_minimumOrderLimiet;
	}
	
	/**
	 *
	 * @param
	 *            $_minimumOrderLimiet
	 */
	public function setMinimumorderlimiet($_minimumOrderLimiet)
	{
	    $this->_minimumOrderLimiet = $_minimumOrderLimiet;
	    return $this;
	}
	
	/**
	 *
	 * @return the float
	 */
	public function getOrdertoeslag()
	{
	    return $this->_orderToeslag;
	}
	
	/**
	 *
	 * @param $_orderToeslag
	 */
	public function setOrdertoeslag($_orderToeslag)
	{
	    $this->_orderToeslag = $_orderToeslag;
	    return $this;
	}

    /**
     *
     * @return the int
     */
    public function getAccountmanager()
    {
        return $this->_accountmanager;
    }

    /**
     *
     * @param $_accountmanager
     */
    public function setAccountmanager($_accountmanager)
    {
        $this->_accountmanager = $_accountmanager;
        return $this;
    }
 
	
	/**
     * @return the $_dffAccesscode
     */
    public function getDffAccesscode()
    {
        return $this->_dffAccesscode;
    }

    /**
     * @param string $_dffAccesscode
     */
    public function setDffAccesscode($_dffAccesscode)
    {
        $this->_dffAccesscode = $_dffAccesscode;
        return $this;
    }

    /**
     * @return the $_overrideLimits
     */
    public function getOverrideLimits()
    {
        return $this->_overrideLimits;
    }

    /**
     * @param boolean $_overrideLimits
     */
    public function setOverrideLimits($_overrideLimits)
    {
        $this->_overrideLimits = $_overrideLimits;
        return $this;
    }

    /**
     * @return the $_debNameAlias
     */
    public function getDebNameAlias()
    {
        return utf8_encode($this->_debNameAlias);
    }

    /**
     * @param string $_debNameAlias
     */
    public function setDebNameAlias($_debNameAlias)
    {
        $this->_debNameAlias = $_debNameAlias;
    }

    /**
     * @return the $_debWWWAlias
     */
    public function getDebWWWAlias()
    {
        return utf8_encode($this->_debWWWAlias);
    }

    /**
     * @param string $_debWWWAlias
     */
    public function setDebWWWAlias($_debWWWAlias)
    {
        $this->_debWWWAlias = $_debWWWAlias;
    }

    public function toArray()
	{
		$item = array();
		$item['NAAM'] = $this->getNaam();
		$item['TYPE'] = $this->getType();
		$item['DEBITEURNR'] = $this->getDebiteurnr();
		$item['FAKTUURDEBITEURNR'] = $this->getFaktuurdebiteurnr();
		$item['CLASSIFICATIE'] = $this->getClassificatie();
		$item['CLASS_OMS'] = $this->getClass_oms();
		$item['BTWNR'] = $this->getBtwnr();
		$item['BETALINGSCONDITIE'] = $this->getBetalingsconditie();
		$item['BETALINGSCONDITIEOMS'] = $this->getBetalingsconditieoms();
		$item['LEVERINGSWIJZE'] = $this->getLeveringswijze();
		$item['WOOOD.NL'] = $this->getWoood_nl();
		$item['PORTAL'] = $this->getPortal();
		$item['FACTADRES'] = $this->getFactadres();
		$item['FACTPC'] = $this->getFactpc();
		$item['FACTPLAATS'] = $this->getFactplaats();
		$item['FACTLANDCODE'] = $this->getFactlandcode();
		$item['FACTLAND'] = $this->getFactland();
		$item['BEZADRES'] = $this->getBezadres();
		$item['BEZPC'] = $this->getBezpc();
		$item['BEZPLAATS'] = $this->getBezplaats();
		$item['BEZLANDCODE'] = $this->getBezlandcode();
		$item['BEZLAND'] = $this->getBezland();
		$item['AFLADRES'] = $this->getAfladres();
		$item['AFLPC'] = $this->getAflpc();
		$item['AFLPLAATS'] = $this->getAflplaats();
		$item['AFLLANDCODE'] = $this->getAfllandcode();
		$item['AFLLAND'] = $this->getAflland();
		$item['POSTADRES'] = $this->getPostadres();
		$item['POSTPC'] = $this->getPostpc();
		$item['POSTPLAATS'] = $this->getPostplaats();
		$item['POSTLANDCODE'] = $this->getPostlandcode();
		$item['POSTLAND'] = $this->getPostland();
		$item['CMP_NAME'] = $this->getCmp_name();
		$item['KVK'] = $this->getKvk();
		$item['FRANCO_LIMIET'] = $this->getFrancolimiet();
		$item['MINIMUM_ORDER_LIMIET'] = $this->getMinimumorderlimiet();
		$item['ORDER_TOESLAG'] = $this->getOrdertoeslag();
		$item['ACCOUNTMANAGER'] = $this->getAccountmanager();
		$item['DFF_ACCESSCODE'] = $this->getDffAccesscode();
		$item['OVERRIDE_LIMITS'] = $this->getOverrideLimits();
		$item['DEB_NAME_ALIAS'] = $this->getDebNameAlias();
		$item['DEB_WWW_ALIAS'] = $this->getDebWWWAlias();
		
		return $item;
	}
}