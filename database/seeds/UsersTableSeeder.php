<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $user = DB::table('users')->where('email','full@fullc.om')->first();

        if (! $user) {
        	user::Create ([
        		'name' => 'mail@mail.com',
        	    'email' => 'mail@mail.com',
        	    'password' => Hash::make('mail@mail.com'),
        	    'role' => 'admin'

        	]);
        	
        }
    }
}
