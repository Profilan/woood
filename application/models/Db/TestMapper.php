<?php
class Site_Model_Db_TestMapper
{
	private $_connection;
	
	public function __construct()
	{
		$this->_connection = odbc_connect('API', 'administrator', 'dihap') or die(odbc_errormsg($this->_connection));
	}

	/**
	 * 
	 * @param Site_Model_Test $model
	 * @throws InvalidArgumentException
	 */
	public function save($model) {
		if (!$model instanceof Site_Model_Test) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		if ($model->getArtikelnr() < 0) {
			// nieuw object, doe insert
			$sql = 'INSERT INTO TEST (ARTIKELNR, OMSCHRIJVING, VOORRAAD)'
			     .' VALUES ('
			     .$model->getArtikelnr().', '
			     ."'".$model->getOmschrijving()."', "
			     .$model->getVoorraad().')';
			$result = odbc_exec($this->_connection, $sql);
			
			// $model->setId($id);
	
		} else {
			// bestaand object, doe update
			$sql = "UPDATE TEST SET"
				 ." OMSCHRIJVING = '".$model->getOmschrijving()."', "
				 ." VOORRAAD = ".$model->getVoorraad()
				 ." WHERE ARTIKELNR = ".$model->getArtikelnr();
			$result = odbc_exec($this->_connection, $sql);
		}
	}
	
	public function find($id, $model = null)
	{
		$row = null;
		$sql = 'SELECT * FROM TEST'
			 .' WHERE ARTIKELNR = '.$id;
		$result = odbc_exec($this->_connection, $sql);
		if ($result) {
			if (odbc_fetch_row($result)) {
				if (!($model instanceof Site_Model_Test)) {
					$model = new Site_Model_Test();
				}
				// vul het model object
				$model->setArtikelnr(odbc_result($result, 'ARTIKELNR'));
				$model->setOmschrijving(odbc_result($result, 'OMSCHRIJVING'));
				$model->setVoorraad(odbc_result($result, 'VOORRAAD'));
				$row = $model;
			}
		}
		return $row;
	}
	
	public function delete($id)
	{
		$sql = "DELETE FROM TEST WHERE ARTIKELNR = ".$id;
		$result = odbc_exec($this->_connection, $sql);
		
		return $result;
	}
	
	public function fetchAll()
	{
		$sql = 'SELECT * FROM TEST';
		
		$result = odbc_exec($this->_connection, $sql);
		
		$rows = array();
		while(odbc_fetch_row($result)){
			$model = new Site_Model_Test();
			$model->setArtikelnr(odbc_result($result, 'ARTIKELNR'));
			$model->setOmschrijving(odbc_result($result, 'OMSCHRIJVING'));
			$model->setVoorraad(odbc_result($result, 'VOORRAAD'));
			$rows[] = $model;
		}
		return $rows;
	}

	public function __destruct()
	{
		odbc_close($this->_connection);
	}
}