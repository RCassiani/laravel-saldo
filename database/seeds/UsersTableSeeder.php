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
        User::create([
            'name'      =>  'Rodrigo Cassiani',
            'email'     =>  'rcassiani@outlook.com',
            'password'  =>  bcrypt('123'),
        ]);

        User::create([
            'name'      =>  'Heloisa Miranda',
            'email'     =>  'hmiranda@outlook.com',
            'password'  =>  bcrypt('123456'),
        ]);
    }
}
