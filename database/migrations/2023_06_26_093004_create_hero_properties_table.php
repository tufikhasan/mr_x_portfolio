<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create( 'hero_properties', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'key_line' )->nullable();
            $table->string( 'title' )->nullable();
            $table->string( 'short_title' )->nullable();
            $table->string( 'image' )->nullable();
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists( 'hero_properties' );
    }
};
