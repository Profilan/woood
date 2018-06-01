<?php

class Site_Model_Db_SQLWooodOrderMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model) {
		if (!$model instanceof Site_Model_SQLWooodOrder) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		$db1 = Zend_Registry::get('db1');
		
		$data = array();
		$data['REFERENTIE'] = $model->getReferentie();
		$data['OMSCHRIJVING'] = $model->getOmschrijving();
		$data['DEBITEURNR'] = $model->getDebiteurnr();
		$data['STATUS'] = $model->getStatus();
		$data['ORDERNR'] = $model->getOrdernr();
		$data['SYSMSG'] = $model->getSysmsg();
		// Toegevoegd op 7-1-2015 door R.A. Soffner
		$data['SELECTIECODE'] = $model->getSelectiecode();
		$data['ORDERTOELICHTING'] = $model->getOrdertoelichting();
		$data['ACCEPTATIE_VERZAMELEN'] = $model->getAcceptatieVerzamelen();
		$data['ACCEPTATIE_ORDERKOSTEN'] = $model->getAcceptatieOrderkosten();
		$data['DS_NAAM'] = $model->getDsNaam();
		$data['DS_AANSPREEKTITEL'] = $model->getDsAanspreektitel();
		$data['DS_ADRES1'] = $model->getDsAdres1();
		$data['DS_POSTCODE'] = $model->getDsPostcode();
		$data['DS_PLAATS'] = $model->getDsPlaats();
		$data['DS_LAND'] = $model->getDsLand();
		$data['DS_TELEFOON'] = $model->getDsTelefoon();
		$data['DS_EMAIL']= $model->getDsEmail();
		$data['AUTHENTICATED_USER'] = $model->getAuthenticatedUser();
		$data['ACCEPTATIE_ORDERSPLITSING'] = $model->getAcceptatieOrdersplitsing();
		$data['PAYMENT_RELEASE_REQUIRED'] = $model->getPaymentReleaseRequired();
		
		if ($model->getId() < 0) {
			// nieuw object, doe insert
			$data['SYSCREATED'] = $model->getSyscreated();
			$db1->insert('_AB_TB_WEB_ORKRG', $data);
			$id = $db1->lastInsertId();
			$model->setId($id);
	
		} else {
			// bestaand object, doe update
			$data['SYSMODIFIED'] = $model->getSysmodified();
			$where = 'id = '. $model->getId();
			$db1->update('_AB_TB_WEB_ORKRG', $data, $where);
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
		$result = null;
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_TB_WEB_ORKRG');
		$select->where('ID = ?', $id);
		
		$row = $db1->fetchRow($select);
		if ($row) {
			if (!($model instanceof Site_Model_SQLWooodOrder)) {
				$model = new Site_Model_SQLWooodOrder();
			}
			// vul het model object
			$model->setId($row['ID']);
			$model->setReferentie($row['REFERENTIE']);
			$model->setOmschrijving($row['OMSCHRIJVING']);
			$model->setDebiteurnr($row['DEBITEURNR']);
			$model->setStatus($row['STATUS']);
			$model->setSyscreated($row['SYSCREATED']);
			$model->setSysmodified($row['SYSMODIFIED']);
			$model->setOrdernr($row['ORDERNR']);
			$model->setSysmsg($row['SYSMSG']);

			// Toegevoegd d.d. 7-1-2015 door R.A. Soffner
			$model->setSelectiecode($row['SELECTIECODE']);
			$model->setOrdertoelichting($row['ORDERTOELICHTING']);
			$model->setAcceptatieVerzamelen($row['ACCEPTATIE_VERZAMELEN']);
			$model->setAcceptatieOrderkosten($row['ACCEPTATIE_ORDERKOSTEN']);
			$model->setDsNaam($row['DS_NAAM']);
			$model->setDsAanspreektitel($row['DS_AANSPREEKTITEL']);
			$model->setDsAdres1($row['DS_ADRES1']);
			$model->setDsPostcode($row['DS_POSTCODE']);
			$model->setDsPlaats($row['DS_PLAATS']);
			$model->setDsLand($row['DS_LAND']);
			$model->setDsTelefoon($row['DS_TELEFOON']);
			$model->setDsEmail($row['DS_EMAIL']);
			$model->setAuthenticatedUser($row['AUTHENTICATED_USER']);
			$model->setAcceptatieOrdersplitsing($row['ACCEPTATIE_ORDERSPLITSING']);
			$model->setPaymentReleaseRequired($row['PAYMENT_RELEASE_REQUIRED']);
			
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
		$select->from('_AB_TB_WEB_ORKRG');
		
		$rows = $db1->fetchAll($select);
		
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodOrder();
			$order->setId($row['ID']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setOmschrijving($row['OMSCHRIJVING']);
			$order->setDebiteurnr($row['DEBITEURNR']);
			$order->setStatus($row['STATUS']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['SYSMODIFIED']);
			$order->setOrdernr($row['ORDERNR']);
			$order->setSysmsg($row['SYSMSG']);

			// Toegevoegd d.d. 7-1-2015 door R.A. Soffner
			$order->setSelectiecode($row['SELECTIECODE']);
			$order->setOrdertoelichting($row['ORDERTOELICHTING']);
			$order->setAcceptatieVerzamelen($row['ACCEPTATIE_VERZAMELEN']);
			$order->setAcceptatieOrderkosten($row['ACCEPTATIE_ORDERKOSTEN']);
			$order->setDsNaam($row['DS_NAAM']);
			$order->setDsAanspreektitel($row['DS_AANSPREEKTITEL']);
			$order->setDsAdres1($row['DS_ADRES1']);
			$order->setDsPostcode($row['DS_POSTCODE']);
			$order->setDsPlaats($row['DS_PLAATS']);
			$order->setDsLand($row['DS_LAND']);
			$order->setDsTelefoon($row['DS_TELEFOON']);
			$order->setDsEmail($row['DS_EMAIL']);
			$order->setAuthenticatedUser($row['AUTHENTICATED_USER']);
			$order->setAcceptatieOrdersplitsing($row['ACCEPTATIE_ORDERSPLITSING']);
			$order->setPaymentReleaseRequired($row['PAYMENT_RELEASE_REQUIRED']);
				
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
		$select->from('_AB_TB_WEB_ORKRG');
		$select->where('ORDERNR = ?', $ordernr);
	
		$rows = $db1->fetchAll($select);
	
		$orders = array();
		foreach ($rows as $row) {
			$order = new Site_Model_SQLWooodOrder();
			$order->setId($row['ID']);
			$order->setReferentie($row['REFERENTIE']);
			$order->setOmschrijving($row['OMSCHRIJVING']);
			$order->setDebiteurnr($row['DEBITEURNR']);
			$order->setStatus($row['STATUS']);
			$order->setSyscreated($row['SYSCREATED']);
			$order->setSysmodified($row['SYSMODIFIED']);
			$order->setOrdernr($row['ORDERNR']);
			$order->setSysmsg($row['SYSMSG']);

			// Toegevoegd d.d. 7-1-2015 door R.A. Soffner
			$order->setSelectiecode($row['SELECTIECODE']);
			$order->setOrdertoelichting($row['ORDERTOELICHTING']);
			$order->setAcceptatieVerzamelen($row['ACCEPTATIE_VERZAMELEN']);
			$order->setAcceptatieOrderkosten($row['ACCEPTATIE_ORDERKOSTEN']);
			$order->setDsNaam($row['DS_NAAM']);
			$order->setDsAanspreektitel($row['DS_AANSPREEKTITEL']);
			$order->setDsAdres1($row['DS_ADRES1']);
			$order->setDsPostcode($row['DS_POSTCODE']);
			$order->setDsPlaats($row['DS_PLAATS']);
			$order->setDsLand($row['DS_LAND']);
			$order->setDsTelefoon($row['DS_TELEFOON']);
			$order->setDsEmail($row['DS_EMAIL']);
			$order->setAuthenticatedUser($row['AUTHENTICATED_USER']);
			$order->setAcceptatieOrdersplitsing($row['ACCEPTATIE_ORDERSPLITSING']);
			$order->setPaymentReleaseRequired($row['PAYMENT_RELEASE_REQUIRED']);
				
			$orders[] = $order;
		}
	
		return $orders;
	}
	
	/**
	 * Geeft alle artikelen terug.
	 * @return array
	 */
	public function fetchByDebiteurnrReference($key) {
	    if (!is_array($key)) {
	        throw new Exception('fetchByOrdernrReference:: $key must be an array');
	    }
	    
	    $db1 = Zend_Registry::get('db1');
	    /**
	     * 
	     * @var Zend_Db_Select $select
	     */
	    $select = $db1->select();
	    $select->from('_AB_TB_WEB_ORKRG');
	    $select->where('DEBITEURNR = ?', $key['DEBITEURNR']);
	    $select->where('REFERENTIE = ?', $key['REFERENTIE']);
	    
	    $rows = $db1->fetchAll($select);
	    
	    $orders = array();
	    foreach ($rows as $row) {
	        $order = new Site_Model_SQLWooodOrder();
	        $order->setId($row['ID']);
	        $order->setReferentie($row['REFERENTIE']);
	        $order->setOmschrijving($row['OMSCHRIJVING']);
	        $order->setDebiteurnr($row['DEBITEURNR']);
	        $order->setStatus($row['STATUS']);
	        $order->setSyscreated($row['SYSCREATED']);
	        $order->setSysmodified($row['SYSMODIFIED']);
	        $order->setOrdernr($row['ORDERNR']);
	        $order->setSysmsg($row['SYSMSG']);
	        
	        
	        
	        // Toegevoegd d.d. 7-1-2015 door R.A. Soffner
	        $order->setSelectiecode($row['SELECTIECODE']);
	        $order->setOrdertoelichting($row['ORDERTOELICHTING']);
	        $order->setAcceptatieVerzamelen($row['ACCEPTATIE_VERZAMELEN']);
	        $order->setAcceptatieOrderkosten($row['ACCEPTATIE_ORDERKOSTEN']);
	        $order->setDsNaam($row['DS_NAAM']);
	        $order->setDsAanspreektitel($row['DS_AANSPREEKTITEL']);
	        $order->setDsAdres1($row['DS_ADRES1']);
	        $order->setDsPostcode($row['DS_POSTCODE']);
	        $order->setDsPlaats($row['DS_PLAATS']);
	        $order->setDsLand($row['DS_LAND']);
	        $order->setDsTelefoon($row['DS_TELEFOON']);
	        $order->setDsEmail($row['DS_EMAIL']);
	        $order->setAuthenticatedUser($row['AUTHENTICATED_USER']);
	        $order->setAcceptatieOrdersplitsing($row['ACCEPTATIE_ORDERSPLITSING']);
	        $order->setPaymentReleaseRequired($row['PAYMENT_RELEASE_REQUIRED']);
	        
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
			$model = new Site_Model_SQLWooodOrder();
			$model->setId($row->id);
			$model->setReferentie($row->referentie);
			$model->setOmschrijving($row->omschrijving);
			$model->setDebiteurnr($row->debiteurnr);
			$model->setStatus($row->status);
			$model->setSyscreated($row->syscreated);
			$model->setSysmodified($row->sysmodified);
			$model->setOrdernr($row->ordernr);
			$model->setSysmsg($row->sysmsg);

			// Toegevoegd d.d. 7-1-2015 door R.A. Soffner
			$model->setSelectiecode($row->selectiecode);
			$model->setOrdertoelichting($row->ordertoelichting);
			$model->setAcceptatieVerzamelen($row->acceptatie_verzamelen);
			$model->setAcceptatieOrderkosten($row->acceptatie_orderkosten);
			$model->setDsNaam($row->ds_naam);
			$model->setDsAanspreektitel($row->ds_aanspreektitel);
			$model->setDsAdres1($row->ds_adres1);
			$model->setDsPostcode($row->ds_postcode);
			$model->setDsPlaats($row->ds_plaats);
			$model->setDsLand($row->ds_land);
			$model->setDsTelefoon($row->ds_telefoon);
			$model->setDsEmail($row->ds_email);
			$model->setAuthenticatedUser($row->authenticated_user);
			$model->setAcceptatieOrdersplitsing($row->acceptatie_ordersplitsing);
			$model->setPaymentReleaseRequired($row->payment_release_required);
				
			$result[] = $model;
		}
		return $result;
	}
	
	public function getInfo() {
	    $db1 = Zend_Registry::get('db1');
	    
	    return $db1->describeTable('_AB_TB_WEB_ORKRG');
	}
}