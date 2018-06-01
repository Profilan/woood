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
 * NotBlackListAssertion klasse voor het dyanmisch bepalen van gebruikersrechten
 *
 * @author Wouter Tengeler
 */
class Site_Model_Acl_Assert_NotBlackListAssertion implements Zend_Acl_Assert_Interface
{
	public function assert(Zend_Acl $acl,
                           Zend_Acl_Role_Interface $role = null,
                           Zend_Acl_Resource_Interface $resource = null,
                           $privilege = null)
    {
		$result = $this->_isNotBlackListed($_SERVER['REMOTE_ADDR']);
		//Zend_Registry::get('logger')->debug(__METHOD__.' IP: '.$_SERVER['REMOTE_ADDR']. ' allowed : '. (($result) ? 'yes': 'no'));
		return $result;
    }

	/**
	 * Geeft false terug als het gegeven ip-adres voorkomt in de blacklist
	 * @param string $ip
	 * @return boolean
	 */
	protected function _isNotBlackListed($ip) {
		$blacklist = array('10.0.0.5', '98.120.23.162');
		if (in_array($ip, $blacklist)) {
			return false;
		} else {
			return true;
		}
	}

}