<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Firebase\JWT\JWT;

class UserController extends Controller
{
    public function index(Request $request){
        
        $searchbox = $request->query('searchbox');
        if($searchbox == ''){
            $users = User::all();
        }else{
            $users = User::where('name','like','%'.$searchbox.'%')->get();
        }
        return view('users.index' , ['users'=>$users]);
    }

    public function store(Request $request){

        var_dump($request->input());
        $name = $request->input('name');
        $email = $request->input('email');
        $role = $request->input('role');
        $password = Hash::make($request->input('password'));
        var_dump([$name,$email,$password,$role]);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = $password;

        $user->save();
        return Redirect::route('users.index');
        // $name = $request->input('name');
        //
    }

    public function create(){
        return view('users.create');
    }

    public function show($id, Request $request){
        $user = User::where('id', $id)->first();
        return view('users.show',['user'=>$user]);
    }

    public function update($id, Request $request){
       
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        if($request->password != ''){
        $user->password = Hash::make($request->password);
        }
        $user->save();

        // die();
        return Redirect::route('users.index');
    }

    public function destroy($id, Request $request){
        User::destroy($id);
        var_dump($id);
        return Redirect::route('users.index');

    }

    // API ALL

    public function apiGetAll(){
        $users = User::all();
        return response()->json($users,200);
    }

    // API ONE

    public function apiGetOne($id){

        try{
            $users = User::where('id',$id)->firstOrFail();
        } catch (\Throwable $th) {
            return response()->json('User Not Found',404);
        }

        return response()->json($users,200);
    }

    // API CREATE USER

    public function apiCreateUser(Request $request){

        $validators = Validator::make($request->all(),[
            'email' => 'required | email | max:200 | unique:users,email',
            'name' => 'required | max:100',
            'role' => 'required | in:member,Admin',
            'password' => 'required | max:50'
        ]);

        if($validators ->fails()){
            $errors = $validators->errors();
            return response()->json($errors, 400);
        }

        $data = $request->only([
            'name',
            'email',
            'password',
            'role'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if($user){
            $responsedata = [
                'status'=>'Success',
                'messages'=>'User Created'
            ];
            return response()->json($responsedata,200);
        }else{
            $responsedata = [
                'status'=>'Failed',
                'messages'=>'Unable to Create User'
            ];
            return response()->json($responsedata,403);
        }

        return response()->json('',200);
    // SAVE DB
    }



    public function apiUpdate(Request $request,$id)
    {
        $validators = Validator::make($request->all(),[
            'email' => 'required | email | max:200'.Rule::unique('users','email'),
            'name' => 'required | max:100',
            'role' => 'required | in:member,Admin',
            'password' => 'required | max:50'
        ]);

        if($validators ->fails()){
            $errors = $validators->errors();
            return response()->json($errors, 400);
        }

        try{
            $data = $request->only([
                'name',
                'email',
                'password',
                'role'
            ]);

        $data['password'] = Hash::make($data['password']);
        User::find($id)->update($data);
        return response()->json('User Updated',404);

        }catch (\Throwable $th) {
        return response()->json('User Not Updated',404);
        }



            // try{
            //     $user=User::find($id);
            //     $user->update($request->all());
            //     $user['password'] = Hash::make($user['password']);
            //     return $user;
            // } catch (\Throwable $th) {
            //     return response()->json('User Not Created',404);
            // }
    }

    public function apiDelete($id)
    {
    $count = User::where('id',$id)->delete();
    // dd($data);
    if($count > 0 ){

        return response()->json(['message'=>'Successfully Deleted']);
    }
    else{
        return response()->json(['message'=>'Delete Failed']);
    }

    }

    public function profile(Request $request){
        return $request->user();
    }
}
