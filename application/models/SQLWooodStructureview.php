<?php

class Site_Model_SQLWooodStructureview
{
	/**
	 * @var int ID
	 */
	private $_id;
	/**
	 * @var int LVL
	 */
	private $_lvl;
	/**
	 * @var string SEQ_NO
	 */
	private $_seqNo;
	/**
	 * @var string MAINPROD
	 */
	private $_mainprod;
	/**
	 * @var string ITEMPROD
	 */
	private $_itemprod;
	/**
	 * @var string ITEMPROD_DESC
	 */
	private $_itemprodDesc;
	/**
	 * @var string ITEMREQ
	 */
	private $_itemreq;
	/**
	 * @var string ITEMREQ_DESC
	 */
	private $_itemreqDesc;
	/**
	 * @var string EN_ITEMREQ_DESC
	 */
	private $_enItemreqDesc;
	/**
	 * @var string DE_ITEMREQ_DESC
	 */
	private $_deItemreqDesc;
	/**
	 * @var string FR_ITEMREQ_DESC
	 */
	private $_frItemreqDesc;
	/**
	 * @var float QTY_PER_MAINPROD
	 */
	private $_qtyPerMainprod;
	
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
	    $this->_lvl = 0;
	    $this->_seqNo = '';
	    $this->_mainprod = '';
	    $this->_itemprod = '';
	    $this->_itemprodDesc = '';
	    $this->_itemreq = '';
	    $this->_itemreqDesc = '';
	    $this->_enItemreqDesc = '';
	    $this->_deItemreqDesc = '';
	    $this->_frItemreqDesc = '';
	    $this->_qtyPerMainprod = 0;
	    
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_ARTIKELSTRUCTUREN');
		$select->where('ID = ?', $id);
		
		$row = $db1->fetchRow($select);
		
		$this->setId($row['ID']);
		$this->setLvl($row['LVL']);
		$this->setSeqNo($row['SEQ_NO']);
		$this->setMainprod($row['MAINPROD']);
		$this->setItemprod($row['ITEMPROD']);
		$this->setItemprodDesc($row['ITEMPROD_DESC']);
		$this->setItemreq($row['ITEMREQ']);
		$this->setItemreqDesc($row['ITEMREQ_DESC']);
		$this->setEnItemreqDesc($row['EN_ITEMREQ_DESC']);
		$this->setDeItemreqDesc($row['DE_ITEMREQ_DESC']);
		$this->setFrItemreqDesc($row['FR_ITEMREQ_DESC']);
		$this->setQtyPerMainprod($row['QTY_PER_MAINPROD']);
		
		$this->getMapper()->find($id, $this);
	}

	/**
     * @return the $_id
     */
    public function getId()
    {
        return $this->_id;
    }

	/**
     * @param number $_id
     */
    public function setId($_id)
    {
        $this->_id = $_id;
    }

	/**
     * @return the $_lvl
     */
    public function getLvl()
    {
        return $this->_lvl;
    }

	/**
     * @param number $_lvl
     */
    public function setLvl($_lvl)
    {
        $this->_lvl = $_lvl;
    }

	/**
     * @return the $_seqNo
     */
    public function getSeqNo()
    {
        return $this->_seqNo;
    }

	/**
     * @param string $_seqNo
     */
    public function setSeqNo($_seqNo)
    {
        $this->_seqNo = $_seqNo;
    }

	/**
     * @return the $_mainprod
     */
    public function getMainprod()
    {
        return $this->_mainprod;
    }

	/**
     * @param string $_mainprod
     */
    public function setMainprod($_mainprod)
    {
        $this->_mainprod = $_mainprod;
    }

	/**
     * @return the $_itemprod
     */
    public function getItemprod()
    {
        return $this->_itemprod;
    }

	/**
     * @param string $_itemprod
     */
    public function setItemprod($_itemprod)
    {
        $this->_itemprod = $_itemprod;
    }

	/**
     * @return the $_itemprodDesc
     */
    public function getItemprodDesc()
    {
        return utf8_encode($this->_itemprodDesc);
    }

	/**
     * @param string $_itemprodDesc
     */
    public function setItemprodDesc($_itemprodDesc)
    {
        $this->_itemprodDesc = $_itemprodDesc;
    }

	/**
     * @return the $_itemreq
     */
    public function getItemreq()
    {
        return $this->_itemreq;
    }

	/**
     * @param string $_itemreq
     */
    public function setItemreq($_itemreq)
    {
        $this->_itemreq = $_itemreq;
    }

	/**
     * @return the $_itemreqDesc
     */
    public function getItemreqDesc()
    {
        return utf8_encode($this->_itemreqDesc);
    }

	/**
     * @param string $_itemreqDesc
     */
    public function setItemreqDesc($_itemreqDesc)
    {
        $this->_itemreqDesc = $_itemreqDesc;
    }

	/**
     * @return the $_enItemreqDesc
     */
    public function getEnItemreqDesc()
    {
        return $this->_enItemreqDesc;
    }

	/**
     * @param string $_enItemreqDesc
     */
    public function setEnItemreqDesc($_enItemreqDesc)
    {
        $this->_enItemreqDesc = $_enItemreqDesc;
    }

	/**
     * @return the $_deItemreqDesc
     */
    public function getDeItemreqDesc()
    {
        return $this->_deItemreqDesc;
    }

	/**
     * @param string $_deItemreqDesc
     */
    public function setDeItemreqDesc($_deItemreqDesc)
    {
        $this->_deItemreqDesc = $_deItemreqDesc;
    }

	/**
     * @return the $_frItemreqDesc
     */
    public function getFrItemreqDesc()
    {
        return $this->_frItemreqDesc;
    }

	/**
     * @param string $_frItemreqDesc
     */
    public function setFrItemreqDesc($_frItemreqDesc)
    {
        $this->_frItemreqDesc = $_frItemreqDesc;
    }

	/**
     * @return the $_qtyPerMainprod
     */
    public function getQtyPerMainprod()
    {
        return $this->_qtyPerMainprod;
    }

	/**
     * @param number $_qtyPerMainprod
     */
    public function setQtyPerMainprod($_qtyPerMainprod)
    {
        $this->_qtyPerMainprod = $_qtyPerMainprod;
    }

	public function toArray()
	{
		$item = array();
		$item['ID'] = $this->getId();
		$item['LVL'] = $this->getLvl();
		$item['SEQ_NO'] = $this->getSeqNo();
		$item['MAINPROD'] = $this->getMainprod();
		$item['ITEMPROD'] = $this->getItemprod();
		$item['ITEMPROD_DESC'] = $this->getItemprodDesc();
		$item['ITEMREQ'] = $this->getItemreq();
		$item['NL_ITEMREQ_DESC'] = $this->getItemreqDesc();
		$item['EN_ITEMREQ_DESC'] = $this->getEnItemreqDesc();
		$item['DE_ITEMREQ_DESC'] = $this->getDeItemreqDesc();
		$item['FR_ITEMREQ_DESC'] = $this->getFrItemreqDesc();
		$item['QTY_PER_MAINPROD'] = $this->getQtyPerMainprod();
		
		return $item;
	}
}