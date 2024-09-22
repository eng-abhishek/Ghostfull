<?php

use Illuminate\Database\Seeder;
use App\Models\Setting\StorageProvider;

class StorageProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$storage = [

    	['name' =>'Local Storage (Default)', 'is_active'=>'Y', 'credentials'=>'123456789', 'slug' => 'local_storage'],

    	['name' =>'Amazon S3', 'is_active'=>'N', 'credentials'=>'123456789', 'slug' => 'amazon_s3'],

    	['name' =>'Wasabi Cloud Storage', 'is_active'=>'N', 'credentials'=>'123456789', 'slug' => 'wasabi_cloud_storage'],

    	['name' =>'Storj', 'is_active'=>'N', 'credentials'=>'123456789', 'slug' => 'storj'],
    	
    	['name' =>'Digitalocean Spaces', 'is_active'=>'N', 'credentials'=>'123456789', 'slug' => 'digitalocean_spaces']

                   ];
    	
    	foreach ($storage as $key => $value) {
        
        $check_storage=StorageProvider::where('slug', $value['slug'])->first();

        if($check_storage){
            
            StorageProvider::where('slug', $value['slug'])->update($storage[$key]);

        }else{

            StorageProvider::insert($storage[$key]);        
        }
        }
    }
}
