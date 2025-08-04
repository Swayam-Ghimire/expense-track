<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
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
            'monthly_income' => fake()->randomFloat(2, 100, 100000),
            'created_date' => $date,
            'user_id' => 1,
        ];
    }
}
