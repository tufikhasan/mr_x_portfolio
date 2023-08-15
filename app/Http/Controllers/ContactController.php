<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller {
    function page() {
        $seo = DB::table( 'seo_properties' )->where( 'page_name', 'contact' )->first();
        return view( 'frontend.pages.contact', compact( 'seo' ) );
    }
    /**
     * Ajax method list below
     */
    function storeContact( Request $request ) {
        DB::table( 'contacts' )->insert( [
            'full_name' => $request->full_name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'message'   => $request->message,
        ] );
        return response()->json( ['status' => 'success'], 201 );
    }
}
