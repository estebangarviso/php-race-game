<?php

namespace App\Models\Vehicle;

use App\Models\Factories\HasFactory;

/**
 * Class Car
 * @package App\Models\Vehicle
 */
class Car extends AbstractVehicle
{
    use HasFactory;

    /**
     * Car constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}
