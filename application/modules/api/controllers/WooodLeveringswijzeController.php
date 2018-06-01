<?php
class Api_WooodLeveringswijzeController extends Zend_Controller_Action
{
    private $_WSDL_URI="https://is.woood.eu/api/woood-leveringswijze?wsdl";

    public function init()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction()
    {
        $request = $this->getRequest();

        $this->_helper->viewRenderer->setNoRender();
    }

    public function listAction()
    {
        $request = $this->getRequest();
        $code = $request->getParam('code', 0);
        $response = array();

        $leveringswijzeModel = new Site_Model_SQLWooodLeveringswijzeList();
        if ($code) {
            $list = $leveringswijzeModel->getList('code', $code);
        } else {
            $list = $leveringswijzeModel->getList();
        }

        foreach ($list as $item) {
            $leveringswijzeArr = $item->toArray();

            $response[] = $leveringswijzeArr;
        }

        echo Zend_Json::encode($response);
    }

    public function viewAction()
    {
        $request = $this->getRequest();
        $code = $request->getParam('code', 0);
        $response = array();

        $leveringswijzeModel = new Site_Model_SQLWooodLeveringswijzeList();
        if ($code) {
            $list = $leveringswijzeModel->getList('code', $code);
        }
        foreach ($list as $item) {
            $leveringswijzeArr = $item->toArray();

            $response[] = $leveringswijzeArr;
        }

        echo Zend_Json::encode($response[0]);
    }
}
