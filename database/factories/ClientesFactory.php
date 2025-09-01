<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes>
 */
class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_customer' => $this->faker->firstName(),
            'lastname_customer' => $this->faker->lastName(),
            'identification' => $this->generateUniqueIdentification(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->generatePhoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
    protected function generateUniqueIdentification(): string
    {
        $types = ['V', 'E', 'J', 'P'];
        $type = $this->faker->randomElement($types);

        return $type . '-' . $this->faker->unique()->numberBetween(1000000, 99999999);
    }

    /**
     * Genera un número de teléfono válido para la región.
     */
    protected function generatePhoneNumber(): string
    {
        $prefixes = ['0412', '0414', '0424', '0416', '0426'];
        $prefix = $this->faker->randomElement($prefixes);

        return $prefix . '-' . $this->faker->numerify('###-####');
    }
}
