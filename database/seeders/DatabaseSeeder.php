<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //commenté pour ne pas effacer les donnée en bdd
        $products = Product::factory(32)->create();

        $users = User::factory(10)
        ->has(Address::factory())
        ->has(Cart::factory(3))
        ->create();

        foreach($users as $user) {
            $carts[] = Cart::where('user_id', '=', $user->id)->get();
        }

        foreach($carts as $cart) {
            $productIds = $this->generateNonEqualsProductId();
            for($i = 0; $i < count($cart); $i++) {
                $cart[$i]->product_id = $productIds[$i];
                $cart[$i]->save();
            }
        }

    }

    public function generateNonEqualsProductId() 
    {
        $productIds = [];

        //generate a list of random product id
        while(count($productIds) < 3) {
            $newId = Product::all()->random()->id; 
            if(!in_array($newId, $productIds)) {
                $productIds[] = $newId;
            }
        }

        return $productIds;
    }
}
