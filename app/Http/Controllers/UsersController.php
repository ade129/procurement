<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Items;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
       $contents = [
         'users' => User::all(),
       ];
       // dd($contents);
       $pagecontent = view('users.index',$contents);

       //masterpage
       $pagemain = array(
           'title' => 'Users Profile',
           'menu' => 'master',
           'submenu' => 'users',
           'pagecontent' => $pagecontent,
       );

       return view('masterpage', $pagemain);
    }

    public function update_page(User $user)
    {
       $content = [
         'user' => User::find($user->idusers),
       ];

       $pagecontent = view('users.update',$content);

       //masterpage
       $pagemain = array(
           'title' => 'Users Profile',
           'menu' => 'setting',
           'submenu' => 'user',
           'pagecontent' => $pagecontent,
       );

       return view('masterpage', $pagemain);
    }

    public function update_save(Request $request, User $user)
    {
        $request->validate([
             'email' => 'required',
             'name' => 'required',
         ]);

         $saveUpdateUser = User::find($user->idusers);
         $saveUpdateUser->name = $request->name;
         $saveUpdateUser->email = $request->email;
         $saveUpdateUser->create = $request->create;
         $saveUpdateUser->view = $request->view;
         $saveUpdateUser->delete =  $request->delete;
         $saveUpdateUser->read = $request->read;
         $saveUpdateUser->print = $request->print;
         $saveUpdateUser->approve = $request->approve;
         $saveUpdateUser->save();

        return redirect('users')->with('status_success','User updated');
    }

    // public function history_Order(User $user)
    // {
    //   $users = User::with('orders','items')->where('idusers',$user->idusers)->get();
    //
    //   $contents = [
    //     'users' => $users,
    //   ];
    //   // return $contents;
    //
    //   $pagecontent = view('users.history_user',$contents);
    //   //masterpage
    //   $pagemain = array(
    //       'title' => 'History Orders',
    //       'menu' => 'Orders',
    //       'submenu' => '',
    //       'pagecontent' => $pagecontent,
    //   );
    //
    //   return view('masterpage', $pagemain);
    // }
}
