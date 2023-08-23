<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        // dd(Auth::user()->nivelAcesso);
        isset(Auth::user()->nivelAcesso) ? $nivel = Auth::user()->nivelAcesso : $nivel = 0;
        return view('components.index', ['nivel' => $nivel]);
    }
}
