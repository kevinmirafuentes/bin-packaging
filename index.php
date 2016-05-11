<?php

include 'Packer.php';
include 'Item.php';
include 'Box.php';

// calculate total order volume
// get smallest classes which has greater volume than order
    // sort shipping classes from biggest dimensions
    // get the smallest classes which has greater volume than order
        // when order cannot fit any shipping any classes, split order and try again
// get the cheapest transport method based on shipping classes volume

// sort from biggest to smallest

$test = new Packer();
foreach ($x = 0; $x < 3; $x++) {
    $test->addItem(new Item('Product 1', 30, 20, 10));    
}

foreach ($x = 0; $x < 5; $x++) {
    $test->addItem(new Item('Product 2', 20, 5, 2));    
}

foreach ($x = 0; $x < 5; $x++) {
    $test->addItem(new Item('Product 3', 5, 5, 5));    
}

$test->addBox(new Box('small bag', 10, 10, 5));
$test->addBox(new Box('large bag', 20, 20, 10));
$test->addBox(new Box('small box', 30, 30, 20));
$test->addBox(new Box('large box', 40, 40, 30));

$test->pack();


// $order = array(
//     0 => array('name' => 'product 1', 'qty' => 3, 'dimension' => '10x20x30'),
//     1 => array('name' => 'product 2', 'qty' => 5, 'dimension' => '20x2x5'),
//     2 => array('name' => 'product 3', 'qty' => 10, 'dimension' => '5x5x5'),
// );

// $shippingClasses = array(
//     0 => array('name' => 'small bag', 'dimension' => '10x10x5'),
//     1 => array('name' => 'large bag', 'dimension' => '20x20x10'),
//     2 => array('name' => 'small box', 'dimension' => '30x40x20'),
//     3 => array('name' => 'large box', 'dimension' => '40x40x30'),
// );

// $transportMethod = array(
//     0 => array('name' => 'freighter', 'volume' => 1920000, 'cost' => 30),
//     1 => array('name' => 'dump truck', 'volume' => 1440000, 'cost' => 30),
//     2 => array('name' => 'pellet truck', 'volume' => 100000, 'cost' => 30),
// );