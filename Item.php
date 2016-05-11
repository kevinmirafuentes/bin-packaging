<?php 

class Item 
{
    public $name;
    public $length;
    public $width; 
    public $depth;

    public function __construct($name, $length = 0, $width = 0, $depth = 0)
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

    public function getLongestLength()
    {
        return max($this->getLength(), $this->getWidth(), $this->getDepth());
    }

    public function getShortestLength()
    {
        return min($this->getLength(), $this->getWidth(), $this->getDepth());
    }

    public function getVolume()
    {
        return $this->getLength() * $this->getWith() * $this->getDepth();
    }

    public function split()
    {
        if ($this->qty > 1) {
            $clone = clone $this;
            $this->qty = ceil($this->qty / 2);
            $clone->qty -= $this->qty;
            return $clone;
        }
        return false;
    }
}