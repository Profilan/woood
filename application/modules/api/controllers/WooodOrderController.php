<?php
class Api_WooodOrderController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-order?wsdl";
	private $_debug = true;
	
    public function init()
    {
        $this->_helper->layout()->disableLayout(); 
    	$this->_helper->viewRenderer->setNoRender(true);
    	$this->getResponse()->setHeader('Content-Type', 'application/json');
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
    	$ordernr = $request->getParam('ordernr', 0);
    	$response = array();
    	 
    	$orderViewModel = new Site_Model_SQLWooodOrderList();
    	if ($ordernr) {
    		$orderViewList = $orderViewModel->getList('ordernr', $ordernr);
    	} else {
    		$orderViewList = $orderViewModel->getList();
    	}
    	 
    	foreach ($orderViewList as $item) {
    		$orderlistArr = $item->toArray();
    		
    		$response[] = $orderlistArr;
    	}
    	 
    	echo Zend_Json::encode($response);
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$ordernr = $request->getParam('ordernr', 0);
    	$response = array();
    	$response['body'] = array();
    	 
    	$orderViewModel = new Site_Model_SQLWooodOrderList();
    	$orderViewList = $orderViewModel->getList('ordernr', $ordernr);
    	 
    	foreach ($orderViewList as $item) {
    		$orderlistArr = $item->toArray();
    		
    		$response[] = $orderlistArr;
    	}
    	
    	echo Zend_Json::encode($response);
    }
    
    public function createAction()
    {
//     	$data = json_decode(file_get_contents('php://input'));
    	//		var_dump($data);
    			 
//     	$request = $this->getRequest();
    	// $data = $request->getParam('data', null);
    	$data = file_get_contents('php://input');

    	$response = array();
    	$response['header'] = array();
    	$response['body'] = array();
    	$response['body']['message'] = '';
    	$response['body']['references'] = array();
    	
    	$status_code = 200;
    	$status_message = 'OK';
    	$message = '';
    	
    	try {
    			$dataArr = Zend_Json::decode($data);

    			if (isset($dataArr['header']['api-key'])) {
 //   			    $apiKey = $dataArr['header']['api-key'];
    			    
    			    // Get the API key of the logged in user
    			    $userModel = new Site_Model_User();
    			    $userModel->loadByUserName($dataArr['header']['username']);
    			    
    			    $apiKey = $userModel->getApiKey();
    			    
    			    if ($apiKey != $dataArr['header']['api-key']) {
    			        $status_code = 401;
    			        $status_message = 'Unauthorized';
    			        $message = 'API key is not correct. Get a right API key from the service provider.';
    			        
    			        $response['header'] = array(
    			            'status_code' => $status_code,
    			            'status_message' => $status_message,
    			        );
    			        
    			        $response['body']['message'] = $message;
    			        
    			        Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    			        $this->getResponse()->setHttpResponseCode(401);
    			        
    			        echo Zend_Json::encode($response);
    			        
    			        return false;
    			    }
    			} else {
    			    $status_code = 401;
    			    $status_message = 'Unauthorized';
    			    $message = 'API key is missing';

    			    $response['header'] = array(
    			        'status_code' => $status_code,
    			        'status_message' => $status_message,
    			    );
    			     
    			    $response['body']['message'] = $message;
    			    
    			    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    			    $this->getResponse()->setHttpResponseCode(401);
    			     
    			    echo Zend_Json::encode($response);
    			    	
    			    return false;
    			}
    			 
    	    	try {
    	    		$orderCount = 0;
    	    		if (!is_array($dataArr['body']['order'])) {
    	    		    $status_code = 400;
    	    		    $status_message = 'Bad Request';
    	    		    $message = 'Order must be an array';
    	    		    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    	    		    $this->getResponse()->setHttpResponseCode(400);
    	    		} else {
    			    	foreach ($dataArr['body']['order'] as $order) {
    			    		$totalOrderLines = count($order['item']);
    			    		
        	    			// Check for required fields
        	    			if (!isset($order['REFERENTIE'])) {
    				    		$status_code = 400;
    				    		$status_message = 'Bad Request';
        	    				$message = 'ORDER.REFERENTIE is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			} elseif (!isset($order['DEBITEURNR'])) {
    				    		$status_code = 400;
    				    		$status_message = 'Bad Request';
        	    				$message = 'ORDER.DEBITEURNR is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			} elseif (count($order['item']) == 0) {
        	    				$status_code = 400;
        	    				$status_message = 'Bad Request';
        	    				$message = 'At least one orderline is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			}
        	    			if ($this->_debug) {
        	    			    $message = 'Order received (REFERENTIE: ' . $order['REFERENTIE'] . '). Total order lines: ' . $totalOrderLines;
        	    			    Zend_Registry::get('logger')->info(__METHOD__ . ' ' . $userModel->getUserName()  . ' ' . $message);
        	    			}
        	    			
    			    		$orderModel = new Site_Model_SQLWooodOrder();
    			    		$orderModel->setReferentie($order['REFERENTIE']);
    			    		$orderModel->setOmschrijving($order['OMSCHRIJVING']);
    			    		$orderModel->setDebiteurnr($order['DEBITEURNR']);
    			    		$orderModel->setSyscreated(new Zend_Date());
    			    		
    			    		// Toegevoegd door R.A. Soffner d.d. 7-1-2015
    			    		if (isset($order['SELECTIECODE'])) {
    			    		    $orderModel->setSelectiecode($order['SELECTIECODE']);
    			    		}
    			    		if (isset($order['ORDERTOELICHTING'])) {
    			    		    $orderModel->setOrdertoelichting($order['ORDERTOELICHTING']);
    			    		}
    			    		if (isset($order['ACCEPTATIE_VERZAMELEN'])) {
    			    		    $orderModel->setAcceptatieVerzamelen($order['ACCEPTATIE_VERZAMELEN']);
    			    		}
    			    		if (isset($order['ACCEPTATIE_ORDERKOSTEN'])) {
    			    		    $orderModel->setAcceptatieOrderkosten($order['ACCEPTATIE_ORDERKOSTEN']);
    			    		}
    			    		if (isset($order['DS_NAAM'])) {
    			    		    $orderModel->setDsNaam($order['DS_NAAM']);
    			    		}
    			    		if (isset($order['DS_AANSPREEKTITEL'])) {
    			    		    $orderModel->setDsAanspreektitel($order['DS_AANSPREEKTITEL']);
    			    		}
    			    		if (isset($order['DS_ADRES1'])) {
    			    		    $orderModel->setDsAdres1($order['DS_ADRES1']);
    			    		}
    			    		if (isset($order['DS_POSTCODE'])) {
    			    		    $orderModel->setDsPostcode($order['DS_POSTCODE']);
    			    		}
    			    		if (isset($order['DS_PLAATS'])) {
    			    		    $orderModel->setDsPlaats($order['DS_PLAATS']);
    			    		}
    			    		if (isset($order['DS_LAND'])) {
    			    		    $orderModel->setDsLand($order['DS_LAND']);
    			    		}
    			    		if (isset($order['DS_TELEFOON'])) {
    			    		    $orderModel->setDsTelefoon($order['DS_TELEFOON']);
    			    		}
    			    		if (isset($order['DS_EMAIL'])) {
    			    		    $orderModel->setDsEmail($order['DS_EMAIL']);
    			    		}
    			    		if (isset($dataArr['header']['username'])) {
    			    		    $orderModel->setAuthenticatedUser($dataArr['header']['username']);
    			    		}    			    		
    			    		if (isset($order['ACCEPTATIE_ORDERSPLITSING'])) {
    			    		    $orderModel->setAcceptatieOrdersplitsing($order['ACCEPTATIE_ORDERSPLITSING']);
    			    		}
    			    		if (isset($order['PAYMENT_RELEASE_REQUIRED'])) {
    			    		    $orderModel->setPaymentReleaseRequired($order['PAYMENT_RELEASE_REQUIRED']);
    			    		}  			    		
    			    		$orderList = new Site_Model_SQLWooodOrderList();
    			    		
    			    	    $existingOrders = $orderList->getList('reference', array(
    			    	       'DEBITEURNR' => $order['DEBITEURNR'],
    			    	       'REFERENTIE' => $order['REFERENTIE']
    			    	    ));
    			    	    
    			    	    if (count($existingOrders) > 0) {
    			    	        $status_code = 400;
    			    	        $status_message = 'Bad Request';
    			    	        $message = 'The combination of DEBITEURNR and REFERENTIE must be unique';
    			    	        Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    			    	        /**
    			    	         * 
    			    	         * @var  Zend_Http_Response $resp
    			    	         */
    			    	        $resp = $this->getResponse();
    			    	        $this->getResponse()->setHttpResponseCode(400);
    			    	        
    			    	        $response['header'] = array(
    			    	            'status_code' => $status_code,
    			    	            'status_message' => $status_message,
    			    	        );
    			    	        $response['references'] = array(
    			    	            $existingOrders[0]->getReferentie()  
    			    	        );
    			    	        
    			    	        $response['body']['message'] = $message;
    			    	        
    			    	        echo Zend_Json::encode($response);return;
    			    	    }
//     			    	    echo 'Verificatie geslaagd';die();
//     			    	    var_dump($orderModel->toArray());die();
    			    	    
    			    		$orderModel->save();
    			    		++$orderCount;
    			    		
    			    		$orderLineCount = 0;
    			    		foreach ($order['item'] as $item) {
    							if (!isset($item['ITEMCODE'])) {
    					    		$status_code = 400;
    					    		$status_message = 'Bad Request';
    	    	    				$message = 'ITEM.ITEMCODE is required';
    	    	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    	    	    				$this->getResponse()->setHttpResponseCode(400);
    	    	    				break;
    	    	    			} elseif (!isset($item['AANTAL'])) {
    					    		$status_code = 400;
    					    		$status_message = 'Bad Request';
    	    	    				$message = 'ITEM.AANTAL is required';
    	    	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    	    	    				$this->getResponse()->setHttpResponseCode(400);
    	    	    				break;
    	    	    			}				    			
    	    	    			$orderLineModel = new Site_Model_SQLWooodOrderLine();
    			    			$orderLineModel->setReferentie($order['REFERENTIE']);
    			    			$orderLineModel->setDebiteurnr($order['DEBITEURNR']);
    			    			$orderLineModel->setItemcode($item['ITEMCODE']);
    			    			$orderLineModel->setAantal($item['AANTAL']);
    			    			$orderLineModel->setSyscreated(new Zend_Date());
    			    			if (isset($item['VERZENDWEEK'])) {
    			    			    $orderLineModel->setVerzendweek($item['VERZENDWEEK']);
    			    			}
    			    			
    			    			$orderLineModel->save();
    			    			++$orderLineCount;
    			    		}
    			    		$response['body']['references'][] = $orderModel->getReferentie();
    			    		if ($this->_debug) {
    			    		    $message = 'Order processed (REFERENTIE: ' . $orderModel->getReferentie() . ')';
    			    		    Zend_Registry::get('logger')->info(__METHOD__ . ' ' . $userModel->getUserName()  . ' ' . $message);
    			    		}
    			    	}
    	    		}
			    	if (!$orderCount) {
    	    			$status_code = 400;
    	    			$status_message = 'Bad Request';
			    		$message = 'No orders added';
			    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
			    		$this->getResponse()->setHttpResponseCode(400);
			    	} elseif (!$orderLineCount) {
			    		$status_code = 400;
			    		$status_message = 'Bad Request';
			    		$message = 'No orderlines added';
			    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
			    		$this->getResponse()->setHttpResponseCode(400);
			    	} else {
			    		$status_code = 200;
			    		$status_message = 'OK';
			    		$message = 'Order has been succesfully added';
			    		if ($this->_debug) {
			    		    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
			    		}
			    	}
		    	} 
		    	catch (Exception $e) {
		    		$message = 'There was an error when the order was added: '.$e->getMessage();
		    		$status_code = 500;
		    		$status_message = 'Server Error';
		    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
		    		$this->getResponse()->setHttpResponseCode(500);
		    	}
    	}
    	catch (Exception $e) {
    		$status_code = 400;
    		$status_message = 'Bad Request';
    		$message = 'Syntax error: '.$e->getMessage();
    		
    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
    		$this->getResponse()->setHttpResponseCode(400);
    	}
    	
    	$response['header'] = array(
    				'status_code' => $status_code,
    				'status_message' => $status_message,
    			);
    	
    	$response['body']['message'] = $message;
    	
    	echo Zend_Json::encode($response);
    }
    
    public function infoAction()
    {
        $model = new Site_Model_SQLWooodOrderLine();
        
        $tableInfo = $model->getTableInfo();
        
        $sizes = array();
        foreach ($tableInfo as $item) {
            $size = array(
                'field' => $item['COLUMN_NAME'],
                'length'    => $item['LENGTH']
            );
            $sizes[] = $size;
        }
        
        echo json_encode($sizes);
    }

    public function createTestAction()
    {
//     	$data = json_decode(file_get_contents('php://input'));
    	//		var_dump($data);
    			 
    	$request = $this->getRequest();
//     	$data = $request->getParam('data', null);
    	$data = file_get_contents('php://input');
    	
//     	echo 'Result:';
//     	echo '<pre>'.print_r($data, true).'</pre>';return;
    	 

    	$response = array();
    	$response['header'] = array();
    	$response['body'] = array();
    	$response['body']['message'] = '';
    	$response['body']['references'] = array();
    	
    	$status_code = 200;
    	$status_message = 'OK';
    	$message = '';
    	
    	try {
    			$dataArr = Zend_Json::decode($data);

    			if (isset($dataArr['header']['api-key'])) {
   			    $apiKey = $dataArr['header']['api-key'];
    			    
    			    // Get the API key of the logged in user
    			    $userModel = new Site_Model_User();
    			    $userModel->loadByUserName($dataArr['header']['username']);
    			    
    			    $apiKey = $userModel->getApiKey();
    			    
    			    if ($apiKey != $dataArr['header']['api-key']) {
    			        $status_code = 401;
    			        $status_message = 'Unauthorized';
    			        $message = 'API key is not correct. Get a right API key from the service provider.';
    			        
    			        $response['header'] = array(
    			            'status_code' => $status_code,
    			            'status_message' => $status_message,
    			        );
    			        
    			        $response['body']['message'] = $message;
    			        
    			        Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    			        $this->getResponse()->setHttpResponseCode(401);
    			        
    			        echo Zend_Json::encode($response);
    			        
    			        return false;
    			    }
    			} else {
    			    $status_code = 401;
    			    $status_message = 'Unauthorized';
    			    $message = 'API key is missing';

    			    $response['header'] = array(
    			        'status_code' => $status_code,
    			        'status_message' => $status_message,
    			    );
    			     
    			    $response['body']['message'] = $message;
    			    
    			    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    			    $this->getResponse()->setHttpResponseCode(401);
    			     
    			    echo Zend_Json::encode($response);
    			    	
    			    return false;
    			}
    			 
    			// var_dump($dataArr);
    	    	try {
    	    		$orderCount = 0;
    	    		if (!is_array($dataArr['body']['order'])) {
    	    		    $status_code = 400;
    	    		    $status_message = 'Bad Request';
    	    		    $message = 'Order must be an array';
    	    		    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    	    		    $this->getResponse()->setHttpResponseCode(400);
    	    		} else {
    			    	foreach ($dataArr['body']['order'] as $order) {
    			    		$totalOrderLines = count($order['item']);
        	    			// Check for required fields
        	    			if (!isset($order['REFERENTIE'])) {
    				    		$status_code = 400;
    				    		$status_message = 'Bad Request';
        	    				$message = 'ORDER.REFERENTIE is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			} elseif (!isset($order['DEBITEURNR'])) {
    				    		$status_code = 400;
    				    		$status_message = 'Bad Request';
        	    				$message = 'ORDER.DEBITEURNR is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			} elseif (count($order['item']) == 0) {
        	    				$status_code = 400;
        	    				$status_message = 'Bad Request';
        	    				$message = 'At least one orderline is required';
        	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
        	    				$this->getResponse()->setHttpResponseCode(400);
        	    				break;
        	    			}
        	    			die();
        	    			
    			    	    if ($this->_debug) {
        	    			    $message = 'Order received (REFERENTIE: ' . $order['REFERENTIE'] . '). Total order lines: ' . $totalOrderLines;
        	    			    Zend_Registry::get('logger')->info(__METHOD__ . ' ' . $userModel->getUserName()  . ' ' . $message);
        	    			}
        	    			$orderModel = new Site_Model_SQLWooodOrder();
    			    		$orderModel->setReferentie($order['REFERENTIE']);
    			    		$orderModel->setOmschrijving($order['OMSCHRIJVING']);
    			    		$orderModel->setDebiteurnr($order['DEBITEURNR']);
    			    		$orderModel->setSyscreated(new Zend_Date());
    			    		
    			    		// Toegevoegd door R.A. Soffner d.d. 7-1-2015
    			    		if (isset($order['SELECTIECODE'])) {
    			    		    $orderModel->setSelectiecode($order['SELECTIECODE']);
    			    		}
    			    		if (isset($order['ORDERTOELICHTING'])) {
    			    		    $orderModel->setOrdertoelichting($order['ORDERTOELICHTING']);
    			    		}
    			    		if (isset($order['ACCEPTATIE_VERZAMELEN'])) {
    			    		    $orderModel->setAcceptatieVerzamelen($order['ACCEPTATIE_VERZAMELEN']);
    			    		}
    			    		if (isset($order['ACCEPTATIE_ORDERKOSTEN'])) {
    			    		    $orderModel->setAcceptatieOrderkosten($order['ACCEPTATIE_ORDERKOSTEN']);
    			    		}
    			    		if (isset($order['DS_NAAM'])) {
    			    		    $orderModel->setDsNaam($order['DS_NAAM']);
    			    		}
    			    		if (isset($order['DS_AANSPREEKTITEL'])) {
    			    		    $orderModel->setDsAanspreektitel($order['DS_AANSPREEKTITEL']);
    			    		}
    			    		if (isset($order['DS_ADRES1'])) {
    			    		    $orderModel->setDsAdres1($order['DS_ADRES1']);
    			    		}
    			    		if (isset($order['DS_POSTCODE'])) {
    			    		    $orderModel->setDsPostcode($order['DS_POSTCODE']);
    			    		}
    			    		if (isset($order['DS_PLAATS'])) {
    			    		    $orderModel->setDsPlaats($order['DS_PLAATS']);
    			    		}
    			    		if (isset($order['DS_LAND'])) {
    			    		    $orderModel->setDsLand($order['DS_LAND']);
    			    		}
    			    		if (isset($order['DS_TELEFOON'])) {
    			    		    $orderModel->setDsTelefoon($order['DS_TELEFOON']);
    			    		}
    			    		if (isset($order['DS_EMAIL'])) {
    			    		    $orderModel->setDsEmail($order['DS_EMAIL']);
    			    		}
    			    		if (isset($dataArr['header']['username'])) {
    			    		    $orderModel->setAuthenticatedUser($dataArr['header']['username']);
    			    		}    			    		
    			    		if (isset($order['ACCEPTATIE_ORDERSPLITSING'])) {
    			    		    $orderModel->setAcceptatieOrdersplitsing($order['ACCEPTATIE_ORDERSPLITSING']);
    			    		}
    			    		if (isset($order['PAYMENT_RELEASE_REQUIRED'])) {
    			    		    $orderModel->setPaymentReleaseRequired($order['PAYMENT_RELEASE_REQUIRED']);
    			    		}
    			    		
    			    		// DEBITEURNR + REFERENTIE must be unique
    			    		 
//      			    		$orderModel->save();
    			    		++$orderCount;
    			    		
    			    		$orderLineCount = 0;
    			    		foreach ($order['item'] as $item) {
    							if (!isset($item['ITEMCODE'])) {
    					    		$status_code = 400;
    					    		$status_message = 'Bad Request';
    	    	    				$message = 'ITEM.ITEMCODE is required';
    	    	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    	    	    				$this->getResponse()->setHttpResponseCode(400);
    	    	    				break;
    	    	    			} elseif (!isset($item['AANTAL'])) {
    					    		$status_code = 400;
    					    		$status_message = 'Bad Request';
    	    	    				$message = 'ITEM.AANTAL is required';
    	    	    				Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    	    	    				$this->getResponse()->setHttpResponseCode(400);
    	    	    				break;
    	    	    			}				    			
    	    	    			$orderLineModel = new Site_Model_SQLWooodOrderLine();
    			    			$orderLineModel->setReferentie($order['REFERENTIE']);
    			    			$orderLineModel->setDebiteurnr($order['DEBITEURNR']);
    			    			$orderLineModel->setItemcode($item['ITEMCODE']);
    			    			$orderLineModel->setAantal($item['AANTAL']);
    			    			$orderLineModel->setSyscreated(new Zend_Date());
    			    			if (isset($item['VERZENDWEEK'])) {
    			    			    $orderLineModel->setVerzendweek($item['VERZENDWEEK']);
    			    			}
    			    			
//      			    			$orderLineModel->save();
    			    			++$orderLineCount;
    			    		}
    			    		$response['body']['references'][] = $orderLineModel->toArray();
    			    	    if ($this->_debug) {
    			    		    $message = 'Order processed (REFERENTIE: ' . $orderModel->getReferentie() . ')';
    			    		    Zend_Registry::get('logger')->info(__METHOD__ . ' ' . $userModel->getUserName()  . ' ' . $message);
    			    		}
    			    	}
    	    		}
			    	if (!$orderCount) {
    	    			$status_code = 400;
    	    			$status_message = 'Bad Request';
			    		$message = 'No orders added';
			    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
			    		$this->getResponse()->setHttpResponseCode(400);
			    	} elseif (!$orderLineCount) {
			    		$status_code = 400;
			    		$status_message = 'Bad Request';
			    		$message = 'No orderlines added';
			    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
			    		$this->getResponse()->setHttpResponseCode(400);
			    	} else {
			    		$status_code = 200;
			    		$status_message = 'OK';
			    		$message = 'Order has been succesfully added';
			    	    if ($this->_debug) {
			    		    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
			    		}
			    	}
		    	} 
		    	catch (Exception $e) {
		    		$message = 'There was an error when the order was added: '.$e->getMessage();
		    		$status_code = 500;
		    		$status_message = 'Server Error';
		    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
		    		$this->getResponse()->setHttpResponseCode(500);
		    	}
    	}
    	catch (Exception $e) {
    		$status_code = 400;
    		$status_message = 'Bad Request';
    		$message = 'Syntax error: '.$e->getMessage();
    		
    		Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' '  . ' ' . $status_message . ' ' . $message);
    		$this->getResponse()->setHttpResponseCode(400);
    	}
    	
    	$response['header'] = array(
    				'status_code' => $status_code,
    				'status_message' => $status_message,
    			);
    	
    	$response['body']['message'] = $message;
    	
    	echo Zend_Json::encode($response);
    }
        
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodOrder');
    
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
    	$autodiscover->setClass('Site_Model_JsonRpcSQLWooodOrder');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SOAPRpcSQLWooodOrder');
    	
    	$server->handle();
    }
}

