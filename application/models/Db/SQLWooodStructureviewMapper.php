<?php

class Site_Model_Db_SQLWooodStructureviewMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model)
	{
		parent::save($model);
	}

	/**
	 * Zoek het item met het gegeven PRODNR en geef een gevuld Structureview object terug. Als
	 * de DEBITEURNR niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodStructureview $model
	 * @return Site_Model_SQLWooodStructureview|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodStructureview)) {
				$model = new Site_Model_SQLWooodStructureview();
			}
			// vul het model object
			$model->setId($row->ID);
			$model->setLvl($row->LVL);
			$model->setSeqNo($row->SEQ_NO);
			$model->setMainprod($row->MAINPROD);
			$model->setItemprod($row->ITEMPROD);
			$model->setItemprodDesc($row->ITEMPROD_DESC);
			$model->setItemreq($row->ITEMREQ);
			$model->setItemreqDesc($row->ITEMREQ_DESC);
    		$model->setEnItemreqDesc($row->EN_ITEMREQ_DESC);
    		$model->setDeItemreqDesc($row->DE_ITEMREQ_DESC);
    		$model->setFrItemreqDesc($row->FR_ITEMREQ_DESC);
			$model->setQtyPerMainprod($row->QTY_PER_MAINPROD);
				
			$result = $model;
		}
		return $result;
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll($page = null, $limit = null) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_vw_ARTIKELSTRUCTUREN');
		$select->order('MAINPROD');
		
		if ($page) {
    		$paginator = Zend_Paginator::factory($select);
    		$paginator->setCurrentPageNumber($page);
            $paginator->setItemCountPerPage($limit);
		} else {
		    $paginator = $db1->fetchAll($select);
		}
		
//		$rows = $db1->fetchAll($select);
		
		$items = array();
		
		foreach ($paginator as $row) {
			$item = new Site_Model_SQLWooodStructureview();
			$item->setMainprod($row['MAINPROD']);
				
			$items[] = $item;
		}
		
		return $items;
	}

	/**
	 * Geeft de items van 1 product terug.
	 * @return array
	 */
	public function fetchByProdnr($prodnr, $page = null, $limit = null) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_ARTIKELSTRUCTUREN');
		$select->where('MAINPROD = ?', $prodnr);
		$select->order('ID');
	
		$rows = $db1->fetchAll($select);
	
		$items = array();
		foreach ($rows as $row) {
			$item = new Site_Model_SQLWooodStructureview();
			$item->setId($row['ID']);
			$item->setLvl($row['LVL']);
			$item->setSeqNo($row['SEQ_NO']);
			$item->setMainprod($row['MAINPROD']);
			$item->setItemprod($row['ITEMPROD']);
			$item->setItemprodDesc($row['ITEMPROD_DESC']);
			$item->setItemreq($row['ITEMREQ']);
			$item->setItemreqDesc($row['ITEMREQ_DESC']);
    		$item->setEnItemreqDesc($row['EN_ITEMREQ_DESC']);
    		$item->setDeItemreqDesc($row['DE_ITEMREQ_DESC']);
    		$item->setFrItemreqDesc($row['FR_ITEMREQ_DESC']);
			$item->setQtyPerMainprod($row['QTY_PER_MAINPROD']);
							
			$items[] = $item;
		}
	
		return $items;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodStructureview();
			$model->setId($row->ID);
			$model->setLvl($row->LVL);
			$model->setSeqNo($row->SEQ_NO);
			$model->setMainprod($row->MAINPROD);
			$model->setItemprod($row->ITEMPROD);
			$model->setItemprodDesc($row->ITEMPROD_DESC);
			$model->setItemreq($row->ITEMREQ);
			$model->setItemreqDesc($row->ITEMREQ_DESC);
    		$model->setEnItemreqDesc($row->EN_ITEMREQ_DESC);
    		$model->setDeItemreqDesc($row->DE_ITEMREQ_DESC);
    		$model->setFrItemreqDesc($row->FR_ITEMREQ_DESC);
			$model->setQtyPerMainprod($row->QTY_PER_MAINPROD);
			$result[] = $model;
		}
		return $result;
	}
}