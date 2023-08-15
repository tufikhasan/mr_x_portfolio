<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller {
    function resumeLink() {
        $data = Resume::first();
        return view( 'admin.components.resume', compact( 'data' ) );
    }
    function updateResume( Request $request ) {
        $request->validate( ['download_link' => 'required|mimes:pdf'] );
        $data = Resume::findOrFail( $request->id );
        $download_link = $data->download_link;
        if ( $request->hasFile( 'download_link' ) ) {
            if ( $data->download_link && file_exists( 'upload/resume/' . $data->download_link ) ) {
                unlink( Helper::static_path( 'upload/resume/' . $data->download_link ) );
            }
            $pdf = $request->file( 'download_link' );
            $download_link = hexdec( uniqid() ) . '.' . $pdf->getClientOriginalExtension();
            $pdf->move( Helper::static_path( 'upload/resume' ), $download_link );
        }
        $data->update( [
            'download_link' => $download_link,
        ] );
        return response()->json( ['status' => 'success'] );
    }

    function page() {
        $seo = DB::table( 'seo_properties' )->where( 'page_name', 'resume' )->first();
        return view( 'frontend.pages.resume', compact( 'seo' ) );
    }
    /**
     * Ajax method list below
     */
    function resumeData() {
        $data = DB::table( 'resumes' )->first();
        $link = url( 'upload/resume/', $data->download_link );
        return response()->json( ['download_link' => $link] );
    }
    function experienceData() {
        $data = DB::table( 'experiences' )->latest()->get();
        return $data;
    }
    function educationData() {
        $data = DB::table( 'education' )->latest()->get();
        return $data;
    }
    function skillData() {
        $data = DB::table( 'skills' )->latest()->get();
        return $data;
    }
    function languageData() {
        $data = DB::table( 'languages' )->latest()->get();
        return $data;
    }
}
