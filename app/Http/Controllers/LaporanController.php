<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        //nak kene lek pengen modif2 ge ngirim data nak view
        return view("pelaporan");
    }
    public function store(Request $request){
        return response()->json($request->all());
    }
}
