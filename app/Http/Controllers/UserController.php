<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        try{
            return view('users.index', ['users' => User::all()]);
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    protected function store(Request $request)
    {
        try{
            $data = $request->all();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->save();
            toast('User created with success!','success');
                return back();
            }
            catch (Throwable $e) {
                toast('Pleasy try again!','error');
            }
    }

    public function edit($id)
    {
        try{
            $user = DB::table('users')->select('id','name','email','password')->where('users.id','=',$id)->first();
            return view('users.edit', ['user' => $user]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::where('id','=', $id)->first();
            $user->fill($request->only('name','email'));
            $user->password = Hash::make($request['password']);
            $user->save();

            toast('User updated with success!','success');

            return redirect()->route('users.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
            }
    }


    public function destroy(User $user)
    {
        try {
        $user = User::where('id','=', $user->id)->first();
        $user->delete();
        toast('User deleted with success!','success');
        return redirect()->back();
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
