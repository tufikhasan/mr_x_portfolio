<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller {
    function getEducation() {
        $educations = Education::latest()->paginate( 5 );
        return view( 'admin.education.educations', compact( 'educations' ) );
    }
    function addEducation( Request $request ) {
        $request->validate( [
            'duration'       => 'required',
            'institute_name' => 'required',
            'field'          => 'required',
        ], [
            'duration.required'       => 'Duration is Required',
            'institute_name.required' => 'Institute name is Required',
            'field.required'          => 'Field name is Required',
        ] );
        Education::insert( [
            'duration'       => $request->duration,
            'institute_name' => $request->institute_name,
            'field'          => $request->field,
            'details'        => $request->details,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function updateEducation( Request $request ) {
        $request->validate( [
            'duration'       => 'required',
            'institute_name' => 'required',
            'field'          => 'required',
        ], [
            'duration.required'       => 'Duration is Required',
            'institute_name.required' => 'Institute name is Required',
            'field.required'          => 'Field name is Required',
        ] );
        Education::findOrFail( $request->id )->update( [
            'duration'       => $request->duration,
            'institute_name' => $request->institute_name,
            'field'          => $request->field,
            'details'        => $request->details,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function deleteEducation( Request $request ) {
        Education::findOrFail( $request->id )->delete();
        return response()->json( ['status' => 'success'] );
    }
    function educationPaginate() {
        $educations = Education::latest()->paginate( 5 );
        return view( 'admin.education.education_paginate', compact( 'educations' ) )->render();
    }
    function searchEducation( Request $request ) {
        $educations = Education::where( 'duration', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'institute_name', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'field', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'details', 'like', '%' . $request->search_string . '%' )
            ->orderBy( 'id', 'desc' )
            ->paginate( 5 );

        if ( $educations->count() >= 1 ) {
            return view( 'admin.education.education_paginate', compact( 'educations' ) )->render();
        } else {
            return response()->json( ['status' => 'not-found'] );
        }
    }
}
