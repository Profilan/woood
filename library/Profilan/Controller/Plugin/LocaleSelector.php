<?php
/**
 * weblog-12.0
 * 
 * Deze broncode is onderdeel van het weblog-voorbeeld uit het boek 
 * "Leer jezelf Professioneel werken met het Zend Framework".
 * U mag deze broncode gebruiken voor uw eigen projecten onder de voorwaarde
 * dat dit commentaarblock gehandhaafd blijft. U bent vrij de broncode aan
 * te passen en uit te breiden voor uw eigen doeleinden
 * De auteurs bieden geen garantie voor de correcte werking van de broncode.
 * 
 * @copyright Copyright (c) 2010 Leer Jezelf Professioneel Zend Framework
 * @license http://framework.zend.com/license/new-bsd New BSD License
 * @author Wouter Tengeler <wouter@leerjezelf-zendframework.nl>
 * @author Matthijs van den Bos <matthijs@leerjezelf-zendframework.nl>
 * @link http://www.leerjezelf-zendframework.nl
 * @category LeerJezelf
 * @version weblog-12.0
 */


/**
 * @package LeerJezelf_Controller_Plugin
 * @author Matthijs van den Bos
 *
 */
class LeerJezelf_Controller_Plugin_LocaleSelector
    extends Zend_Controller_Plugin_Abstract {

    /**
     * De methode dispatchLoopStartup van frontcontroller plugins
     * wordt als eerste uitgevoerd. We kiezen hiervoor omdat we
     * de locale zo vroeg mogelijk en maar een keer
     * willen instellen per applicatie run
     *
     * @access public
     * @return void
     */
    public function dispatchLoopStartup(
        Zend_Controller_Request_Abstract $request
    )
    {
        // We halen de instanties van Zend_Locale en Zend_Translate op
        // uit het applicatieregister
        $locale = Zend_Registry::get('Zend_Locale');
        $translator = Zend_Registry::get('Zend_Translate');

        // We gaan de lokatieinformatie in de sessie opslaan
        // onder de namespace 'Weblog_Locale'
        $session = new Zend_Session_Namespace('Weblog_Locale');

        /*
         * Als we een lokatie in het request hebben, stellen we die in.
         * Als we die niet hebben, nemen we die uit de sessie
         * Als die er niet is, stellen we de standaardlokatie in
         */
        if ($request->getParam('locale')) {
            $localeString = $request->getParam('locale');
        } elseif (isset($session->localeString)) {
            $localeString = $session->localeString;
        } else {
            $localeString = $locale->toString();
        }

        // Vervolgens stellen we de lokatie in voor
        // zowel Zend_Locale als Zend_Translate
        $locale->setLocale($localeString);
        $translator->setLocale($localeString);

        // Tot slot wijzen we de lokatie toe aan de sessie,
        // zodat de gekozen taal de volgende keer automatisch ingesteld wordt
        $session->localeString = $locale->toString();
    }
}