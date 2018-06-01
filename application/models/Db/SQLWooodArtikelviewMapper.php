<?php

class Site_Model_Db_SQLWooodArtikelviewMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_SQLWooodArtikelview $model
	 * @return Site_Model_SQLWooodArtikelview|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$db = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA');
		$select->where('ARTIKELCODE = ?', $id);
		
		$rows = $db->fetchAll($select);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodArtikelview)) {
				$model = new Site_Model_SQLWooodArtikelview();
			}
			// vul het model object
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setNL($row->NL);
			$model->setEN($row->EN);
			$model->setDE($row->DE);
			$model->setFR($row->FR);
			$model->setColorFinish($row->COLOR_FINISH);
			$model->setMaterial($row->MATERIAL);
			$model->setBrand($row->BRAND);
			$model->setAssortment($row->ASSORTMENT);
			$model->setProductgroup($row->PRODUCTGROUP);
			$model->setProductgroupCode($row->PRODUCTGROUP_CODE);
			$model->setDefaultSubproductgroupCode($row->DEFAULT_SUBPRODUCTGROUP_CODE);
			$model->setDefaultSubproductgroupName($row->DEFAULT_SUBPRODUCTGROUP_NAME);
			$model->setRange($row->RANGE);
			$model->setStatus($row->STATUS);
			$model->setExclusiv($row->EXCLUSIV);
			$model->setVerkoopprijs($row->VERKOOPPRIJS);
			$model->setVerkoopeenheid($row->VERKOOPEENHEID);
			$model->setAantalPakketten($row->AANTAL_PAKKETTEN);
			$model->setAfmetingArtikelHxbxd($row->AFMETING_ARTIKEL_HXBXD);
			$model->setEancode($row->EANCode);
			$model->setEnLongDesc($row->EN_LONG_DESC);
			$model->setNlLongDesc($row->NL_LONG_DESC);
			$model->setDeLongDesc($row->DE_LONG_DESC);
			$model->setFrLongDesc($row->FR_LONG_DESC);
			// $model->setAantalVerp($row->AANTAL_VERP);
			$model->setSource($row->SOURCE);
			// $model->setMrpRun($row->MRP_RUN);
			$model->setConsumentenPrijs($row->CONSUMENTENPRIJS);
			$model->setConsumentenPrijsVan($row->CONSUMENTENPRIJS_VAN);
			$model->setIseConsumentenPrijs($row->ISE_CONSUMENTENPRIJS);
			$model->setIseConsumentenPrijsVan($row->ISE_CONSUMENTENPRIJS_VAN);
			$model->setGewicht($row->GEWICHT);
			// $model->setNewArrival($row->NEW_ARRIVAL);
			$model->setVerpakDikteMm($row->VERPAK_DIKTE_mm);
			$model->setVerpakLengteMm($row->VERPAK_LENGTE_mm);
			$model->setVerpakBreedteMm($row->VERPAK_BREEDTE_mm);
			$model->setVrijeVoorraad($row->VrijeVoorraad);
			$model->setAssCodeExclusiv($row->ASS_CODE_EXCLUSIV);
			$model->setAtp($row->ATP);
    		$model->setFsc($row->FSC);
    		$model->setCountryOfOrigin($row->COUNTRY_OF_ORIGIN);
    		$model->setIntrastatCode($row->INTRASTAT_CODE);
    		$model->setAssemblyRequired($row->ASSEMBLY_REQUIRED);
    		$model->setWebVanPrijsNl($row->WEB_VAN_PRIJS_NL);
    		$model->setWebVanPrijsIse($row->WEB_VAN_PRIJS_ISE);
    		$model->setAvailabilityWeek($row->AvailabilityWeek);
			// $model->setVolM3Verp($row->VOL_M3_VERP);
				
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
	    $db = Zend_Registry::get('db3');
	     
	    return $db->fetchOne( 'SELECT COUNT(*) AS count FROM EEK_ARTIKELDATA' );
	}
	
	
	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll($page = null, $limit = null) {
		$db = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA');
		$select->order(array('ARTIKELCODE ASC'));

		if ($page) {
		    $paginator = Zend_Paginator::factory($select);
		    $paginator->setCurrentPageNumber($page);
		    $paginator->setItemCountPerPage($limit);
		} else {
		    $paginator = $db->fetchAll($select);
		}
		
		$articles = array();
		foreach ($paginator as $row) {
			$article = new Site_Model_SQLWooodArtikelview();
			$article->setArtikelcode($row['ARTIKELCODE']);
			$article->setNL($row['NL']);
			$article->setEN($row['EN']);
			$article->setDE($row['DE']);
			$article->setFR($row['FR']);
			$article->setColorFinish($row['COLOR_FINISH']);
			$article->setMaterial($row['MATERIAL']);
			$article->setBrand($row['BRAND']);
			$article->setAssortment($row['ASSORTMENT']);
			$article->setProductgroup($row['PRODUCTGROUP']);
			$article->setProductgroupCode($row['PRODUCTGROUP_CODE']);
			$article->setDefaultSubproductgroupCode($row['DEFAULT_SUBPRODUCTGROUP_CODE']);
			$article->setDefaultSubproductgroupName($row['DEFAULT_SUBPRODUCTGROUP_NAME']);
			$article->setRange($row['RANGE']);
			$article->setStatus($row['STATUS']);
			$article->setExclusiv($row['EXCLUSIV']);
			$article->setVerkoopprijs($row['VERKOOPPRIJS']);
			$article->setVerkoopeenheid($row['VERKOOPEENHEID']);
			$article->setAantalPakketten($row['AANTAL_PAKKETTEN']);
			$article->setAfmetingArtikelHxbxd($row['AFMETING_ARTIKEL_HXBXD']);
			$article->setEancode($row['EANCode']);
			$article->setEnLongDesc($row['EN_LONG_DESC']);
			$article->setNlLongDesc($row['NL_LONG_DESC']);
			$article->setDeLongDesc($row['DE_LONG_DESC']);
			$article->setFrLongDesc($row['FR_LONG_DESC']);
			$article->setAantalVerp($row['AANTAL_VERP']);
			$article->setSource($row['SOURCE']);
			$article->setMrpRun($row['MRP_RUN']);
			$article->setConsumentenPrijs($row['CONSUMENTENPRIJS']);
			$article->setConsumentenPrijsVan($row['CONSUMENTENPRIJS_VAN']);
			$article->setIseConsumentenPrijs($row['ISE_CONSUMENTENPRIJS']);
			$article->setIseConsumentenPrijsVan($row['ISE_CONSUMENTENPRIJS_VAN']);
			$article->setGewicht($row['GEWICHT']);
			$article->setNewArrival($row['NEW_ARRIVAL']);
			$article->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
			$article->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
			$article->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
			$article->setVolM3Verp($row['VOL_M3_VERP']);
			$article->setVrijeVoorraad($row['VrijeVoorraad']);
			$article->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
			$article->setAtp($row['ATP']);
			$article->setFsc($row['FSC']);
			$article->setCountryOfOrigin($row['COUNTRY_OF_ORIGIN']);
			$article->setIntrastatCode($row['INTRASTAT_CODE']);
			$article->setAssemblyRequired($row['ASSEMBLY_REQUIRED']);
			$article->setWebVanPrijsNl($row['WEB_VAN_PRIJS_NL']);
			$article->setWebVanPrijsIse($row['WEB_VAN_PRIJS_ISE']);
            $article->setAvailabilityWeek($row['AvailabilityWeek']);				
			
			$articles[] = $article;
		}
		
		
		return $articles;
	}
	
	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchByArtikelcode($artikelcode, $page = null, $limit = null) {
		$db = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA');
		$select->where('ARTIKELCODE LIKE ?', '%'.$artikelcode.'%');
		$select->order(array('ARTIKELCODE ASC'));

		if ($page) {
		    $paginator = Zend_Paginator::factory($select);
		    $paginator->setCurrentPageNumber($page);
		    $paginator->setItemCountPerPage($limit);
		} else {
		    $paginator = $db->fetchAll($select);
		}
		
		$articles = array();
		foreach ($paginator as $row) {
			$article = new Site_Model_SQLWooodArtikelview();
			$article->setArtikelcode($row['ARTIKELCODE']);
			$article->setNL($row['NL']);
			$article->setEN($row['EN']);
			$article->setDE($row['DE']);
			$article->setFR($row['FR']);
			$article->setColorFinish($row['COLOR_FINISH']);
			$article->setMaterial($row['MATERIAL']);
			$article->setBrand($row['BRAND']);
			$article->setAssortment($row['ASSORTMENT']);
			$article->setProductgroup($row['PRODUCTGROUP']);
			$article->setProductgroupCode($row['PRODUCTGROUP_CODE']);
			$article->setDefaultSubproductgroupCode($row['DEFAULT_SUBPRODUCTGROUP_CODE']);
			$article->setDefaultSubproductgroupName($row['DEFAULT_SUBPRODUCTGROUP_NAME']);
			$article->setRange($row['RANGE']);
			$article->setStatus($row['STATUS']);
			$article->setExclusiv($row['EXCLUSIV']);
			$article->setVerkoopprijs($row['VERKOOPPRIJS']);
			$article->setVerkoopeenheid($row['VERKOOPEENHEID']);
			$article->setAantalPakketten($row['AANTAL_PAKKETTEN']);
			$article->setAfmetingArtikelHxbxd($row['AFMETING_ARTIKEL_HXBXD']);
			$article->setEancode($row['EANCode']);
			$article->setEnLongDesc($row['EN_LONG_DESC']);
			$article->setNlLongDesc($row['NL_LONG_DESC']);
			$article->setDeLongDesc($row['DE_LONG_DESC']);
			$article->setFrLongDesc($row['FR_LONG_DESC']);
			$article->setAantalVerp($row['AANTAL_VERP']);
			$article->setSource($row['SOURCE']);
			$article->setMrpRun($row['MRP_RUN']);
			$article->setConsumentenPrijs($row['CONSUMENTENPRIJS']);
			$article->setConsumentenPrijsVan($row['CONSUMENTENPRIJS_VAN']);
			$article->setIseConsumentenPrijs($row['ISE_CONSUMENTENPRIJS']);
			$article->setIseConsumentenPrijsVan($row['ISE_CONSUMENTENPRIJS_VAN']);
			$article->setGewicht($row['GEWICHT']);
			$article->setNewArrival($row['NEW_ARRIVAL']);
			$article->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
			$article->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
			$article->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
			$article->setVolM3Verp($row['VOL_M3_VERP']);
			$article->setVrijeVoorraad($row['VrijeVoorraad']);
			$article->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
			$article->setAtp($row['ATP']);
			$article->setFsc($row['FSC']);
			$article->setCountryOfOrigin($row['COUNTRY_OF_ORIGIN']);
			$article->setIntrastatCode($row['INTRASTAT_CODE']);
			$article->setAssemblyRequired($row['ASSEMBLY_REQUIRED']);
			$article->setWebVanPrijsNl($row['WEB_VAN_PRIJS_NL']);
			$article->setWebVanPrijsIse($row['WEB_VAN_PRIJS_ISE']);
			$article->setAvailabilityWeek($row['AvailabilityWeek']);
				
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
			$model = new Site_Model_SQLWooodArtikelview();
			$model->setArtikelcode($row->ARTIKELCODE);
			$model->setNL($row->NL);
			$model->setEN($row->EN);
			$model->setDE($row->DE);
			$model->setFR($row->FR);
			$model->setColorFinish($row->COLOR_FINISH);
			$model->setMaterial($row->MATERIAL);
			$model->setBrand($row->BRAND);
			$model->setAssortment($row->ASSORTMENT);
			$model->setProductgroup($row->PRODUCTGROUP);
			$model->setProductgroupCode($row->PRODUCTGROUP_CODE);
			$model->setDefaultSubproductgroupCode($row->DEFAULT_SUBPRODUCTGROUP_CODE);
			$model->setDefaultSubproductgroupName($row->DEFAULT_SUBPRODUCTGROUP_NAME);
			$model->setRange($row->RANGE);
			$model->setStatus($row->STATUS);
			$model->setExclusiv($row->EXCLUSIV);
			$model->setVerkoopprijs($row->VERKOOPPRIJS);
			$model->setVerkoopeenheid($row->VERKOOPEENHEID);
			$model->setAantalPakketten($row->AANTAL_PAKKETTEN);
			$model->setAfmetingArtikelHxbxd($row->AFMETING_ARTIKEL_HXBXD);
			$model->setEancode($row->EANCode);
 			$model->setEnLongDesc($row->EN_LONG_DESC);
 			$model->setNlLongDesc($row->NL_LONG_DESC);
			$model->setDeLongDesc($row->DE_LONG_DESC);
			$model->setFrLongDesc($row->FR_LONG_DESC);
// 			// $model->setAantalVerp($row->AANTAL/VERP);
 			$model->setSource($row->SOURCE);
// 			// $model->setMrpRun($row->MRP RUN);
// 			$model->setConsumentenPrijs($row->CONSUMENTENPRIJS);
// 			$model->setConsumentenPrijsVan($row->CONSUMENTENPRIJS_VAN);
// 			$model->setGewicht($row->GEWICHT);
// 			// $model->setNewArrival($row->NEW ARRIVAL);
// 			$model->setVerpakDikteMm($row->VERPAK_DIKTE_mm);
// 			$model->setVerpakLengteMm($row->VERPAK_LENGTE_mm);
// 			$model->setVerpakBreedteMm($row->VERPAK_BREEDTE_mm);
// 			// $model->setVolM3Verp($row->VOL_M3/VERP);
			$model->setVrijeVoorraad($row->VrijeVoorraad);
			$model->setAssCodeExclusiv($row->ASS_CODE_EXCLUSIV);
			$model->setAtp($row->ATP);
    		$model->setFsc($row->FSC);
    		$model->setCountryOfOrigin($row->COUNTRY_OF_ORIGIN);
    		$model->setIntrastatCode($row->INTRASTAT_CODE);
    		$model->setAssemblyRequired($row->ASSEMBLY_REQUIRED);
    		$model->setWebVanPrijsNl($row->WEB_VAN_PRIJS_NL);
    		$model->setWebVanPrijsIse($row->WEB_VAN_PRIJS_ISE);
    		$model->setAvailabilityWeek($row['AvailabilityWeek']);
    		$result[] = $model;
		}
		return $result;
	}
}