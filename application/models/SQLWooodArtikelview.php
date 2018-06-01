<?php

class Site_Model_SQLWooodArtikelview
{

	/**
	 * @var string ARTIKELCODE
	 */
	private $_artikelcode;
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
	 * @var string COLOR_FINISH
	 */
	private $_colorFinish;
	/**
	 * @var string MATERIAL
	 */
	private $_material;
	/**
	 * @var string BRAND
	 */
	private $_brand;
	/**
	 * @var string ASSORTMENT
	 */
	private $_assortment;
	/**
	 * @var string PRODUCTGROUP_CODE
	 */
	private $_productgroupCode;
	/**
	 * @var string PRODUCTGROUP
	 */
	private $_productgroup;
	/**
	 * @var string DEFAULT_SUBPRODUCTGROUP_CODE
	 */
	private $_defaultSubproductgroupCode;
	/**
	 * @var string DEFAULT_SUBPRODUCTGROUP_NAME
	 */
	private $_defaultSubproductgroupName;
	/**
	 * @var string RANGE
	 */
	private $_range;
	/**
	 * @var string STATUS
	 */
	private $_status;
	/**
	 * @var string EXCLUSIV
	 */
	private $_exclusiv;
	/**
	 * @var float VERKOOPPRIJS
	 */
	private $_verkoopprijs;
	/**
	 * @var string VERKOOPEENHEID
	 */
	private $_verkoopeenheid;
	/**
	 * @var float AANTAL_PAKKETTEN
	 */
	private $_aantalPakketten;
	/**
	 * @var string AFMETING_ARTIKEL_HXBXD
	 */
	private $_afmetingArtikelHxbxd;
	/**
	 * @var string EANCode
	 */
	private $_eancode;
	/**
	 * @var string EN_LONG_DESC
	 */
	private $_enLongDesc;
	/**
	 * @var string NL_LONG_DESC
	 */
	private $_nlLongDesc;
	/**
	 * @var string DE_LONG_DESC
	 */
	private $_deLongDesc;
	/**
	 * @var string FR_LONG_DESC
	 */
	private $_frLongDesc;
	/**
	 * @var float AANTAL_VERP
	 */
	private $_aantalVerp;
	/**
	 * @var string SOURCE
	 */
	private $_source;
	/**
	 * @var string MRP_RUN
	 */
	private $_mrpRun;
	/**
	 * @var float CONSUMENTENPRIJS
	 */
	private $_consumentenPrijs;
	/**
	 * @var float CONSUMENTENPRIJS_VAN
	 */
	private $_consumentenPrijsVan;
	/**
	 * @var float ISE_CONSUMENTENPRIJS
	 */
	private $_iseConsumentenPrijs;
	/**
	 * @var float ISE_CONSUMENTENPRIJS_VAN
	 */
	private $_iseConsumentenPrijsVan;
	/**
	 * @var float GEWICHT
	 */
	private $_gewicht;
	/**
	 * @var bool NEW_ARRIVAL
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
	 * @var float VOL_M3_VERP
	 */
	private $_volM3Verp;
	/**
	 * @var float VrijeVoorraad
	 */
	private $_vrijeVoorraad;
	/**
	 * @var float ASS_CODE_EXCLUSIV
	 */
	private $_assCodeExclusiv;
	/**
	 * @var string ATP
	 */
	private $_atp;
	/**
	 * @var bool FSC
	 */
	private $_fsc;
	/**
	 * @var string COUNTRY_OF_ORIGIN
	 */
	private $_countryOfOrigin;
	/**
	 * @var string INTRASTAT_CODE
	 */
	private $_intrastatCode;
	/**
	 * @var bool ASSEMBLY_REQUIRED
	 */
	private $_assemblyRequired;
	/**
	 * @var float WEB_VAN_PRIJS_NL
	 */
	private $_webVanPrijsNl;
	/**
	 * @var float WEB_VAN_PRIJS_ISE
	 */
	private $_webVanPrijsIse;
	/**
	 * @var strin AvailabilityWeek
	 */
	private $_availabilityWeek;
	
	
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
		$this->_nl = '';
		$this->_en = '';
		$this->_de = '';
		$this->_colorFinish = '';
		$this->_material = '';
		$this->_brand = '';
		$this->_assortment = '';
		$this->_productgroupCode = '';
		$this->_productgroup = '';
		$this->_defaultSubproductgroupCode = '';
		$this->_defaultSubproductgroupName = '';
		$this->_range = '';
		$this->_status = '';
		$this->_exclusiv = '';
		$this->_verkoopprijs = 0.00;
		$this->_verkoopeenheid = '';
		$this->_afmetingArtikelHxbxd = '';
		$this->_aantalPakketten = 0;
		$this->_eancode = '';
		$this->_enLongDesc = '';
		$this->_nlLongDesc = '';
		$this->_deLongDesc = '';
		$this->_aantalVerp = 0;
		$this->_source = '';
		$this->_mrpRun = '';
		$this->_consumentenPrijs = 0.00;
		$this->_consumentenPrijsVan = 0.00;
		$this->_iseConsumentenPrijs = 0.00;
		$this->_iseConsumentenPrijsVan = 0.00;
		$this->_gewicht = 0;
		$this->_newArrival = 0;
		$this->_verpakBreedteMm = 0;
		$this->_verpakLengteMm = 0;
		$this->_verpakDikteMm = 0;
		$this->_volM3Verp = 0;
		$this->_vrijeVoorraad = 0;
		$this->_assCodeExclusiv = '';
		$this->_atp = '';
		$this->_fsc = 0;
		$this->_countryOfOrigin = '';
		$this->_intrastatCode = '';
		$this->_assemblyRequired = 0;
		$this->_webVanPrijsNl = 0.00;
		$this->_webVanPrijsIse = 0.00;
		$this->_availabilityWeek = '';
		
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db3');
		$select = $db1->select();
		$select->from('EEK_ARTIKELDATA');
		$select->where('ARTIKELCODE = ?', $id);
		
		$row = $db1->fetchRow($select);
		$this->setArtikelcode($row['ARTIKELCODE']);
		$this->setNL($row['NL']);
		$this->setEN($row['EN']);
		$this->setDE($row['DE']);
		$this->setColorFinish($row['COLOR_FINISH']);
		$this->setMaterial($row['MATERIAL']);
		$this->setBrand($row['BRAND']);
		$this->setAssortment($row['ASSORTMENT']);
		$this->setProductgroupCode($row['PRODUCTGROUP_CODE']);
		$this->setProductgroup($row['PRODUCTGROUP']);
		$this->setDefaultSubproductgroupCode($row['DEFAULT_SUBPRODUCTGROUP_CODE']);
		$this->setDefaultSubproductgroupName($row['DEFAULT_SUBPRODUCTGROUP_NAME']);
		$this->setRange($row['RANGE']);
		$this->setStatus($row['STATUS']);
		$this->setExclusiv($row['EXCLUSIV']);
		$this->setVerkoopprijs($row['VERKOOPPRIJS']);
		$this->setVerkoopeenheid($row['VERKOOPEENHEID']);
		$this->setAantalPakketten($row['AANTAL_PAKKETTEN']);
		$this->setAfmetingArtikelHxbxd($row['AFMETING_ARTIKEL_HXBXD']);
		$this->setEancode($row['EANCode']);
		$this->setEnLongDesc($row['EN_LONG_DESC']);
		$this->setNlLongDesc($row['NL_LONG_DESC']);
		$this->setDeLongDesc($row['DE_LONG_DESC']);
		$this->setAantalVerp($row['AANTAL_VERP']);
		$this->setSource($row['SOURCE']);
		$this->setMrpRun($row['MRP_RUN']);
		$this->setConsumentenPrijs($row['CONSUMENTENPRIJS']);
		$this->setConsumentenPrijsVan($row['CONSUMENTENPRIJS_VAN']);
		$this->setIseConsumentenPrijs($row['ISE_CONSUMENTENPRIJS']);
		$this->setIseConsumentenPrijsVan($row['ISE_CONSUMENTENPRIJS_VAN']);
		$this->setGewicht($row['GEWICHT']);
		$this->setNewArrival($row['NEW_ARRIVAL']);
		$this->setVerpakDikteMm($row['VERPAK_DIKTE_mm']);
		$this->setVerpakLengteMm($row['VERPAK_LENGTE_mm']);
		$this->setVerpakBreedteMm($row['VERPAK_BREEDTE_mm']);
		$this->setVolM3Verp($row['VOL_M3_VERP']);
		$this->setVrijeVoorraad($row['VrijeVoorraad']);
		$this->setAssCodeExclusiv($row['ASS_CODE_EXCLUSIV']);
		$this->setAtp($row['ATP']);
		$this->setFsc($row['FSC']);
		$this->setCountryOfOrigin($row['COUNTRY_OF_ORIGIN']);
		$this->setIntrastatCode($row['INTRASTAT_CODE']);
		$this->setAssemblyRequired($row['ASSEMBLY_REQUIRED']);
		$this->setWebVanPrijsNl($row['WEB_VAN_PRIJS_NL']);
		$this->setWebVanPrijsIse($row['WEB_VAN_PRIJS_ISE']);
		$this->setAvailabilityWeek($row['AVAILABILITY_WEEK']);
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
	 * setter voor _nl
	 * @param string $nl
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setNL($nl) {
		if (is_string($nl) || $nl == null) {
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
	 * setter voor _color_finish
	 * @param string $colorFinish
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setColorFinish($colorFinish) {
		if (is_string($colorFinish) || $colorFinish == null) {
			$this->_colorFinish = $colorFinish;
		} else {
			throw new InvalidArgumentException('colorFinish should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _colorFinish
	 * @return string
	 */
	public function getColorFinish() {
		return $this->_colorFinish;
	}

	/**
	 * setter voor _material
	 * @param string $material
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setMaterial($material) {
		if (is_string($material) || $material == null) {
			$this->_material = $material;
		} else {
			throw new InvalidArgumentException('material should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _material
	 * @return string
	 */
	public function getMaterial() {
		return $this->_material;
	}

	/**
	 * setter voor _brand
	 * @param string $brand
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setBrand($brand) {
		if (is_string($brand) || $brand == null) {
			$this->_brand = $brand;
		} else {
			throw new InvalidArgumentException('brand should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _brand
	 * @return string
	 */
	public function getBrand() {
		return $this->_brand;
	}

	/**
	 * setter voor _assortment
	 * @param string $assortment
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setAssortment($assortment) {
		if (is_string($assortment) || $assortment == null) {
			$this->_assortment = $assortment;
		} else {
			throw new InvalidArgumentException('assortment should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _assortment
	 * @return string
	 */
	public function getAssortment() {
		return $this->_assortment;
	}

	/**
	 * setter voor _productgroup
	 * @param string $productgroup
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setProductgroup($productgroup) {
		if (is_string($productgroup) || $productgroup == null) {
			$this->_productgroup = $productgroup;
		} else {
			throw new InvalidArgumentException('productgroup should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _productgroup
	 * @return string
	 */
	public function getProductgroup() {
		return $this->_productgroup;
	}

	/**
     * @return the $_productgroupCode
     */
    public function getProductgroupCode()
    {
        return $this->_productgroupCode;
    }

    /**
     * @param string $_productgroupCode
     */
    public function setProductgroupCode($_productgroupCode)
    {
        $this->_productgroupCode = $_productgroupCode;
    }

    /**
     * @return the $_defaultSubproductgroupCode
     */
    public function getDefaultSubproductgroupCode()
    {
        return $this->_defaultSubproductgroupCode;
    }

    /**
     * @param string $_defaultSubproductgroupCode
     */
    public function setDefaultSubproductgroupCode($_defaultSubproductgroupCode)
    {
        $this->_defaultSubproductgroupCode = $_defaultSubproductgroupCode;
    }

    /**
     * @return the $_defaultSubproductgroupName
     */
    public function getDefaultSubproductgroupName()
    {
        return $this->_defaultSubproductgroupName;
    }

    /**
     * @param string $_defaultSubproductgroupName
     */
    public function setDefaultSubproductgroupName($_defaultSubproductgroupName)
    {
        $this->_defaultSubproductgroupName = $_defaultSubproductgroupName;
    }

    /**
	 * setter voor _range
	 * @param string $range
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setRange($range) {
		if (is_string($range) || $range == null) {
			$this->_range = $range;
		} else {
			throw new InvalidArgumentException('range should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _range
	 * @return string
	 */
	public function getRange() {
		return $this->_range;
	}

	/**
	 * setter voor _status
	 * @param string $status
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setStatus($status) {
		if (is_string($status) || $status == null) {
			$this->_status = $status;
		} else {
			throw new InvalidArgumentException('status should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _status
	 * @return string
	 */
	public function getStatus() {
		return $this->_status;
	}

	/**
	 * setter voor _exclusiv
	 * @param string $exclusiv
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setExclusiv($exclusiv) {
		if (is_string($exclusiv) || $exclusiv == null) {
			$this->_exclusiv = $exclusiv;
		} else {
			throw new InvalidArgumentException('exclusiv should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _exclusiv
	 * @return string
	 */
	public function getExclusiv() {
		return $this->_exclusiv;
	}

	/**
	 * setter voor _verkoopprijs
	 * @param string $verkoopprijs
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVerkoopprijs($verkoopprijs) {
		if (is_numeric($verkoopprijs) || $verkoopprijs == null) {
			if (is_numeric($verkoopprijs)) {
				$this->_verkoopprijs = $verkoopprijs;
			} else {
				$this->_verkoopprijs = floatval($verkoopprijs);
			}
		} else {
			throw new InvalidArgumentException('verkoopprijs should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _verkoopprijs
	 * @return float
	 */
	public function getVerkoopprijs() {
		return $this->_verkoopprijs;
	}

	/**
	 * setter voor _verkoopeenheid
	 * @param string $verkoopeenheid
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setVerkoopeenheid($verkoopeenheid) {
		if (is_string($verkoopeenheid) || $verkoopeenheid == null) {
			$this->_verkoopeenheid = $verkoopeenheid;
		} else {
			throw new InvalidArgumentException('verkoopeenheid should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _verkoopeenheid
	 * @return string
	 */
	public function getVerkoopeenheid() {
		return $this->_verkoopeenheid;
	}

	/**
	 * setter voor _aantalPakketten
	 * @param string $aantalPakketten
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setAantalPakketten($aantalPakketten) {
		if (is_numeric($aantalPakketten) || $aantalPakketten == null) {
			if (is_numeric($aantalPakketten)) {
				$this->_aantalPakketten = $aantalPakketten;
			} else {
				$this->_aantalPakketten = floatval($aantalPakketten);
			}
		} else {
			throw new InvalidArgumentException('aantalPakketten should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _aantalPakketten
	 * @return float
	 */
	public function getAantalPakketten() {
		return $this->_aantalPakketten;
	}

	/**
	 * setter voor _afmetingArtikelHxbxd
	 * @param string $afmeting
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setAfmetingArtikelHxbxd($afmeting) {
		if (is_string($afmeting) || $afmeting == null) {
			$this->_afmetingArtikelHxbxd = utf8_encode($afmeting);
		} else {
			throw new InvalidArgumentException('afmeting should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _afmetingArtikelHxbxd
	 * @return string
	 */
	public function getAfmetingArtikelHxbxd() {
		return $this->_afmetingArtikelHxbxd;
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
	 * setter voor _enLongDesc
	 * @param string $enLongDesc
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setEnLongDesc($enLongDesc) {
		if (is_string($enLongDesc) || $enLongDesc == null) {
			$this->_enLongDesc = utf8_encode($enLongDesc);
		} else {
			throw new InvalidArgumentException('enLongDesc should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _enLongDesc
	 * @return string
	 */
	public function getEnLongDesc() {
		return $this->_enLongDesc;
	}

	/**
	 * setter voor _nlLongDesc
	 * @param string $nlLongDesc
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setNlLongDesc($nlLongDesc) {
		if (is_string($nlLongDesc) || $nlLongDesc == null) {
			$this->_nlLongDesc = utf8_encode($nlLongDesc);
		} else {
			throw new InvalidArgumentException('nlLongDesc should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _nlLongDesc
	 * @return string
	 */
	public function getNlLongDesc() {
		return $this->_nlLongDesc;
	}

	/**
	 * setter voor _deLongDesc
	 * @param string $deLongDesc
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setDeLongDesc($deLongDesc) {
		if (is_string($deLongDesc) || $deLongDesc == null) {
			$this->_deLongDesc = utf8_encode($deLongDesc);
		} else {
			throw new InvalidArgumentException('deLongDesc should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _deLongDesc
	 * @return string
	 */
	public function getDeLongDesc() {
		return $this->_deLongDesc;
	}

	/**
	 * setter voor _frLongDesc
	 * @param string $frLongDesc
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setFrLongDesc($frLongDesc) {
		if (is_string($frLongDesc) || $frLongDesc == null) {
			$this->_frLongDesc = utf8_encode($frLongDesc);
		} else {
			throw new InvalidArgumentException('frLongDesc should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _frLongDesc
	 * @return string
	 */
	public function getFrLongDesc() {
		return $this->_frLongDesc;
	}
	
	/**
	 * setter voor _aantalVerp
	 * @param float $aantalVerp
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setAantalVerp($aantalVerp) {
		if (is_numeric($aantalVerp) || $aantalVerp == null) {
			if (is_numeric($aantalVerp)) {
				$this->_aantalVerp = $aantalVerp;
			} else {
				$this->_aantalVerp = floatval($aantalVerp);
			}
		} else {
			throw new InvalidArgumentException('aantalVerp should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _aantalVerp
	 * @return float
	 */
	public function getAantalVerp() {
		return $this->_aantalVerp;
	}

	/**
	 * setter voor _source
	 * @param string $source
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setSource($source) {
		if (is_string($source) || $source == null) {
			$this->_source = $source;
		} else {
			throw new InvalidArgumentException('source should be of type string');
		}
		return $this;
	}

	/**
	 * getter voor _source
	 * @return string
	 */
	public function getSource() {
		return $this->_source;
	}

	/**
	 * setter voor _mrpRun
	 * @param string $mrpRun
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setMrpRun($mrpRun) {
		if (is_string($mrpRun) || $mrpRun == null) {
			$this->_mrpRun = $mrpRun;
		} else {
			throw new InvalidArgumentException('mrpRun should be of type string');
		}
		return $this;
	}
	
	/**
	 * getter voor _mrpRun
	 * @return string
	 */
	public function getMrpRun() {
		return $this->_mrpRun;
	}

	/**
	 * setter voor _consumentenPrijs
	 * @param float $consumentenPrijs
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setConsumentenPrijs($consumentenPrijs) {
		if (is_numeric($consumentenPrijs) || $consumentenPrijs == null) {
			if (is_numeric($consumentenPrijs)) {
				$this->_consumentenPrijs = $consumentenPrijs;
			} else {
				$this->_consumentenPrijs = floatval($consumentenPrijs);
			}
		} else {
			throw new InvalidArgumentException('consumentenPrijs should be decimal');
		}
		return $this;
	}
	
	/**
	 * getter voor _consumentenPrijs
	 * @return float
	 */
	public function getConsumentenPrijs() {
		return $this->_consumentenPrijs;
	}

	/**
     * @return the $_consumentenPrijsVan
     */
    public function getConsumentenPrijsVan()
    {
        return $this->_consumentenPrijsVan;
    }

	/**
     * @param number $_consumentenPrijsVan
     */
    public function setConsumentenPrijsVan($_consumentenPrijsVan)
    {
		if (is_numeric($_consumentenPrijsVan) || $_consumentenPrijsVan == null) {
			if (is_numeric($_consumentenPrijsVan)) {
				$this->_consumentenPrijsVan = $_consumentenPrijsVan;
			} else {
				$this->_consumentenPrijsVan = floatval($_consumentenPrijsVan);
			}
		} else {
			throw new InvalidArgumentException('consumentenPrijsVan should be decimal');
		}
		return $this;
    }

	/**
     * @return the $_iseConsumentenPrijs
     */
    public function getIseConsumentenPrijs()
    {
        return $this->_iseConsumentenPrijs;
    }

    /**
     * @param number $_iseConsumentenPrijs
     */
    public function setIseConsumentenPrijs($_iseConsumentenPrijs)
    {
        $this->_iseConsumentenPrijs = $_iseConsumentenPrijs;
        return $this;
    }

    /**
     * @return the $_iseConsumentenPrijsVan
     */
    public function getIseConsumentenPrijsVan()
    {
        return $this->_iseConsumentenPrijsVan;
    }

    /**
     * @param number $_iseConsumentenPrijsVan
     */
    public function setIseConsumentenPrijsVan($_iseConsumentenPrijsVan)
    {
        $this->_iseConsumentenPrijsVan = $_iseConsumentenPrijsVan;
        return $this;
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
	 * setter voor _newArrival
	 * @param bool $newArrival
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setNewArrival($newArrival) {
		if (is_numeric($newArrival) || $newArrival == null) {
			if (is_numeric($newArrival)) {
				$this->_newArrival = $newArrival;
			} else {
				$this->_newArrival = intval($newArrival);
			}
		} else {
			throw new InvalidArgumentException('newArrivalaantal should be boolean');
		}
		return $this;
	}
	
	/**
	 * getter voor _newArrival
	 * @return bool
	 */
	public function getNewArrival() {
		return $this->_newArrival;
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
	 * @return the $_vrijeVoorraad
	 */
	public function getVrijeVoorraad() {
		return $this->_vrijeVoorraad;
	}

	/**
	 * @param number $vrijeVoorraad
	 */
	public function setVrijeVoorraad($vrijeVoorraad) {
		if (is_numeric($vrijeVoorraad) || $vrijeVoorraad == null) {
			if (is_numeric($vrijeVoorraad)) {
				$this->_vrijeVoorraad = $vrijeVoorraad;
			} else {
				$this->_vrijeVoorraad = floatval($vrijeVoorraad);
			}
		} else {
			throw new InvalidArgumentException('vrijeVoorraad should be decimal');
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
	 * @param float $assCodeExclusiv
	 */
	public function setAssCodeExclusiv($assCodeExclusiv) {
		$this->_assCodeExclusiv = intval($assCodeExclusiv);
	}

	/**
	 * @return the $_atp
	 */
	public function getAtp() {
		return $this->_atp;
	}

	/**
	 * @param string $_atp
	 */
	public function setAtp($_atp) {
		$this->_atp = $_atp;
	}

	/**
     * @return the $_fsc
     */
    public function getFsc()
    {
        return $this->_fsc;
    }

	/**
     * @param boolean $_fsc
     */
    public function setFsc($_fsc)
    {
        $this->_fsc = $_fsc;
    }

	/**
     * @return the $_countryOfOrigin
     */
    public function getCountryOfOrigin()
    {
        return $this->_countryOfOrigin;
    }

	/**
     * @param string $_countryOfOrigin
     */
    public function setCountryOfOrigin($_countryOfOrigin)
    {
        $this->_countryOfOrigin = $_countryOfOrigin;
    }

	/**
     * @return the $_intrastatCode
     */
    public function getIntrastatCode()
    {
        return $this->_intrastatCode;
    }

	/**
     * @param string $_intrastatCode
     */
    public function setIntrastatCode($_intrastatCode)
    {
        $this->_intrastatCode = $_intrastatCode;
    }

	/**
     * @return the $_assemblyRequired
     */
    public function getAssemblyRequired()
    {
        return $this->_assemblyRequired;
    }

	/**
     * @param boolean $_assemblyRequired
     */
    public function setAssemblyRequired($_assemblyRequired)
    {
        $this->_assemblyRequired = $_assemblyRequired;
    }

	/**
     * @return the $_webVanPrijsNl
     */
    public function getWebVanPrijsNl()
    {
        return $this->_webVanPrijsNl;
    }

	/**
     * @param number $_webVanPrijsNl
     */
    public function setWebVanPrijsNl($_webVanPrijsNl)
    {
        $this->_webVanPrijsNl = $_webVanPrijsNl;
    }

	/**
     * @return the $_webVanPrijsIse
     */
    public function getWebVanPrijsIse()
    {
        return $this->_webVanPrijsIse;
    }

	/**
     * @param number $_webVanPrijsIse
     */
    public function setWebVanPrijsIse($_webVanPrijsIse)
    {
        $this->_webVanPrijsIse = $_webVanPrijsIse;
    }

	/**
     * @return the $_availabilityWeek
     */
    public function getAvailabilityWeek()
    {
        return $this->_availabilityWeek;
    }

    /**
     * @param strin $_availabilityWeek
     */
    public function setAvailabilityWeek($_availabilityWeek)
    {
        $this->_availabilityWeek = $_availabilityWeek;
    }

    public function toArray()
	{
		$item = array();
		$item['ARTIKELCODE'] = $this->getArtikelcode();
		$item['NL'] = $this->getNL();
		$item['EN'] = $this->getEN();
		$item['DE'] = $this->getDE();
		$item['FR'] = $this->getFR();
		$item['COLOR_FINISH'] = $this->getColorFinish();
		$item['MATERIAL'] = $this->getMaterial();
		$item['BRAND'] = $this->getBrand();
		$item['ASSORTMENT'] = $this->getAssortment();
		$item['PRODUCTGROUP_CODE'] = $this->getProductgroupCode();
		$item['PRODUCTGROUP'] = $this->getProductgroup();
		$item['DEFAULT_SUBPRODUCTGROUP_CODE'] = $this->getDefaultSubproductgroupCode();
		$item['DEFAULT_SUBPRODUCTGROUP_NAME'] = $this->getDefaultSubproductgroupName();
		$item['RANGE'] = $this->getRange();
		$item['STATUS'] = $this->getStatus();
		$item['EXCLUSIV'] = $this->getExclusiv();
		$item['VERKOOPPRIJS'] = $this->getVerkoopprijs();
		$item['VERKOOPEENHEID'] = $this->getVerkoopeenheid();
		$item['AANTAL_PAKKETTEN'] = $this->getAantalPakketten();
		$item['AFMETING_ARTIKEL_HXBXD'] = $this->getAfmetingArtikelHxbxd();
		$item['EANCode'] = $this->getEancode();
		$item['EN_LONG_DESC'] = $this->getEnLongDesc();
		$item['NL_LONG_DESC'] = $this->getNlLongDesc();
		$item['DE_LONG_DESC'] = $this->getDeLongDesc();
		$item['FR_LONG_DESC'] = $this->getFrLongDesc();
		$item['AANTAL_VERP'] = $this->getAantalVerp();
		$item['SOURCE'] = $this->getSource();
		$item['MRP_RUN'] = $this->getMrpRun();
		$item['CONSUMENTENPRIJS'] = $this->getConsumentenPrijs();
		$item['CONSUMENTENPRIJS_VAN'] = $this->getConsumentenPrijsVan();
		$item['ISE_CONSUMENTENPRIJS'] = $this->getIseConsumentenPrijs();
		$item['ISE_CONSUMENTENPRIJS_VAN'] = $this->getIseConsumentenPrijsVan();
		$item['GEWICHT'] = $this->getGewicht();
		$item['NEW_ARRIVAL'] = $this->getNewArrival();
		$item['VERPAK_DIKTE_MM'] = $this->getVerpakDikteMm();
		$item['VERPAK_LENGTE_MM'] = $this->getVerpakLengteMm();
		$item['VERPAK_BREEDTE_MM'] = $this->getVerpakBreedteMm();
		$item['VOL_M3_VERP'] = $this->getVolM3Verp();
		$item['VRIJEVOORRAAD'] = $this->getVrijeVoorraad();
		$item['ASS_CODE_EXCLUSIV'] = $this->getAssCodeExclusiv();
		$item['ATP'] = $this->getAtp();
		$item['FSC'] = $this->getFsc();
		$item['COUNTRY_OF_ORIGIN'] = $this->getCountryOfOrigin();
		$item['INTRASTAT_CODE'] = $this->getIntrastatCode();
		$item['ASSEMBLY_REQUIRED'] = $this->getAssemblyRequired();
		$item['WEB_VAN_PRIJS_NL'] = $this->getWebVanPrijsNl();
		$item['WEB_VAN_PRIJS_ISE'] = $this->getWebVanPrijsIse();
		$item['AVAILABILITY_WEEK'] = $this->getAvailabilityWeek();
		
		
		return $item;
	}
}