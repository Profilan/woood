<?php
class Api_WooodBetalingsconditieController extends Zend_Controller_Action
{
    private $_WSDL_URI="https://is.woood.eu/api/woood-betalingsconditie?wsdl";

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

        $betalingsconditieModel = new Site_Model_SQLWooodBetalingsconditieList();
        if ($code) {
            $list = $betalingsconditieModel->getList('code', $code);
        } else {
            $list = $betalingsconditieModel->getList();
        }

        foreach ($list as $item) {
            $betalingsconditieArr = $item->toArray();

            $response[] = $betalingsconditieArr;
        }

        echo Zend_Json::encode($response);
    }

    public function viewAction()
    {
        $request = $this->getRequest();
        $code = $request->getParam('code', 0);
        $response = array();

        $betalingsconditieModel = new Site_Model_SQLWooodBetalingsconditieList();
        if ($code) {
            $list = $betalingsconditieModel->getList('code', $code);
        }
        foreach ($list as $item) {
            $betalingsconditieArr = $item->toArray();

            $response[] = $betalingsconditieArr;
        }

        echo Zend_Json::encode($response[0]);
    }
}
