<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Code;

class loginController extends Controller
{
    //
    public function getListOfUsers()
    {
        $success = true;
        $users = User::all();
        return response()->json(['success' => $success, 'data' => $users]);
    }

    //http://localhost:8888/assignment/public/api/
    public function getListOfCodes()
    {
        $success = true;
        $codes = Code::all();
        return response()->json(['success' => $success, 'data' => $codes]);
    }


    //login by email 
    //http://localhost:8888/assignment/public/api/user/login 
    public function loginByEmail(Request $request)
    {
        $success = false;
        $validator = Validator::make($request->all(),
        ['id' => 'required']);

        if($validator->fails()){
            $message = $validator->errors()->all();
            return response()->json(['success' => $success, 'message' => $message]);
        }
        $success = true;
        if(User::where('email',$request->id)->exists()){
            $userData = User::select('id' , 'first_name', 'last_name' , 'phone' , 'email' )
            ->where('users.email', $request->id)
            ->where('users.password', $request->password)
            ->get();
        }
        else{
            $success = false;
            $message = 'invalid email!';
            return response()->json(['success' => $success, 'message' => $message]);
        }
        return response()->json(['success' => $success, 'data' => $userData]);
    }

    //signup 
    public function newUser(Request $request)
    {
        $success = false;
        $validator = Validator::make($request->all(),
        ['first_name' => 'required',
          'last_name',
          'phone',
          'email',
          'address',
          'password'
        ]);

        if($validator->fails()){
            $message = $validator->errors()->all();
            return response()->json(['success' => $success, 'message' => $message]);
        }
        $success = true;
        $newUser = new User;
        $newUser->first_name = $request->first_name; 
        $newUser->last_name = $request->last_name; 
        $newUser->phone = $request->phone; 
        $newUser->email = $request->email; 
        $newUser->address = $request->address; 
        $newUser->password = $request->password; 
        $newUser->save();
        return response()->json(['success' => $success, 'data' => $newUser]);
    }
    // new code 
    public function newCode(Request $request)
    {
        $success = false;
        $validator = Validator::make($request->all(),
        ['code' => 'required',
          'country_name'
        ]);

        if($validator->fails()){
            $message = $validator->errors()->all();
            return response()->json(['success' => $success, 'message' => $message]);
        }
        $success = true;
        $newCode = new Code;
        $newCode->code = $request->code; 
        $newCode->country_name = $request->country_name; 

        $newCode->save();
        return response()->json(['success' => $success, 'data' => $newCode]);
    }
}
