<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


  public function __contruct()

  {

    $this->middleware('guest', ['except' => 'destroy']);

  }


  public function create()

  {
    return view ('user.login');

  }


  public function store()

  { //tentar autenticar o user

    if(! auth()->attempt(request(['email', 'password']))){

      return back()->withErrors([

        'message' => 'Please check your credentials and try again.'
      ]);
    }

    return redirect()->home();
  }


  public function profile()
  {

    return view('user.profile', array('user' => Auth::user()) );

  }


  public function update_avatar(Request $request)
  {
    //composer require intervention/image || tratar o avatar - handling de imagens em php

    if($request->hasFile('profile_photo')){
    		$profile_photo = $request->file('profile_photo');
    		$filename = time() . '.' . $profile_photo->getClientOriginalExtension();
    		Image::make($profile_photo)->resize(300, 300)->save( public_path('/img/profile_photo' . $filename ) );
    		$user = Auth::user();
    		$user->profile_photo = $filename;
    		$user->save();
    	}
    	return view('user.profile', array('user' => Auth::user()) );
    }



  public function destroy()

  {

    auth()->logout();

    return redirect()->home();

  }


}
