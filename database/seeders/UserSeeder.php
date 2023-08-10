<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'John Doe';
        $user->email = 'john@example.com';
        $user->active = 1;
        $user->password = Hash::make('johndoe1234');
        $user->save();

        $user->assignRole(Role::where('name', 'Super admin')->first());
    }
}
