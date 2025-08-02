<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category'=>'Food'], 
            ['category'=>'Bills & Utilities'], ['category'=>'Entertainment'], ['category'=>'Transportation'], ['category'=>'Communication'], ['category'=>'Health'], ['category'=>'Education'], ['category'=>'Travel'], ['category'=>'Others']];
        foreach($categories as $cat){
            Categories::create($cat);
        }
    }  
}
