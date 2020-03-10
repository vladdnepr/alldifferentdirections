<?php

namespace App\Tests;

use App\Advice;
use PHPUnit\Framework\TestCase;

class AdviceTest extends TestCase
{

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                "87.342 34.30 start 0 walk 10.0",
                87.342,
                34.3,
                97.342,
                34.3,
            ],
            [
                "2.6762 75.2811 start -45.0 walk 40 turn 40.0 walk 60",
                2.6762,
                75.2811,
                90.73215,
                41.76748,
            ],
            [
                "58.518 93.508 start 270 walk 50 turn 90 walk 40 turn 13 walk 5",
                58.518,
                93.508,
                103.38985,
                44.63276,
            ],
            [
                "30 40 start 90 walk 5",
                30,
                40,
                30,
                45,
            ],
            [
                "40 50 start 180 walk 10 turn 90 walk 5",
                40,
                50,
                30,
                45,
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param string $payload
     * @param float $xStart
     * @param float $yStart
     * @param float $xFinish
     * @param float $yFinish
     */
    public function test(
        string $payload,
        float $xStart,
        float $yStart,
        float $xFinish,
        float $yFinish
    ) {
        $advice = new Advice($payload);

        $this->assertEquals($xStart, round($advice->getX(), 5));
        $this->assertEquals($yStart, round($advice->getY(), 5));

        $advice->run();

        $this->assertEquals($xFinish, round($advice->getX(), 5));
        $this->assertEquals($yFinish, round($advice->getY(), 5));
    }
}