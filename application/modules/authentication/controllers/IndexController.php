<?php

class Authentication_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function loginAction()
    {
    	$auth = Site_Model_Authentication::getInstance();
    	
    	$result = $auth->login('APITest', 'SA32apitest');
    	
    	echo $result;
    }


}

