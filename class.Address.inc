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
    protected $_postal_code;
    
    
    // védett tulajdonságok azoknak az adatoknak, amelyeket meg szeretnénk védeni az illetéktelen írástól
    // az _ itt csak megszokás, nem kötelező
    // metódus nem futtatható tulajdonság megadásakor - tehát a $_time_created = time(); nem lenne jó!!
    protected $_address_id;
    protected $_time_created;
    protected $_time_updated = null;
    
    // minden magic method publikus!
    // a constructor alapból lefut, de lehet alakítgatni, ha többet szeretnénk tőle, mint a példány szimpla megkreálása
    public function __construct() {
        $this->_time_created = time();
    }
    
    /**
     * Magic __get
     * @param string $name
     * @return mixed
     */
    
    public function __get($name) {
        // ha nincs beállítva az irányítószám, akkor futtatjuk a keresést rá
        if (!$this->_postal_code) {
            $this->_postal_code = $this->_postal_code_search();
        }
        
        // megpróbálunk a szóban forgó védett tulajdonsággal visszatérni
        // magyarul megnézzük, hogy megkapta-e a method a paramétert, és így az létezik-e        
        $protected_property_name = '_'.$name;
        if (property_exists($this, $protected_property_name)) {
            return $this->$protected_property_name;
        }
        
        // ha nem létező tulajdonság lenne, nyomunk egy errort
        // idáig el se jutunk, ha létezik, mert lefut a return
        trigger_error('Nem elérhető tulajdonság __get által: '.$name);
    }
    
    public function __set($name, $value) {
        // irányítószám beállítása minden lehetséges esetben
        if ($name == 'postal_code') {
            $this->$name = $value;
            // ha ez megvan, kötelező a return, hogy ne piszkálja tovább a többi esetet
            return;
        }
        // ha nem sikerül, jön az error
        trigger_error('Nem meghatározott vagy nem engedélyezett tulajdonságelérés __set által: '.$name);
    }
    
    /**
    * irányítószám-keresés ellenőrzésre és megadásra városnév és városrésznév alapján
    * @todo lecserélni valódi lekérésre
     * 
     * @return string*/
     
    protected function _postal_code_search() {
        return 'keresés...';
    }
    
    /**
     * Cím kiírása html formátumban
     * @return string;
     */
    
    // ha jól kommenteljük, ctrl+hover-re megmutatja, hogy az adott eljárás mit csinál, és mivel tér vissza
    public function display() {
        $output = '<div>';
        // a $this-en keresztül látja az osztály a saját példányát, így tud rá hivatkozni
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

