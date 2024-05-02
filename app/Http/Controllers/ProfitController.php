<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfitController extends Controller
{
    public function index(){
        //nak kene lek pengen modif2 ge ngirim data nak view
        return view("profit");
    }
}
