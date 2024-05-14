<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;



class pegawaiController extends Controller
{
    public function index(){
        $user = DB::table("users")->orderBy('role_id', 'asc')->Paginate(10);
        
        return view("admin.index",["users" => $user]);
    }
    public function add(){
        return view("admin.add");
    }
    public function addSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ],[
            'password_confirmation.same' => 'Password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return redirect('/admin')->with('error',$validator->errors()->first());
        }
        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->email_verified_at = now();
        $user->role_id = $request->role_id;
        $user->save();

        return redirect('/admin')->with('success', 'Data berhasil disimpan!');
    }
    public function store(Request $request){
        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return view("admin.index", ["added" => true]);
    }
    public function edit($id) {
        $user = DB::table("users")->where(['id' => $id])->first();
        $userauth = Auth::user();
        if($user){
        if($user->role_id ==0 && $userauth->id!=$user->id){
            return redirect('/admin')->with('error','Anda tidak memiliki hak akses untuk mengedit data ini');
        }
        else{
        return view("admin.edit", ["user" => $user,"userauth"=> $userauth]);
        }
        }else{
            return redirect("/admin")->with("error","Data tidak ditemukan");
        }
    }
    public function editsave(Request $request ,$id) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
            'password' => 'nullable',
            'password_confirmation' => 'nullable|same:password',
        ],[
            'password_confirmation.same' => 'Password tidak sesuai',
        ]);

        if ($validator->fails()) {
            return redirect('/admin')->with('error',$validator->errors()->first());
        }
        $validatedData = $request->validate([
            'nama' => 'required',
            'email'=> 'required',
            'password'=> 'nullable',
            'password_confirmation' => 'nullable|same:password',
            'role_id'=> 'nullable',
        ],[
            'password_confirmation.same' => 'Password tidak sesuai',
        ]);
        
        $dataToUpdate = [
            'name' => $request->nama,
            'email' => $request->email,
            'updated_at' => now(),
        ];
    
        if ($request->filled('password')&&$request->filled('password_confirmation')) {
            if ($request->password==$request->password_confirmation) {
            $dataToUpdate['password'] = bcrypt($validatedData['password']);
            }
        }
        if ($request->filled('role_id')) {
            $dataToUpdate['role_id'] = $request->role_id;
        }
        DB::table('users')->where('id', $id)->update($dataToUpdate);
        
        return redirect('/admin');
    }
    public function delete($id){
        $userDelete=User::where('id', $id)->first();
        $authUser=User::where('id', Auth::user()->id)->first();
        if ($userDelete->role_id==0 && $authUser->id!=$userDelete->id) {
            return redirect('/admin')->with('error','Anda tidak memiliki hak akses untuk menghapus data ini');
        }
        DB::table('users')->where('id', $id)->delete();;
        if($userDelete->name==$authUser->name){
            return redirect('/');
        }

        return redirect('/admin');
    }
    public function deleteALL(){
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        return redirect('/');
    }
}
