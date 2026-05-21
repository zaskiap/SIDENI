<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        return view('beranda', ['user' => $request->user()]);
    }
}
