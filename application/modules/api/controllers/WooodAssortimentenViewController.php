<?php
class Api_WooodAssortimentenViewController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-assortimenten-view?wsdl";
	
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
    	$assId = $request->getParam('id', 9);
    	$response = array();
    	 
    	$assortimentenViewModel = new Site_Model_SQLWooodAssortimentenViewList();
    		
    	$assortimentenViewList = $assortimentenViewModel->getList('assortment', $assId);
    	 
    	foreach ($assortimentenViewList as $assortment) {
    		$assortmentArr = $assortment->toArray();
    		
    		$response[] = $assortmentArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodAssortimentenView');
    
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
    	$autodiscover->setClass('Site_Model_SoapRpcSQLWooodAssortimentenView');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SoapRpcSQLWooodAssortimentenView');
    	
    	$server->handle();
    }
}

