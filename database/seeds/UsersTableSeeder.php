<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name' => 'Chris',
            'email' => 'gatch14@gmail.com',
            'password' => Hash::make('12345')
        ]);

        User::create([
            'name' => 'gatch',
            'email' => 'ssobgib@hotmail.com',
            'password' => Hash::make('12345')
        ]);
    }
}
