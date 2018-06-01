<?php

class Admin_UserController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('1column');

        // voeg de stylesheet toe aan de view resource
		$this->view->headLink()->appendStylesheet('/css/admin.css');
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
    	$auth = Site_Model_Authentication::getInstance();
		$user = $auth->getUser();
        
        // ophalen van lijst met User-objecten uit het model
        $userList = new Site_Model_UserList();
        $users = $userList->getList('all');
        
        $this->view->userList = $users; 
    }

    public function editAction()
    {
    	$request = $this->getRequest();
    	
    	$userId = $request->getParam('id');

		$userForm = new Admin_Form_User_Edit();
		
		if ($userId) {
			$user = new Site_Model_User();
			$user->load($userId);
			$userForm->id->setValue($user->getId());
			$userForm->email->setValue($user->getEmail());
			$userForm->username->setValue($user->getUserName());
			$userForm->api_key->setValue($user->getApiKey());
			$userForm->ip_from->setValue($user->getIpFrom());
			$userForm->ip_to->setValue($user->getIpTo());
		}
		
		$this->view->userForm = $userForm;

		// we zetten de action van het form op de huidige URL
		$userForm->setAction($this->view->url());
		if ($request->isPost()) {
            // Formulier valideren
            if ($userForm->isValid($request->getPost())) {
                $user = new Site_Model_User();
                $user->load($userForm->id->getValue());
				$user->setEmail($userForm->email->getValue());
				$user->setUserName($userForm->username->getValue());
				$user->setApiKey($userForm->api_key->getValue());
				$user->setIpFrom($userForm->ip_from->getValue());
				$user->setIpTo($userForm->ip_to->getValue());
				$user->save();
                $this->_helper->getHelper('Redirector')->gotoSimple('list', 'user', 'admin');
            }
		}
    }

    public function newAction()
    {
    	$request = $this->getRequest();
    	
    	$userId = $request->getParam('id');
    	
    	$userForm = new Admin_Form_User_New();
		
		$this->view->userForm = $userForm;

		// we zetten de action van het form op de huidige URL
		$userForm->setAction($this->view->url());
		if ($request->isPost()) {
			// Formulier valideren
			if ($userForm->isValid($request->getPost())) {
				$user = new Site_Model_User();
				$user->setPassword($userForm->password1->getValue(), true);
				$user->setEmail($userForm->email->getValue());
				$user->setUserName($userForm->username->getValue());
				$user->setApiKey($userForm->api_key->getValue());
				$user->setIpFrom($userForm->ip_from->getValue());
				$user->setIpTo($userForm->ip_to->getValue());
				$user->save();
				$this->_helper->getHelper('Redirector')->gotoSimple('list', 'user', 'admin');
			}
		}
		
    }


}







