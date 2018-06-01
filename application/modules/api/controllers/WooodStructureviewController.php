<?php
class Api_WooodStructureviewController extends Zend_Controller_Action
{
	private $_WSDL_URI="https://is.woood.eu/api/woood-structureview?wsdl";
	
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
    	$prodnr = $request->getParam('artikelcode', 0);
    	$page = (int)$request->getParam('page', 1);
    	$page_size = (int)$request->getParam('limit', $this->_limit);
    	$response = array();
    	
    	$model = new Site_Model_SQLWooodStructureviewList();
    	$list = $model->getList();
    	$total_items = count($list);
    	$page_count = ceil($total_items / $page_size);
        	
//     	if ($prodnr) {
//     	    $list = $model->getList('prodnr', $prodnr);
//     	} else {
//     	    $list = $model->getList();
//     	}
    	$list = $model->getList('all', null, $page, $page_size);
    	
//    	echo '<pre>'.print_r($list, true).'</pre>'; return; 

    	$products = array();
    	foreach ($list as $item) {
   	        $products[] = $this->getItem($item->getMainprod());
//   	        var_dump($products);die();
//            echo $item->getMainprod().'<br>';
    	}
//   	return;
    	
//     	$products = array();
//         foreach ($list as $item) {
//     		$listArr = $item->toArray();
    		
//     		$seqArr = explode('.', $listArr['SEQ_NO']);
    		
//     		if (!isset($products[$listArr['MAINPROD']])) {
//     		    $articleModel = new Site_Model_SQLWooodArtikelview();
//     		    $articleModel->load($listArr['MAINPROD']);
//     		    $products[$listArr['MAINPROD']] = array(
//     		      'LVL'           => '0',
//     		      'SEQ_NO'        => '000',
//     		      'ARTIKELCODE'   => $listArr['MAINPROD'],
//     		      'NL_DESCR'      => $listArr['ITEMPROD_DESC'],
// 		          'EN_DESCR'      => $articleModel->getEN(),
// 		          'DE_DESCR'      => $articleModel->getDE(),
// 		          'FR_DESCR'      => $articleModel->getFR(),
//     		      'QTY'           => $listArr['QTY_PER_MAINPROD'],
//     		    );
//     		    $products[$listArr['MAINPROD']][$seqArr[0]] = array(
//     		        'LVL'         => $listArr['LVL'],
//     		        'SEQ_NO'      => $listArr['SEQ_NO'],
//     		        'ARTIKELCODE' => $listArr['ITEMREQ'],
//     		        'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
//     		        'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
//     		        'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
//     		        'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
//     		        'QTY'         => $listArr['QTY_PER_MAINPROD'],
//     		    );
//     		} else {
    		    
//     		    switch (count($seqArr)) {
//     		        case '1':
//                         $products[$listArr['MAINPROD']][$seqArr[0]] = array(
//                             'LVL'         => $listArr['LVL'],
//                             'SEQ_NO'      => $listArr['SEQ_NO'],
//                             'ARTIKELCODE' => $listArr['ITEMREQ'],
//                             'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
//                             'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
//                             'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
//                             'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
//                             'QTY'         => $listArr['QTY_PER_MAINPROD'],
//                         );
//             		    break;
//     		        case '2':
//                         $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]] = array(
//                             'LVL'         => $listArr['LVL'],
//                             'SEQ_NO'      => $listArr['SEQ_NO'],
//                             'ARTIKELCODE' => $listArr['ITEMREQ'],
//                             'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
//                             'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
//                             'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
//                             'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
//                             'QTY'         => $listArr['QTY_PER_MAINPROD'],
//                         );
//             		    break;
//     		        case '3':
//                         $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]] = array(
//                             'LVL'         => $listArr['LVL'],
//                             'SEQ_NO'      => $listArr['SEQ_NO'],
//                             'ARTIKELCODE' => $listArr['ITEMREQ'],
//                             'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
//                             'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
//                             'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
//                             'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
//                             'QTY'         => $listArr['QTY_PER_MAINPROD'],
//                         );
//             		    break;
//     		        case '4':
//                         $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]][$seqArr[3]] = array(
//                             'LVL'         => $listArr['LVL'],
//                             'SEQ_NO'      => $listArr['SEQ_NO'],
//                             'ARTIKELCODE' => $listArr['ITEMREQ'],
//                             'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
//                             'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
//                             'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
//                             'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
//                             'QTY'         => $listArr['QTY_PER_MAINPROD'],
//                         );
//             		    break;
//     		    }
//     		}
//     	}
    	    	
	$response = array(
        '_embedded'     => $products,
	    'page_count'    => $page_count,
        'page_size'     => $page_size,
        'total_items'   => $total_items,
        'page'          => $page,
    );

//     	echo '<pre>'.print_r($response).'</pre>';
  	    echo Zend_Json::encode($response);
    }
    
    protected function getItem($prodnr)
    {
        $model = new Site_Model_SQLWooodStructureviewList();
        $list = $model->getList('prodnr', $prodnr);
        
        $products = array();
         
        foreach ($list as $item) {
    		$listArr = $item->toArray();
    		
    		$seqArr = explode('.', $listArr['SEQ_NO']);
     		
    		if (!isset($products[$listArr['MAINPROD']])) {
    		    $articleModel = new Site_Model_SQLWooodArtikelview();
    		    $articleModel->load($listArr['MAINPROD']);
    		    $products[$listArr['MAINPROD']] = array(
    		      'LVL'           => '0',
    		      'SEQ_NO'        => '000',
    		      'ARTIKELCODE'   => $listArr['MAINPROD'],
    		      'NL_DESCR'      => $listArr['ITEMPROD_DESC'],
		          'EN_DESCR'      => $articleModel->getEN(),
		          'DE_DESCR'      => $articleModel->getDE(),
		          'FR_DESCR'      => $articleModel->getFR(),
    		      'QTY'           => $listArr['QTY_PER_MAINPROD'],
    		    );
    		    $products[$listArr['MAINPROD']][$seqArr[0]] = array(
    		        'LVL'         => $listArr['LVL'],
    		        'SEQ_NO'      => $listArr['SEQ_NO'],
    		        'ARTIKELCODE' => $listArr['ITEMREQ'],
    		        'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
    		        'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
    		        'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
    		        'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
    		        'QTY'         => $listArr['QTY_PER_MAINPROD'],
    		    );
    		    
    		} else {
    		    
    		    switch (count($seqArr)) {
    		        case '1':
                        $products[$listArr['MAINPROD']][$seqArr[0]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '2':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '3':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '4':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]][$seqArr[3]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		    }
    		}
        }
        
        return $products;
    }
    
    public function viewAction()
    {
		$request = $this->getRequest();
    	$prodnr = $request->getParam('artikelcode', 0);
    	$response = array();
    	 
    	$model = new Site_Model_SQLWooodStructureviewList();
    	$list = $model->getList('prodnr', $prodnr);
    	 
    	$products = array();
    	foreach ($list as $item) {
    		$listArr = $item->toArray();
    		
    		$seqArr = explode('.', $listArr['SEQ_NO']);
    		
    		if (!isset($products[$listArr['MAINPROD']])) {
    		    $articleModel = new Site_Model_SQLWooodArtikelview();
    		    $articleModel->load($listArr['MAINPROD']);
    		    $products[$listArr['MAINPROD']] = array(
    		      'LVL'           => '0',
    		      'SEQ_NO'        => '000',
    		      'ARTIKELCODE'   => $listArr['MAINPROD'],
    		      'NL_DESCR'      => $listArr['ITEMPROD_DESC'],
		          'EN_DESCR'      => $articleModel->getEN(),
		          'DE_DESCR'      => $articleModel->getDE(),
		          'FR_DESCR'      => $articleModel->getFR(),
    		      'QTY'           => $listArr['QTY_PER_MAINPROD'],
    		    );
                $products[$listArr['MAINPROD']][$seqArr[0]] = array(
                    'LVL'         => $listArr['LVL'],
                    'SEQ_NO'      => $listArr['SEQ_NO'],
                    'ARTIKELCODE' => $listArr['ITEMREQ'],
                    'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                    'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                    'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                    'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                    'QTY'         => $listArr['QTY_PER_MAINPROD'],
                );
    		} else {
    		    
    		    switch (count($seqArr)) {
    		        case '1':
                        $products[$listArr['MAINPROD']][$seqArr[0]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '2':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '3':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		        case '4':
                        $products[$listArr['MAINPROD']][$seqArr[0]][$seqArr[1]][$seqArr[2]][$seqArr[3]] = array(
                            'LVL'         => $listArr['LVL'],
                            'SEQ_NO'      => $listArr['SEQ_NO'],
                            'ARTIKELCODE' => $listArr['ITEMREQ'],
                            'NL_DESCR'    => $listArr['NL_ITEMREQ_DESC'],
                            'EN_DESCR'    => $listArr['EN_ITEMREQ_DESC'],
                            'DE_DESCR'    => $listArr['DE_ITEMREQ_DESC'],
                            'FR_DESCR'    => $listArr['FR_ITEMREQ_DESC'],
                            'QTY'         => $listArr['QTY_PER_MAINPROD'],
                        );
            		    break;
    		    }
    		}
    	}
    	
    	$response = $products;

//     	echo '<pre>'.print_r($response).'</pre>';
  	    echo Zend_Json::encode($response);
    }
    
    private function handleJson()
    {
    	$server = new Zend_Json_Server();
    	$server->setClass('Site_Model_JsonRpcSQLWooodWebAvailability');
    
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
    	$autodiscover->setClass('Site_Model_JsonRpcSQLWooodWebAvailability');
    	$autodiscover->handle();
    }
    
    private function handleSOAP()
    {
    	$server = new Zend_Soap_Server($this->_WSDL_URI);
    	$server->setClass('Site_Model_SOAPRpcSQLWooodWebAvailability');
    	
    	$server->handle();
    }
}

