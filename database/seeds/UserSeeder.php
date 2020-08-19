<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
          'name' => '周祐宇',
          'email' => 'jhouyouyu@gmail.com',
          'password'  =>  Hash::make('123456789'),
        ]);

        User::create([
          'name' => 'ジョウヨウユー',
          'email' => 'jack40508@gmail.com',
          'password'  =>  Hash::make('123456789'),
        ]);

        User::create([
          'name' => 'Jhou you yu',
          'email' => 'yoyu930310@gmail.com',
          'password'  =>  Hash::make('123456789'),
        ]);
    }
}
