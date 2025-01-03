<?php

use PHPUnit\Framework\TestCase;
use App\ItemManager;  // Adjust the namespace if necessary

class ExampleTest extends TestCase
{
    public function testAddItem()
    {
        $expected = 'item added';
        $itemManager = new ItemManager();  // Instantiate the class
        $result = $itemManager->addItem('item_name');  // Call the method
        $this->assertEquals($expected, $result);
    }
}

