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
 * View helper om een datum te formatteren in een standaard formaat
 * @author wouter
 *
 */
class LeerJezelf_View_Helper_Date extends Zend_View_Helper_Abstract
{
	/**
	 * return de geformateerde datum van het gegeven Zend_Date object
	 * @param Zend_Date $date de te formatteren datum
	 * @return string
	 */
	public function date(Zend_Date $date) 
	{
	   	return $date->get('d MMM y HH:mm:ss');
	}
}
