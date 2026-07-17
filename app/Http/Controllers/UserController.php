<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


   public function index(Request $request)
{
    $search = $request->search;

    $users = User::with('roles')

        ->when($search,function($query) use($search){

            $query->where('name','like',"%{$search}%")
                  ->orWhere('email','like',"%{$search}%");

        })

        ->latest()

        ->paginate(10)

        ->withQueryString();

    return view(
        'users.index',
        compact('users','search')
    );
}



    public function create()
    {

        $roles = Role::all();


        return view(
            'users.create',
            compact('roles')
        );

    }




    public function store(Request $request)
    {


        $request->validate([

            'name'=>'required',

            'email'=>'required|email|unique:users',

            'password'=>'required',

            'role'=>'required'

        ]);



        $user = User::create([


            'name'=>$request->name,

            'email'=>$request->email,

            'password'=>Hash::make($request->password)

        ]);



        $user->assignRole($request->role);



        return redirect()
        ->route('users.index')
        ->with(
            'success',
            'User Created Successfully'
        );


    }


  public function edit(User $user)
{
    $roles = Role::all();

    return view('users.edit', compact('user','roles'));
}



public function update(Request $request, User $user)
{

    $request->validate([

        'name'=>'required',

        'email'=>'required|email',

        'role'=>'required'

    ]);

    $user->update([

        'name'=>$request->name,

        'email'=>$request->email,

    ]);

    if($request->password){

        $user->update([

            'password'=>Hash::make($request->password)

        ]);

    }

    $user->syncRoles([$request->role]);

    return redirect()

        ->route('users.index')

        ->with('success','User Updated Successfully');

}



public function destroy(User $user)
{

   if(Auth::user()?->id == $user->id){

        return back()->with(
            'error',
            'You cannot delete your own account.'
        );

    }

    $user->delete();

    return redirect()

        ->route('users.index')

        ->with(
            'success',
            'User Deleted Successfully'
        );

}




}