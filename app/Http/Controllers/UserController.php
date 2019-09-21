<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        if($users == null){
            return response()->json(['success' => 0, 'message' => 'Failed to get users'], 404);
        }

        return response()->json(['users' => $users, 'success' => 1, 'message' => 'Got users successfully'], 200);

    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $users = User::find($id);

        if($users == null){
            return response()->json(['success' => 0, 'message' => 'Failed to get user'], 404);
        }
        
        return response()->json(['user' => $user, 'success' => 1, 'message' => 'Got user successfully'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if($user == null){
            $user = User::create(['name' => 'temp', 'email' => 'default@email.com', 'password' => '123']);
        }

        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['password']);
        $user->save();

        return response()->json(['user' => $user, 'success' => 1, 'message' => 'User updated successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
