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
        //
        $user = new User();
        $user->name ="lamine";
        $user->email ="laminenatidiarra@yahoo.fr";
        $user->password = Hash::make('123456789');
        $user->save();
        $user->roles()->attach(1);

        $user = new User();
        $user->name ="harouna";
        $user->email ="laminenatiediarra@yahoo.fr";
        $user->password = Hash::make('123456789');
        $user->save();
        $user->roles()->attach(2);
    }
}
