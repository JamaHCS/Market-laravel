<?php

namespace Database\Seeders;

use App\Models\Sell;
use App\Models\User;
use App\Models\Market;
use App\Models\Product;
use App\Models\MarketUser;
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
        $user = User::create([
            'name' => 'Jama',
            'email' => 'jamahcs@outlook.com',
            'password' => bcrypt('acceso.jama')
        ]);

        $market = Market::create([
            'name' => 'Tienda doña pelos',
            'user_id' => 1,
            'uuid' => substr(uniqid(), 5),
        ]);

        DB::insert('insert into role_on_markets (role) value (?)', ['Dueño']);
        DB::insert('insert into role_on_markets (role) value (?)', ['Administrador']);
        DB::insert('insert into role_on_markets (role) value (?)', ['Trabajador']);

        MarketUser::create(
            [
                'uuid' => $market->uuid,
                'market_id' => $market->id,
                'user_id' => $user->id,
                'role_id' => 1
            ]
        );

        Product::factory()->count(10)->create();

        Sell::factory()->count(50)->create();

        SellDetail::factory()->count(200)->create();
    }
}
