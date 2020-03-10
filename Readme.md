# All Different Directions Solution [![Build Status](https://travis-ci.org/vladdnepr/alldifferentdirections.svg?branch=master)](https://travis-ci.org/vladdnepr/alldifferentdirections)
#### https://open.kattis.com/problems/alldifferentdirections
If you walk through a big city and try to find your way around, you might try asking people for directions. However, asking nn people for directions might result in nn different sets of directions. But you believe in the law of averages: if you consider everyone’s advice, then you will have a good idea of where to go by computing the average destination that they all lead to. You would also like to know how far off were the worst directions. You compute this as the maximum straight-line distance between each direction’s destination and the averaged destination.

#### Requirements and depends
* PHP >= 7.2

## Install

* ``$ composer install``

## Tests

1. ``$ composer install``
2. ``./vendor/bin/phpunit``

## Run

``make run``

or 

``cat ./data.in | php console.php``