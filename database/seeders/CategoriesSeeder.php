<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ['Food', 'Bills & Utilities', 'Entertainment', 'Transportation', 'Communication', 'Health', 'Education', 'Travel', 'Others'];
    }  
}
