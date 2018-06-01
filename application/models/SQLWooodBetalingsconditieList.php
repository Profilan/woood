<?php

class Site_Model_SQLWooodBetalingsconditieList
{
    /**
     * @var array De lijst met Betalingsconditie objecten
     */
    private $_betalingscondities;

    /**
     * De DataMapper voor Artikel-objecten
     * @var Site_Model_Db_PricelistViewMapper $_mapper
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
     * @return Site_Model_Db_SQLWooodBetalingsconditieMapper
     */
    public function getMapper() {
        if (null === $this->_mapper) {
            $this->setMapper(new Site_Model_Db_SQLWooodBetalingsconditieMapper(new Site_Model_Db_SQLWooodBetalingsconditieDao()));
        }
        return $this->_mapper;
    }

    /**
     * retourneert een lijst met Betalingsconditie-objecten
     * @param string $key De naam van de gevraagde ...
     * @return array Array gevuld met Betalingsconditie objecten
     */
    public function getList($type = 'all', $key = null) {
        switch ($type) {
            case 'code':
                $this->_betalingscondities = $this->getMapper()->fetchByCode($key);
                break;
            case 'all' :
            default :
                $this->_betalingscondities = $this->getMapper()->fetchAll();
        }
        return $this->_betalingscondities;
    }
    
    /**
     * verwijdert alle elementen uit de lijst
     * @return void
     */
    public function clear() {
        $this->_betalingscondities = array();
    }
    
    
    /**
     * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
     * @param array $data De array met gegevens van de betalingscondities
     * @return array Array gevuld met Betalingsconditie objecten
     * @throws InvalidArgumentException als verkeerde data wordt meegegeven
     */
    protected function populate($data) {
        //echo(__METHOD__.' - data: '.print_r($data));
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data is not type array');
        }
        $this->clear();
        $betalingsconditie = null;
        foreach ($data as $betalingsconditieData) {
            try {
                $betalingsconditie = new Site_Model_SQLWooodBetalingsconditie();
                // vul de Betalingsconditie met gegevens
                $betalingsconditie->populate($betalingsconditieData);
                // voeg Betalingsconditie toe aan lijst
                $this->_betalingscondities[] = $betalingsconditie;
            } catch (InvalidArgumentException $e) {
                // sla incorrecte category over en ga verder met de rest
            }
        }
    }
}