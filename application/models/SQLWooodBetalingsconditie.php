<?php

class Site_Model_SQLWooodBetalingsconditie
{
    /**
     * @var string CODE
     */
    private $code;
    
    /**
     * @var string NL_DESC
     */
    private $nlDesc;

    /**
     * @var string EN_DESC
     */
    private $enDesc;

    /**
     * @var string DE_DESC
     */
    private $deDesc;

    /**
     * @var string FR_DESC
     */
    private $frDesc;

    /**
     * De datamapper voor dit object
     * @var Site_Model_Db_DataMapperAbstract
     */
    private $mapper;
    
    public function __construct() {
        $this->code = '';
        $this->nlDesc = '';
        $this->enDesc = '';
        $this->deDesc = '';
        $this->frDesc = '';
        
        $this->mapper = null;
    }
    
    /**
     * @return the $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return the $nlDesc
     */
    public function getNlDesc()
    {
        return utf8_encode($this->nlDesc);
    }

    /**
     * @param string $nlDesc
     */
    public function setNlDesc($nlDesc)
    {
        $this->nlDesc = $nlDesc;
    }

    /**
     * @return the $enDesc
     */
    public function getEnDesc()
    {
        return utf8_encode($this->enDesc);
    }

    /**
     * @param string $enDesc
     */
    public function setEnDesc($enDesc)
    {
        $this->enDesc = $enDesc;
    }

    /**
     * @return the $deDesc
     */
    public function getDeDesc()
    {
        return utf8_encode($this->deDesc);
    }

    /**
     * @param string $deDesc
     */
    public function setDeDesc($deDesc)
    {
        $this->deDesc = $deDesc;
    }

    /**
     * @return the $frDesc
     */
    public function getFrDesc()
    {
        return utf8_encode($this->frDesc);
    }

    /**
     * @param string $frDesc
     */
    public function setFrDesc($frDesc)
    {
        $this->frDesc = $frDesc;
    }

    public function load($id)
    {
        $db1 = Zend_Registry::get('db1');
        $select = $db1->select();
        $select->from('_AB_DEB_BETALINGSCONDITIES');
        $select->where('CODE = ?', $id);
    
        $row = $db1->fetchRow($select);
        $this->setCode($row['CODE']);
        $this->setNlDesc($row['NL_DESC']);
        $this->setEnDesc($row['EN_DESC']);
        $this->setDeDesc($row['DE_DESC']);
        $this->setFrDesc($row['FR_DESC']);
    }
    
    public function toArray()
    {
        $item = array();
        $item['CODE']  = $this->getCode();
        $item['NL_DESC']    = $this->getNlDesc();
        $item['EN_DESC']    = $this->getEnDesc();
        $item['DE_DESC']    = $this->getDeDesc();
        $item['FR_DESC']    = $this->getFrDesc();
    
        return $item;
    }
    
}