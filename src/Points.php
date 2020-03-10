<?php
/*
 * @author Vladislav Lyshenko <vladdnepr1989@gmail.com>
 */

namespace App;

class Points
{
    private $points = [];

    public function add(float $x, float $y)
    {
        $this->points[] = [$x, $y];
    }

    public function getAvgX()
    {
        return array_sum(array_column($this->points, 0)) / count($this->points);
    }

    public function getAvgY()
    {
        return array_sum(array_column($this->points, 1)) / count($this->points);
    }

    public function getDistance(): float
    {
        $avgX = $this->getAvgX();
        $avgY = $this->getAvgY();

        $distances = [];

        foreach ($this->points as $point) {
            $distances[] = pow($point[0] - $avgX, 2)
                + pow($point[1] - $avgY, 2);
        }

        return sqrt(max($distances));
    }
}