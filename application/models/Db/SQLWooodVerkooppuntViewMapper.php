<?php

class Site_Model_Db_SQLWooodVerkooppuntViewMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_SQLWooodVerkooppuntView $model
	 * @return Site_Model_SQLWooodVerkooppuntView|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodVerkooppuntView)) {
				$model = new Site_Model_SQLWooodVerkooppuntView();
			}
			// vul het model object
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setArtcodePakket($row->ARTCODE_PAKKET);
			$model->setNL($row->NL);
			$model->setEN($row->EN);
			$model->setDE($row->DE);
			$model->setGewicht($row->GEWICHT);
			$model->setVerpakDikteMm($row->VERPAK_DIKTE_mm);
			$model->setVerpakLengteMm($row->VERPAK_LENGTE_mm);
			$model->setVerpakBreedteMm($row->VERPAK_BREEDTE_mm);
			// $model->setVolM3Verp($row->VOL_M3/VERP);
					
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
		$select->from('_AB_WOOOD_SELLINGPOINTS');
		
		$rows = $db1->fetchAll($select);
		
		$sellingPoints = array();
		foreach ($rows as $row) {
			$sellingPoint = new Site_Model_SQLWooodVerkooppuntView();
			$sellingPoint->setArtikelcode($row['ARTIKELCODE']);
			$sellingPoint->setFactuurDebiteurNr($row['FACTUURDEBITEURNR']);
			$sellingPoint->setFactuurDebiteurNaam($row['FACTUURDEBITEURNAAM']);
			$sellingPoint->setFactuurDebiteurNaamAlias($row['FACTUURDEBITEUR NAAM ALIAS']);
			$sellingPoint->setFactuurDebiteurWeb($row['FACTUURDEBITEURWEB']);
			$sellingPoint->setFactuurDebiteurWebAlias($row['FACTUURDEBITEUR WEB ALIAS']);
			$sellingPoint->setFactuurDebiteurLand($row['FACTUURDEBITEURLAND']);
			
			$sellingPoints[] = $sellingPoint;
		}
		
		return $sellingPoints;
	}

	/**
	 * Geeft alle artikelen terug in een pakket.
	 * @return array
	 */
	public function fetchByArticle($artikelCode) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_WOOOD_SELLINGPOINTS');
		$select->where('ARTIKELCODE LIKE ?', '%'.$artikelCode.'%');
	
		$rows = $db1->fetchAll($select);
	
		$sellingPoints = array();
		foreach ($rows as $row) {
			$sellingPoint = new Site_Model_SQLWooodVerkooppuntView();
			$sellingPoint->setArtikelcode($row['ARTIKELCODE']);
			$sellingPoint->setFactuurDebiteurNr($row['FACTUURDEBITEURNR']);
			$sellingPoint->setFactuurDebiteurNaam($row['FACTUURDEBITEURNAAM']);
			$sellingPoint->setFactuurDebiteurNaamAlias($row['FACTUURDEBITEUR NAAM ALIAS']);
			$sellingPoint->setFactuurDebiteurWeb($row['FACTUURDEBITEURWEB']);
			$sellingPoint->setFactuurDebiteurWebAlias($row['FACTUURDEBITEUR WEB ALIAS']);
			$sellingPoint->setFactuurDebiteurLand($row['FACTUURDEBITEURLAND']);
			
			$sellingPoints[] = $sellingPoint;
		}
		
		return $sellingPoints;
	}

	/**
	 * Geeft alle artikelen terug in een pakket.
	 * @return array
	 */
	public function fetchByDebiteur($debCode) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_WOOOD_SELLINGPOINTS');
		$select->where('FACTUURDEBITEURNR LIKE ?', '%'.$debCode.'%');
	
		$rows = $db1->fetchAll($select);
	
		$sellingPoints = array();
		foreach ($rows as $row) {
			$sellingPoint = new Site_Model_SQLWooodVerkooppuntView();
			$sellingPoint->setArtikelcode($row['ARTIKELCODE']);
			$sellingPoint->setFactuurDebiteurNr($row['FACTUURDEBITEURNR']);
			$sellingPoint->setFactuurDebiteurNaam($row['FACTUURDEBITEURNAAM']);
			$sellingPoint->setFactuurDebiteurNaamAlias($row['FACTUURDEBITEUR NAAM ALIAS']);
			$sellingPoint->setFactuurDebiteurWeb($row['FACTUURDEBITEURWEB']);
			$sellingPoint->setFactuurDebiteurWebAlias($row['FACTUURDEBITEUR WEB ALIAS']);
			$sellingPoint->setFactuurDebiteurLand($row['FACTUURDEBITEURLAND']);
				
			$sellingPoints[] = $sellingPoint;
		}
	
		return $sellingPoints;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodVerkooppuntView();
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setFactuurDebiteurNr($row->FACTUURDEBITEURNR);
			$model->setFactuurDebiteurNaam($row->FACTUURDEBITEURNAAM);
			// $model->setFactuurDebiteurNaamAlias($row->FACTUURDEBITEUR NAAM ALIAS);
			$model->setFactuurDebiteurWeb($row->FACTUURDEBITEURWEB);
			// $model->setFactuurDebiteurWebAlias($row->FACTUURDEBITEUR WEB ALIAS);
			$model->setFactuurDebiteurLand($row->FACTUURDEBITEURLAND);
			
			$result[] = $model;
		}
		return $result;
	}
}