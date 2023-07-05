<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create( 'seo_properties', function ( Blueprint $table ) {
            $table->id();
            $table->enum( 'page_name', ['home', 'project', 'contact', 'resume'] );
            $table->string( 'title' )->nullable();
            $table->string( 'keywords' )->nullable();
            $table->string( 'description' )->nullable();
            $table->string( 'ogSiteName' )->nullable();
            $table->string( 'ogUrl' )->nullable();
            $table->string( 'ogTitle' )->nullable();
            $table->string( 'ogDescription' )->nullable();
            $table->string( 'ogImage' )->nullable();
            $table->timestamp( 'created_at' )->useCurrent();
            $table->timestamp( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
        } );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists( 'seo_properties' );
    }
};
