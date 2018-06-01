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
 * 
 */


class Site_Model_User
{

	/**
	 * vaste string die voor ieder wachtwoord wordt geplakt om het een lastiger te raden wachtwoord te maken
	 */
 	const SALT = '%$#HD&^5637*';

	/**
	 * Het id van de gebruiker
	 * @var int $_id
	 */
	private $_id;
	/**
	 * De gebruikersnaam (inlognaam)
	 * @var string $_userName
	 */
	private $_userName;
	/**
	 * Het emailaddress van de gebruiker
	 * @var string $_email
	 */
	private $_email;
	/**
	 * De rol die de gebruiker heeft
	 * @var string
	 */
	private $_role;
	/**
	 * Het versleutelde wachtwoord van de gebruiker
	 * @var string $_password
	 */
	private $_password;
	/**
	 * De API key van de gebruiker
	 * @var string $_api_key
	 */
	private $_api_key;
	/**
	 * IP adres van van de gebruiker
	 * @var string $_ip_from
	 */
	private $_ip_from;
	/**
	 * IP adres tot van de gebruiker
	 * @var string $_ip_to
	 */
	private $_ip_to;
	/**
	 * De datamapper voor de user
	 * @var Site_Model_Db_UserMapper
	 */
	private $_mapper;


	/**
	 * constructor initialiseert alle member. Wachtwoord wordt leeg gezet.
	 */
	public function __construct() {
		$this->_id = -1;
		$this->_userName = '';
		$this->_email = '';
		$this->_api_key = '';
		$this->_ip_from = '0.0.0.0';
		$this->_ip_to = '255.255.255.255';
		$this->setPassword('', true);
		$this->_role = Site_Model_Authentication::DEFAULT_ROLE;
	 
	}
	 
    /**
     * setter voor $_id
     * @param int $id
     * @return void
     * @throws InvalidArgumentException
     */
    public function setId($id) {
        if (is_int($id) || (is_string($id) && ctype_digit($id))) {
            if (is_int($id)) {
                $this->_id = $id;
            } else {
                $this->_id = intVal($id);
            }
        } else {
            throw new InvalidArgumentException('id should be numeric');
        }
		return $this;
    }
    /**
     * getter voor _id
     * @return int
     */
    public function getId() {
        return $this->_id;
    }
	 
    /**
     * setter voor _userName
     * @param string $name
     * @return void
     * @throws InvalidArgumentException
     */
    public function setUserName($name) {
        if (is_string($name)) {
            $this->_userName = $name;
        } else {
            throw new InvalidArgumentException('username should be of type string');
        }
		return $this;
    }
    /**
     * getter voor _userName
     * @return string
     */
    public function getUserName() {
        return $this->_userName;
    }

	/**
	 * setter voor $_email
	 * @param string $email Een geldig email adres
	 * @return Site_Model_User
	 * @throws InvalidArgumentException
	 */
	public function setEmail($email) {
        if (is_string($email)) {
			// valideer of de string een geldig email adres is
			$validate = new Zend_Validate_EmailAddress();
			if ($validate->isValid($email)) {
				$this->_email = $email;
			} else {
	            throw new InvalidArgumentException('email should be valid email address');
			}
        } else {
            throw new InvalidArgumentException('email should be of type string');
        }
		return $this;
	}

	/**
	 * getter voor $_email
	 * @return string Het email adres 
	 */
	public function getEmail() {
		return $this->_email;
	}

	/**
	 * Het wachtwoord kan gegeven worden in gewone tekst vorm, in dat geval moet het nog
	 * worden versleuteld, of het kan al versleuteld worden meegegeven waarna het niet meer versleuteld
	 * hoeft te worden. Om een versleuteld wachtwoord moeilijker te maken wordt er voor ieder
	 * wachtwoord een vaste string geplaatst. Hierdoor krijgen eenvoudige wachtwoorden toch een niet te
	 * raden versleutelde string
	 * @param string $password
	 * @param boolean $encrypt true betekent dat het gegeven wachtwoord versleuteld moet worden
	 * @throws InvalidArgumentException
	 */
	public function setPassword($password, $encrypt) {
		if (is_string($password)) {
			if ($encrypt) {
				// plain password
				$this->_password = sha1(self::SALT . $password);
			} else {
				$this->_password = $password;
			}
		} else {
			throw new InvalidArgumentException('password must be string');
		}
	}

	/**
	 * Geeft altijd een SHA1 versleuteld wachtwoord terug
	 * @return string 
	 */
	public function getPassword() {
		return $this->_password;
	}

	/**
	 * De API key kan gegeven worden in gewone tekst vorm, in dat geval moet het nog
	 * worden versleuteld, of het kan al versleuteld worden meegegeven waarna het niet meer versleuteld
	 * hoeft te worden. Om een versleuteld wachtwoord moeilijker te maken wordt er voor ieder
	 * wachtwoord een vaste string geplaatst. Hierdoor krijgen eenvoudige wachtwoorden toch een niet te
	 * raden versleutelde string
	 * @param string $password
	 * @param boolean $encrypt true betekent dat het gegeven wachtwoord versleuteld moet worden
	 * @throws InvalidArgumentException
	 */
	public function setApiKey($apiKey, $encrypt) {
		if (is_string($apiKey)) {
			if ($encrypt) {
				// plain password
				$this->_api_key = sha1(self::SALT . $apiKey);
			} else {
				$this->_api_key = $apiKey;
			}
		} else {
			throw new InvalidArgumentException('API key must be string');
		}
	}
	
	/**
	 * Geeft altijd een SHA1 versleuteld wachtwoord terug
	 * @return string
	 */
	public function getApiKey() {
		return $this->_api_key;
	}

	/**
	 * Zet de IP vanaf van de gebruiker
	 * @param string $ip_from
	 * @throws InvalidArgumentException
	 */
	public function setIpFrom($ip) {
		if (is_string($ip)) {
			$this->_ip_from = $ip;
		} else {
			throw new InvalidArgumentException('ip from should be an IP address');
		}
	}
	
	/**
	 * geeft de IP vanaf van de gebruiker terug
	 * @return string
	 */
	public function getIpFrom() {
		return $this->_ip_from;
	}

	/**
	 * Zet de IP tot van de gebruiker
	 * @param string $ip_from
	 * @throws InvalidArgumentException
	 */
	public function setIpTo($ip) {
		if (is_string($ip)) {
			$this->_ip_to = $ip;
		} else {
			throw new InvalidArgumentException('ip from should be an IP address');
		}
	}
	
	/**
	 * geeft de IP tot van de gebruiker terug
	 * @return string
	 */
	public function getIpTo() {
		return $this->_ip_to;
	}
	
	/**
	 * Zet de huidige rol van de gebruiker
	 * @param string $role
	 * @throws InvalidArgumentException
	 */
	public function setRole($role) {
		if (is_string($role)) {
			$this->_role = $role;
		} else {
			throw new InvalidArgumentException('role should be string');
		}
	}

	/**
	 * geeft de huidige rol van de gebruiker terug
	 * @return string
	 */
	public function getRole() {
		return $this->_role;
	}

	/**
	 * methode om in één keer verschillende setters aan te roepen
	 * Array moet geassocieerde array met één van de volgende opties
	 * id, username, firstname, lastname, nameext, email, role, password, encrypt
	 * Password kan gezet worden met of zonder encryptie. Een extra boolean associatie 'encrypt' kan worden gegeven
	 * encrypt => true passsword is gegeven in plain text en wordt gecrypt, encrypt => false password is al versleuteld
	 * mapper kan niet via populate worden gezet vanwege het speciale karakter
	 * @param array $data
	 * @throws InvalidArgumentException
	 */
	public function populate($data) {
		if (is_array($data)) {
			if (isset($data['id'])) {
				$this->setId($data['id']);
			}
			if (isset($data['username'])) {
				$this->setUserName($data['username']);
			}
			if (isset($data['email'])) {
				$this->setEmail($data['email']);
			}
			if (isset($data['role'])) {
				$this->setRole($data['role']);
			}
			if (isset($data['password'])) {
				$encrypt = false;
				if (isset($data['encrypt']) && is_bool($data['encrypt'])) {
					$encrypt = $data['encrypt'];
				}
				$this->setPassword($data['password'], $encrypt);
			}
		} else {
			throw new InvalidArgumentException('data must be associated array');
		}
	}

	/**
	 *
	 * @param Site_Model_Db_DataMapperAbstract $mapper
	 */
	public function setMapper($mapper) {
		$this->_mapper = $mapper;
		return $this;
	}

	/**
	 * geef het ingestelde DataMapper object terug. Als deze nog niet bestaat wordt het aangemaakt
	 * @return Site_Model_Db_UserMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_UserMapper('Site_Model_Db_UserDao'));
		}
		return $this->_mapper;
	}

	/**
	 * load de user met het gegeven id
	 * @param int $id
	 * @return Site_Model_User|null
	 * @throws InvalidArgumentException
	 */
	public function load($id) {
        if (is_int($id) || (is_string($id) && ctype_digit($id))) {
			return $this->getMapper()->find($id, $this);
        } else {
            throw new InvalidArgumentException('id must be numeric');
        }
	}

	/**
	 * laad de user met een bepaalde username
	 * @param string $username
	 * @return Site_Model_User|null Geeft null als de user niet geladen kon worden
	 */
	public function loadByUserName($username) {
		return $this->getMapper()->findByUserName($username, $this);
	}

	/**
	 * sla de hudige user op
	 */
	public function save() {
		return $this->getMapper()->save($this);
	}

	/**
	 * Verwijder de user met het gegeven id
	 * @param int $id
	 * @return int Het aantal gewijzigde records
	 */
	public static function delete($id) {
		$mapper = new Site_Model_Db_UserMapper('Site_Model_Db_UserDao');
		return $mapper->delete($id);
	}
}