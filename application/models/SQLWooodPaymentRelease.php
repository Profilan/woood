<?php

class Site_Model_SQLWooodPaymentRelease
{
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $referentie;
    
    /**
     * @var string
     */
    protected $debiteurnr;
    
    /**
     * @var boolean
     */
    protected $paymentRelease;
    
    /**
     * @var integer
     */
    protected $status;
    
    /**
     * @var \DateTime
     */
    protected $syscreated;
    
    /**
     * @var \DateTime
     */
    protected $sysmodified;
    
    /**
     * @var string
     */
    protected $sysmsg;
    

    /**
	 * De datamapper voor dit object
	 * @var Site_Model_Db_DataMapperAbstract
	 */
	protected $_mapper;

    /**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		
	    $this->id = -1;
	    $this->syscreated = new Zend_Date();
	    $this->sysmodified = new Zend_Date();
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
     * @return the $referentie
     */
    public function getReferentie()
    {
        return $this->referentie;
    }

    /**
     * @param string $referentie
     */
    public function setReferentie($referentie)
    {
        $this->referentie = $referentie;
    }

    /**
     * @return the $debiteurnr
     */
    public function getDebiteurnr()
    {
        return $this->debiteurnr;
    }

    /**
     * @param string $debiteurnr
     */
    public function setDebiteurnr($debiteurnr)
    {
        $this->debiteurnr = $debiteurnr;
    }

    /**
     * @return the $paymentRelease
     */
    public function getPaymentRelease()
    {
        return $this->paymentRelease;
    }

    /**
     * @param boolean $paymentRelease
     */
    public function setPaymentRelease($paymentRelease)
    {
        $this->paymentRelease = $paymentRelease;
    }

    /**
     * @return the $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param number $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
	 * @return string $syscreated
	 */
	public function getSyscreated() {
		return $this->syscreated->toString('YYYY-MM-dd HH:mm:ss');
	}
	
	/**
	 * @return Zend_Date $syscreated
	 */
	public function getSyscreatedObject() {
		return $this->syscreated;
	}

	/**
	 * @param mixed $syscreated
	 */
	public function setSyscreated($syscreated) {
	    if ($syscreated instanceof DateTime) {
	      $this->syscreated = $syscreated;
	    } else {
		  $this->syscreated = new Zend_Date($syscreated);
	    }
	}

	/**
	 * @return string $sysmodified
	 */
	public function getSysmodified() {
		return $this->sysmodified->toString('YYYY-MM-dd HH:mm:ss');
	}
	
	/**
	 * @return mixed $sysmodified
	 */
	public function getSysmodifiedObject() {
		return $this->sysmodified;
	}

	/**
	 * @param Zend_Date $sysmodified
	 */
	public function setSysmodified($sysmodified) {
	    if ($sysmodified instanceof DateTime) {
	        $this->sysmodified = $sysmodified;
	    } else {
		  $this->sysmodified = new Zend_Date($sysmodified);
	    }
	}

	/**
     * @return string $sysmsg
     */
    public function getSysmsg()
    {
        return $this->sysmsg;
    }

    /**
     * @param string $sysmsg
     */
    public function setSysmsg($sysmsg)
    {
        $this->sysmsg = $sysmsg;
    }

    /**
	 * @return Site_Model_Db_SQLWooodPaymentReleaseMapper $_mapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodPaymentReleaseMapper('Site_Model_Db_SQLWooodPaymentReleaseDao'));  
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
		$item['DEBITEURNR'] = $this->getDebiteurnr();
		$item['PAYMENT_RELEASE'] = $this->getPaymentRelease();
		$item['STATUS'] = $this->getStatus();
		$item['SYSCREATED'] = $this->getSyscreated();
		$item['SYSMODIFIED'] = $this->getSysmodified();
		$item['SYSMSG'] = $this->getSysmsg();
		
		return $item;
	}
} 