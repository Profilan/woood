<?php
class Api_WooodProductviewController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-productview?wsdl";

	private $_limit = 25;
	
    public function init()
    {
        $this->_helper->layout()->disableLayout(); 
    	$this->_helper->viewRenderer->setNoRender(true);
    }

   public function indexAction()
    {
		$request = $this->getRequest();
		
    	$this->_helper->viewRenderer->setNoRender();
    	
    	$format = $request->getParam('format', 'json');
    	
    	switch ($format) {
    		case 'json':
   			$this->handleJson();
    			break;
    		case 'xml':
    		default:
    			if(isset($_GET['wsdl'])) {
    				//return the WSDL
    				$this->handleWSDL();
    			} else {
    				//handle SOAP request
    				$this->handleSOAP();
    			}
    			break;
     	}
    	
    }
    
    public function listAction()
    {
        $request = $this->getRequest();
    	$page = (int)$request->getParam('page', 1);
    	$page_size = (int)$request->getParam('limit', $this->_limit);
    	
        $response = array();

        $model = new Site_Model_SQLWooodArtikelviewList();
        $total_items = $model->getTotalCount();
        $page_count = ceil($total_items / $page_size);
        
    	try {
    	
        	$artikelViewModel = new Site_Model_SQLWooodArtikelviewList();
        	if ($page) {
        	   $artikelViewList = $artikelViewModel->getList('all', null, $page, $page_size);
        	} else {
        	    $artikelViewList = $artikelViewModel->getList();
        	}
        	
        	Zend_Registry::get('logger')->info('WooodProductController: ' .__METHOD__. ' Total in query: ' . count($artikelViewList) );
        	 
        	$totalProcessed = 0;
        	$articles = array();
        	foreach ($artikelViewList as $artikel) {
        		$artikelArr = $artikel->toArray();
        		// Controleer of artikel uit meerdere pakketten bestaat
        		$aantalPakketten = $artikel->getAantalPakketten();
        	
        		$pakketten = array();
        		if ($artikel->getAantalPakketten() > 1) {
        			$artikelViewPakketModel = new Site_Model_SQLWooodArtikelviewPakketList();
        			$artikelViewPakketList = $artikelViewPakketModel->getList('article', $artikel->getArtikelCode());
        			foreach ($artikelViewPakketList as $pakket) {
        				$pakketArr = $pakket->toArray();
         				unset($pakketArr['EANCode']); 
        				$pakketten[] = $pakket->toArray();
        			}
        		} else {
        			$pakketArr = $artikel->toArray();
        			unset($pakketArr['COLOR_FINISH']);
        			unset($pakketArr['MATERIAL']);
        			unset($pakketArr['BRAND']);
        			unset($pakketArr['ASSORTMENT']);
        			unset($pakketArr['PRODUCTGROUP']);
        			unset($pakketArr['PRODUCTGROUP_CODE']);
        			unset($pakketArr['DEFAULT_SUBPRODUCTGROUP_CODE']);
        			unset($pakketArr['DEFAULT_SUBPRODUCTGROUP_NAME']);
        			unset($pakketArr['RANGE']);
        			unset($pakketArr['STATUS']);
        			unset($pakketArr['EXCLUSIV']);
        			unset($pakketArr['VERKOOPPRIJS']);
        			unset($pakketArr['VERKOOPEENHEID']);
    //    			unset($pakketArr['AANTAL_PAKKETTEN']);
        			unset($pakketArr['AFMETING_ARTIKEL_HXBXD']);
        			unset($pakketArr['EN_LONG_DESC']);
        			unset($pakketArr['DE_LONG_DESC']);
        			unset($pakketArr['NL_LONG_DESC']);
        			unset($pakketArr['FR_LONG_DESC']);
        			unset($pakketArr['AANTAL_VERP']);
        			unset($pakketArr['SOURCE']);
        			unset($pakketArr['MRP_RUN']);
        			unset($pakketArr['CONSUMENTENPRIJS']);
        			unset($pakketArr['CONSUMENTENPRIJS_VAN']);
        			unset($pakketArr['ISE_CONSUMENTENPRIJS']);
        			unset($pakketArr['ISE_CONSUMENTENPRIJS_VAN']);
        			unset($pakketArr['NEW_ARRIVAL']);
        			$pakketArr['ARTCODE_PAKKET'] = $pakketArr['ARTIKELCODE'];
        			$pakketArr['VRIJEVOORRAADPAKKET'] = $pakketArr['VRIJEVOORRAAD'];
        			unset($pakketArr['VRIJEVOORRAAD']);
        			$pakketArr['EANCode_PAKKET'] = $pakketArr['EANCode'];
        			unset($pakketArr['EANCode']);
        			unset($pakketArr['WEB_VAN_PRIJS_NL']);
        			unset($pakketArr['WEB_VAN_PRIJS_ISE']);
        			unset($pakketArr['AVAILABILITY_WEEK']);
         			
        			$pakketten[] = $pakketArr;
        		}
        		unset($artikelArr['GEWICHT']);
        		unset($artikelArr['VERPAK_DIKTE_MM']);
        		unset($artikelArr['VERPAK_LENGTE_MM']);
        		unset($artikelArr['VERPAK_BREEDTE_MM']);
        		unset($artikelArr['VOL_M3_VERP']);
        		$artikelArr['PAKKETTEN'] = $pakketten;
        		$articles[] = $artikelArr;
        		
        		$totalProcessed = $totalProcessed + 1;
        	}
    
        	Zend_Registry::get('logger')->info('WooodProductController: ' .__METHOD__. ' Total processed: ' . $totalProcessed );
    	} catch  (Exception $e) {
    	    $message = 'There was an error when the getting products: '.$e->getMessage();
    	    Zend_Registry::get('logger')->info(__METHOD__.  ' ' . $message);
    	    	
    	}

    	$response = array(
    	    '_embedded'     => $articles,
    	    'page_count'    => $page_count,
    	    'page_size'     => $page_size,
    	    'total_items'   => $total_items,
    	    'page'          => $page,
    	);
    	 
    	
    	echo Zend_Json::encode($response);
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$artikelcode = $request->getParam('artikelcode', 0);
    	$response = array();
    	 
    	$artikelViewModel = new Site_Model_SQLWooodArtikelviewList();
    	$artikelViewList = $artikelViewModel->getList('artikelcode', $artikelcode);
    	 
    	foreach ($artikelViewList as $artikel) {
    		$artikelArr = $artikel->toArray();
    		// Controleer of artikel uit meerdere pakketten bestaat
    		$aantalPakketten = $artikel->getAantalPakketten();
    	
    		$pakketten = array();
    		if ($artikel->getAantalPakketten() > 1) {
    			$artikelViewPakketModel = new Site_Model_SQLWooodArtikelviewPakketList();
    			$artikelViewPakketList = $artikelViewPakketModel->getList('article', $artikel->getArtikelCode());
    			foreach ($artikelViewPakketList as $pakket) {
    				$pakketArr = $pakket->toArray();
     				unset($pakketArr['EANCode']); 
    				$pakketten[] = $pakket->toArray();
    			}
    		} else {
    			$pakketArr = $artikel->toArray();
    			unset($pakketArr['COLOR_FINISH']);
    			unset($pakketArr['MATERIAL']);
    			unset($pakketArr['BRAND']);
    			unset($pakketArr['ASSORTMENT']);
    			unset($pakketArr['PRODUCTGROUP']);
    			unset($pakketArr['PRODUCTGROUP_CODE']);
    			unset($pakketArr['DEFAULT_SUBPRODUCTGROUP_CODE']);
    			unset($pakketArr['DEFAULT_SUBPRODUCTGROUP_NAME']);
    			unset($pakketArr['RANGE']);
    			unset($pakketArr['STATUS']);
    			unset($pakketArr['EXCLUSIV']);
    			unset($pakketArr['VERKOOPPRIJS']);
    			unset($pakketArr['VERKOOPEENHEID']);
    			unset($pakketArr['AANTAL_PAKKETTEN']);
    			unset($pakketArr['AFMETING_ARTIKEL_HXBXD']);
    			unset($pakketArr['EN_LONG_DESC']);
    			unset($pakketArr['DE_LONG_DESC']);
    			unset($pakketArr['NL_LONG_DESC']);
    			unset($pakketArr['FR_LONG_DESC']);
    			unset($pakketArr['AANTAL_VERP']);
    			unset($pakketArr['SOURCE']);
    			unset($pakketArr['MRP_RUN']);
    			unset($pakketArr['CONSUMENTENPRIJS']);
    			unset($pakketArr['CONSUMENTENPRIJS_VAN']);
    			unset($pakketArr['ISE_CONSUMENTENPRIJS']);
    			unset($pakketArr['ISE_CONSUMENTENPRIJS_VAN']);
    			unset($pakketArr['NEW_ARRIVAL']);
    			$pakketArr['ARTCODE_PAKKET'] = $pakketArr['ARTIKELCODE'];
    			$pakketArr['VRIJEVOORRAADPAKKET'] = $pakketArr['VRIJEVOORRAAD'];
    			unset($pakketArr['VRIJEVOORRAAD']);
    			$pakketArr['EANCode_PAKKET'] = $pakketArr['EANCode'];
    			unset($pakketArr['EANCode']);
    			unset($pakketArr['WEB_VAN_PRIJS_NL']);
    			unset($pakketArr['WEB_VAN_PRIJS_ISE']);
    			unset($pakketArr['AVAILABILITY_WEEK']);
     			
    			$pakketten[] = $pakketArr;
    		}
    		unset($artikelArr['GEWICHT']);
    		unset($artikelArr['VERPAK_DIKTE_MM']);
    		unset($artikelArr['VERPAK_LENGTE_MM']);
    		unset($artikelArr['VERPAK_BREEDTE_MM']);
    		unset($artikelArr['VOL_M3_VERP']);
    		$artikelArr['PAKKETTEN'] = $pakketten;
    		$response[] = $artikelArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }

    public function testAction()
    {
    	$request = $this->getRequest();
    	$id = $request->getParam('id', 0);
    	$response = array();
    	 
    	$artikelViewItem = new Site_Model_SQLWooodArtikelview();
    	$artikelViewItem->load($id);
    	
    	$response = $artikelViewItem->toArray();

    	if ($artikelViewItem->getAantalPakketten() > 1) {
    		$artikelViewPakketModel = new Site_Model_SQLWooodArtikelviewPakketList();
    		$artikelViewPakketList = $artikelViewPakketModel->getList('article', $artikelViewItem->getArtikelCode());
    		foreach ($artikelViewPakketList as $pakket) {
    			$pakketten[] = $pakket->toArray();
    		}
    	}
    	
    	$response['PAKKETTEN'] = $pakketten;
    	 
    	echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodArtikelview');
    
    	if ('GET' == $_SERVER['REQUEST_METHOD']) {
    		// Indicate the URL endpoint, and the JSON-RPC version used:
    		$server->setTarget('/index.php')
    		->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);
    
    		// Grab the SMD
    		$smd = $server->getServiceMap();
    
    		// Return the SMD to the client
    		header('Content-Type: application/json');
    		echo $smd;
    		return;
    	}
    
    	$server->handle();
    }
    
    private function handleWSDL()
    {
    	$autodiscover = new Zend_Soap_AutoDiscover();
    	$autodiscover->setClass('Site_Model_SoapRpcSQLWooodArtikelview');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SoapRpcSQLWooodArtikelview');
    	
    	$server->handle();
    }
}

