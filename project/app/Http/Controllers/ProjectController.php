<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller {
    function page() {
        $seo = DB::table( 'seo_properties' )->where( 'page_name', 'project' )->first();
        return view( 'frontend.pages.project', compact( 'seo' ) );
    }

    function getProject() {
        $projects = Project::latest()->paginate( 5 );
        return view( 'admin.project.projects', compact( 'projects' ) );
    }
    function addProject( Request $request ) {
        $request->validate( [
            'title'        => 'required',
            'preview_link' => 'required',
            'details'      => 'required',
        ], [
            'title.required'        => 'Title is Required',
            'preview_link.required' => 'Preview Link is Required',
            'details.required'      => 'Details is Required',
        ] );
        $image_url = null;
        if ( $request->hasFile( 'thumbnail_link' ) ) {
            $image = $request->file( 'thumbnail_link' );
            $image_url = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            $image->move( Helper::static_path( 'upload/project' ), $image_url );
        }
        Project::insert( [
            'title'          => $request->title,
            'preview_link'   => $request->preview_link,
            'details'        => $request->details,
            'thumbnail_link' => $image_url,
        ] );
        return response()->json( ['status' => 'success'] );
    }
    function updateProject( Request $request ) {
        $project = Project::findOrFail( $request->id );
        $image_url = $project->thumbnail_link;

        $request->validate( [
            'title'        => 'required',
            'preview_link' => 'required',
            'details'      => 'required',
        ], [
            'title.required'        => 'Title is Required',
            'preview_link.required' => 'Preview Link is Required',
            'details.required'      => 'Details is Required',
        ] );

        if ( $request->hasFile( 'thumbnail_link' ) ) {
            if ( $project->thumbnail_link ) {
                unlink( Helper::static_path( 'upload/project' . $project->thumbnail_link ) );
            }
            $image = $request->file( 'thumbnail_link' );
            $image_url = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            $image->move( Helper::static_path( 'upload/project' ), $image_url );
        }
        $project->update( [
            'title'          => $request->title,
            'preview_link'   => $request->preview_link,
            'details'        => $request->details,
            'thumbnail_link' => $image_url,
        ] );
        return response()->json( ['status' => 'success'] );
    }

    function deleteProject( Request $request ) {
        $project = Project::findOrFail( $request->id );
        if ( $project->thumbnail_link ) {
            unlink( Helper::static_path( 'upload/project/' . $project->thumbnail_link ) );
        }
        $project->delete();
        return response()->json( ['status' => 'success'] );
    }

    function projectPaginate() {
        $projects = Project::latest()->paginate( 5 );
        return view( 'admin.project.project_paginate', compact( 'projects' ) )->render();
    }
    function searchProject( Request $request ) {
        $projects = Project::where( 'title', 'like', '%' . $request->search_string . '%' )->where( 'details', 'like', '%' . $request->search_string . '%' )
            ->orderBy( 'id', 'desc' )->paginate( 5 );

        if ( $projects->count() >= 1 ) {
            return view( 'admin.project.project_paginate', compact( 'projects' ) )->render();
        } else {
            return response()->json( ['status' => 'not-found'] );
        }
    }

    /**
     * Ajax method list below
     */
    function projectData() {
        $data = DB::table( 'projects' )->get();
        return $data;
    }
}
