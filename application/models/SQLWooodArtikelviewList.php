<?php

class Site_Model_SQLWooodArtikelviewList
{
	/**
	 * @var array De lijst met Artikel objecten
	 */
	private $_articles;

	/**
	 * De DataMapper voor Artikel-objecten
	 * @var Site_Model_Db_ArticleMapper $_mapper
	 */
	private $_mapper;

	/**
	 * constructor
	 * @return void
	 */
	public function __construct() {
		$this->clear();
		$this->_mapper = null;
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
	 * @return Site_Model_Db_SQLWooodArtikelviewMapper
	 */
	public function getMapper() {
		if (null === $this->_mapper) {
			$this->setMapper(new Site_Model_Db_SQLWooodArtikelviewMapper(new Site_Model_Db_SQLWooodArtikelviewDao()));
		}
		return $this->_mapper;
	}

	/**
	 * retourneert een lijst met Article-objecten
	 * @param string $key De naam van de gevraagde ...
	 * @return array Array gevuld met Article objecten
	 */
	public function getList($type = 'all', $key = null, $page = null, $limit = null) {
		switch ($type) {
			case 'artikelcode':
				$this->_articles = $this->getMapper()->fetchByArtikelcode($key, $page, $limit);
				break;
			case 'all' :
			default :
				$this->_articles = $this->getMapper()->fetchAll($page, $limit);
		}
		return $this->_articles;
	}

	public function getTotalCount()
	{
	    return $this->getMapper()->getTotalCount();
	}
	
	/**
	 * verwijdert alle elementen uit de lijst
	 * @return void
	 */
	public function clear() {
		$this->_articles = array();
	}


	/**
	 * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
	 * @param array $data De array met gegevens van de artikelen
	 * @return array Array gevuld met Article objecten
	 * @throws InvalidArgumentException als verkeerde data wordt meegegeven
	 */
	protected function populate($data) {
		//echo(__METHOD__.' - data: '.print_r($data));
		if (!is_array($data)) {
			throw new InvalidArgumentException('Data is not type array');
		}
		$this->clear();
		$article = null;
		foreach ($data as $articleData) {
			try {
				$article = new Site_Model_SQLWooodArtikelview();
				// vul de Stock met gegevens
				$article->populate($articleData);
				// voeg Article toe aan lijst
				$this->_articles[] = $article;
			} catch (InvalidArgumentException $e) {
				// sla incorrecte category over en ga verder met de rest 
			}
		}
	}
}