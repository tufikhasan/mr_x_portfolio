<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void{
        DB::table( 'abouts' )->insert( [
            'title'   => 'My name is Towfik Help and I help brands grow.',
            'details' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugit dolorum itaque qui unde quisquam consequatur autem. Eveniet quasi nobis aliquid cumque officiis sed rem iure ipsa! Praesentium ratione atque dolorem?',
        ] );
    }
}
