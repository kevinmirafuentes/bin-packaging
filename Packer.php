<?php 

class Packer
{
    public $boxes;
    public $items;
    public $unpackedItems;

    public function addItem(Item $item)
    {
        $this->items[] = $item;
    }

    public function addBox(Box $box)
    {
        $this->boxes[] = $box;
    }

    public function pack()
    {
        $this->unpackedItems = $this->items;
        $packages = array();

        while (count($this->unpackedItems) > 0) {
            $smallestBox = false;
            foreach ($this->boxes as $box) {
                if ($box->canFit($this->items)) {
                    $smallestBox = $box;
                }
            }
            if ($smallestBox) {
                $packages[] = array('box' => $smallestBox, $items);
                $unpackedItems = $this->reduceItems($this->items);
            } else {
                $unpackedItems = $this->splitItems();
            }
        }

        return;

        // while ($items > 0) {
        //     foreach ($this->shippingClasses as $class) {
        //         if ($this->canFit($items, $class)) {
        //             $smallestClass = $class;
        //         }
        //     }
        //     if ($smallestClass) {
        //         $packages[] = array('class' => $smallestClass, 'items' => $items);
        //         $items = $this->reduceItems($items);
        //     } else {
        //         $items = $this->splitItems($items);
        //     }
        // }
    }

    public function splitItems()
    {
        // todo: sort items, biggest first
        foreach ($this->items as $key => $item) {
            $tmp = $item->split();
            if ($tmp) {
                foreach ((array) $this->unpackedItems as $unpackedItem) {
                    // todo: should be unique identifier
                    if ($unpackedItem->name == $tmp->name) {
                        $unpackedItem->qty += $tmp->qty;
                    }
                }
            }
        }
    }

    public function reduceItems($items)
    {
        // removed $items from $this->items
    }

    public function canFit()
    {
        
    }
}