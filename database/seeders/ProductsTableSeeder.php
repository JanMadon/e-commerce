<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        DB::table('products')->truncate();

        $products = [
            // Electronics - Smartphones
            ['name' => 'iPhone 12', 'description' => 'Experience the latest iPhone with cutting-edge features.', 'subcategory_id' => 1, 'price' => 3999, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Samsung Galaxy S21', 'description' => 'Powerful Android smartphone with stunning display.', 'subcategory_id' => 1, 'price' => 3599, 'quantity'=>50, 'status'=> 'active'],

            // Electronics - Laptops
            ['name' => 'Asus ROG Strix G15', 'description' => 'Powerful gaming laptop with high-end specifications.', 'subcategory_id' => 2, 'price' => 5499, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Dell XPS 13', 'description' => 'Ultra-thin laptop with a borderless InfinityEdge display.', 'subcategory_id' => 2, 'price' => 2199, 'quantity'=>50, 'status'=> 'active'],

            // Electronics - Audio & Video
            ['name' => 'Sony WH-1000XM4', 'description' => 'Premium noise-canceling headphones for an immersive audio experience.', 'subcategory_id' => 3, 'price' => 899, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'LG OLED CX Series 65-Inch TV', 'description' => 'Stunning OLED TV for an exceptional visual experience.', 'subcategory_id' => 3, 'price' => 2999, 'quantity'=>50, 'status'=> 'active'],

            // Office Supplies - Stationery
            ['name' => 'Parker Jotter Ballpoint Pen', 'description' => 'Elegant pen for smooth and precise writing.', 'subcategory_id' => 4, 'price' => 29, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Muji Gel Ink Pen Set', 'description' => 'High-quality gel ink pens for a comfortable writing experience.', 'subcategory_id' => 4, 'price' => 12, 'quantity'=>50, 'status'=> 'active'],

            // Office Supplies - Furniture
            ['name' => 'IKEA Markus Office Chair', 'description' => 'Comfortable and ergonomic chair for your office space.', 'subcategory_id' => 5, 'price' => 299, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Homall Gaming Chair', 'description' => 'Sleek gaming chair with adjustable lumbar support and headrest.', 'subcategory_id' => 5, 'price' => 159, 'quantity'=>50, 'status'=> 'active'],

            // Office Supplies - Printers & Scanners
            ['name' => 'Epson EcoTank ET-2750', 'description' => 'High-quality all-in-one printer with cost-effective ink tank technology.', 'subcategory_id' => 6, 'price' => 449, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Canon imageFORMULA DR-C225 II', 'description' => 'Compact document scanner for efficient office workflows.', 'subcategory_id' => 6, 'price' => 349, 'quantity'=>50, 'status'=> 'active'],

            // Home Appliances - Kitchen Appliances
            ['name' => 'Instant Pot Duo 7-in-1', 'description' => 'Versatile kitchen appliance for quick and easy cooking.', 'subcategory_id' => 7, 'price' => 129, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Breville Smart Oven Air Fryer', 'description' => 'Multipurpose countertop oven with air frying capabilities.', 'subcategory_id' => 7, 'price' => 349, 'quantity'=>50, 'status'=> 'active'],

            // Home Appliances - Home Security
            ['name' => 'Ring Video Doorbell Pro', 'description' => 'Enhance your home security with a smart video doorbell.', 'subcategory_id' => 8, 'price' => 249, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Arlo Pro 3 Wire-Free Security Camera', 'description' => 'Wire-free security camera with 2K HDR for clear video monitoring.', 'subcategory_id' => 8, 'price' => 499, 'quantity'=>50, 'status'=> 'active'],

            // Home Appliances - Cleaning Products
            ['name' => 'Dyson V11 Torque Drive Vacuum', 'description' => 'Powerful cordless vacuum cleaner for efficient cleaning.', 'subcategory_id' => 9, 'price' => 599, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'iRobot Roomba i7+', 'description' => 'Smart robot vacuum with automatic dirt disposal.', 'subcategory_id' => 9, 'price' => 799, 'quantity'=>50, 'status'=> 'active'],

            // Clothing - Men's Clothing
            ['name' => 'Levi\'s 501 Original Fit Jeans', 'description' => 'Classic and timeless jeans for a stylish look.', 'subcategory_id' => 10, 'price' => 79, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Nike Sportswear Club Fleece Hoodie', 'description' => 'Comfortable and warm fleece hoodie for a sporty style.', 'subcategory_id' => 10, 'price' => 49, 'quantity'=>50, 'status'=> 'active'],

            // Clothing - Women's Clothing
            ['name' => 'Zara Floral Print Dress', 'description' => 'Chic floral dress for a fashionable and feminine appearance.', 'subcategory_id' => 11, 'price' => 59, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'H&M High-Waisted Skinny Jeans', 'description' => 'Trendy high-waisted skinny jeans for a modern look.', 'subcategory_id' => 11, 'price' => 29, 'quantity'=>50, 'status'=> 'active'],

            // Clothing - Footwear
            ['name' => 'Nike Air Max 270', 'description' => 'Iconic sneakers with comfortable Air cushioning.', 'subcategory_id' => 12, 'price' => 129, 'quantity'=>50, 'status'=> 'active'],
            ['name' => 'Adidas Ultraboost Running Shoes', 'description' => 'Responsive running shoes for maximum comfort and performance.', 'subcategory_id' => 12, 'price' => 169, 'quantity'=>50, 'status'=> 'active'],
        ];

        DB::table('products')->insert($products);
    }
}
