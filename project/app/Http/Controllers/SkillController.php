<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller {
    function getSkill() {
        $skills = Skill::latest()->paginate( 5 );
        return view( 'admin.skill.skills', compact( 'skills' ) );
    }
    function addSkill( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ], [
            'name.required' => 'Name is Required',
        ] );
        Skill::insert( [
            'name' => $request->name,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function updateSkill( Request $request ) {
        $request->validate( [
            'name' => 'required',
        ], [
            'name.required' => 'Name is Required',
        ] );
        Skill::findOrFail( $request->id )->update( [
            'name' => $request->name,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function deleteSkill( Request $request ) {
        Skill::findOrFail( $request->id )->delete();
        return response()->json( ['status' => 'success'] );
    }
    function skillPaginate() {
        $skills = Skill::latest()->paginate( 5 );
        return view( 'admin.skill.skill_paginate', compact( 'skills' ) )->render();
    }
    function searchSkill( Request $request ) {
        $skills = Skill::where( 'name', 'like', '%' . $request->search_string . '%' )
            ->orderBy( 'id', 'desc' )
            ->paginate( 5 );

        if ( $skills->count() >= 1 ) {
            return view( 'admin.skill.skill_paginate', compact( 'skills' ) )->render();
        } else {
            return response()->json( ['status' => 'not-found'] );
        }
    }
}
