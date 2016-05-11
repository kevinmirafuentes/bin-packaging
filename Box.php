<?php 

class Box 
{
    public $name;
    public $length;
    public $width;
    public $depth;

    public function __construct($name, $length, $width, $depth)
    {
        $this->name = $name;
        $this->length = $length;
        $this->width = $width;
        $this->depth = $depth;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function canFit()
    {
        
    }
}