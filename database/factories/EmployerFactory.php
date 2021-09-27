<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->name(),
            'lastname' => $this->faker->name(),
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->numerify('##########'),
            'company_id' => function () {
                return Company::factory()->create()->id;
            }
        ];
    }
}
