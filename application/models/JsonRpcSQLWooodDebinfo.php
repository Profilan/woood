<?php 
class Site_Model_JsonRpcSQLWooodDebinfo
{
    /**
     * Geef een lijst met debiteuren terug
     *
     * @return array
     */
    public function getList()
    {
        $response = array();
    	
    	$model = new Site_Model_SQLWooodDebinfoList();
    	$list = $model->getList();
    	
    	foreach ($list as $item) {
    		$itemArr = $item->toArray();

    		$response[] = $itemArr;
    	}
    	
    	return $response;
    }

    /**
     * Geeft een debinfo item terug
     *
     * @param  string $debiteurnr
     * @return array
     */
    public function getItem($debiteurnr)
    {
    	$item = new Site_Model_SQLWooodDebinfo();
    	$item->load($debiteurnr);
    
    	return $item->toArray();
    }
        
}