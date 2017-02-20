<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
            'name' => 'Travis Obregon',
    		'username' => 'travisobregon',
    		'email' => 'travismobregon@gmail.com',
    		'password' => bcrypt('apple123'),
            'remember_token' => str_random(10),
            'created_at' => Carbon\Carbon::now(),
    		'updated_at' => Carbon\Carbon::now(),
		]);

        factory(App\User::class, 3)->create();
    }
}
