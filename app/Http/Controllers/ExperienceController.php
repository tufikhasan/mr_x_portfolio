<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller {
    function getExperience() {
        $experiences = Experience::latest()->paginate( 5 );
        return view( 'admin.experience.experiences', compact( 'experiences' ) );
    }
    function addExperience( Request $request ) {
        $request->validate( [
            'duration'    => 'required',
            'title'       => 'required',
            'designation' => 'required',
        ], [
            'duration.required'    => 'Duration is Required',
            'title.required'       => 'Title is Required',
            'designation.required' => 'Designation name is Required',
        ] );
        Experience::insert( [
            'duration'    => $request->duration,
            'title'       => $request->title,
            'designation' => $request->designation,
            'details'     => $request->details,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function updateExperience( Request $request ) {
        $request->validate( [
            'duration'    => 'required',
            'title'       => 'required',
            'designation' => 'required',
        ], [
            'duration.required'    => 'Duration is Required',
            'title.required'       => 'Title is Required',
            'designation.required' => 'Designation name is Required',
        ] );
        Experience::findOrFail( $request->id )->update( [
            'duration'    => $request->duration,
            'title'       => $request->title,
            'designation' => $request->designation,
            'details'     => $request->details,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function deleteExperience( Request $request ) {
        Experience::findOrFail( $request->id )->delete();
        return response()->json( ['status' => 'success'] );
    }
    function experiencePaginate() {
        $experiences = Experience::latest()->paginate( 5 );
        return view( 'admin.experience.experience_paginate', compact( 'experiences' ) )->render();
    }
    function searchExperience( Request $request ) {
        $experiences = Experience::where( 'duration', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'title', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'designation', 'like', '%' . $request->search_string . '%' )
            ->orWhere( 'details', 'like', '%' . $request->search_string . '%' )
            ->orderBy( 'id', 'desc' )
            ->paginate( 5 );

        if ( $experiences->count() >= 1 ) {
            return view( 'admin.experience.experience_paginate', compact( 'experiences' ) )->render();
        } else {
            return response()->json( ['status' => 'not-found'] );
        }
    }
}
