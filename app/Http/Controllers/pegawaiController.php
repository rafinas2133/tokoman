<?php

namespace App\Http\Controllers;

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
        $user = DB::table("users")->Paginate(10);
        
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
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/admin')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
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
        return view("admin.edit", ["user" => $user]);
    }
    public function editsave(Request $request){

        $validatedData = $request->validate([
            'nama' => 'required',
            'email'=> 'required',
            'password'=> 'nullable',
            'id'=>'required',
        ]);
        $dataToUpdate = [
            'name' => $request->nama,
            'email' => $request->email,
        ];
    
        if ($request->filled('password')&&$request->filled('password_confirmation')) {
            if ($request->password==$request->password_confirmation) {
            $dataToUpdate['password'] = bcrypt($validatedData['password']);
            }
        }
        DB::table('users')->where('id', $validatedData['id'])->update($dataToUpdate);
        
        return redirect('/admin');
    }
    public function delete($id){
        
        DB::table('users')->where('id', $id)->delete();;
        if($id = Auth::user()->id){
            Session::forget('role_id');
            return redirect('/');
        }

        return redirect('/admin');
    }
    public function deleteALL(){
        Session::forget('role_id');
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        return redirect('/');
    }
}
