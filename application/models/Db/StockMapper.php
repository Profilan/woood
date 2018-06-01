<?php

class Site_Model_Db_StockMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model)
	{
		parent::save($model);
	}

	/**
	 * Zoek het item met het gegeven Artikelcode en geef een gevuld Stock object terug. Als
	 * de Artikelcode niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_Stock $model
	 * @return Site_Model_Stock|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_Stock)) {
				$model = new Site_Model_Stock();
			}
			// vul het model object
			$model->setArtikelcode($row->Artikelcode);
			$model->setOmschrijving($row->Omschrijving);
			$model->setPlankvoorraad($row->Plankvoorraad);
			$result = $model;
		}
		return $result;
	}

	/**
	 * Geeft alle voorraad aantallen terug.
	 * @return array
	 */
	public function fetchAll() {
		return $this->fetchFiltered(null, '_AB_Voorraad_Aantal.Artikelcode ASC');
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_Stock();
			$model->setArtikelcode($row->Artikelcode);
			$model->setOmschrijving($row->Omschrijving);
			$model->setPlankvoorraad($row->Plankvoorraad);
			$result[] = $model;
		}
		return $result;
	}
}