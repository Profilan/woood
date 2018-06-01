<?php

class Default_TestController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-artikelview?wsdl";
	
	public function init()
    {
        /* Initialize action controller here */
    }

    public function wooodArtikelviewlistAction()
    {
    	$username = 'APITest';
    	$password = 'SA32apitest';
    	
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    					),
    	);
    	
    	$params = array(
    			'jsonrp' => '2.0',
    			'method' => 'getList',
    			// 'params' => array('371151'),
    			'id' => 'woood-artikelviewlist'
    	);
    	
    	$http = new Zend_Http_Client('https://is.woood.eu/api/woood-artikelview?format=json', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    	
    	echo $http->request()->getBody();
    	
        
    }
    
    public function wooodArtikelviewAction()
    {
    	$username = 'APITest';
    	$password = 'SA32apitest';

    	$request = $this->getRequest();
    	$artikelcode = $request->getParam('artikelcode');
    	 
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    					),
    	);
    	
    	$params = array(
    			'jsonrp' => '2.0',
    			'method' => 'getItem',
    			'params' => array($artikelcode),
    			'id' => 'woood-artikelview'
    	);
    	
    	$http = new Zend_Http_Client('https://is.woood.eu/api/woood-artikelview?format=json', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    	
    	echo $http->request()->getBody();
    }
    
    public function kadobonAction()
    {
    	$username = 'APITest';
    	$password = 'SA32apitest';
    	
    	$request = $this->getRequest();
    	$registratienummer = $request->getParam('registratienummer');
    	
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    					),
    	);
    	
    	$params = array(
    			'jsonrp' => '2.0',
    			'method' => 'getItem',
    			'params' => array($registratienummer),
    			'id' => 'kadobon'
    	);
    	
    	$http = new Zend_Http_Client('https://is.woood.eu/api/kadobon?format=json', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    	
    	echo $http->request()->getBody();
    }
    
    public function kadobonlistAction()
    {
    	$username = 'APITest';
    	$password = 'SA32apitest';
    	 
    	$request = $this->getRequest();
    	
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    			),
    	);
    	 
    	$params = array(
    			'jsonrp' => '2.0',
    			'method' => 'getList',
    			'params' => array($pageNumber, $pageCount),
    			'id' => 'pricelist'
    	);
    	 
    	$http = new Zend_Http_Client('https://is.woood.eu/api/kadobon?format=json', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    	 
    	echo $http->request()->getBody();
    }

    public function pricelistAction()
    {
    	$username = 'APITest';
    	$password = 'SA32apitest';
    
    	$request = $this->getRequest();
    	$pageNumber = $request->getParam('pagenumber', 0);
    	$pageCount = $request->getParam('pagecount', 25);
    	 
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    			),
    	);
    
    	$params = array(
    			'jsonrp' => '2.0',
    			'method' => 'getList',
    			// 'params' => array($pageNumber, $pageCount),
    			'id' => 'pricelist'
    	);
    
    	$http = new Zend_Http_Client('https://is.woood.eu/api/woood-pricelist?format=json', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    
    	echo $http->request()->getBody();
    }
    
    public function debtorsAction()
    {
    	$username = 'Administrator';
    	$password = 'dihap';
    
    	$request = $this->getRequest();
    	$pageNumber = $request->getParam('pagenumber', 0);
    	$pageCount = $request->getParam('pagecount', 25);
    
    	$config = array(
    			'adapter'   => 'Zend_Http_Client_Adapter_Curl',
    			'curloptions' => array(
    					CURLOPT_USERPWD => $username . ":" . $password,
    					CURLOPT_HEADER => 0,
    					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    					CURLOPT_RETURNTRANSFER => 1,
    					CURLOPT_SSL_VERIFYPEER => false,
    			),
    	);
    
    	$params = array(
    			
    	);
    
    	$http = new Zend_Http_Client('https://is.woood.eu/api/woood-order/create-test', $config);
    	$http->setMethod(Zend_Http_Client::POST);
    	$http->setRawData(json_encode($params));
    
    	echo $http->request()->getBody();
    }
    
    
    public function orderCreateAction()
    {
    	$username = 'administrator';
    	$password = 'dihap';
    	
//     	$ch = curl_init();
    	
//     	$data = array('data' => 'Eekhoorn Test');
    
//     	curl_setopt($ch, CURLOPT_URL, 'https://is.woood.eu/api/woood-order/create-test');
//     	curl_setopt($ch, CURLOPT_POST, 1);
//     	curl_setopt($ch, CURLOPT_USERPWD, 'montagny:ffNbeW8YdqC9');
//     	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//     	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//     	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     	curl_setopt($ch, CURLOPT_HEADER, 0);
//     	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	    
//         $result = curl_exec($ch);
    	
// //     	$result = array('data' => 'Eekhoorn Test');
    	
//     	echo Zend_Json::encode($result);

    	$orderItems = array();
    	$orderItems[] = array(
    	    'ITEMCODE' => '8714713040339',
    	    'AANTAL' => 1,
    	    'VERZENDWEEK' => date("Y-W"),
    	);
    	// Hierna eventueel nog extra regels
    	// $orderItems[] = ... etc.
    	
    	$orders = array();
    	$orders[] = array(
    	    'REFERENTIE' => '424242',
    	    'OMSCHRIJVING' => '424242',
    	    'DEBITEURNR' => '123',
    	    'SELECTIECODE' => 'TH',
    	    'ORDERTOELICHTING' => 'Lorem ipsum',
    	    'DS_NAAM' => 'Test User',
            'DS_AANSPREEKTITEL' => 'M',
            'DS_ADRES1' => 'kromme weele 23',
            'DS_POSTCODE' => '4331 PA',
            'DS_PLAATS' => 'Middelburg',
            'DS_LAND' => 'NL',
            'DS_TELEFOON' => '0031616787296',
            'DS_EMAIL' => 'test@domain.nl',
            'item' => $orderItems,
        );
        // After this other order if present
        // $orders[] = ... etc.
    	
        $jsonData = array(
            'header' => array(
                'api-key' => "ffNbeW8YdqC98boLHDBaBxyXL2mb5vMHx8dRJLm",
                'username' => $username,
                'password' => $password,
            ),
            'body' => array(
                'order' => $orders,
            )
        );
     
        $jsonDataEncoded = json_encode($jsonData);
     
        $ch = curl_init('https://is.woood.eu/api/woood-order/create');
    	     
    	    curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
    	    curl_setopt($ch, CURLOPT_HEADER, 0);
    	    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    	    curl_setopt($ch, CURLOPT_POST, true);
    	    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	    $data = curl_exec($ch);
    	    $resultStatus = curl_getinfo($ch);
    	     
    	    if($resultStatus['http_code'] == 200) {
    	        echo $data;
    	    } else {
    	        echo 'Fout<br><br>';
    	        echo '<pre>'.print_r($resultStatus).'</pre>';
    	    }
    	     
    }
}

