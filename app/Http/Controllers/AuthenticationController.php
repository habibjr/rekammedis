<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
    }

    public function logout(Request $request)
    {
        //$user->tokens()->where('id', $tokenId)->delete();
        
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout Successfully'],200);
        
    }

    public function me(Request $request)
    {

        return response()->json(Auth::user());
    }

    public function register(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'name' => 'required',
            'username' => 'required|unique:users|min:2|max:100',
            'password' => 'required',
            'jabatan' => 'required',
            'poli' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
               'message'=>'Validation Error',
               'errors' => $validator->errors()
                ],422);

        }

        $user = User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'jabatan'=>$request->jabatan,
            'poli'=>$request->poli,
        ]);

        return response()->json([
            'message'=>'Registration Successfully',
            'data' => $user
             ],200);

        
    }

    function getalluser(){
        
        $userall1 = User::where('jabatan','=',0)->get();
        $userall1 = count($userall1);

        $userall2 = User::where('jabatan','=',1)->get();
        $userall2 = count($userall2);

        $userall3 = User::where('jabatan','=',2)->get();
        $userall3 = count($userall3);


        return response()->json( ['data' => [
            'Petugas Admin'=>$userall3,
            'Admin' => $userall2,
            'Dokter'=> $userall1
            ]]);


    }

    function getuser($id){
        
        $userall = User::where('jabatan','=',$id)->get();
        return response()->json( ['data' => $userall]);


    }

    function destroyuser ($id){
        
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => "Akun Berhasil dihapus"]);
    }


}
