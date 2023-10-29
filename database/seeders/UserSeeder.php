<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()->firstOrCreate(['username' => 'super'], [
            'name' => 'super',
            'password' => 'super',
            'email' => 'super@gmail.com',
        ]);
        $user->syncRoles(['super admin']);
    }
}
