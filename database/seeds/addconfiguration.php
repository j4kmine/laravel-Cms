<?php

use Illuminate\Database\Seeder;

class addconfiguration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('configuration')->insert([
        	'id'=> null
            'meta_title' => str_random(10),
            'meta_description' => str_random(10),
            'meta_keyword' => str_random(10),
            'alamat' => str_random(10),
            'no_hp' => str_random(10),
            'no_fax' => str_random(10),
            'twitter_url' => str_random(10),
            'gplus_url' => str_random(10),
            'instagram_url' => str_random(10),
            'site_title' => str_random(10),
            'main_cover' => 'main_cover.jpg',
            'destinasi_cover' => 'destinasi_cover.jpg',
            'video_cover' => 'video_cover.jpg',
            'video_img' => str_random(10),
            'video_url' => str_random(10),
            'video_desc' => str_random(100),
            'email' => str_random(10).'@gmail.com',
            
        ]);
    }
}
