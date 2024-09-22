<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentGateway;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$gateway = [

    	['name' =>'Stripe', 'is_active'=>'Y', 'credentials'=>'123456789', 'slug' => 'stripe','fees' => '20', 'min' => '10'],

        ['name' =>'Pay Pal', 'is_active'=>'N', 'credentials'=>'123456789', 'slug' => 'paypal','fees' => '25', 'min' => '10'],

                   ];
    	
    	foreach ($gateway as $key => $value) {
        
        $check_gateway=PaymentGateway::where('slug', $value['slug'])->first();

        if($check_gateway){
            
            PaymentGateway::where('slug', $value['slug'])->update($gateway[$key]);

        }else{

            PaymentGateway::insert($gateway[$key]);        
        }
        }
    }
}
