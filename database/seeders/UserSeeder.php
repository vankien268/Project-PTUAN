<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::truncate();
		// admin
		$admin = User::create([
			'username' => 'admin',
			'password' => Hash::make('123'),
			'email' => 'ducconit@gmail.com',
			'mobile' => '0123456789',
			'name' => 'Administrator'
		]);

		// Tạo 50 người
		User::factory(50)->create();
	}
}
