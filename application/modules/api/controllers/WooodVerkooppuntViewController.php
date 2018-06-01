<?php
class Api_WooodVerkooppuntViewController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-verkooppunt-view?wsdl";
	
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
    	$artikelcode = $request->getParam('artikelcode', 0);
    	$response = array();
    	 
    	$verkooppuntViewModel = new Site_Model_SQLWooodVerkooppuntViewList();
    	if ($artikelcode) {
    		$verkooppuntViewList = $verkooppuntViewModel->getList('article', $artikelcode);
    	} else {
    		$verkooppuntViewList = $verkooppuntViewModel->getList();
    	}
    	 
    	foreach ($verkooppuntViewList as $verkooppunt) {
    		$verkooppuntArr = $verkooppunt->toArray();
    		
    		if ($verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS'])
    			$verkooppuntArr['FACTUURDEBITEURNAAM'] = $verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS'];

    		if ($verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS'])
    			$verkooppuntArr['FACTUURDEBITEURWEB'] = $verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS'];
    		
    		unset($verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS']);
    		unset($verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS']);
    		
    		$response[] = $verkooppuntArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$id = $request->getParam('artikelcode', 0);
		$request = $this->getRequest();
    	$artikelcode = $request->getParam('artikelcode', 0);
    	$debcode = $request->getParam('factuurdebiteurnr', 0);
    	$response = array();
    	 
    	$verkooppuntViewModel = new Site_Model_SQLWooodVerkooppuntViewList();
    	if ($artikelcode) {
    		$verkooppuntViewList = $verkooppuntViewModel->getList('article', $artikelcode);
    	}
    	if ($debcode) {
    		$verkooppuntViewList = $verkooppuntViewModel->getList('debcode', $debcode);
    	}
    	 
    	foreach ($verkooppuntViewList as $verkooppunt) {
    		$verkooppuntArr = $verkooppunt->toArray();
    		
    		if ($verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS'])
    			$verkooppuntArr['FACTUURDEBITEURNAAM'] = $verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS'];

    		if ($verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS'])
    			$verkooppuntArr['FACTUURDEBITEURWEB'] = $verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS'];
    		
    		unset($verkooppuntArr['FACTUURDEBITEUR_NAAM_ALIAS']);
    		unset($verkooppuntArr['FACTUURDEBITEUR_WEB_ALIAS']);
    		
    		$response[] = $verkooppuntArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodVerkooppuntView');
    
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
    	$autodiscover->setClass('Site_Model_SoapRpcSQLWooodVerkooppuntView');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SoapRpcSQLWooodVerkooppuntView');
    	
    	$server->handle();
    }
}

