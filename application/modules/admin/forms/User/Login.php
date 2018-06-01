<?php
/**
 * Site_Form_Authentication_Registerrepresenteert een formulier voor het aanmaken van een gebruikersprofiel
 *
 * @author Raymond Soffner
 */
class Authentication_Form_Login extends Zend_Form 
{

    public function init() {
    // gebruik een eigen view-script voor de rendering van het form
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'forms/form_authentication_login.phtml'))
        ));
        $this->setMethod(Zend_Form::METHOD_POST);

        // maken van form elementen
        $email					= $this->createElement('text', 'email');
        $password				= $this->createElement('password', 'password');
        $redirect   			= $this->createElement('hidden', 'redirect');
        $submit      			= $this->createElement('submit', 'submit');

        // labels toekennen aan de elementen
        $email->setLabel('E-mailadres');
        $password->setLabel('Wachtwoord');
        $submit->setLabel('Inloggen');
        
        // de elementen toevoegen aan het formulier
        $this->addElements(array($email, $password, $redirect, $submit));
        // De decorators voor alle toegevoegde elementen instellen
        $this->setElementDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label'),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        ));

        // de decorators voor het submit element aanpassen,
        // zodat het label niet getoond wordt maar de td wel
        $submit->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array(array('labelAlias' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        ));
    }

}