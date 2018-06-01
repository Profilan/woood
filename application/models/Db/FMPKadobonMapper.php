<?php
class Site_Model_Db_FMPKadobonMapper
{
	private $_connection;
	
	public function __construct()
	{
		$this->_connection = odbc_connect('API', 'administrator', 'dihap') or die(odbc_errormsg($this->_connection));
	}

	/**
	 * 
	 * @param Site_Model_FMPKadobon $model
	 * @throws InvalidArgumentException
	 */
	public function save($model) {
		if (!$model instanceof Site_Model_FMPKadobon) {
			throw new InvalidArgumentException('Model is not of correct type');
		}
		if (strlen($model->getRegistratienummer()) == 0) {
			// nieuw object, doe insert
// 			$sql = 'INSERT INTO BL_Kadobonnen (Registratienummer, Status)'
// 			     .' VALUES ('
// 			     .$model->getRegistratienummer().', '
// 			     .$model->getStatus().')';
// 			$result = odbc_exec($this->_connection, $sql);
			
			// $model->setId($id);
	
		} else {
			// bestaand object, doe update
			$sql = "UPDATE BL_Kadobonnen SET"
				 ." Status = ".$model->getStatus()
				 ." WHERE Registratienummer = ".$model->getRegistratienummer();
			$result = odbc_exec($this->_connection, $sql);
		}
	}
	
	public function find($id, $model = null)
	{
		$row = null;
		$sql = "SELECT * FROM BL_Kadobonnen"
			 ." WHERE `Registratienummer` = '".$id."'";
		$result = odbc_exec($this->_connection, $sql);
		if ($result) {
			if (odbc_fetch_row($result)) {
				if (!($model instanceof Site_Model_FMPKadobon)) {
					$model = new Site_Model_FMPKadobon();
				}
				// vul het model object
				$model->setRegistratienummer(odbc_result($result, 'Registratienummer'));
				$model->setStatus(odbc_result($result, 'Status'));
				$row = $model;
			}
		}
		return $row;
	}

	public function findByRegistratienummer($registratienummer, $model = null)
	{
		$row = null;
		$sql = "SELECT * FROM BL_Kadobonnen"
			." WHERE `Registratienummer` = '".$registratienummer."'";
		$result = odbc_exec($this->_connection, $sql);
		if ($result) {
			if (odbc_fetch_row($result)) {
				if (!($model instanceof Site_Model_FMPKadobon)) {
					$model = new Site_Model_FMPKadobon();
				}
				// vul het model object
				$model->setRegistratienummer(odbc_result($result, 'Registratienummer'));
				$model->setStatus(odbc_result($result, 'Status'));
				$row = $model;
			}
		}
		return $row;
	}
	
	public function delete($id)
	{
		$sql = "DELETE FROM BL_Kadobonnen WHERE Registratienummer = ".$id;
		$result = odbc_exec($this->_connection, $sql);
		
		return $result;
	}
	
	public function fetchAll()
	{
		$sql = 'SELECT * FROM BL_Kadobonnen';
		
		$limit = 20;
		$limitstart = 0;
		
		$result = odbc_exec($this->_connection, $sql);
		
		$rows = array();
		for ($i = 0; $i < $limit; $i++) {
			odbc_fetch_row($result);
			$model = new Site_Model_FMPKadobon();
			$model->setRegistratienummer(odbc_result($result, 'Registratienummer'));
			$model->setStatus(odbc_result($result, 'Status'));
			$rows[] = $model;
		}
		return $rows;
	}

	public function fetchPage($pageNumber = 1, $pageCount = 25)
	{
		$sql = 'SELECT * FROM BL_Kadobonnen';
	
		$limit = $pageCount;
		$limitstart = ($pageNumber - 1) * $pageCount;
	
		$result = odbc_exec($this->_connection, $sql);
	
		$rows = array();
		for ($i = 0; $i < $limit; $i++) {
			odbc_fetch_row($result, $limitstart + $i);
			$model = new Site_Model_FMPKadobon();
			$model->setRegistratienummer(odbc_result($result, 'Registratienummer'));
			$model->setStatus(odbc_result($result, 'Status'));
			$rows[] = $model;
		}
		return $rows;
	}
	
	public function __destruct()
	{
		odbc_close($this->_connection);
	}
}