<?php
require_once('bar.php');
class Foo
{
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function printBar()
    {
        echo $this->bar->print();
    }
}
