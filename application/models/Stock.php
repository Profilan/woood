<?php

class Site_Model_Stock
{

	/**
	 * @var string Artikelcode
	 */
	private $_artikelcode;
	/**
	 * @var string Omschrijving
	 */
	private $_omschrijving;
	/**
	 * @var float Plankvoorraad
	 */
	private $_plankvoorraad;

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
		$this->_omschrijving = '';
		$this->_mapper = null;
	}
	
	public function load($id) 
	{
		$db1 = Zend_Registry::get('db1');
		$select = $db1->select();
		$select->from('_AB_Voorraad_Aantal');
		$select->where('Artikelcode = ?', $id);
		
		$row = $db1->fetchRow($select);
		$this->setArtikelcode($row['Artikelcode']);
		$this->setOmschrijving($row['Omschrijving']);
		$this->setPlankvoorraad($row['Plankvoorraad']);
	}

	/**
	 * setter voor _artikelcode
	 * @param string $artikelcode
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setArtikelcode($artikelcode) {
		if (is_string($artikelcode)) {
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
	 * setter voor _omschrijving
	 * @param string $omschrijving
	 * @return void
	 * @throws InvalidArgumentException
	 */
	public function setOmschrijving($omschrijving) {
		if (is_string($omschrijving)) {
			$this->_omschrijving = $omschrijving;
		} else {
			throw new InvalidArgumentException('omschrijving should be of type string');
		}
		return $this;
	}

	/**
	 * getter voor _omschrijving
	 * @return string
	 */
	public function getOmschrijving() {
		return $this->_omschrijving;
	}

	/**
	 * setter voor _plankvoorraad
	 * @param float $amount
	 * @return void
	 * @throws InvalidArgumentException
	 * @todo strip tags and invalid characters
	 */
	public function setPlankvoorraad($amount) {
		if (is_numeric($amount)) {
			if (is_numeric($amount)) {
				$this->_plankvoorraad = $amount;
			} else {
				$this->_plankvoorraad = floatval($amount);
			}
		} else {
			throw new InvalidArgumentException('amount should be decimal');
		}
		return $this;
	}

	/**
	 * getter voor _plankvoorraad
	 * @return float
	 */
	public function getPlankvoorraad() {
		return $this->_plankvoorraad;
	}
	
	public function toArray()
	{
		$item = array();
		$item['Artikelcode'] = $this->getArtikelcode();
		$item['Omschrijving'] = $this->getOmschrijving();
		$item['Plankvoorraad'] = $this->getPlankvoorraad();
		
		return $item;
	}
}