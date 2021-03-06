<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;


class UserController extends Controller
{

    public function userLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    public function userRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'role' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required',
            'c_password' => 'same:password',
        ]);

        if ($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //$input = $input['role'];
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;

        return response()->json(['success'=>$success], 200);
    }


    public function userDetails()
    {
        $user = Auth::user();
        return response()->json(['persons' => $user], 200);
    }

    public function postUser(Request $request)
    {
        $user = new User();

        $user->personid = $request->input('personid');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->annotation = $request->input('annotation');
        $user->email = $request->input('email');
        $user->role = $request->input('role');


        $user->save();
        return response()->json(['quote' => $user], 201);

    }

    public function getUsers(){
        $persons = User::all();
        $response = [
            'persons' => $persons
        ];
        return response()->json($response,200);
    }

    public function getByIdUsers($id){
        $persons = User::find($id);
        $response = [
            'persons' => $persons
        ];
        return response()->json($response,200);
    }

    public function putUser(Request $request, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json(['message'=>'User not found'], 404);

        }
        $user->firstname = $request->input('personid');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->annotation = $request->input('annotation');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
//        $user->password =bcrypt( $request->input('password'));
        $user->save();
        return response()->json(['user' => $user], 200);
    }

    public function deletePerson($id){
        $user = User::find($id);


        if (DB::table('Lending')->where('personid', '=', $user->personid)->count() <= 0) {
            $user->delete();
            return response()->json(['message' => 'User Deleted'],200);

        }
        return response()->json(['message' => 'Open Lending. Cant Delete.'],401);

    }


}