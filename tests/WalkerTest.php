<?php

namespace App\Tests;

use App\Advice;
use App\Walker;
use PHPUnit\Framework\TestCase;

class WalkerTest extends TestCase
{

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                [
                    "87.342 34.30 start 0 walk 10.0",
                    "2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60",
                    "58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5",
                ],
                97.15467,
                40.23341,
                7.63097,
            ],
            [
                [
                    "30 40 start 90 walk 5",
                    "40 50 start 180 walk 10 turn 90 walk 5",
                ],
                30,
                45,
                0,
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param string[] $payload
     * @param float $avgX
     * @param float $avgY
     * @param float $distance
     */
    public function test(
        array $payload,
        float $avgX,
        float $avgY,
        float $distance
    ) {
        $walker = new Walker();

        foreach ($payload as $item) {
            $walker->addAdvice(new Advice($item));
        }

        $walker->run();

        $this->assertEquals($avgX, round($walker->getAvgX(), 5));
        $this->assertEquals($avgY, round($walker->getAvgY(), 5));
        $this->assertEquals($distance, round($walker->getDistance(), 5));
    }
}