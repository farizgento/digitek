<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    use PasswordValidationRules;

    public function getAllAdmin(Request $request){

        if(Auth::user()->hasRole('super_admin')) {
            $admins = User::role('admin')->with('sekolah')->paginate(10);
            $sekolahs = Sekolah::all();
            return view('super-admin.admin', compact('admins','sekolahs'));
        } else {
            // Handle unauthorized access (e.g., redirect or show an error)
            return abort(403, 'Unauthorized');
        }
    }
    public function addAdmin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'sekolah_id' => 'required',
            'role' => ['required', 'string'],
        ]);
        if($validator->fails()){
            Alert::error('Error', $validator->errors()->first());
            return back()->withErrors($validator)->withInput();
        } else {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'sekolah_id' => $request->input('sekolah_id'),
                'password' => Hash::make($request->input('password')),
            ]);
        
            // Assign the default role to the user
            $user->assignRole($request->input('role'));
        
            return redirect()->route('admin-superadmin')->with('success', 'Berhasil ditambahkan');
        }
    }
    
}
