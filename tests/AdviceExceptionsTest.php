<?php

namespace App\Tests;

use App\Advice;
use App\InvalidAdviceException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class AdviceExceptionsTest extends TestCase
{

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                "87.342 34.30",
            ],
            [
                "87.342 34.30 start 0 walk",
            ],
            [
                "87.342 34.30 start 0 jump 10.0",
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param string $payload
     */
    public function testInvalidAdviceException(
        string $payload
    ) {
        $this->expectException(InvalidAdviceException::class);
        new Advice($payload);
    }

    public function testRunTwice()
    {
        $this->expectException(RuntimeException::class);
        $advice = new Advice("87.342 34.30 start 0 walk 10.0");
        $advice->run();
        $advice->run();
    }
}