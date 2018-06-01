<?php

class Site_Model_Db_SQLWooodPricelistViewMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_SQLWooodPricelistView $model
	 * @return Site_Model_SQLWooodPricelistView|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodPricelistView)) {
				$model = new Site_Model_SQLWooodPricelistView();
			}
			// vul het model object
			$model->setDebiteurnr($row->debiteurnr);
			$model->setFaktuurdebiteurnr($row->faktuurdebiteurnr);		
			$model->setArtikelnr($row->artikelnr);
			$model->setSalesprice($row->salesprice);
			$model->setPrijslijst($row->prijslijst);
			$model->setKorting($row->korting);
			$model->setAantal0($row->aantal0);
			$model->setPrijs0($row->prijs0);
			$model->setAantal1($row->aantal1);
			$model->setPrijs1($row->prijs1);
			$model->setAantal2($row->aantal2);
			$model->setPrijs2($row->prijs2);
			$model->setAantal3($row->aantal3);
			$model->setPrijs3($row->prijs3);
			$model->setAantal4($row->aantal4);
			$model->setPrijs4($row->prijs4);
			$model->setAantal5($row->aantal5);
			$model->setPrijs5($row->prijs5);
			$model->setAantal6($row->aantal6);
			$model->setPrijs6($row->prijs6);
			$model->setAantal7($row->aantal7);
			$model->setPrijs7($row->prijs7);
			$model->setAantal8($row->aantal8);
			$model->setPrijs8($row->prijs8);
			$model->setAantal9($row->aantal9);
			$model->setPrijs9($row->prijs9);
			$model->setAantal10($row->aantal10);
			$model->setPrijs10($row->prijs10);
			$model->setValcode($row->valcode);
			$model->setStandaard_salesprice($row->standaard_salesprice);
			$model->setKortingtype($row->kortingtype);
			$model->setPrijssoort($row->prijssoort);
 				
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
// 		$select = $db1->select();
// 		$select->from('_AB_Prijzen_Webshop');
		
// 		$rows = $db1->fetchAll($select);
		
		$sql = 'SELECT * FROM _AB_Prijzen_Webshop';
		$stmt = $db1->query($sql);
		$rows = $stmt->fetchAll();
		
		$articles = array();
		foreach ($rows as $row) {
			$article = new Site_Model_SQLWooodPricelistView();
			$article->setDebiteurnr($row['debiteurnr']);
			$article->setFaktuurdebiteurnr($row['faktuurdebiteurnr']);		
			$article->setArtikelnr($row['artikelnr']);
			$article->setSalesprice($row['salesprice']);
			$article->setPrijslijst($row['prijslijst']);
			$article->setKorting($row['korting']);
			$article->setAantal0($row['aantal0']);
			$article->setPrijs0($row['prijs0']);
			$article->setAantal1($row['aantal1']);
			$article->setPrijs1($row['prijs1']);
			$article->setAantal2($row['aantal2']);
			$article->setPrijs2($row['prijs2']);
			$article->setAantal3($row['aantal3']);
			$article->setPrijs3($row['prijs3']);
			$article->setAantal4($row['aantal4']);
			$article->setPrijs4($row['prijs4']);
			$article->setAantal5($row['aantal5']);
			$article->setPrijs5($row['prijs5']);
			$article->setAantal6($row['aantal6']);
			$article->setPrijs6($row['prijs6']);
			$article->setAantal7($row['aantal7']);
			$article->setPrijs7($row['prijs7']);
			$article->setAantal8($row['aantal8']);
			$article->setPrijs8($row['prijs8']);
			$article->setAantal9($row['aantal9']);
			$article->setPrijs9($row['prijs9']);
			$article->setAantal10($row['aantal10']);
			$article->setPrijs10($row['prijs10']);
			$article->setValcode($row['valcode']);
			$article->setStandaard_salesprice($row['standaard_salesprice']);
			$article->setKortingtype($row['kortingtype']);
			$article->setPrijssoort($row['prijssoort']);
						
			$articles[] = $article;
		}
		
		
		return $articles;
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchByDebiteur($debiteurnr) {
	    /**
	     *
	     * @var Zend_Db $db1
	     */
		$db1 = Zend_Registry::get('db1');
// 		$select = $db1->select();
// 		$select->from('_AB_Prijzen_Webshop');
// 		$select->where('DEBITEURNR = ?', $debiteurnr);
		
		$sql = 'SELECT * FROM _AB_Prijzen_Webshop WHERE DEBITEURNR = '.$debiteurnr; 
		$stmt = $db1->query($sql);
	    $rows = $stmt->fetchAll();
		
//		$rows = $db1->fetchAll($select);
	
		$articles = array();
		foreach ($rows as $row) {
			$article = new Site_Model_SQLWooodPricelistView();
			$article->setDebiteurnr($row['debiteurnr']);
			$article->setFaktuurdebiteurnr($row['faktuurdebiteurnr']);
			$article->setArtikelnr($row['artikelnr']);
			$article->setSalesprice($row['salesprice']);
			$article->setPrijslijst($row['prijslijst']);
			$article->setKorting($row['korting']);
			$article->setAantal0($row['aantal0']);
			$article->setPrijs0($row['prijs0']);
			$article->setAantal1($row['aantal1']);
			$article->setPrijs1($row['prijs1']);
			$article->setAantal2($row['aantal2']);
			$article->setPrijs2($row['prijs2']);
			$article->setAantal3($row['aantal3']);
			$article->setPrijs3($row['prijs3']);
			$article->setAantal4($row['aantal4']);
			$article->setPrijs4($row['prijs4']);
			$article->setAantal5($row['aantal5']);
			$article->setPrijs5($row['prijs5']);
			$article->setAantal6($row['aantal6']);
			$article->setPrijs6($row['prijs6']);
			$article->setAantal7($row['aantal7']);
			$article->setPrijs7($row['prijs7']);
			$article->setAantal8($row['aantal8']);
			$article->setPrijs8($row['prijs8']);
			$article->setAantal9($row['aantal9']);
			$article->setPrijs9($row['prijs9']);
			$article->setAantal10($row['aantal10']);
			$article->setPrijs10($row['prijs10']);
			$article->setValcode($row['valcode']);
			$article->setStandaard_salesprice($row['standaard_salesprice']);
			$article->setKortingtype($row['kortingtype']);
			$article->setPrijssoort($row['prijssoort']);
	
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
			$model = new Site_Model_SQLWooodPricelistView();
			$model->setDebiteurnr($row->debiteurnr);
			$model->setFaktuurdebiteurnr($row->faktuurdebiteurnr);		
			$model->setArtikelcode($row->artikelnr);
			$model->setSalesprice($row->salesprice);
			$model->setPrijslijst($row->prijslijst);
			$model->setKorting($row->korting);
			$model->setAantal0($row->aantal0);
			$model->setPrijs0($row->prijs0);
			$model->setAantal1($row->aantal1);
			$model->setPrijs1($row->prijs1);
			$model->setAantal2($row->aantal2);
			$model->setPrijs2($row->prijs2);
			$model->setAantal3($row->aantal3);
			$model->setPrijs3($row->prijs3);
			$model->setAantal4($row->aantal4);
			$model->setPrijs4($row->prijs4);
			$model->setAantal5($row->aantal5);
			$model->setPrijs5($row->prijs5);
			$model->setAantal6($row->aantal6);
			$model->setPrijs6($row->prijs6);
			$model->setAantal7($row->aantal7);
			$model->setPrijs7($row->prijs7);
			$model->setAantal8($row->aantal8);
			$model->setPrijs8($row->prijs8);
			$model->setAantal9($row->aantal9);
			$model->setPrijs9($row->prijs9);
			$model->setAantal10($row->aantal10);
			$model->setPrijs10($row->prijs10);
			$model->setValcode($row->valcode);
			$model->setStandaard_salesprice($row->standaard_salesprice);
			$model->setKortingtype($row->kortingtype);
			$model->setPrijssoort($row->prijssoort);
 			$result[] = $model;
		}
		return $result;
	}
}