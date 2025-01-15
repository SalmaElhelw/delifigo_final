<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    //Display a listing of users
public function index()
{
    
    $users = User::all();
    return view('users.index', compact('users'));

}

   //show the form for creating a new user
   
   public function create()
   {
    
    return view('users.create');
   
   }

   //store a newly created user
   
   public function store(Request $request)
   {
      $request->validate([
        'name' => 'required',
        'email' => 'required|email|Unique::users,email',
        'password' =>'required|min::8',
      ]);
     
       user::create([

        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),

       ]);
    
    return redirect()->route('users.index');
    
    }

    //Display the specified user

     public function show(User $user)
     {
        
        return view('Users.show', compact('user'));
     
     }

    //show the form for editing the specified user

    public function edit(User $user)
    {

        return view('user.edit', compact('user'));

    }

    //update the specified user

    public function update(Request $request, User $user)
    {

        $request->validate([

        'name' => 'required',
        'email' => 'required|email|unique::users,email'  . $user->id,
        'password'=> 'unllable|min::8',
        
        ]);

        $user->update([

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);
      
        return redirect()->route('users.index');
    }

    //remove the specified user

    public function destory(User $user)
    {
        $user->delete();
        
         return redirect()->route('user.index');
    }



}
