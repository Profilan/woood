<?php

class Site_Model_SQLWooodLeveringswijzeList
{
    /**
     * @var array De lijst met Leveringswijze objecten
     */
    private $_leveringswijzen;

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
     * @return Site_Model_Db_SQLWooodLeveringswijzeMapper
     */
    public function getMapper() {
        if (null === $this->_mapper) {
            $this->setMapper(new Site_Model_Db_SQLWooodLeveringswijzeMapper(new Site_Model_Db_SQLWooodLeveringswijzeDao()));
        }
        return $this->_mapper;
    }

    /**
     * retourneert een lijst met Leveringswijze-objecten
     * @param string $key De naam van de gevraagde ...
     * @return array Array gevuld met Leveringswijze objecten
     */
    public function getList($type = 'all', $key = null) {
        switch ($type) {
            case 'code':
                $this->_leveringswijzes = $this->getMapper()->fetchByCode($key);
                break;
            case 'all' :
            default :
                $this->_leveringswijzes = $this->getMapper()->fetchAll();
        }
        return $this->_leveringswijzes;
    }
    
    /**
     * verwijdert alle elementen uit de lijst
     * @return void
     */
    public function clear() {
        $this->_leveringswijzes = array();
    }
    
    
    /**
     * vul de lijst met objecten aan de hand van de gegeven tweedimensionale array
     * @param array $data De array met gegevens van de leveringswijzes
     * @return array Array gevuld met Leveringswijze objecten
     * @throws InvalidArgumentException als verkeerde data wordt meegegeven
     */
    protected function populate($data) {
        //echo(__METHOD__.' - data: '.print_r($data));
        if (!is_array($data)) {
            throw new InvalidArgumentException('Data is not type array');
        }
        $this->clear();
        $leveringswijze = null;
        foreach ($data as $leveringswijzeData) { 
            try {
                $leveringswijze = new Site_Model_SQLWooodLeveringswijze();
                // vul de Leveringswijze met gegevens
                $leveringswijze->populate($leveringswijzeData);
                // voeg Leveringswijze toe aan lijst
                $this->_leveringswijzes[] = $leveringswijze;
            } catch (InvalidArgumentException $e) {
                // sla incorrecte category over en ga verder met de rest
            }
        }
    }
}