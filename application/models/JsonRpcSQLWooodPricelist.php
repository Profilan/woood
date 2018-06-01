<?php 
class Site_Model_JsonRpcSQLWooodPricelist
{
    /**
     * Geef een lijst met artikelen terug
     *
     * @return array
     */
    public function getList()
    {
        $response = array();
    	
    	$model = new Site_Model_SQLWooodPricelistViewList();
    	$list = $model->getList();
    	
    	foreach ($list as $item) {
    		$itemArr = $item->toArray();

    		$response[] = $itemArr;
    	}
    	
    	return $response;
    }

    /**
     * Geeft een pricelist item terug
     *
     * @param  string $artikelnummer
     * @return array
     */
    public function getItem($artikelnummer)
    {
    	$item = new Site_Model_SQLWooodPricelistView();
    	$item->load($artikelnummer);
    
    	return $item->toArray();
    }
        
}