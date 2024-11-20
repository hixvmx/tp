<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        $users = [
            [
                'name' => "admin 1",
                'email' => "admin1@gmail.com",
                'password' => bcrypt(123),
            ],
            [
                'name' => "admin 2",
                'email' => "admin2@gmail.com",
                'password' => bcrypt(123),
            ],
            [
                'name' => "admin 3",
                'email' => "admin3@gmail.com",
                'password' => bcrypt(123),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }


        // Products
        $products = [
            [
                'name' => "Product A",
                'total_quantity' => 100,
                'sold_quantity' => 30,
                'available_quantity' => 70,
                'created_by' => 1,
            ],
            [
                'name' => "Product B",
                'total_quantity' => 150,
                'sold_quantity' => 50,
                'available_quantity' => 100,
                'created_by' => 2,
            ],
            [
                'name' => "Product C",
                'total_quantity' => 200,
                'sold_quantity' => 120,
                'available_quantity' => 80,
                'created_by' => 3,
            ],
            [
                'name' => "Product D",
                'total_quantity' => 75,
                'sold_quantity' => 25,
                'available_quantity' => 50,
                'created_by' => 1,
            ],
            [
                'name' => "Product E",
                'total_quantity' => 300,
                'sold_quantity' => 150,
                'available_quantity' => 150,
                'created_by' => 2,
            ],
            [
                'name' => "Product F",
                'total_quantity' => 500,
                'sold_quantity' => 300,
                'available_quantity' => 200,
                'created_by' => 3,
            ],
            [
                'name' => "Product G",
                'total_quantity' => 400,
                'sold_quantity' => 100,
                'available_quantity' => 300,
                'created_by' => 1,
            ],
            [
                'name' => "Product H",
                'total_quantity' => 250,
                'sold_quantity' => 50,
                'available_quantity' => 200,
                'created_by' => 2,
            ],
            [
                'name' => "Product I",
                'total_quantity' => 120,
                'sold_quantity' => 80,
                'available_quantity' => 40,
                'created_by' => 3,
            ],
            [
                'name' => "Product J",
                'total_quantity' => 180,
                'sold_quantity' => 60,
                'available_quantity' => 120,
                'created_by' => 1,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
