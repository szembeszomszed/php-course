<?php

class Bird
{
    public $canFly;
    public $legCount;

    // protected elements can be accessed by the subclasses
    protected $location;

    // private elements can only be accesses within the class where they were defined
    private $isNice;

    public function __construct($canFly, $legCount, $location, $isNice)
    {
        $this->canFly = $canFly;
        $this->legCount = $legCount;
        $this->location = $location;
        $this->isNice = $isNice;
    }

    // this method will simply return the value of the instance's canFly property
    public function canFly()
    {
        return $this->canFly;
    }

    // this method will simply return the value of the instance's legCount property
    public function getLegCount()
    {
        return $this->legCount;
    }

    public function getLocation()
    {
        return $this->location;
    }
}