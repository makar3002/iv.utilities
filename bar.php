<?php
class Bar
{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    public function print()
    {
        return $this->str;
    }
}
