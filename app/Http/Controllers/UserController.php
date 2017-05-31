<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Image;
use Mail;
use Validator;
use Session;



use App\Mail\ConfirmationEmail;
use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{


  public function __contruct()

  {

  //  $this->middleware('guest', ['except' => 'destroy']);
    $this->middleware('guest');

  }


  //list users
  public function index()
    {
        $users = User::paginate(10);
        $title = 'List users';

        return view('user.index', compact('users'));
        //return view('user.edit', compact('title', 'user'));
    }



/*    public function create()

    {
      //return view('sessions.create');
      return view('registration.create');
    }


    public function store()
    {

  //Validar a Form dos users

      $this->validate(request(), [

        'name' => 'required',

        'email' => 'required|email',

        'password' => 'required|confirmed',

        'admin' => 'required',

        'blocked' => 'required',

        'print_evals' => 'required',

        'print_counts' => 'required',

        'department_id' => 'required',

      ]);


  //criar e guardar o user

  //$user = User::create(request(['name', 'email', 'password', 'admin', 'blocked', 'print_evals', 'print_counts', 'department_id']));

  $user = User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password')),
        'admin' => request('admin'),
        'blocked' => request('blocked'),
        'print_evals' => request('print_evals'),
        'print_counts' => request('print_counts'),
        'department_id' => request('department_id')
      ]);
  //iniciar sess

  auth()->login($user);

  //redirecionar para a pagina Admins (no inicio sera testado o redirect para a pagina Home)

  return redirect()->home();

  }

  */



  public function create()
  {
      //$this->authorize('create', User::class);
      //$title = 'Add user';
      $user = new User();
      return view('registration.create');
  }

  public function store(CreateUserPostRequest $request)
  {
    //  $this->authorize('create', User::class);
    //  $title = 'Add user';  //->except(['_token'])


      $user = User::create($request->input());

      $user->password = password_hash($user->password, PASSWORD_DEFAULT);
              $message = ['message_success' => 'User created successfully'];
      if (!$user->save()) {
          $message = ['message_error  ' => 'Failed to create user'];
      }

      Mail::to($user->email)->send(new ConfirmationEmail($user));

// visto ser ativado por email nao iremos autenticar logo pois a conta está bloqueada
//    auth()->login($user);

      return redirect()->route('home')->with('status', 'Please confirm your email address');
      //return home()
  }


    public function destroy(User $user)
    {
      $this->authorize('delete', $user);
      $message = ['message_success' => 'User removed successfully'];
      if (!$user->delete()) {
          $message = ['message_error' => 'Failed to remove user'];
      }
      return redirect()->route('index')->with($message);
    }


    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $title = 'Edit user';
        // Já não é necessário quando se usa Route Model Binding
        //$user = User::findOrFail($id);
        return view('user.edit', compact('title', 'user'));
    }



  public function profile()
  {
    return view('user.profile', array('user' => Auth::user()) );
  }

  public function showProfile($id)
  {
      //tem de mostrar o user que está na mesma linha da tabela e quando aparecer, mostra so informaçoes sem dar para editar
      $user= User::find($id);
      return view('user.profile', compact('user'));
  }


  public function update_avatar(Request $request)
  {
    //composer require intervention/image || tratar o avatar - handling de imagens em php

    $user = Auth::user();
    //$this->authorize('update', $user);

    if($request->hasFile('profile_photo')){
    		$profile_photo = $request->file('profile_photo');
    		$filename = time() . '.' . $profile_photo->getClientOriginalExtension();
    		Image::make($profile_photo)->resize(300, 300)->save( public_path('/img/profile_photo' . $filename ) );
    		$user = Auth::user();
    		$user->profile_photo = $filename;
        $user->fill($request->input());
        $user->save();

    	}
    	return view('user.profile', array('user' => Auth::user()) );
    }




    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $title = 'Edit user';

        $user->fill($request->input());

        $message = ['message_success' => 'User saved successfully'];
        if (!$user->save()) {
            $message = ['message_error' => 'Failed to save user'];
        }
        return redirect()->route('index')->with($message);
    }


    public function update_profile(Request $request)

    {

      $user = Auth::user();
      $this->authorize('update', $user);
      $user->fill($request->input());
      $user->password = password_hash($user->password, PASSWORD_DEFAULT);
      $user->save();

      $message = ['message_success' => 'User profile edited successfully'];
      if (!$user->save()) {
        $message = ['message_error' => 'Failed to edit user profile'];

      }

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

    public function login_post(Request $request)

    { //tentar autenticar o user | + ['blocked' => true]
        $user = User::where('email', '=', $request['email'])->first();


        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
            'blocked' => $user->blocked,
            'activated' => $user->activated
        ];
        //dd($credentials);


        if ((!Auth::attempt($credentials)) || $credentials['blocked'] == "1" || $credentials['activated'] == "0") {

            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }

        return redirect()->home();
    }


  /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->hasVerified();
        return redirect('login')->with('status', 'You are now confirmed. Please login.');
    }

    public function showBlokedUsers()
    {
        $blockedUsers = User::where('blocked',1)->paginate(5);
        $unblockedUsers = User::where('blocked',0)->paginate(5);

        return view('user.manageBlock', compact('blockedUsers','unblockedUsers'));
    }

    public function blockUser($id)
    {
        User::where('id',$id)->update(['blocked'=>1]);

        return back();
    }

    public function unblockUser($id)
    {
        User::where('id',$id)->update(['blocked'=>0]);

        return back();
    }

    public function showUsersRole()
    {
        $normalUsers = User::where('admin',0)->paginate(5);
        $adminUsers = User::where('admin',1)->paginate(5);

        return view('user.manageRole', compact('normalUsers','adminUsers'));
    }

    public function givePrivileges($id)
    {
        User::where('id',$id)->update(['admin'=>1]);

        return back();
    }

    public function removePrivileges($id)
    {
        User::where('id',$id)->update(['admin'=>0]);

        return back();
    }

}
