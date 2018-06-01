<?php

class Site_Model_Db_SQLWooodDebinfoMapper extends Site_Model_Db_DataMapperAbstract
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
	 * @param Site_Model_SQLWooodDebinfo $model
	 * @return Site_Model_SQLWooodDebinfo|null
	 */
	public function find($id, $model = null) {
		$result = null;
		$rows = $this->getDao()->find($id);
		if (0 !== count($rows)) {
			$row = $rows->current();
			if (!($model instanceof Site_Model_SQLWooodDebinfo)) {
				$model = new Site_Model_SQLWooodDebinfo();
			}
			// vul het model object
			$model->setNaam($row->naam);
			$model->setType($row->type);
			$model->setDebiteurnr($row->debiteurnr);
			$model->setFaktuurdebiteurnr($row->faktuurdebiteurnr);
			$model->setClassificatie($row->classificatie);
			$model->setClass_oms($row->class_oms);
			$model->setBtwnr($row->btwnr);
			$model->setBetalingsconditie($row->betalingsconditie);
			$model->setBetalingsconditieoms($row->betalingsconditieoms);
			$model->setLeveringswijze($row->leveringswijze);
			$model->setWoood_nl($row->woood_nl);
			$model->setPortal($row->portal);
			$model->setFactadres($row->factadres);
			$model->setFactpc($row->factpc);
			$model->setFactplaats($row->factplaats);
			$model->setFactlandcode($row->factlandcode);
			$model->setFactland($row->factland);
			$model->setBezadres($row->bezadres);
			$model->setBezpc($row->bezpc);
			$model->setBezplaats($row->bezplaats);
			$model->setBezlandcode($row->bezlandcode);
			$model->setBezland($row->bezland);
			$model->setAfladres($row->afladres);
			$model->setAflpc($row->aflpc);
			$model->setAflplaats($row->aflplaats);
			$model->setAfllandcode($row->afllandcode);
			$model->setAflland($row->aflland);
			$model->setPostadres($row->postadres);
			$model->setPostpc($row->postpc);
			$model->setPostplaats($row->postplaats);
			$model->setPostlandcode($row->postlandcode);
			$model->setPostland($row->postland);
			$model->setCmp_name($row->cmp_name);
			$model->setKvk($row->kvk);
			$model->setFrancolimiet($row['FRANCO_LIMIET']);
			$model->setMinimumorderlimiet($row['MINIMUM_ORDER_LIMIET']);
			$model->setOrdertoeslag($row['ORDER_TOESLAG']);
			$model->setAccountmanager($row['ACCOUNTMANAGER']);
			$model->setDffAccesscode($row['DFF_Accesscode']);
			$model->setOverrideLimits($row['OVERRIDE_LIMITS']);
			$model->setDebNameAlias($row['DEB_NAME_ALIAS']);
			$model->setDebWWWAlias($row['DEB_WWW_ALIAS']);
				
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
	    
	    return $db1->fetchOne( 'SELECT COUNT(*) AS count FROM _AB_DEBINFO' );
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchAll($page = null, $limit = null) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_DEBINFO');
		$select->order(array('DEBITEURNR ASC'));

		if ($page) {
		    $paginator = Zend_Paginator::factory($select);
		    $paginator->setCurrentPageNumber($page);
		    $paginator->setItemCountPerPage($limit);
		} else {
		    $paginator = $db1->fetchAll($select);
		}
		
		$debs = array();
		foreach ($paginator as $row) {
			$deb = new Site_Model_SQLWooodDebinfo();
			$deb->setNaam($row['NAAM']);
			$deb->setType($row['TYPE']);
			$deb->setDebiteurnr($row['DEBITEURNR']);
			$deb->setFaktuurdebiteurnr($row['FAKTUURDEBITEURNR']);
			$deb->setClassificatie($row['CLASSIFICATIE']);
			$deb->setClass_oms($row['CLASS_OMS']);
			$deb->setBtwnr($row['BTWNR']);
			$deb->setBetalingsconditie($row['BETALINGSCONDITIE']);
			$deb->setBetalingsconditieoms($row['BETALINGSCONDITIEOMS']);
			$deb->setLeveringswijze($row['LEVERINGSWIJZE']);
			$deb->setWoood_nl($row['WOOOD.NL']);
			$deb->setPortal($row['PORTAL']);
			$deb->setFactadres($row['FACTADRES']);
			$deb->setFactpc($row['FACTPC']);
			$deb->setFactplaats($row['FACTPLAATS']);
			$deb->setFactlandcode($row['FACTLANDCODE']);
			$deb->setFactland($row['FACTLAND']);
			$deb->setBezadres($row['BEZADRES']);
			$deb->setBezpc($row['BEZPC']);
			$deb->setBezplaats($row['BEZPLAATS']);
			$deb->setBezlandcode($row['BEZLANDCODE']);
			$deb->setBezland($row['BEZLAND']);
			$deb->setAfladres($row['AFLADRES']);
			$deb->setAflpc($row['AFLPC']);
			$deb->setAflplaats($row['AFLPLAATS']);
			$deb->setAfllandcode($row['AFLLANDCODE']);
			$deb->setAflland($row['AFLLAND']);
			$deb->setPostadres($row['POSTADRES']);
			$deb->setPostpc($row['POSTPC']);
			$deb->setPostplaats($row['POSTPLAATS']);
			$deb->setPostlandcode($row['POSTLANDCODE']);
			$deb->setPostland($row['POSTLAND']);
			$deb->setCmp_name($row['cmp_name']);
			$deb->setKvk($row['KvK']);
			$deb->setFrancolimiet($row['FRANCO_LIMIET']);
			$deb->setMinimumorderlimiet($row['MINIMUM_ORDER_LIMIET']);
			$deb->setOrdertoeslag($row['ORDER_TOESLAG']);
			$deb->setAccountmanager($row['ACCOUNTMANAGER']);
			$deb->setDffAccesscode($row['DFF_Accesscode']);
			$deb->setOverrideLimits($row['OVERRIDE_LIMITS']);
			$deb->setDebNameAlias($row['DEB_NAME_ALIAS']);
			$deb->setDebWWWAlias($row['DEB_WWW_ALIAS']);
				
			$debs[] = $deb;
		}
		
		return $debs;
	}

	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchByDebiteur($debiteurnr) {
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_DEBINFO');
		$select->where('DEBITEURNR LIKE ?', '%'.$debiteurnr.'%');
		$select->order(array('DEBITEURNR ASC'));
	
		$rows = $db1->fetchAll($select);
	
		$debs = array();
		foreach ($rows as $row) {
			$deb = new Site_Model_SQLWooodDebinfo();
			$deb->setNaam($row['NAAM']);
			$deb->setType($row['TYPE']);
			$deb->setDebiteurnr($row['DEBITEURNR']);
			$deb->setFaktuurdebiteurnr($row['FAKTUURDEBITEURNR']);
			$deb->setClassificatie($row['CLASSIFICATIE']);
			$deb->setClass_oms($row['CLASS_OMS']);
			$deb->setBtwnr($row['BTWNR']);
			$deb->setBetalingsconditie($row['BETALINGSCONDITIE']);
			$deb->setBetalingsconditieoms($row['BETALINGSCONDITIEOMS']);
			$deb->setLeveringswijze($row['LEVERINGSWIJZE']);
			$deb->setWoood_nl($row['WOOOD.NL']);
			$deb->setPortal($row['PORTAL']);
			$deb->setFactadres($row['FACTADRES']);
			$deb->setFactpc($row['FACTPC']);
			$deb->setFactplaats($row['FACTPLAATS']);
			$deb->setFactlandcode($row['FACTLANDCODE']);
			$deb->setFactland($row['FACTLAND']);
			$deb->setBezadres($row['BEZADRES']);
			$deb->setBezpc($row['BEZPC']);
			$deb->setBezplaats($row['BEZPLAATS']);
			$deb->setBezlandcode($row['BEZLANDCODE']);
			$deb->setBezland($row['BEZLAND']);
			$deb->setAfladres($row['AFLADRES']);
			$deb->setAflpc($row['AFLPC']);
			$deb->setAflplaats($row['AFLPLAATS']);
			$deb->setAfllandcode($row['AFLLANDCODE']);
			$deb->setAflland($row['AFLLAND']);
			$deb->setPostadres($row['POSTADRES']);
			$deb->setPostpc($row['POSTPC']);
			$deb->setPostplaats($row['POSTPLAATS']);
			$deb->setPostlandcode($row['POSTLANDCODE']);
			$deb->setPostland($row['POSTLAND']);
			$deb->setCmp_name($row['cmp_name']);
			$deb->setKvk($row['KvK']);
			$deb->setFrancolimiet($row['FRANCO_LIMIET']);
			$deb->setMinimumorderlimiet($row['MINIMUM_ORDER_LIMIET']);
			$deb->setOrdertoeslag($row['ORDER_TOESLAG']);
			$deb->setAccountmanager($row['ACCOUNTMANAGER']);
			$deb->setDffAccesscode($row['DFF_Accesscode']);
			$deb->setOverrideLimits($row['OVERRIDE_LIMITS']);
			$deb->setDebNameAlias($row['DEB_NAME_ALIAS']);
			$deb->setDebWWWAlias($row['DEB_WWW_ALIAS']);
				
			$debs[] = $deb;
		}
	
		return $debs;
	}
	

	/**
	 * vul een array met objecten van het juiste type. Deze methode wordt gebruikt door
	 * fetchAll en fetchFiltered
	 * @param Zend_Db_Table_Rowset_Abstract $rowset
	 */
	protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset) {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodDebinfo();
			$model->setNaam($row->naam);
			$model->setType($row->type);
			$model->setDebiteurnr($row->debiteurnr);
			$model->setFaktuurdebiteurnr($row->faktuurdebiteurnr);
			$model->setClassificatie($row->classificatie);
			$model->setClass_oms($row->class_oms);
			$model->setBtwnr($row->btwnr);
			$model->setBetalingsconditie($row->betalingsconditie);
			$model->setBetalingsconditieoms($row->betalingsconditieoms);
			$model->setLeveringswijze($row->leveringswijze);
			$model->setWoood_nl($row->woood_nl);
			$model->setPortal($row->portal);
			$model->setFactadres($row->factadres);
			$model->setFactpc($row->factpc);
			$model->setFactplaats($row->factplaats);
			$model->setFactlandcode($row->factlandcode);
			$model->setFactland($row->factland);
			$model->setBezadres($row->bezadres);
			$model->setBezpc($row->bezpc);
			$model->setBezplaats($row->bezplaats);
			$model->setBezlandcode($row->bezlandcode);
			$model->setBezland($row->bezland);
			$model->setAfladres($row->afladres);
			$model->setAflpc($row->aflpc);
			$model->setAflplaats($row->aflplaats);
			$model->setAfllandcode($row->afllandcode);
			$model->setAflland($row->aflland);
			$model->setPostadres($row->postadres);
			$model->setPostpc($row->postpc);
			$model->setPostplaats($row->postplaats);
			$model->setPostlandcode($row->postlandcode);
			$model->setPostland($row->postland);
			$model->setCmp_name($row->cmp_name);
			$model->setKvk($row->kvk);
			$model->setFrancolimiet($row->franco_limiet);
			$model->setMinimumorderlimiet($row->minimum_order_toeslag);
			$model->setOrdertoeslag($row->order_toeslag);
			$model->setAccountmanager($row->accountmanager);
			$model->setDffAccesscode($row->dff_accesscode);
			$model->setOverrideLimits($row->override_limits);
			$model->setDebNameAlias($row->deb_name_alias);
			$model->setDebWWWAlias($row->deb_www_alias);
				
			$result[] = $model;
		}
		return $result;
	}
}