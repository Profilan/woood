<?php

class Site_Model_SQLWooodArtikelviewPakket
{

	/**
	 * @var string ARTIKELCODE
	 */
	private $_artikelcode;
	/**
	 * @var string ARTCODE_PAKKET
	 */
	private $_artcodePakket;
	/**
	 * @var string NL
	 */
	private $_nl;
	/**
	 * @var string EN
	 */
	private $_en;
	/**
	 * @var string DE
	 */
	private $_de;
	/**
	 * @var string FR
	 */
	private $_fr;
	/**
	 * @var float GEWICHT
	 */
	private $_gewicht;
	/**
	 * @var bool NEW ARRIVAL
	 */
	private $_newArrival;
	/**
	 * @var float VERPAK_DIKTE_mm
	 */
	private $_verpakBreedteMm;
	/**
	 * @var float VERPAK_LENGTE_mm
	 */
	private $_verpakLengteMm;
	/**
	 * @var float VERPAK_BREEDTE_mm
	 */
	private $_verpakDikteMm;
	/**
	 * @var float VOL_M3/VERP
	 */
	private $_volM3Verp;
	/**
	 * @var float VrijeVoorraadPakket
	 */
	private $_vrijeVoorraadPakket;
	/**
	 * @var float ASS_CODE_EXCLUSIV
	 */
	private $_assCodeExclusiv;
	/**
	 * @var string EANCode
	 */
	private $_eancode;
	/**
	 * @var float AANTAL_PAKKETTEN
	 */
	private $_aantal_pakketten;
	
	/**
	 * De datamapper voor dit object
	 * @var Site_Model_Db_DataMapperAbstract
	 */
	private $_mapper;

	/**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		$this->_artikelcode = '';
		$this->_artcodePakket = '';
		$this->_nl = '';
		$this->_en = '';
		$this->_de = '';
		$this->_gewicht = 0;
		$this->_verpakBreedteMm = 0;
		$this->_verpakLengteMm = 0;
		$this->_verpakDikteMm = 0;
		$this->_vrijeVoorraadPakket = 0;
		$this->_assCodeExclusiv = '';
		$this->_eancode = '';
		$this->_aantal_pakketten = 0;
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db = Zend_Registry::get('db3');
		$select = $db->select();
		$select->from('EEK_ARTIKELDATA_PAKKET');
		$select->where('ARTIKELCODE = ?', $id);
		
		$row = $db->fetchRow($select);
		$this->setArtikelcode($row['ARTIKELCODE']);
		$this->setArtcodePakket($row['ARTCODE_PAKKET']);
		$this->setNL($row['NL']);
		$this->setEN($row['EN']);
		$this->setDE($row['DE']);
		$this->setGewicht($row['GEWICHT']);
		$this->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
		$this->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
		$this->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
		$this->setVolM3Verp($row['VOL_M3/VERP']);
		$this->setVrijeVoorraadPakket($row['VrijeVoorraadPakket']);
		$this->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
	}

	/**
	 * setter voor _artikelcode
	 * @param string $artikelcode
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setArtikelcode($artikelcode) {
		if (is_string($artikelcode) || $artikelcode == null) {
			$this->_artikelcode = $artikelcode;
		} else {
			throw new InvalidArgumentException('artikelcode should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _artikelcode
	 * @return string
	 */
	public function getArtikelcode() {
		return $this->_artikelcode;
	}

	/**
	 * setter voor _artcodePakket
	 * @param string $artcodePakket
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setArtcodePakket($artikelcode) {
		if (is_string($artikelcode) || $artikelcode == null) {
			$this->_artcodePakket = $artikelcode;
		} else {
			throw new InvalidArgumentException('artikelcode should be of type string');
		}
		return $this;
	}
	/**
	 * getter voor _artcodePakket
	 * @return string
	 */
	public function getArtcodePakket() {
		return $this->_artcodePakket;
	}
	
	/**
	 * setter voor _nl
	 * @param string $nl
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setNL($nl) {
		if (is_string($nl) || $nl == null ) {
			$this->_nl = utf8_encode($nl);
		} else {
			throw new InvalidArgumentException('nl should be of type string');
		}
		return $this;
	}

	/**
	 * getter voor _nl
	 * @return string
	 */
	public function getNL() {
		return $this->_nl;
	}

	/**
	 * setter voor _en
	 * @param string $en
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setEN($en) {
		if (is_string($en) || $en == null) {
			$this->_en = utf8_encode($en);
		} else {
			throw new InvalidArgumentException('en should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _en
	 * @return string
	 */
	public function getEN() {
		return $this->_en;
	}

	/**
	 * setter voor _de
	 * @param string $de
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setDE($de) {
		if (is_string($de) || $de == null) {
			$this->_de = utf8_encode($de);
		} else {
			throw new InvalidArgumentException('de should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _de
	 * @return string
	 */
	public function getDE() {
		return $this->_de;
	}

	/**
	 * setter voor _fr
	 * @param string $fr
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFR($fr) {
		if (is_string($fr) || $fr == null) {
			$this->_fr = utf8_encode($fr);
		} else {
			throw new InvalidArgumentException('de should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _fr
	 * @return string
	 */
	public function getFR() {
		return $this->_fr;
	}
	
	/**
	 * setter voor _gewicht
	 * @param float $gewicht
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setGewicht($gewicht) {
		if (is_numeric($gewicht) || $gewicht == null) {
			if (is_numeric($gewicht)) {
				$this->_gewicht = $gewicht;
			} else {
				$this->_gewicht = floatval($gewicht);
			}
		} else {
			throw new InvalidArgumentException('gewicht should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _gewicht
	 * @return float
	 */
	public function getGewicht() {
		return $this->_gewicht;
	}
	
	/**
	 * setter voor _verpakBreedteMm
	 * @param float $verpakBreedteMm
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVerpakBreedteMm($verpakBreedteMm) {
		if (is_numeric($verpakBreedteMm) || $verpakBreedteMm == null) {
			if (is_numeric($verpakBreedteMm)) {
				$this->_verpakBreedteMm = $verpakBreedteMm;
			} else {
				$this->_verpakBreedteMm = floatval($verpakBreedteMm);
			}
		} else {
			throw new InvalidArgumentException('verpakBreedteMm should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _verpakBreedteMm
	 * @return float
	 */
	public function getVerpakBreedteMm() {
		return $this->_verpakBreedteMm;
	}
	
	/**
	 * setter voor _verpakLengteMm
	 * @param float $verpakLengteMm
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVerpakLengteMm($verpakLengteMm) {
		if (is_numeric($verpakLengteMm) || $verpakLengteMm == null) {
			if (is_numeric($verpakLengteMm)) {
				$this->_verpakLengteMm = $verpakLengteMm;
			} else {
				$this->_verpakLengteMm = floatval($verpakLengteMm);
			}
		} else {
			throw new InvalidArgumentException('verpakLengteMm should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _verpakLengteMm
	 * @return float
	 */
	public function getVerpakLengteMm() {
		return $this->_verpakLengteMm;
	}
	
	/**
	 * setter voor _verpakDikteMm
	 * @param float $verpakDikteMm
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVerpakDikteMm($verpakDikteMm) {
		if (is_numeric($verpakDikteMm) || $verpakDikteMm == null) {
			if (is_numeric($verpakDikteMm)) {
				$this->_verpakDikteMm = $verpakDikteMm;
			} else {
				$this->_verpakDikteMm = floatval($verpakDikteMm);
			}
		} else {
			throw new InvalidArgumentException('verpakDikteMm should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _verpakDikteMm
	 * @return float
	 */
	public function getVerpakDikteMm() {
		return $this->_verpakDikteMm;
	}
	
	/**
	 * setter voor _volM3Verp
	 * @param float $volM3Verp
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVolM3Verp($volM3Verp) {
		if (is_numeric($volM3Verp) || $volM3Verp == null) {
			if (is_numeric($volM3Verp)) {
				$this->_volM3Verp = $volM3Verp;
			} else {
				$this->_volM3Verp = floatval($volM3Verp);
			}
		} else {
			throw new InvalidArgumentException('volM3Verp should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _volM3Verp
	 * @return float
	 */
	public function getVolM3Verp() {
		return $this->_volM3Verp;
	}

	/**
	 * @return the $_vrijeVoorraadPakket
	 */
	public function getVrijeVoorraadPakket() {
		return $this->_vrijeVoorraadPakket;
	}
	
	/**
	 * @param number $vrijeVoorraadPakket
	 */
	public function setVrijeVoorraadPakket($vrijeVoorraadPakket) {
		if (is_numeric($vrijeVoorraadPakket) || $vrijeVoorraadPakket == null) {
			if (is_numeric($vrijeVoorraadPakket)) {
				$this->_vrijeVoorraadPakket = $vrijeVoorraadPakket;
			} else {
				$this->_vrijeVoorraadPakket = floatval($vrijeVoorraadPakket);
			}
		} else {
			throw new InvalidArgumentException('vrijeVoorraadPakket should be decimal');
		}
		return $this;
	}
	
	/**
	 * @return the $_assCodeExclusiv
	 */
	public function getAssCodeExclusiv() {
		return $this->_assCodeExclusiv;
	}
	
	/**
	 * @param string $assCodeExclusiv
	 */
	public function setAssCodeExclusiv($assCodeExclusiv) {
		$this->_assCodeExclusiv = intval($assCodeExclusiv);
	}

	/**
	 * setter voor _eancode
	 * @param string $eancode
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setEancode($eancode) {
		if (is_string($eancode) || $eancode == null) {
			$this->_eancode = $eancode;
		} else {
			throw new InvalidArgumentException('eancode should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _eancode
	 * @return string
	 */
	public function getEancode() {
		return $this->_eancode;
	}
	
	/**
	 * @return the $_aantal_pakketten
	 */
	public function getAantal_pakketten() {
		return $this->_aantal_pakketten;
	}

	/**
	 * @param number $_aantal_pakketten
	 */
	public function setAantal_pakketten($_aantal_pakketten) {
		$this->_aantal_pakketten = $_aantal_pakketten;
	}

	public function toArray()
	{
		$item = array();
		$item['ARTIKELCODE'] = $this->getArtikelcode();
		$item['ARTCODE_PAKKET'] = $this->getArtcodePakket();
		$item['NL'] = $this->getNL();
		$item['EN'] = $this->getEN();
		$item['DE'] = $this->getDE();
		$item['FR'] = $this->getFR();
		$item['GEWICHT'] = $this->getGewicht();
		$item['VERPAK_DIKTE_MM'] = $this->getVerpakDikteMm();
		$item['VERPAK_LENGTE_MM'] = $this->getVerpakLengteMm();
		$item['VERPAK_BREEDTE_MM'] = $this->getVerpakBreedteMm();
		$item['VOL_M3_VERP'] = $this->getVolM3Verp();
		$item['VRIJEVOORRAADPAKKET'] = $this->getVrijeVoorraadPakket();
		$item['ASS_CODE_EXCLUSIV'] = $this->getAssCodeExclusiv();
//		$item['EANCode'] = $this->getEancode();
		$item['EANCode_PAKKET'] = $this->getEancode();
		$item['AANTAL_PAKKETTEN'] = $this->getAantal_pakketten();
				
		return $item;
	}
}