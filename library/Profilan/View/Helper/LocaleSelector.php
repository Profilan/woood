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
 * View helper om een een lijst met lokatielinks te krijgen.
 * @author matthijs
 *
 */
class LeerJezelf_View_Helper_LocaleSelector
    extends Zend_View_Helper_Abstract
{
	/**
	 * return een string met hrefs van de beschikbare
	 * lokaties voor de applicatie
	 * @return string
	 */
    public function localeSelector()
    {
        // Eerst vragen we de huidige lokatie als string op
        $currentLocaleString = Zend_Registry::get('Zend_Locale')->toString();

        // Vervolgens vragen we de configuratie van de applicatie op als array
        $config = Zend_Controller_Front::getInstance()
            ->getParam('bootstrap')
            ->getOptions();

        // Vervolgens nemen we de beschikbare lokaties array
        $availableLocales = $config['resources']['locale']['available'];

        // We bouwen een array met links op met behulp van de View Helper 'url'
        $localeHrefs = array();
        foreach ($availableLocales as $localeString) {
            /*
             * We vragen de volledige naam van de
             * lokatie op in de taal van de lokatie.
             */
            $languageString = Zend_Locale::getTranslation(
                $localeString, 'language', $localeString
            );

            /*
             * Als de taal niet bestaat voor de volledige lokatie,
             * vragen we hem op voor het taaldeel van de lokatie.
             */
            if (!$languageString) {
                $language = current(explode('_', $localeString));
                $languageString = Zend_Locale::getTranslation(
                    $language, 'language', $localeString
                );
            }

            /*
             * Als de lokatie overeenkomt met de huidige
             * lokatie, maken we geen link, maar tonen de taal wel.
             * Als de lokatie niet overeenkomt met de huidige,
             * maken we een link naar de huidige URL met als toevoeging
             * 'locale=localenaam' bv. 'locale=en_US'
             */
            if ($currentLocaleString === $localeString) {
                $localeHrefs[$localeString] = $languageString;

            } else {
                $localeHrefs[$localeString] =
                    '<a href="'
                    . $this->view->url(array('locale' => $localeString))
                    . '">' . $languageString . '</a>';
            }
        }

        // Tot slot returnen we de array met links als string,
        // gescheiden door '|'
        return implode('&nbsp;|&nbsp;', $localeHrefs);
    }
}
