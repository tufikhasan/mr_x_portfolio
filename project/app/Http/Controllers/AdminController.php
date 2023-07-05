<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller {
    /**
     * Destroy an authenticated session.
     */
    public function adminLogout( Request $request ): RedirectResponse{
        Auth::guard( 'web' )->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = [
            'message'    => "Logout Successfully",
            'alert-type' => 'success',
        ];
        return redirect( '/login' )->with( $notification );
    }
    function adminProfile(): View{
        $id = Auth::user()->id;
        $adminData = User::find( $id );
        return view( 'admin.profile.profile', compact( 'adminData' ) );
    }
    function editProfile( Request $request ): View{
        $adminData = User::find( $request->id );
        return view( 'admin.profile.edit_profile', compact( 'adminData' ) );
    }
    function updateProfile( Request $request ) {
        $id = Auth::user()->id;
        $user = User::find( $id );
        $imageUrl = $user->profile_image;
        if ( $request->hasFile( 'profile_image' ) ) {
            if ( $user->profile_image ) {
                if ( file_exists( Helper::static_path( 'upload/admin_images/' . $user->profile_image ) ) ) {
                    unlink( Helper::static_path( 'upload/admin_images/' . $user->profile_image ) );
                }
            }
            $image = $request->file( 'profile_image' );
            $imageUrl = hexdec( uniqid() ) . '.' . $image->getClientOriginalExtension();
            $image->move( Helper::static_path( 'upload/admin_images' ), $imageUrl );
        }
        $user->update( [
            'name'          => $request->name,
            'email'         => $request->email,
            'profile_image' => $imageUrl,
        ] );

        // $notification = [
        //     'message'    => "Profile Updated Successfully",
        //     'alert-type' => 'success',
        // ];
        // return redirect()->route( 'admin.profile' )->with( $notification );
        return response()->json( ['status' => 'success'] );

    }

    function changePassword(): View {
        return view( 'admin.profile.change_password' );
    }
    function updatePassword( Request $request ) {
        $request->validate( [
            'old_password'     => 'required',
            'new_password'     => 'required',
            'confirm_password' => 'required|same:new_password',
        ] );

        $hashPassword = Auth::user()->password;
        if ( Hash::check( $request->old_password, $hashPassword ) ) {
            $user = User::find( Auth::id() );
            $user->password = bcrypt( $request->new_password );
            $user->save();
            session()->flash( 'message', 'Password Updated Successfully' );
            return redirect()->back();
        } else {
            session()->flash( 'message', 'Old Password Not Match' );
            return redirect()->back();
        }
    }

}
