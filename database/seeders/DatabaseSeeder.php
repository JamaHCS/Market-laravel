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
use App\Models\ProductImage;
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
            'password' => bcrypt('acceso.jama'),
            'password_verified' => true
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
            'uuid' => '56abd7df',
            'name' => 'Tienda doña pelos',
            'logo' => 'logos/logo.svg',
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
                'role_id' => 1,
                'is_main' => true
            ]
        );

        $cheetos = Product::create([
            'is_active' => true,
            'name' => 'Cheetos Flamin´ Hot 145gr',
            'type' => 'Botanas',
            'brand' => 'Frito-Lay',
            'price' => 13,
            'cost' => 10,
            'market_id' => 1,
            'stock' => 100
        ]);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/56abd7df/cheetos.png',
            'product_id' => $cheetos->id
        ]);

        $sabritas = Product::create([
            'is_active' => true,
            'name' => 'Sabritas Clásicas 145gr',
            'type' => 'Botanas',
            'brand' => 'Frito-Lay',
            'price' => 15,
            'cost' => 13,
            'market_id' => 1,
            'stock' => 100
        ]);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/56abd7df/sabritas.jpg',
            'product_id' => $sabritas->id
        ]);

        $coca = Product::create([
            'is_active' => true,
            'name' => 'Coca-cola 600ml',
            'brand' => 'Coca-Cola',
            'type' => 'Refrescos',
            'price' => 16,
            'cost' => 14,
            'market_id' => 1,
            'stock' => 100
            ]);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/56abd7df/coca600.png',
            'product_id' => $coca->id
        ]);

        $coca2 = Product::create([
            'is_active' => true,
            'name' => 'Coca-cola 2l',
            'brand' => 'Coca-Cola',
            'type' => 'Refrescos',
            'price' => 30,
            'cost' => 28,
            'market_id' => 1,
            'stock' => 0
        ]);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/56abd7df/coca2.jpg',
            'product_id' => $coca2->id
        ]);

        $kinder = Product::create([
            'is_active' => true,
            'name' => 'Kinder Delice 42gr',
            'brand' => 'Ferrero',
            'type' => 'Golosinas',
            'price' => 12,
            'cost' => 9,
            'market_id' => 1,
            'stock' => 100
        ]);

        ProductImage::create([
            'is_url' => false,
            'image' => 'products/56abd7df/kinder.jpg',
            'product_id' => $kinder->id
        ]);


        $ciel = Product::create([
            'is_active' => true,
            'name' => 'Ciel 1L',
            'barcode' => '7501055310883',
            'brand' => 'Ciel',
            'type' => 'Bebidas no alcohólicas',
            'price' => 10,
            'cost' => 11,
            'market_id' => 1,
            'stock' => 100
        ]);

        ProductImage::create([
            'is_url' => true,
            'image' => 'https://static.openfoodfacts.org/images/products/750/105/531/0883/front_es.15.full.jpg',
            'product_id' => $ciel->id
        ]);

        $valle = Product::create([
            'is_active' => true,
            'name' => 'del valle',
            'barcode' => '7501055330461',
            'brand' => 'del valle',
            'type' => 'Jugos',
            'price' => 10,
            'cost' => 11,
            'market_id' => 1,
            'stock' => 100
        ]);

        ProductImage::create([
            'is_url' => true,
            'image' => 'https://static.openfoodfacts.org/images/products/750/105/533/0461/front_es.3.full.jpg',
            'product_id' => $valle->id
        ]);

        $sells = Sell::factory()->count(50)->create();

        SellDetail::factory()->count(200)->create();
    }
}
