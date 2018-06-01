<?php

class Site_Model_Db_SQLWooodPaymentReleaseMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model) {
	    
		if (!$model instanceof Site_Model_SQLWooodPaymentRelease) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		$db1 = Zend_Registry::get('db1');
		
		$data = array();
		$data['REFERENTIE'] = $model->getReferentie();
		$data['DEBITEURNR'] = $model->getDebiteurnr();
		$data['PAYMENT_RELEASE'] = $model->getPaymentRelease();
		
		if ($model->getId() < 0) {
			// nieuw object, doe insert
			$data['SYSCREATED'] = $model->getSyscreated();
			
			$db1->insert('_AB_TB_WEB_ORKRG_PAYMENT_RELEASE', $data);
			
			$id = $db1->lastInsertId();
			$model->setId($id);
	
		} else {
			// bestaand object, doe update
			$data['SYSMODIFIED'] = $model->getSysmodified();
			$where = 'id = '. $model->getId();
			$db1->update('_AB_TB_WEB_ORKRG_PAYMENT_RELEASE', $data, $where);
		}
	}
	
	/**
	 * Zoek het item met het gegeven ORDERNR en geef een gevuld Debinfo object terug. Als
	 * de DEBITEURNR niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodOrder $model
	 * @return Site_Model_SQLWooodOrder|null
	 */
	public function find($id, $model = null) {
		throw new Exception('Not implemented');
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll() {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORKRG_PAYMENT_RELEASE');
		
		$rows = $db1->fetchAll($select);
		
		$paymentReleases = array();
		foreach ($rows as $row) {
			$paymentRelease = new Site_Model_SQLWooodPaymentRelease();
			$paymentRelease->setId($row['ID']);
			$paymentRelease->setReferentie($row['REFERENTIE']);
			$paymentRelease->setDebiteurnr($row['DEBITEURNR']);
			$paymentRelease->setStatus($row['STATUS']);
			$paymentRelease->setPaymentRelease($row['PAYMENT_RELEASE']);
			$paymentRelease->setSyscreated($row['SYSCREATED']);
			$paymentRelease->setSysmodified($row['SYSMODIFIED']);
			$paymentRelease->setSysmsg($row['SYSMSG']);
				
			$paymentReleases[] = $paymentRelease;
		}
		
		return $paymentReleases;
	}

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodPaymentRelease();
			$model->setId($row->id);
			$model->setReferentie($row->referentie);
			$model->setDebiteurnr($row->debiteurnr);
			$model->setStatus($row->status);
			$model->setPaymentRelease($row->payment_release);
			$model->setSyscreated($row->syscreated);
			$model->setSysmodified($row->sysmodified);
			$model->setSysmsg($row->sysmsg);
				
			$result[] = $model;
		}
		return $result;
	}
	
	public function getInfo() {
	    $db1 = Zend_Registry::get('db1');
	    
	    return $db1->describeTable('_AB_TB_WEB_ORKRG_PAYMENT_RELEASE');
	}
}