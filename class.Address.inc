<?php

/**
 * Címkezelő osztály
 */

// lehetőleg nagybetű, CamelCase - számmal nem kezdődhet
class Address {
    // publikus tulajdonság
    // címsor 1
    public $street_address_1;    
    // címsor 2
    public $street_address_2;    
    // ország
    public $country_name;    
    // város
    public $city_name;    
    // városrész
    public $subdivision_name;    
    //irányítószám
    public $postal_code;
    
    
    // védett tulajdonságok azoknak az adatoknak, amelyeket meg szeretnénk védeni az illetéktelen írástól
    // az _ itt csak megszokás, nem kötelező
    // metódus nem futtatható tulajdonság megadásakor - tehát a $_time_created = time(); nem lenne jó!!
    protected $_address_id;
    protected $_time_created;
    protected $_time_updated = null;
    
    // minden magic method publikus!
    public function __construct() {
        $this->_time_created = time();
    }
    /**
     * Cím kiírása html formátumban
     * @return string;
     */
    
    // ha jól kommenteljük, ctrl+hover-re megmutatja, hogy az adott eljárás mit csinál, és mivel tér vissza
    public function display() {
        $output = '<div>';
        // a $this látja az osztály a saját példányát, így tud rá hivatkozni
        $output .= $this->street_address_1;
        if ($this->street_address_2) {
            $output .= '<br>'.$this->street_address_2;
        }
        $output .= '<br>'.$this->postal_code.', '. $this->city_name;
        if ($this->subdivision_name) {
            $output .= ', '.$this->subdivision_name;
        }
        $output .= '<br><b>'.$this->country_name.'</b>';
        $output .= '</div>';
        
        // visszatérés
        return $output;
    }
}

