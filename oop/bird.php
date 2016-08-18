<?php

class Bird
{
    public $canFly;
    public $legCount;

    public function __construct($canFly, $legCount)
    {
        $this->canFly = $canFly;
        $this->legCount = $legCount;
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
}