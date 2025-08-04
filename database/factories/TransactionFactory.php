<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'amount' => fake()->randomFloat(2, 0, 9000),// randomFloat(decimaldigits, minimum, maximum)
            'description' => fake()->paragraph(3), 
            'transaction_date' => fake()->dateTimeBetween('2024-01-01', '2025-08-04')->format('Y-m-d'), 
            'user_id' => 1, 
            'category_id' => fake()->numberBetween(1,9),
        ];
    }
}
