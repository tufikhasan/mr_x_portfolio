<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller {
    function getLanguage() {
        $languages = Language::latest()->paginate( 5 );
        return view( 'admin.language.languages', compact( 'languages' ) );
    }
    function addLanguage( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ], [
            'name.required' => 'Name is Required',
        ] );
        Language::insert( [
            'name' => $request->name,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function updateLanguage( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ], [
            'name.required' => 'Name is Required',
        ] );
        Language::findOrFail( $request->id )->update( [
            'name' => $request->name,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function deleteLanguage( Request $request ) {
        Language::findOrFail( $request->id )->delete();
        return response()->json( ['status' => 'success'] );
    }
    function languagePaginate() {
        $languages = Language::latest()->paginate( 5 );
        return view( 'admin.language.language_paginate', compact( 'languages' ) )->render();
    }
    function searchlanguage( Request $request ) {
        $languages = Language::where( 'name', 'like', '%' . $request->search_string . '%' )
            ->orderBy( 'id', 'desc' )
            ->paginate( 5 );

        if ( $languages->count() >= 1 ) {
            return view( 'admin.language.language_paginate', compact( 'languages' ) )->render();
        } else {
            return response()->json( ['status' => 'not-found'] );
        }
    }
}
