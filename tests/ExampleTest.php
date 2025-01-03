<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testAddItem()
    {
        $expected = 'item added';
        $result = addItem('item_name'); // Replace with your actual function to test
        $this->assertEquals($expected, $result);
    }
}

