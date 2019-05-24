<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index()
    {
        return view('index.address.index');
    }

    public function list()
    {
        $data = request()->all();
        // dd($data);
        return view('index.address.list');
    }
}
