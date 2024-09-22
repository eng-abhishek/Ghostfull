<?php

use Illuminate\Database\Seeder;
use App\Models\Setting\Upload;

class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uploads = [
                  
        ['name' =>'User Uploads', 'is_active'=>'Y', 'slug' => 'user', 'storage_space'=>'1073741824','size_per_file'=>'3145728','file_expired_in'=>'15','upload_at_once'=>'5','password_protection'=>'N','advertisements'=>'N'],
        
        ['name' =>'Gust Uploads', 'is_active'=>'N', 'slug' => 'guest', 'storage_space'=>'1073741824','size_per_file'=>'3145728','file_expired_in'=>'15','upload_at_once'=>'5','password_protection'=>'N','advertisements'=>'N']
                  
                  ];
        
        foreach ($uploads as $key => $value) {
        
        $check_data=Upload::where('slug', $value['slug'])->first();

        if($check_data){
            
          Upload::where('slug', 'user')->update($uploads[$key]);
          
          }else{

          Upload::insert($uploads[$key]);
         }
        }

      }

}
