<?php

namespace App\Models\Track;

class Track
{
    /** @var int Constant maximum total elements */
    const MAX_TOTAL_ELEMENTS = 2000;

    /** @var int Constant minimum length of a series of elements */
    const MIN_ELEMENT_LENGTH = 40;

    /** @var array Array of types of elements */
    private $types = [
        'straight',
        'curve',
    ];

    private array $map = [];


    /**
     * Get the map.
     *
     * @return array
     */
    public function getMap(): array
    {
        return $this->map;
    }


    /**
     * Track constructor.
     */
    public function __construct()
    {
        $trackSeriesCount = round(self::MAX_TOTAL_ELEMENTS / self::MIN_ELEMENT_LENGTH);

        for ($i = 0, $step = 1; $i < $trackSeriesCount; $i++, $step++) {
            $maxElementChunkIndex = $step * self::MIN_ELEMENT_LENGTH;
            $this->map[--$maxElementChunkIndex] = self::$types[array_rand(self::$types)];
        }
    }
}
