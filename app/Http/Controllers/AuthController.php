<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirectLogin(Request $request){
 
        $user = Auth::user();
        
        if ($user->hasRole('super_admin')) {
            return redirect()->route('super-admin-index');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin-index');
        } elseif ($user->hasRole('user')) {
            return redirect()->route('user-index');
        } else {
            
            return redirect()->route('login');
        }
    }
}
