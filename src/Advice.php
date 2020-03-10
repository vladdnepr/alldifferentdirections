<?php
/*
 * @author Vladislav Lyshenko <vladdnepr1989@gmail.com>
 */

namespace App;

use RuntimeException;

class Advice
{
    /**
     * @var array
     */
    private $actions = [];

    /**
     * @var float
     */
    protected $x = 0.0;

    /**
     * @var float
     */
    protected $y = 0.0;

    /**
     * east is 0 degrees, north is 90 degrees
     * @var int
     */
    private $orientation = 0;

    /**
     * Advice constructor.
     * @param string $actionsString
     */
    public function __construct(string $actionsString)
    {
        $actions = explode(' ', $actionsString);

        if (count($actions) < 4) {
            throw new InvalidAdviceException(sprintf(
                'Invalid passerby actions: %s',
                $actionsString
            ));
        }

        if (count($actions) % 2 !== 0) {
            throw new InvalidAdviceException(sprintf(
                'Invalid passerby actions count: %s',
                $actionsString
            ));
        }

        $this->x = floatval(array_shift($actions));
        $this->y = floatval(array_shift($actions));

        while ($actions) {
            $doAction = array_shift($actions);
            $doMethod = 'do' . ucfirst($doAction);
            $value = floatval(array_shift($actions));

            if (!method_exists($this, $doMethod)) {
                throw new InvalidAdviceException(sprintf(
                    'Invalid passerby action %s. %s',
                    $doAction,
                    $actionsString
                ));
            }

            $this->actions[] = [
                'method' => [$this, $doMethod],
                'value' => $value,
            ];
        }
    }

    public function run()
    {
        if (empty($this->actions)) {
            throw new RuntimeException('Already ran');
        }

        while (!empty($this->actions)) {
            $action = array_shift($this->actions);
            call_user_func($action['method'], $action['value']);
        }
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * An angle in degrees you should turn.
     * A positive α indicates to turn to the left.
     * @param float $degrees
     * @return $this
     */
    protected function doTurn(float $degrees): self
    {
        $this->orientation += $degrees;

        return $this;
    }

    /**
     * α is the initial direction you are facing in degrees
     * (east is 0 degrees, north is 90 degrees).
     * @param float $degrees
     * @return $this
     */
    protected function doStart(float $degrees): self
    {
        $this->orientation = $degrees;

        return $this;
    }

    protected function doWalk(float $units): self
    {
        $this->x += $units * cos(deg2rad($this->orientation));
        $this->y += $units * sin(deg2rad($this->orientation));

        return $this;
    }
}