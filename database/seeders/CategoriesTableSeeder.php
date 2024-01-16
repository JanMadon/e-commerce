<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('categories')->truncate();
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Office Supplies', 'description' => 'Office-related products'],
            ['name' => 'Home Appliances', 'description' => 'Household appliances'],
            ['name' => 'Clothing', 'description' => 'Clothing and accessories'],
        ];

        // Insert data into Categories table
        DB::table('categories')->insert($categories);
    
    }
}
