<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'gilmouralmalbiss@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Gil',
                'email' => 'gilmouralmalbiss@gmail.com',
                'role' => 'admin',
                'about' => 'initial admin',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
