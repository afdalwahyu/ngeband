<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User

class BandController extends Controller
{

    $required = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'location' => 'required',
        'instrument' => 'required',
        'genre' => 'required',
    ]

    public function store(Requests $request)
    {

    }

    public function show($id)
    {

    }

    public function join(Requests $request, $id)
    {

    }

    public function list($id)
    {

    }
}
