<?php
class Api_WooodPaymentReleaseController extends Zend_Controller_Action
{
    private $_WSDL_URI="https://is.woood.eu/api/woood-payment-release?wsdl";
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
        
        $response = array();
                
        echo Zend_Json::encode($response);
    }
    
    public function viewAction()
    {
        $request = $this->getRequest();
       
        $response = array();
        
        echo Zend_Json::encode($response);
    }
    
    public function createAction()
    {
        $data = file_get_contents('php://input');
        
        $response = array();
        $response['header'] = array();
        $response['body'] = array();
        $response['body']['message'] = '';
        
        $status_code = 200;
        $status_message = 'OK';
        $message = '';
        
        try {
            $dataArr = Zend_Json::decode($data);
            
            if (isset($dataArr['header']['api-key'])) {
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
                
                $post = $dataArr['body'];
                
                if (!isset($post['REFERENTIE'])) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'REFERENTIE is required';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                if (!isset($post['DEBITEURNR'])) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'DEBITEURNR is required';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                if (!isset($post['PAYMENT_RELEASE'])) {
                    $post['PAYMENT_RELEASE'] = 0;
                }
                
                // Check if the REFERENTIE and ORDERNR exists
                $orderList = new Site_Model_SQLWooodOrderList();
                
                $existingOrders = $orderList->getList('reference', array(
                    'DEBITEURNR' => $post['DEBITEURNR'],
                    'REFERENTIE' => $post['REFERENTIE']
                ));
                
                if (count($existingOrders) == 0) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'DEBITEURNR-REFERENTIE UNKNOWN';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                // If everything is OK save the payment release
                $model = new Site_Model_SQLWooodPaymentRelease();
                
                $model->setDebiteurnr($post['DEBITEURNR']);
                $model->setReferentie($post['REFERENTIE']);
                $model->setPaymentRelease($post['PAYMENT_RELEASE']);
                
                $model->save();
                
                $message = 'The Release Payment was succesfully added';
                
            }
            catch (Exception $e) {
                $message = 'There was an error when the payment release was added: '.$e->getMessage();
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
    
    public function createTestAction()
    {
        $data = file_get_contents('php://input');
        
        $response = array();
        $response['header'] = array();
        $response['body'] = array();
        $response['body']['message'] = '';
        
        $status_code = 200;
        $status_message = 'OK';
        $message = '';
        
        try {
            $dataArr = Zend_Json::decode($data);
            
            if (isset($dataArr['header']['api-key'])) {
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
                
                $post = $dataArr['body'];
                
                if (!isset($post['REFERENTIE'])) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'REFERENTIE is required';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                if (!isset($post['DEBITEURNR'])) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'DEBITEURNR is required';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                if (!isset($post['PAYMENT_RELEASE'])) {
                    $post['PAYMENT_RELEASE'] = 0;
                }
                
                /*
                
                // Check if the REFERENTIE and ORDERNR exists
                $orderList = new Site_Model_SQLWooodOrderList();
                
                $existingOrders = $orderList->getList('reference', array(
                    'DEBITEURNR' => $post['DEBITEURNR'],
                    'REFERENTIE' => $post['REFERENTIE']
                ));
                
                if (count($existingOrders) == 0) {
                    $status_code = 400;
                    $status_message = 'Bad Request';
                    $message = 'DEBITEURNR-REFERENTIE UNKNOWN';
                    Zend_Registry::get('logger')->info(__METHOD__. ' ' . $status_code . ' ' . $userModel->getUserName() . ' ' . $status_message . ' ' . $message);
                    
                    $this->getResponse()->setHttpResponseCode(400);
                    
                    $response['header'] = array(
                        'status_code' => $status_code,
                        'status_message' => $status_message,
                    );
                    
                    $response['body']['message'] = $message;
                    
                    echo Zend_Json::encode($response);return;
                }
                
                // If everything is OK save the payment release
                $model = new Site_Model_SQLWooodPaymentRelease();
                
                $model->setDebiteurnr($post['DEBITEURNR']);
                $model->setReferentie($post['REFERENTIE']);
                $model->setPaymentRelease($post['PAYMENT_RELEASE']);
                
                $model->save();
                
                */
                
                $message = 'The Release Payment was succesfully added';
                
            }
            catch (Exception $e) {
                $message = 'There was an error when the payment release was added: '.$e->getMessage();
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

