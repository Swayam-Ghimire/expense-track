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
        static $month = 1;
        static $year = 2024;
        $date = Carbon::create($year, $month, 4);

        $month++;
        if($month > 12) {
            $year++;
            $month = 1;
        }
        return [
            'amount' => fake()->randomFloat(2, 0, 100000),// randomFloat(decimaldigits, minimum, maximum)
            'description' => fake()->paragraph(3), 
            'transaction_date' => $date, 
            'user_id' => 1, 
            'category_id' => fake()->numberBetween(1,9),
        ];
    }
}
