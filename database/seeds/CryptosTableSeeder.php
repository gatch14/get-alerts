<?php

use Illuminate\Database\Seeder;
use App\model\Crypto;

class CryptosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cryptos')->delete();

        Crypto::create([
            'name' => 'BTC',
            'price' => 10500,
            'choices' => 'low',
            'choices_value' => 'BTC',
            'user_id' => 1
        ]);

        Crypto::create([
            'name' => 'BTC',
            'price' => 10500,
            'choices' => 'high',
            'choices_value' => 'BTC',
            'user_id' => 2
        ]);

        Crypto::create([
            'name' => 'ETH',
            'price' => 400,
            'choices' => 'low',
            'choices_value' => 'BTC',
            'user_id' => 1
        ]);

        Crypto::create([
            'name' => 'ETH',
            'price' => 450,
            'choices' => 'high',
            'choices_value' => 'BTC',
            'user_id' => 2
        ]);
    }
}
