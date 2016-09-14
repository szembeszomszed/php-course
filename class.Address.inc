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

