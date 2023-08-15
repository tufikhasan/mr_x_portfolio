<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table( 'socials' )->insert( [
            'twitter_link'  => 'https://twitter.com/tufik_hasan',
            'github_link'   => 'https://github.com/tufikhasan',
            'linkedin_link' => 'https://www.facebook.com/ami.toufiq',
        ] );
    }
}
