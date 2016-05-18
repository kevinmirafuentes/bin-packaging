<?php

$items = array(
    'a' => array('length' => 10, 'width' => 20, 'height' => 5, 'quantity' => 5,  'weight' => 0.5),
    'b' => array('length' => 13, 'width' => 10, 'height' => 16, 'quantity' => 3, 'weight' => 1),
);

$packages = array(
    'p1' => array('length' => 30, 'width' => 20, 'height' => 15, 'weight' => 5),
);


class Item
{
    public $length;
    public $width;
    public $height;
    public $weight;
    public $quantity;

    public $dimensions;

    public function __construct($length, $width, $height, $weight, $quantity = 1)
    {
        $this->weight = $weight;
        $this->quantity = $quantity;

        $tmp = array($length, $width, $height);
        rsort($tmp);

        $this->length = $tmp[0];
        $this->width  = $tmp[1];
        $this->height = $tmp[2];
    }
}

class ItemList
{
    public $items;

    public function addItem(Item $item)
    {
        $this->items = $item;
    }

    public function getTotalVolume()
    {
        $totalVolume = 0;
        foreach ($this->items as $item) {
            $totalVolume += $item->length * $item->width * $this->height;
        }
        return $totalVolume;
    }

    public function getTotalWeight()
    {
        $totalWeight = 0;
        foreach ($this->items as $item) {
            $totalWeight += $item->weight;
        }
        return $totalWeight;
    }

    public function getTotalLength()
    {
        $totalLength = 0;
        foreach ($this->items as $item) {
            $totalLength += $item->length;
        }
        return $totalLength;
    }

    public function getTotalWidth()
    {
        $totalWidth = 0;
        foreach ($this->items as $item) {
            $totalWidth += $item->width;
        }
        return $totalWidth;
    }

    public function getLongestItemLength()
    {
        $lengths = array();
        foreach ($this->items as $item) {
            $lengths[] = $item->lenght;
        }
        return max($lengths);
    }

    public function getLongestItemWidth()
    {
        $widths = array();
        foreach ($this->items as $item) {
            $widths[] = $item->width;
        }
        return max($widths);
    }

    public function getLongestItemHeight()
    {
        $heights = array();
        foreach ($this->items as $item) {
            $heights[] = $item->height;
        }
        return max($heights);
    }
}

class Package
{
    public $lenght;
    public $width;
    public $height;
    public $maxWeight;
    public $contents;

    public function __construct($length, $width, $height, $weight)
    {
        $this->maxWeight = $weight;

        $tmp = array($length, $width, $height);
        rsort($tmp);

        $this->length = $tmp[0];
        $this->width  = $tmp[1];
        $this->height = $tmp[2];
    }

    public function getVolume()
    {
        return $this->length * $this->width * $this->height;
    }

    public function canPack(ItemList $itemlist)
    {
        if ($itemlist->getTotalVolume() > $this->getVolume()) {
            return false;
        }

        if ($itemlist->getTotalWeight() > $this->maxWeight) {
            return false;
        }

        // check if can fit in normal orientations
        if ($itemlist->getTotalLength() <= $this->length &&
            $itemlist->getLongestItemWidth() <= $this->width &&
            $itemlist->getLongestItemHeight() <= $this->height) {
            $this->contents = $itemlist->items;
            return true;
        }

        // check if can fit in rotated orientations
        if ($itemlist->getTotalWidth() <= $this->length &&
            $itemlist->getLongestItemLength() <= $this->width &&
            $itemlist->getLongestItemHeight() <= $this->height) {
            $this->contents = $itemlist->items;
            return true;
        }

        // try to fit items one by one
        $rlength = $this->lenght;
        $rheight = $this->height;
        $rwidth  = $this->width;

        foreach ($itemlist->items as $item) {
            if ($rheight < $item->height) {
                return false;
            }
            // normal orientation
            if ($rlength >= $item->length && $rwidth >= $item->width) {
                $rlength -= $item->length;
                $rwidth  -= $item->width;
                if ($rheight > ($this->height - $item->height)) {
                    $rheight = $this->height - $item-$this->height;
                }
                $this->contents[] = $item;
            }
            // try rotated orientation
            if ($rlength >= $item->width && $rwidth >= $item->length) {
                $rlength -= $item->width;
                $rwidth  -= $item->length;
                if ($rheight > ($this->height - $item->height)) {
                    $rheight = $this->height - $item-$this->height;
                }
                $this->contents[] = $item;
            }
        }

        return count($this->contents) == count($itemlist->items);
    }
}

