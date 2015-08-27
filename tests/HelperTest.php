<?php


use JK\DslAnalytics\Helper;

class HelperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider secondIndexProvider
     */
    public function testIndexToSecondIndex($timestamp, $expectedIndex)
    {
        $datetime = new \DateTime($timestamp);
        $result = Helper::hashToSecondIndex($datetime);

        $this->assertSame($expectedIndex, $result,
            "Helper::hashToSecondIndex('${timestamp}') should be ${expectedIndex}.");
    }

    public function secondIndexProvider()
    {
        return [
            ['2015-08-27 0:00', 0],
            ['2015-08-27 0:32', 2],
            ['2015-08-27 23:32', 94],
            ['2015-08-27 23:59', 95],
        ];
    }
}
