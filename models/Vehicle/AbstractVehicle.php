<?php

namespace App\Models\Vehicle;

use App\Models\Track\Track;
use ReflectionClass;

/**
 * Class AbstractVehicle
 * @package App\Models\Vehicle
 */
abstract class AbstractVehicle implements VehicleInterface
{
    /** @var int Constant of the minimum vehicle speed. */
    const MIN_VEHICLE_SPEED = 4;

    /** @var int Constant of the maximum vehicle speed. */
    const MAX_VEHICLE_SPEED = 22;

    /** @var string The vehicle name. */
    protected string $name;

    /** @var int The vehicle speed on the straight element type. */
    protected int $straightSpeed;

    /** @var int The vehicle speed on the curve element type. */
    protected int $curveSpeed;

    /** @var int The vehicle position on the map. */
    protected int $position = 0;

    /**
     * AbstractVehicle constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;

        $this->setSpeed();

        echo '<p>🚙 <b>' . $this->getType() . '</b> was created with name - <b>' . $name . '</b></p>';
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * {@inheritdoc}
     */
    public function getSpeed(): array
    {
        return [
            Track::STRAIGHT_ELEMENT_TYPE => $this->straightSpeed,
            Track::CURVE_ELEMENT_TYPE => $this->curveSpeed,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function move(int $speed): void
    {
        $this->position += $speed;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Method sets vehicle position on the track.
     *
     * @param int $newPosition
     */
    public function setPosition(int $newPosition): void
    {
        $this->position = $newPosition;
    }

    /**
     * Method gets sorted vehicles by position.
     *
     * @param array $vehicles
     * @return array
     */
    public function getSortedVehiclesByPosition(array $vehicles): array
    {
        usort($vehicles, fn ($a, $b) => ($a->position <= $b->position));

        return $vehicles;
    }

    /**
     * Method sets the vehicle speed for types of straight and curved elements.
     */
    private function setSpeed(): void
    {
        $this->straightSpeed = rand(self::MIN_VEHICLE_SPEED, self::MAX_VEHICLE_SPEED - self::MIN_VEHICLE_SPEED);
        $this->curveSpeed = self::MAX_VEHICLE_SPEED - $this->straightSpeed;
    }
}
