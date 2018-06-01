<?php

class Site_Model_Db_SQLWooodBetalingsconditieMapper extends Site_Model_Db_DataMapperAbstract
{
	public function save($model)
	{
		parent::save($model);
	}

	/**
	 * Zoek het item met het gegeven code en geef een gevuld Betalingsconditie object terug. Als
	 * de code niet wordt gevonden, wordt null teruggegeven.
	 * De tweede parameter is optioneel. Wordt deze niet meegegeven, dan wordt een nieuw
	 * object geretourneerd
	 * @param int $id
	 * @param Site_Model_SQLWooodBetalingsconditie $model
	 * @return Site_Model_SQLWooodBetalingsconditie|null
	 */
	public function find($id, $model = null) 
	{
	    $result = null;
	    $rows = $this->getDao()->find($id);
	    if (0 !== count($rows)) {
	        $row = $rows->current();
	        if (!($model instanceof Site_Model_SQLWooodBetalingsconditie)) {
	            $model = new Site_Model_SQLWooodBetalingsconditie();
	        }
	        // vul het model object
			$model->setCode(($row->code));
			$model->setNlDesc($row->nl_desc);
			$model->setEnDesc($row->en_desc);
			$model->setDeDesc($row->de_desc);
			$model->setFrDesc($row->fr_desc);
	        
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
	    $select->from('_AB_DEB_BETALINGSCONDITIES');
	
	    $rows = $db1->fetchAll($select);
	
	    $items = array();
	    foreach ($rows as $row) {
	        $model = new Site_Model_SQLWooodBetalingsconditie();
	        $model->setCode($row['CODE']);
	        $model->setNlDesc($row['NL_DESC']);
	        $model->setEnDesc($row['EN_DESC']);
	        $model->setDeDesc($row['DE_DESC']);
	        $model->setFrDesc($row['FR_DESC']);
	
	        $items[] = $model;
	    }
	
	    return $items;
	}
	
	public function fetchByCode($code)
	{
	    $db1 = Zend_Registry::get('db1');
	    $select = $db1->select();
	    $select->from('_AB_DEB_BETALINGSCONDITIES');
	    $select->where('CODE = ?', $code);
	    
	    $rows = $db1->fetchAll($select);

	    $items = array();
	    foreach ($rows as $row) {
	        $model = new Site_Model_SQLWooodBetalingsconditie();
	        $model->setCode($row['CODE']);
	        $model->setNlDesc($row['NL_DESC']);
	        $model->setEnDesc($row['EN_DESC']);
	        $model->setDeDesc($row['DE_DESC']);
	        $model->setFrDesc($row['FR_DESC']);
	    
	        $items[] = $model;
	    }
	    
	    return $items;
	}
	
    /**
     * {@inheritDoc}
     * @see Site_Model_Db_DataMapperAbstract::createObjectArray()
     */
    protected function createObjectArray(Zend_Db_Table_Rowset_Abstract $rowset)
    {
		$result = array();
		foreach ($rowset as $row) {
			$model = new Site_Model_SQLWooodBetalingsconditie();
			$model->setCode(($row->code));
			$model->setNlDesc($row->nl_desc);
			$model->setEnDesc($row->en_desc);
			$model->setDeDesc($row->de_desc);
			$model->setFrDesc($row->fr_desc);
 			$result[] = $model; 
		}
		return $result;
    }

	
}