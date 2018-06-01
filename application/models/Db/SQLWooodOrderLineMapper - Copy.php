<?php

class Site_Model_Db_SQLWooodOrderLineMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model) {
		if (!$model instanceof Site_Model_SQLWooodOrderLine) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		$db1 = Zend_Registry::get('db1');
		
		$data = array();
		$data['REFERENTIE'] = $model->getReferentie();
		$data['DEBITEURNR'] = $model->getDebiteurnr();
		$data['ITEMCODE'] = $model->getItemcode();
		$data['AANTAL'] = $model->getAantal();
		$data['STATUS'] = $model->getStatus();
		$data['ORDERNR'] = $model->getOrdernr();
		$data['SYSMSG'] = $model->getSysmsg();
		if ($model->getId() < 0) {
			// nieuw object, doe insert
			$data['SYSCREATED'] = $model->getSyscreated();
			$db1->insert('_AB_TB_WEB_ORSRG', $data);
			$id = $db1->lastInsertId();
			$model->setId($id);
	
		} else {
			// bestaand object, doe update
			$data['SYSMODIFIED'] = $model->getSysmodified();
			$where = 'id = '. $model->getId();
			$db1->update('_AB_TB_WEB_ORSRG', $data, $where);
		}
		$data['VERZENDWEEK'] = $model->getVerzendweek();
	}
	
	/**
	 * Zoek het item met het gegeven ORDERNR en geef een gevuld Debinfo object terug. Als
	 * de DEBITEURNR niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodOrderLine $model
	 * @return Site_Model_SQLWooodOrderLine|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORSRG');
		$select->where('ID = ?', $id);
		
		$row = $db1->fetchRow($select);
		if ($row) {
			if (!($model instanceof Site_Model_SQLWooodOrderLine)) {
				$model = new Site_Model_SQLWooodOrderLine();
			}
			// vul het model object
			$model->setId($row['ID']);
			$model->setReferentie($row['REFERENTIE']);
			$model->setDebiteurnr($row['DEBITEURNR']);
			$model->setItemcode($row['ITEMCODE']);
			$model->setAantal($row['AANTAL']);
			$model->setSyscreated($row['SYSCREATED']);
			$model->setSysmodified($row['SYSMODIFIED']);
			$model->setOrdernr($row['ORDERNR']);
			$model->setSysmsg($row['SYSMSG']);
			$model->setVerzendweek($row['VERZENDWEEK']);
										
			$result = $model;
		}
		
		return $result;
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll() {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORSRG');
		
		$rows = $db1->fetchAll($select);
		
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodOrderLine();
			$order->setId($row['ID']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setDebiteurnr($row['DEBITEURNR']);
			$order->setItemcode($row['ITEMCODE']);
			$order->setAantal($row['AANTAL']);
			$order->setStatus($row['STATUS']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['SYSMODIFIED']);
			$order->setOrdernr($row['ORDERNR']);
			$order->setSysmsg($row['SYSMSG']);
			$order->setVerzendweek($row['VERZENDWEEK']);
				
			$orders[] = $order;
		}
		
		return $orders;
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchByOrdernr($ordernr) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORSRG');
		$select->where('ORDERNR = ?', $ordernr);
	
		$rows = $db1->fetchAll($select);
	
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodOrder();
			$order->setId($row['ID']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setDebiteurnr($row['DEBITEURNR']);
			$order->setItemcode($row['ITEMCODE']);
			$order->setAantal($row['AANTAL']);
			$order->setStatus($row['STATUS']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['SYSMODIFIED']);
			$order->setOrdernr($row['ORDERNR']);
			$order->setSysmsg($row['SYSMSG']);
			$order->setVerzendweek($row['VERZENDWEEK']);
				
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
			$model = new Site_Model_SQLWooodOrderLine();
			$model->setId($row->id);
			$model->setReferentie($row->referentie);
			$model->setDebiteurnr($row->debiteurnr);
			$model->setItemcode($row->itemcode);
			$model->setAantal($row->aantal);
			$model->setStatus($row->status);
			$model->setSyscreated($row->syscreated);
			$model->setSysmodified($row->sysmodified);
			$model->setOrdernr($row->ordernr);
			$model->setSysmsg($row->sysmsg);
			$model->setVerzendweek($row->verzendweek);
							
			$result[] = $model;
		}
		return $result;
	}

	public function getInfo() {
	    $db1 = Zend_Registry::get('db1');
	     
	    return $db1->describeTable('_AB_TB_WEB_ORSRG');
	}
	
}