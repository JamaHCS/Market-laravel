<?php

namespace Database\Seeders;

use App\Models\Sell;
use App\Models\User;
use App\Models\Market;
use App\Models\Product;
use App\Models\Location;
use App\Models\MarketType;
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

        $location = Location::create([
            // 20.654064957407833, -100.40611526026878
            'latitude' => 20.654064957407833,
            'longitude' => -100.40611526026878,
        ]);

        $type = MarketType::create(['name' => 'Tienda de abarrotes']);
        MarketType::create(['name' => 'Bazar']);
        MarketType::create(['name' => 'Tienda de ropa']);
        MarketType::create(['name' => 'Vendedor independiente']);

        $market = Market::create([
            'uuid' => substr(uniqid(), 5),
            'name' => 'Tienda doña pelos',
            'logo' => 'https://guiaimpresion.com/wp-content/uploads/2020/06/Logotipo-Amazon.jpg',
            'user_id' => 1,
            'location_id' => $location->id,
            'type_id' => $type->id
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
