<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeoPropertiesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table( 'seo_properties' )->insert( [
            [
                'page_name'     => 'home',
                'title'         => 'Home Page',
                'keywords'      => 'home',
                'description'   => 'This is home page',
                'ogSiteName'    => 'Home Page',
                'ogUrl'         => '/',
                'ogTitle'       => 'Home Page',
                'ogDescription' => 'This is home page',
                'ogImage'       => '',
            ],
            [
                'page_name'     => 'about',
                'title'         => 'About Page',
                'keywords'      => 'about',
                'description'   => 'This is about page',
                'ogSiteName'    => 'About Page',
                'ogUrl'         => '/',
                'ogTitle'       => 'About Page',
                'ogDescription' => 'This is about page',
                'ogImage'       => '',
            ],
            [
                'page_name'     => 'resume',
                'title'         => 'Resume Page',
                'keywords'      => 'resume',
                'description'   => 'This is resume page',
                'ogSiteName'    => 'Resume Page',
                'ogUrl'         => '/',
                'ogTitle'       => 'Resume Page',
                'ogDescription' => 'This is resume page',
                'ogImage'       => '',
            ],
            [
                'page_name'     => 'contact',
                'title'         => 'Contact Page',
                'keywords'      => 'contact',
                'description'   => 'This is contact page',
                'ogSiteName'    => 'Contact Page',
                'ogUrl'         => '/',
                'ogTitle'       => 'Contact Page',
                'ogDescription' => 'This is contact page',
                'ogImage'       => '',
            ],
        ] );
    }
}
