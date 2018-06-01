<?php 
class Site_Model_JsonRpcFMPKadobon
{
    /**
     * Geef een lijst met artikelen terug
     *
     * @param  int $pageNumber
     * @param  int $pageCount
     * @return array
     */
    public function getList($pageNumber = 1, $pageCount = 25)
    {
        $response = array();
    	
    	$model = new Site_Model_FMPKadobonList();
    	$list = $model->getList('page', $pageNumber, $pageCount);
    	
    	foreach ($list as $item) {
    		$itemArr = $item->toArray();

    		$response[] = $itemArr;
    	}
    	
    	return $response;
    }

    /**
     * Geeft een kadobon terug
     *
     * @param  string $registratienummer
     * @return array
     */
    public function getItem($registratienummer)
    {
    	$item = new Site_Model_FMPKadobon();
    	$item->loadByRegistratienummer($registratienummer);
    
    	return $item->toArray();
    }
        
}