<?php

class Penguin extends Bird
{
    public function foo()
    {
        echo "penguin's location is:  $this->location";
    }

    public function bar()
    {
        echo $this->isNice;
    }
}