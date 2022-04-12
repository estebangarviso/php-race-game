<?php

namespace App\Models\Factories;

use App\Models\Vehicle\Car;

/**
 * Class CarFactory
 * @package App\Models\Factories
 */
class CarFactory extends BaseFactory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected string $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => 'Car ' . (++$this->step)
        ];
    }
}
