<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private const BILLIONAIRE_PASSWORD = 3457888;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Миллиардер',
            'email' => 'money@bk.ru',
            'password' => Hash::make(self::BILLIONAIRE_PASSWORD)
        ]);
    }
}
