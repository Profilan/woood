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
 * Profilan_Auth_Storage_File wordt gebruikt door Zend_Auth om de identity van
 * de ingelogde gebruiker op te slaan in een bestand ipv de sessie.
 *
 * @author Wouter Tengeler
 */
class Profilan_Auth_Storage_File implements Zend_Auth_Storage_Interface
{
	/**
	 * De identity van een gebruiker
	 * @var mixed 
	 */
	protected $_contents;
	/**
	 * De naam en pad van het bestand 
	 * @var string $_file
	 */
	protected $_file;
	public function __construct($path)
	{
		// we gebruiker het session id om een unieke bestandnaam te genereren
		$this->_file = $path.Zend_Session::getId().'.id';
		$this->_contents = $this->read();
	}

	/**
	 * bestaat de identity
	 * @return mixed
	 */
	public function isEmpty()
	{
		return empty($this->_contents);
	}

	/**
	 * lees de gegevens uit het bestand
	 * @return mixed De identity
	 * @throws Zend_Auth_Storage_Exception
	 */
	public function read()
	{
		$this->_contents = null;
		if (file_exists($this->_file)) {
			if (false !== ($fp = fopen($this->_file, 'r'))) {
				$contents = unserialize(base64_decode(fread($fp, 1024)));
				$this->_contents = $contents;
			} else {
				throw new Zend_Auth_Storage_Exception('Cannot open file');
			}
		}
		return $this->_contents;
	}

	/**
	 * sla de gegevens op in het bestand
	 * @param mixed $contents
	 */
	public function write($contents)
	{
		if (false !== ($fp = fopen($this->_file, 'w'))) {
			$secure = base64_encode(serialize($contents));
			fwrite($fp, $secure);
			$this->_contents = $contents;
		} else {
			throw new Zend_Auth_Storage_Exception('Cannot open file');
		}
	}

	/**
	 * maakt de gegevens leeg en verwijder het bestand
	 */
	public function clear()
	{
		if (file_exists($this->_file)) {
			unlink($this->_file);
		}
		$this->_contents = null;
	}
}