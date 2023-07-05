<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroPropertiesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table( 'hero_properties' )->insert( [
            'key_line'    => 'DESIGN,DEVELOPMENT,MARKETING',
            'short_title' => 'I can help your business to',
            'title'       => 'Get online and grow fast',
            'image'       => null,
        ] );
    }
}
