<?php

class Default_AuthenticationController extends Zend_Controller_Action
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
        // action body
    }

    public function registerAction()
    {
        $this->view->headScript()->appendFile(
        	'/js/site/jquery.passroids.js'
        );
    	$request = $this->getRequest();

        $registerForm = new Site_Form_Authentication_Register();
        $this->view->form = $registerForm;

        // we zetten de action van het form op de huidige URL
        $registerForm->setAction($this->view->url());

        if ($request->isPost()) {
            // Formulier valideren
            if ($registerForm->isValid($request->getPost())) {
                $user = new Site_Model_User();
                $user->setEmail($registerForm->email->getValue());
                $user->setPassword($registerForm->password1->getValue(), true);
                $user->setGender($registerForm->gender->getValue());
                $user->setFirstName($registerForm->first_name->getValue());
                $user->setLastNamePrefix($registerForm->last_name_prefix->getValue());
                $user->setLastName($registerForm->last_name->getValue());
                $user->setPostcode($registerForm->postcode->getValue());
                $user->setStreetNumber($registerForm->street_number->getValue());
                $user->setStreet($registerForm->street->getValue());
                $user->setCity($registerForm->city->getValue());
                $user->setPhone($registerForm->phone->getValue());
                $user->setNewsletter($registerForm->newsletter->getValue());
                $user->setAccount($registerForm->account->getValue());
                $user->save();
                $this->_helper->getHelper('Redirector')->gotoSimple('index', 'index', 'default');
            }
        }
    }

}



