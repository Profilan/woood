<?php

class Site_Model_Db_SQLWooodWebAvailabilityMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_SQLWooodWebAvailability $model
	 * @return Site_Model_SQLWooodWebAvailability|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodWebAvailability)) {
				$model = new Site_Model_SQLWooodWebAvailability();
			}
			// vul het model object
			$model->setFakdebnr($row->fakdebnr);
			$model->setItemcode($row->ItemCode);
			$model->setToelichting_nl($row->TOELICHTING_NL);
			$model->setToelichting_en($row->TOELICHTING_EN);
			$model->setToelichting_de($row->TOELICHTING_DE);
			$model->setToelichting_fr($row->TOELICHTING_FR);
			$model->setLeverweek($row->LEVERWEEK);
			$model->setLeverweekJW($row->LEVERWEEK_JJJJWW);
			$model->setOmschrijving_nl($row->Omschrijving_NL);
			$model->setOmschrijving_en($row->Omschrijving_EN);
			$model->setOmschrijving_de($row->Omschrijving_DE);
			$model->setOmschrijving_fr($row->Omschrijving_FR);
			$model->setBrand($row->BRAND);
			$model->setExclusive($row->EXCLUSIVE);
			$model->setEancode($row->EANCode);
			$model->setSyscreated($row->SYSCREATED);
			$model->setSysmodified($row->sysmodified);
							
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
		$select->from('_AB_WEB_AVAILABILITY');
		
		$rows = $db1->fetchAll($select);
		
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodWebAvailability();
			$order->setFakdebnr($row['fakdebnr']);
			$order->setItemcode($row['ItemCode']);
			$order->setToelichting_nl($row['TOELICHTING_NL']);
			$order->setToelichting_en($row['TOELICHTING_EN']);
			$order->setToelichting_de($row['TOELICHTING_DE']);
			$order->setToelichting_fr($row['TOELICHTING_FR']);
			$order->setLeverweek($row['LEVERWEEK']);
			$order->setLeverweekJW($row['LEVERWEEK_JJJJWW']);
			$order->setOmschrijving_nl($row['Omschrijving_NL']);
			$order->setOmschrijving_en($row['Omschrijving_EN']);
			$order->setOmschrijving_de($row['Omschrijving_DE']);
			$order->setOmschrijving_fr($row['Omschrijving_FR']);
			$order->setBrand($row['BRAND']);
			$order->setExclusive($row['EXCLUSIVE']);
			$order->setEancode($row['EANCode']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['sysmodified']);
							
			$orders[] = $order;
		}
		
		return $orders;
	}

	/**
	 * Geeft alle orders terug.
	 * @return array
	 */
	public function fetchByFakDebnr($fakdebnr) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_WEB_AVAILABILITY');
		$select->where('fakdebnr = ?', $fakdebnr);
	
		$rows = $db1->fetchAll($select);
	
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodWebAvailability();
			$order->setFakdebnr($row['fakdebnr']);
			$order->setItemcode($row['ItemCode']);
			$order->setToelichting_nl($row['TOELICHTING_NL']);
			$order->setToelichting_en($row['TOELICHTING_EN']);
			$order->setToelichting_de($row['TOELICHTING_DE']);
			$order->setToelichting_fr($row['TOELICHTING_FR']);
			$order->setLeverweek($row['LEVERWEEK']);
			$order->setLeverweekJW($row['LEVERWEEK_JJJJWW']);
			$order->setOmschrijving_nl($row['Omschrijving_NL']);
			$order->setOmschrijving_en($row['Omschrijving_EN']);
			$order->setOmschrijving_de($row['Omschrijving_DE']);
			$order->setOmschrijving_fr($row['Omschrijving_FR']);
			$order->setBrand($row['BRAND']);
			$order->setExclusive($row['EXCLUSIVE']);
			$order->setEancode($row['EANCode']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['sysmodified']);
				
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
			$model = new Site_Model_SQLWooodWebAvailability();
			$model->setFakdebnr($row->fakdebnr);
			$model->setItemcode($row->ItemCode);
			$model->setToelichting_nl($row->TOELICHTING_NL);
			$model->setToelichting_en($row->TOELICHTING_EN);
			$model->setToelichting_de($row->TOELICHTING_DE);
			$model->setToelichting_fr($row->TOELICHTING_FR);
			$model->setLeverweek($row->LEVERWEEK);
			$model->setLeverweekJW($row->LEVERWEEK_JJJJWW);
			$model->setOmschrijving_nl($row->Omschrijving_NL);
			$model->setOmschrijving_en($row->Omschrijving_EN);
			$model->setOmschrijving_de($row->Omschrijving_DE);
			$model->setOmschrijving_fr($row->Omschrijving_FR);
			$model->setBrand($row->BRAND);
			$model->setExclusive($row->EXCLUSIVE);
			$model->setEancode($row->EANCode);
			$model->setSyscreated($row->SYSCREATED);
			$model->setSysmodified($row->sysmodified);
			$result[] = $model;
		}
		return $result;
	}
}