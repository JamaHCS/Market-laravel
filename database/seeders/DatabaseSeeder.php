<?php

namespace Database\Seeders;

use App\Models\Sell;
use App\Models\User;
use App\Models\Market;
use App\Models\Product;
use App\Models\Location;
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

        $market = Market::create([
            'uuid' => substr(uniqid(), 5),
            'name' => 'Tienda doña pelos',
            'logo' => 'https://lh3.googleusercontent.com/proxy/a1JOw-X40mp9AZg-4YniGhaAqamQPZadqhMGBdJ7vXSQi9zMU-Y5RC4S8X3NzfsnMOieZjwQpa8sp6PHwseU78WzO19Zc6zYV1QHiDgAKiC4ZTFfEf-pKfSh-37gqu_ggw',
            'user_id' => 1,
            'location_id' => $location->id
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
