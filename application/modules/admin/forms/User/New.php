<?php
/**
 * Admin_Form_User_New representeert een formulier voor het aanmaken van een gebruikersprofiel
 *
 * @author Raymond Soffner
 */
class Admin_Form_User_New extends Zend_Form 
{

    public function init() {
    // gebruik een eigen view-script voor de rendering van het form
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'forms/form_user_new.phtml'))
        ));
        $this->setMethod(Zend_Form::METHOD_POST);

        // maken van form elementen
        $email					= $this->createElement('text', 'email');
        $username				= $this->createElement('text', 'username');
        $api_key				= $this->createElement('text', 'api_key');
        $ip_from				= $this->createElement('text', 'ip_from');
        $ip_to					= $this->createElement('text', 'ip_to');
        $password1				= $this->createElement('password', 'password1');
        $password2				= $this->createElement('password', 'password2');
        $submit      			= $this->createElement('submit', 'submit');
        
        // labels toekennen aan de elementen
        $email->setLabel('E-mailadres')->addValidator(new Zend_Validate_EmailAddress())->setRequired(true);
        $username->setLabel('Gebruikersnaam')->setRequired(true)->setAttrib('placeholder', 'Gebruikersnaam');
        $password1->setLabel('Wachtwoord')->setRequired(true)->setAttrib('placeholder', 'Wachtwoord');
        $password2->setLabel('Bevestig wachtwoord')->setRequired(true)->setAttrib('placeholder', 'Bevestig wachtwoord');
        $api_key->setLabel('API key')->setRequired(true)->setAttrib('class', 'input-xxlarge');
        $ip_from->setLabel('IP adres van')->setRequired(true);
        $ip_to->setLabel('IP adres tot')->setRequired(true)->setAttrib('placeholder', 'IP adres tot');
        $submit->setLabel('Bewaren')->setAttrib('class', 'btn btn-primary');
        
        // de elementen toevoegen aan het formulier
        $this->addElements(array($email, $username, $password1, $password2, $api_key, $ip_from, $ip_to, $submit));
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