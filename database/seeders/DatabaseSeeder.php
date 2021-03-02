<?php

namespace Database\Seeders;

use App\Models\Sell;
use App\Models\User;
use App\Models\Market;
use App\Models\Product;
use App\Models\SellDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Jama',
            'email' => 'jamahcs@outlook.com',
            'password' => bcrypt('acceso.jama')
        ]);

        Market::create([
            'name' => 'Tienda doña pelos',
            'user_id' => 1,
        ]);

        Product::factory()->count(10)->create();

        Sell::factory()->count(50)->create();

        SellDetail::factory()->count(200)->create();
    }
}
