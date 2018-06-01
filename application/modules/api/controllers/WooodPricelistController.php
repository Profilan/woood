<?php
class Api_WooodPricelistController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-pricelist?wsdl";
	
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
    public function testAction()
    {
    	$request = $this->getRequest();
    	$artikelcode = $request->getParam('artikelcode', 0);
    	$response = array();
    
    	$pricelistViewModel = new Site_Model_SQLWooodPricelistViewList();
    	if ($artikelcode) {
    		$pricelistViewList = $pricelistViewModel->getList('article', $artikelcode);
    	} else {
    		$pricelistViewList = $pricelistViewModel->getList();
    	}
    
    	foreach ($pricelistViewList as $item) {
    		$pricelistArr = $item->toArray();
    
    		$response[] = $pricelistArr;
    	}
    
    	echo sizeof($response);
    }
    
    
    public function listAction()
    {
		$request = $this->getRequest();
    	$artikelcode = $request->getParam('artikelcode', 0);
    	$response = array();
    	 
    	$pricelistViewModel = new Site_Model_SQLWooodPricelistViewList();
    	if ($artikelcode) {
    		$pricelistViewList = $pricelistViewModel->getList('article', $artikelcode);
    	} else {
    		$pricelistViewList = $pricelistViewModel->getList();
    	}
    	 
    	foreach ($pricelistViewList as $item) {
    		$response[] = $item->toArray();
    	}
    	
    	$result = json_encode($response);
     	
    	$resultArr = str_split($result, 65536);
    	
    	foreach ($resultArr as $part) {
    		ob_flush();
    		echo $part;
    	}
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$debcode = $request->getParam('debiteurnr', 0);
    	$response = array();
    	 
    	$pricelistViewModel = new Site_Model_SQLWooodPricelistViewList();
    	$pricelistViewList = $pricelistViewModel->getList('debiteur', $debcode);
    	 
    	foreach ($pricelistViewList as $item) {
    		$pricelistArr = $item->toArray();
    		
    		$response[] = $pricelistArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodPricelist');
    
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
    	$autodiscover->setClass('Site_Model_SoapRpcSQLWooodPricelist');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SoapRpcSQLWooodPricelist');
    	
    	$server->handle();
    }
}

