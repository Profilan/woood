<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('admin');

        // voeg de stylesheet toe aan de view resource
		$this->view->headLink()->appendStylesheet('/css/admin.css');
    		
		if ($_SERVER["SERVER_NAME"] == 'is.woood.eu') {
		    if (strtolower($_SERVER["REMOTE_USER"]) != 'administrator') {
		        throwException(new Exception('You have no access to the admin', '401'));
		    }
		}
    }

    public function indexAction()
    {
        // action body
    }
}







