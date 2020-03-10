<?php
/*
 * @author Vladislav Lyshenko <vladdnepr1989@gmail.com>
 */

namespace App;

class Walker
{
    /**
     * @var Advice[]
     */
    private $advices = [];

    /**
     * @var float
     */
    private $avgX = 0.0;

    /**
     * @var float
     */
    private $avgY = 0.0;

    /**
     * @var float
     */
    private $distance = 0.0;

    public function addAdvice(Advice $advice): self
    {
        $this->advices[] = $advice;

        return $this;
    }

    public function run(): self
    {
        $points = new Points();

        foreach ($this->advices as $advice) {
            $advice->run();

            $points->add($advice->getX(), $advice->getY());
        }

        $this->avgX = $points->getAvgX();
        $this->avgY = $points->getAvgY();
        $this->distance = $points->getDistance();

        return $this;
    }

    /**
     * @return float
     */
    public function getAvgX(): float
    {
        return $this->avgX;
    }

    /**
     * @return float
     */
    public function getAvgY(): float
    {
        return $this->avgY;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }
}