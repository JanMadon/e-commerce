<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {

        DB::table('sub_categories')->truncate();


        $subcategories = [
            // Electronics
            ['category_id' => 1, 'name' => 'Smartphones', 'description' => 'Smartphones and mobile devices'],
            ['category_id' => 1, 'name' => 'Laptops', 'description' => 'Laptops and portable computers'],
            ['category_id' => 1, 'name' => 'Audio & Video', 'description' => 'Audio and video equipment'],

            // Office Supplies
            ['category_id' => 2, 'name' => 'Stationery', 'description' => 'Stationery and office supplies'],
            ['category_id' => 2, 'name' => 'Furniture', 'description' => 'Office furniture and accessories'],
            ['category_id' => 2, 'name' => 'Printers & Scanners', 'description' => 'Printers, scanners, and accessories'],

            // Home Appliances
            ['category_id' => 3, 'name' => 'Kitchen Appliances', 'description' => 'Kitchen appliances and gadgets'],
            ['category_id' => 3, 'name' => 'Home Security', 'description' => 'Home security and surveillance'],
            ['category_id' => 3, 'name' => 'Cleaning Products', 'description' => 'Cleaning products and tools'],

            // Clothing
            ['category_id' => 4, 'name' => 'Men\'s Clothing', 'description' => 'Men\'s clothing and accessories'],
            ['category_id' => 4, 'name' => 'Women\'s Clothing', 'description' => 'Women\'s clothing and accessories'],
            ['category_id' => 4, 'name' => 'Footwear', 'description' => 'Shoes and footwear'],
        ];

        // Insert data into Subcategories table
        DB::table('sub_categories')->insert($subcategories);
    }
}
