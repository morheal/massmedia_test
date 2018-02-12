<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\User;

class UserController extends Controller
{
    public function subscribe()
    {
      Auth::user()->subcribe();
      return Response::json(true);
    }

    public function unsubscribe()
    {
      Auth::user()->unsubcribe();
      return Response::json(true);
    }

    public function userProfile($id)
    {
      $this_user = User::find($id);
      return view('users.user', ['this_user' => $this_user]);
    }
}
