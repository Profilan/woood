<?php 
class Site_Model_JsonRpcSQLWooodArtikelview
{
    /**
     * Geef een lijst met artikelen terug
     *
     * @return array
     */
    public function getList()
    {
        $response = array();
    	
    	$artikelViewModel = new Site_Model_SQLWooodArtikelviewList();
    	$artikelViewList = $artikelViewModel->getList();
    	
    	foreach ($artikelViewList as $artikel) {
    		$artikelArr = $artikel->toArray();
    		// Controleer of artikel uit meerdere pakketten bestaat
    		$aantalPakketten = $artikel->getAantalPakketten();
    		
    		$pakketten = array();
    		if ($artikel->getAantalPakketten() > 1) {
    			$artikelViewPakketModel = new Site_Model_SQLWooodArtikelviewPakketList();
    			$artikelViewPakketList = $artikelViewPakketModel->getList('article', $artikel->getArtikelCode());
    			foreach ($artikelViewPakketList as $pakket) {
    				$pakketten[] = $pakket->toArray();
    			}
    		} else {
    			$pakketten[] = $artikel->toArray();
    		}
    		$artikelArr['PAKKETTEN'] = $pakketten;
    		$response[] = $artikelArr;
    	}
    	
    	return $response;
    }

    /**
     * Geeft een artikel terug
     *
     * @param  int $id
     * @return array
     */
    public function getItem($id)
    {
    	$item = new Site_Model_SQLWooodArtikelview();
    	$item->load($id);
    
    	return $item->toArray();
    }
        
}