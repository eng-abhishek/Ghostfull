<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
		'firstname' =>'admin',
		'lastname'=>'ji',
		'username'=>'admin',
		'email' => 'admin@gmail.com',
		'phone_number' => '1234567891',          
		'is_admin' => 'Y',
		'password' => Hash::make('123456789'),
		];

		$check_user=User::where('is_admin', 'Y')->first();
		
		if($check_user){
		User::where('is_admin', 'Y')->update($userData);

		}else{
		
		User::insert($userData);
		
		}
    }
}