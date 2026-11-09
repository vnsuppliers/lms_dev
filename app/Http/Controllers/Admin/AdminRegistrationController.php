<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Users;

class AdminRegistrationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function admin_users()
    {
        return view('admin.users.users');
    }

    public function user_registrations_store(Request $request)
    {

        // dd($request->all());

        $userData = $request->except('_token');

    // Create a new user with the request data
    $user = Users::create($userData);

    //dd('stored');   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}