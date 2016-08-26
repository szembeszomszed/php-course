<?php

class Chest
{
    // protected property
    protected $lock;
    protected $isClosed;

    // by giving Lock as parameter, anything we pass to a new Chest() as argument, is going to be an instance of Lock
    public function __construct(Lock $lock)
    {
        $this->lock = $lock;
    }
    // when we set $lock to true, it will automatically lock the chest
    // when we set it to false, it will close the chest but leave it unlocked
    // set the $lock parameter to true by default - so we make giving an argument optionals
    public function close($lock = true)
    {
        if ($lock === true) {
            $this->lock->lock();
        }

        $this->isClosed = true;

        echo "Closed.";
    }

    // getter method
    public function isClosed()
    {
        return $this->isClosed;
    }


    public function open()
    {
        if ($this->lock->isLocked()) {
            // call the method defined in the Lock class
            $this->lock->unlock();
        }

        $this->isClosed = false;
        echo "Opened.";
    }


}