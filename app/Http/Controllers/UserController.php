<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Image;

use Validator;

use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{


  public function __contruct()

  {

    //$this->middleware('guest', ['except' => 'destroy']);
    $this->middleware('auth');

  }


  //list users
  public function index()
    {
        $users = User::all();
        $title = 'List users';
        return view('users.index', compact('title', 'users'));
    }



    public function create()
    {
        $this->authorize('create', User::class);
        $title = 'Add user';
        $user = new User();
        return view('users.add', compact('title', 'user'));
    }


    public function store(CreateUserPostRequest $request)
    {
        $this->authorize('create', User::class);
        $title = 'Add user';
        $user = User::create($request->input());
        $user->password = password_hash($user->password, PASSWORD_DEFAULT);
                $message = ['message_success' => 'User created successfully'];
        if (!$user->save()) {
            $message = ['message_error' => 'Failed to create user'];
        }
        return redirect()->route('users.index')->with($message);
    }


    public function destroy(User $user)
    {
      $this->authorize('delete', $user);
      $message = ['message_success' => 'User removed successfully'];
      if (!$user->delete()) {
          $message = ['message_error' => 'Failed to remove user'];
      }
      return redirect()->route('users.index')->with($message);
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $title = 'Edit user';
        // Já não é necessário quando se usa Route Model Binding
        //$user = User::findOrFail($id);
        return view('users.edit', compact('title', 'user'));
    }



  public function profile()
  {

    return view('user.profile', array('user' => Auth::user()) );

  }


  public function update_avatar(UpdateUserRequest $request)
  {
    //composer require intervention/image || tratar o avatar - handling de imagens em php

    //$user = Auth::user();
    //$this->authorize('update', $user);

    if($request->hasFile('profile_photo')){
    		$profile_photo = $request->file('profile_photo');
    		$filename = time() . '.' . $profile_photo->getClientOriginalExtension();
    		Image::make($profile_photo)->resize(300, 300)->save( public_path('/img/profile_photo' . $filename ) );
    		$user = Auth::user();
    		$user->profile_photo = $filename;
        //$user->fill($request->input());
        $user->save();
    	}
    	return view('user.profile', array('user' => Auth::user()) );
    }


    public function update_profile(Request $request)

    {

      $user = Auth::user();
      $this->authorize('update', $user);
      $user->fill($request->input());
      $user->save();

      return view('user.profile', array('user' => Auth::user()) );

    }


  public function logout()

  {

    auth()->logout();

    return redirect()->home();

  }

  public function login_get()

  {
    return view ('user.login');

  }

  public function login_post()

  { //tentar autenticar o user

    if(! auth()->attempt(request(['email', 'password']))){

      return back()->withErrors([

        'message' => 'Please check your credentials and try again.'
      ]);
    }

    return redirect()->home();
  }

}
