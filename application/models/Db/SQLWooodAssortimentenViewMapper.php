<?php

class Site_Model_Db_SQLWooodAssortimentenViewMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model)
	{
		parent::save($model);
	}

	/**
	 * Zoek het item met het gegeven Artikelcode en geef een gevuld Artikel object terug. Als
	 * de Artikelcode niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodAssortimentenView $model
	 * @return Site_Model_SQLWooodAssortimentenView|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodAssortimentenView)) {
				$model = new Site_Model_SQLWooodAssortimentenView();
			}
			// vul het model object
			$model->setAss($row->ASS);
			$model->setCode($row->CODE);
			$model->setOmschrijving($row->OMSCHRIJVING);
					
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
		$select->from('_AB_ASSORTIMENTENVIEW');
		
		$rows = $db1->fetchAll($select);
		
		$assortments = array();
		foreach ($rows as $row) {
			$assortment = new Site_Model_SQLWooodAssortimentenView();
			$assortment->setAss($row['ASS']);
			$assortment->setCode($row['CODE']);
			$assortment->setOmschrijving($row['OMSCHRIJVING']);
			
			$assortments[] = $assortment;
		}
		
		return $assortments;
	}

	/**
	 * Geeft alle artikelen terug in een pakket.
	 * @return array
	 */
	public function fetchByAssortment($assId) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_ASSORTIMENTENVIEW');
		$select->where('ASS = ?', $assId);
	
		$rows = $db1->fetchAll($select);
	
		$assortments = array();
		foreach ($rows as $row) {
			$assortment = new Site_Model_SQLWooodAssortimentenView();
			$assortment->setAss($row['ASS']);
			$assortment->setCode($row['CODE']);
			$assortment->setOmschrijving($row['OMSCHRIJVING']);
			
			$assortments[] = $assortment;
		}
		
		return $assortments;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodAssortimentenView();
			$model->setAss($row->ASS);
			$model->setCode($row->CODE);
			$model->setOmschrijving($row->OMSCHRIJVING);
			
			$result[] = $model;
		}
		return $result;
	}
}