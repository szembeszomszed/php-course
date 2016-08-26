<?php

class Lock
{
    // protected property
    protected $isLocked;

    // public method to give $isLocked a value
    public function lock()
    {
        $this->isLocked = true;
    }

    public function unlock()
    {
        $this->isLocked = false;
    }

    // public function to return variable
    public function isLocked()
    {
        return $this->isLocked;
    }
}