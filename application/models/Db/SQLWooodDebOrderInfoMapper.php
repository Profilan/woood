<?php

class Site_Model_Db_SQLWooodDebOrderInfoMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model)
	{
		parent::save($model);
	}

	/**
	 * Zoek het item met het gegeven DEBITEURNR en geef een gevuld Debinfo object terug. Als
	 * de DEBITEURNR niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodDebOrderInfo $model
	 * @return Site_Model_SQLWooodDebOrderInfo|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodDebOrderInfo)) {
				$model = new Site_Model_SQLWooodDebOrderInfo();
			}
			// vul het model object
			$model->setOrdernr($row->ordernr);
			$model->setDebnr($row->debnr);
			$model->setFakdebnr($row->fakdebnr);
			$model->setReferentie($row->REFERENTIE);
			$model->setOmschrijving($row->OMSCHRIJVING);
			$model->setOrddat($row->orddat);
			$model->setAantal_besteld($row->AANTAL_BESTELD);
			$model->setItemcode($row->ItemCode);
			$model->setAfleverdatum($row->AFLEVERDATUM);
			$model->setOmschrijving_nl($row->OMSCHRIJVING_NL);
			$model->setOmschrijving_en($row->OMSCHRIJVING_EN);
			$model->setOmschrijving_de($row->OMSCHRIJVING_DE);
			$model->setAant_gelev($row->aant_gelev);
			$model->setStatus($row->STATUS);
			$model->setDel_landcode($row->del_landcode);
			$model->setSelcode($row->selcode);
			$model->setPrijs_per_stuk($row->PRIJS_PER_STUK);
			$model->setSubtotaal($row->SUBTOTAAL);
				
			$result = $model;
		}
		return $result;
	}
	
	public function getTotalCount()
	{
	    /**
	     * 
	     * @var Zend_Db $db1
	     */
	    $db1 = Zend_Registry::get('db1');
	    
	    return $db1->fetchOne( 'SELECT COUNT(*) AS count FROM _AB_TB_WEB_ORDERINFO' );
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll($page = null, $limit = null) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORDERINFO');
		$select->order(array('DEBNR ASC', 'ORDERNR ASC'));

		if ($page) {
		    $paginator = Zend_Paginator::factory($select);
		    $paginator->setCurrentPageNumber($page);
		    $paginator->setItemCountPerPage($limit);
		} else {
		    $paginator = $db1->fetchAll($select);
		}
		
		$orders = array();
		foreach ($paginator as $row) {
			$order = new Site_Model_SQLWooodDebOrderInfo();
			$order->setOrdernr($row['ordernr']);
			$order->setDebnr($row['debnr']);
			$order->setFakdebnr($row['fakdebnr']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setOmschrijving($row['OMSCHRIJVING']);
			$order->setOrddat($row['orddat']);
			$order->setAantal_besteld($row['AANTAL_BESTELD']);
			$order->setItemcode($row['ItemCode']);
			$order->setAfleverdatum($row['AFLEVERDATUM']);
			$order->setOmschrijving_nl($row['OMSCHRIJVING_NL']);
			$order->setOmschrijving_en($row['OMSCHRIJVING_EN']);
			$order->setOmschrijving_de($row['OMSCHRIJVING_DE']);
			$order->setAant_gelev($row['aant_gelev']);
			$order->setStatus($row['STATUS']);
			$order->setDel_landcode($row['del_landcode']);
			$order->setSelcode($row['selcode']);
			$order->setPrijs_per_stuk($row['PRIJS_PER_STUK']);
			$order->setSubtotaal($row['SUBTOTAAL']);
				
			$orders[] = $order;
		}
		
		return $orders;
	}

	/**
	 * Geeft alle orders terug.
	 * @return array
	 */
	public function fetchByDebiteur($debiteurnr) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORDERINFO');
		$select->where('debnr = ?', $debiteurnr);
		$select->order(array('ORDERNR ASC'));
	
		$rows = $db1->fetchAll($select);
	
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodDebOrderInfo();
			$order->setOrdernr($row['ordernr']);
			$order->setDebnr($row['debnr']);
			$order->setFakdebnr($row['fakdebnr']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setOmschrijving($row['OMSCHRIJVING']);
			$order->setOrddat($row['orddat']);
			$order->setAantal_besteld($row['AANTAL_BESTELD']);
			$order->setItemcode($row['ItemCode']);
			$order->setAfleverdatum($row['AFLEVERDATUM']);
			$order->setOmschrijving_nl($row['OMSCHRIJVING_NL']);
			$order->setOmschrijving_en($row['OMSCHRIJVING_EN']);
			$order->setOmschrijving_de($row['OMSCHRIJVING_DE']);
			$order->setAant_gelev($row['aant_gelev']);
			$order->setStatus($row['STATUS']);
			$order->setDel_landcode($row['del_landcode']);
			$order->setSelcode($row['selcode']);
			$order->setPrijs_per_stuk($row['PRIJS_PER_STUK']);
			$order->setSubtotaal($row['SUBTOTAAL']);
				
			$orders[] = $order;
		}
	
		return $orders;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodDebOrderInfo();
			$model->setOrdernr($row->ordernr);
			$model->setDebnr($row->debnr);
			$model->setFakdebnr($row->fakdebnr);
			$model->setReferentie($row->REFERENTIE);
			$model->setOmschrijving($row->OMSCHRIJVING);
			$model->setOrddat($row->orddat);
			$model->setAantal_besteld($row->AANTAL_BESTELD);
			$model->setItemcode($row->ItemCode);
			$model->setAfleverdatum($row->AFLEVERDATUM);
			$model->setOmschrijving_nl($row->OMSCHRIJVING_NL);
			$model->setOmschrijving_en($row->OMSCHRIJVING_EN);
			$model->setOmschrijving_de($row->OMSCHRIJVING_DE);
			$model->setAant_gelev($row->aant_gelev);
			$model->setStatus($row->STATUS);
			$model->setDel_landcode($row->del_landcode);
			$model->setSelcode($row->selcode);
			$model->setPrijs_per_stuk($row->PRIJS_PER_STUK);
			$model->setSubtotaal($row->SUBTOTAAL);
			$result[] = $model;
		}
		return $result;
	}
}