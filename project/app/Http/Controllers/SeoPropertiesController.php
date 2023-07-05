<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SeoProperties;
use Illuminate\Http\Request;

class SeoPropertiesController extends Controller {
    function homeSeo() {
        $data = SeoProperties::where( 'page_name', 'home' )->first();
        return view( 'admin.seo.home_seo', compact( 'data' ) );
    }
    function aboutSeo() {
        $data = SeoProperties::where( 'page_name', 'project' )->first();
        return view( 'admin.seo.about_seo', compact( 'data' ) );
    }
    function resumeSeo() {
        $data = SeoProperties::where( 'page_name', 'resume' )->first();
        return view( 'admin.seo.resume_seo', compact( 'data' ) );
    }
    function contactSeo() {
        $data = SeoProperties::where( 'page_name', 'contact' )->first();
        return view( 'admin.seo.contact_seo', compact( 'data' ) );
    }
    function updateSeo( Request $request ) {
        $request->validate( [
            'title' => 'required',
        ], [
            'title.required' => 'Title is Required',
        ] );
        $seo_data = SeoProperties::findOrFail( $request->id );

        $imageUrl = $seo_data->ogImage;
        if ( $request->hasFile( 'ogImage' ) ) {
            if ( $seo_data->ogImage ) {
                unlink( Helper::static_path( 'upload/seo/' . $seo_data->ogImage ) );
            }
            $image = $request->file( 'ogImage' );
            $imageUrl = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            $image->move( Helper::static_path( 'upload/seo' ), $imageUrl );
        }

        $seo_data->update( [
            'title'         => $request->title,
            'keywords'      => $request->keywords,
            'description'   => $request->description,
            'ogSiteName'    => $request->ogSiteName,
            'ogUrl'         => $request->ogUrl,
            'ogTitle'       => $request->ogTitle,
            'ogDescription' => $request->ogDescription,
            'ogImage'       => $imageUrl,
        ] );
        return response()->json( ['status' => 'success'] );
    }
}
