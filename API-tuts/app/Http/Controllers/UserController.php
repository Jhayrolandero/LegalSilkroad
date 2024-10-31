<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers() {
        $users = User::all(); 
        
        return response()->json(["data" => $users]);
    }

    public function addUser(Request $request) {
        try {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        
        $user->save();
        
        } catch(\Throwable $e) {
            report($e);
        }
    }
}
