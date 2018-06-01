<?php
class Api_WooodDebOrderInfoController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-deb-order-info?wsdl";

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
    	$page_size = (int)$request->getParam('limit');
		
    	$response = array();
    	 
    	$debViewModel = new Site_Model_SQLWooodDebOrderInfoList();
//    	$debViewList = $debViewModel->getList();
    	
    	if ($page_size) {
    	    $total_items = $debViewModel->getTotalCount();
    	    $page_count = ceil($total_items / $page_size);
    	    
    	    $debViewList = $debViewModel->getList('all', null, $page, $page_size);
    	} else {
    	    $debViewList = $debViewModel->getList();
    	}
    	 
    	$deblist = array();
    	foreach ($debViewList as $item) {
    		$deblistArr = $item->toArray();
    		
    		$deblist[] = $deblistArr;
    	}

    	if ($page_size) {
    	$response = array(
    	    '_embedded'     => $deblist,
    	    'page_count'    => $page_count,
    	    'page_size'     => $page_size,
    	    'total_items'   => $total_items,
    	    'page'          => $page,
    	);
    	} else {
    	    $response = $deblist;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$debiteurnr = $request->getParam('debiteurnr', 0);
    	$response = array();
    	 
    	$debViewModel = new Site_Model_SQLWooodDebOrderInfoList();
    	$debViewList = $debViewModel->getList('debiteur', $debiteurnr);
    	 
    	foreach ($debViewList as $item) {
    		$deblistArr = $item->toArray();
    		
    		$response[] = $deblistArr;
    	}
    	
    	echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodDebOrderInfo');
    
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
    	$autodiscover->setClass('Site_Model_JsonRpcSQLWooodDeborderInfo');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SOAPRpcSQLWooodDebinfo');
    	
    	$server->handle();
    }
}

