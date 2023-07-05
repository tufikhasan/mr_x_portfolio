<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\About;
use App\Models\HeroProperties;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    function page() {
        $seo = DB::table( 'seo_properties' )->where( 'page_name', 'home' )->first();
        return view( 'frontend.pages.home', compact( 'seo' ) );
    }

    function getHeroProperty() {
        $data = HeroProperties::first();
        return view( 'admin.sections.hero_property', compact( 'data' ) );
    }
    function updateHeroProperty( Request $request ) {
        $request->validate( ['title' => 'required'], ['title.required' => 'Title is Required'] );

        $data = HeroProperties::findOrFail( $request->id );
        $imageUrl = $data->image;
        if ( $request->hasFile( 'image' ) ) {
            if ( $data->image ) {
                if ( file_exists( Helper::static_path( 'upload/about/' . $data->image ) ) ) {
                    unlink( Helper::static_path( 'upload/about/' . $data->image ) );
                }
            }
            $image = $request->file( 'image' );
            $imageUrl = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            $image->move( Helper::static_path( 'upload/about' ), $imageUrl );
        }
        $data->update( [
            'key_line'    => $request->key_line,
            'short_title' => $request->short_title,
            'title'       => $request->title,
            'image'       => $imageUrl,
        ] );

        return response()->json( ['status' => 'success'] );
    }

    function aboutInfo() {
        $data = About::first();
        return view( 'admin.sections.about', compact( 'data' ) );
    }
    function updateAboutInfo( Request $request ) {
        About::findOrFail( $request->id )->update( [
            'title'   => $request->title,
            'details' => $request->details,
        ] );

        return response()->json( ['status' => 'success'] );
    }

    function getSocial() {
        $data = Social::first();
        return view( 'admin.sections.socials_link', compact( 'data' ) );
    }
    function updateSocial( Request $request ) {
        Social::findOrFail( $request->id )->update( [
            'twitter_link'  => $request->twitter_link,
            'github_link'   => $request->github_link,
            'linkedin_link' => $request->linkedin_link,
        ] );
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Ajax method list below
     */
    function heroData() {
        $data = DB::table( 'hero_properties' )->first();
        return $data;
    }
    function aboutData() {
        $data = DB::table( 'abouts' )->first();
        return $data;
    }
    function socialData() {
        $data = DB::table( 'socials' )->first();
        return $data;
    }
}
