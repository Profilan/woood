<?php

class Site_Model_Db_SQLWooodArtikelviewPakketMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_Article $model
	 * @return Site_Model_Article|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodArtikelviewPakket)) {
				$model = new Site_Model_SQLWooodArtikelviewPakket();
			}
			// vul het model object
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setArtcodePakket($row->ARTCODE_PAKKET);
			$model->setNL($row->NL);
			$model->setEN($row->EN);
			$model->setDE($row->DE);
			$model->setFR($row->FR);
			$model->setGewicht($row->GEWICHT);
			$model->setVerpakDikteMm($row->VERPAK_DIKTE_mm);
			$model->setVerpakLengteMm($row->VERPAK_LENGTE_mm);
			$model->setVerpakBreedteMm($row->VERPAK_BREEDTE_mm);
			$model->setVrijeVoorraadPakket($row->VrijeVoorraadPakket);
			$model->setAssCodeExclusiv($row->ASS_CODE_EXCLUSIV);
			$model->setEancode($row->EANCode);
			$model->setAantal_pakketten($row->AANTAL_PAKKETTEN);
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
		$db3 = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA_PAKKET');
		
		$rows = $db->fetchAll($select);
		
		$articles = array();
		foreach ($rows as $row) {
			$article = new Site_Model_SQLWooodArtikelviewPakket();
			$article->setArtikelcode($row['ARTIKELCODE']);
			$article->setArtcodePakket($row['ARTCODE_PAKKET']);
			$article->setNL($row['NL']);
			$article->setEN($row['EN']);
			$article->setDE($row['DE']);
			$article->setFR($row['FR']);
			$article->setGewicht($row['GEWICHT']);
			$article->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
			$article->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
			$article->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
			$article->setVolM3Verp($row['VOL_M3/VERP']);
			$article->setVrijeVoorraadPakket($row['VrijeVoorraadPakket']);
			$article->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
			$article->setEancode($row['EANCode']);
			$article->setAantal_pakketten($row['AANTAL_PAKKETTEN']);
				
			$articles[] = $article;
		}
		
		
		return $articles;
	}

	/**
	 * Geeft alle artikelen terug in een pakket.
	 * @return array
	 */
	public function fetchByArticle($artikelCode) {
		$db = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA_PAKKET');
		$select->where('ARTIKELCODE = ?', $artikelCode);
		$select->order(array('ARTCODE_PAKKET ASC'));
	
		$rows = $db->fetchAll($select);
	
		$articles = array();
		foreach ($rows as $row) {
			$article = new Site_Model_SQLWooodArtikelviewPakket();
			$article->setArtikelcode($row['ARTIKELCODE']);
			$article->setArtcodePakket($row['ARTCODE_PAKKET']);
			$article->setNL($row['NL']);
			$article->setEN($row['EN']);
			$article->setDE($row['DE']);
			$article->setFR($row['FR']);
			$article->setGewicht($row['GEWICHT']);
			$article->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
			$article->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
			$article->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
			$article->setVolM3Verp($row['VOL_M3/VERP']);
			$article->setVrijeVoorraadPakket($row['VrijeVoorraadPakket']);
			$article->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
			$article->setEancode($row['EANCode']);
			$article->setAantal_pakketten($row['AANTAL_PAKKETTEN']);
				
							
			$articles[] = $article;
		}
	
	
		return $articles;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodArtikelviewPakket();
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setArtcodePakket($row->ARTCODE_PAKKET);
			$model->setNL($row->NL);
			$model->setEN($row->EN);
			$model->setDE($row->DE);
			$model->setFR($row->FR);
			$model->setGewicht($row->GEWICHT);
			$model->setVerpakDikteMm($row->VERPAK_DIKTE_mm);
			$model->setVerpakLengteMm($row->VERPAK_LENGTE_mm);
			$model->setVerpakBreedteMm($row->VERPAK_BREEDTE_mm);
			$model->setVrijeVoorraadPakket($row->VrijeVoorraadPakket);
			$model->setAssCodeExclusiv($row->ASS_CODE_EXCLUSIV);
			$model->setEancode($row->EANCode);
			$model->setAantal_pakketten($row->AANTAL_PAKKETTEN);
				
			$result[] = $model;
		}
		return $result;
	}
}