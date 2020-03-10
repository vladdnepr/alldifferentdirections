<?php

namespace App\Tests;

use App\Points;
use PHPUnit\Framework\TestCase;

class PointsTest extends TestCase
{

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                [
                    [0, 0],
                    [0, 100],
                    [100, 100],
                    [100, 0],
                ],
                50,
                50,
                70.71068
            ],
            [
                [
                    [30, 40],
                    [30, 45],
                    [30, 50],
                    [30, 45],
                ],
                30,
                45,
                5
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     * @param float $avgX
     * @param float $avgY
     * @param float $distance
     */
    public function test(
        array $data,
        float $avgX,
        float $avgY,
        float $distance
    ) {
        $points = new Points();

        foreach ($data as $row) {
            $points->add($row[0], $row[1]);
        }

        $this->assertEquals($avgX, round($points->getAvgX(), 5));
        $this->assertEquals($avgY, round($points->getAvgY(), 5));
        $this->assertEquals($distance, round($points->getDistance(), 5));
    }
}