<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function create() {
        return view('usuarios.create');
    }

    public function store(UsersFormRequest $request) {
        // dd($request);
        $dados = $request->except(['_token']);
        $dados['password'] = Hash::make($dados['password']);

        $user = User::create($dados);
        Auth::login($user);
        return to_route('home.index');
    }

    public function index() {
        $usuarios = User::select('id','name','email','nivelAcesso')->get();
        $nivel = Auth::user()->nivelAcesso;
        $id = Auth::user()->id;
        return view('usuarios.index')->with(['usuarios' => $usuarios,'nivel' => $nivel, 'id' => $id]);
    }

    public function edit(User $usuario) {
        // dd($usuario);
        $nivel = Auth::user()->nivelAcesso;
        return view('usuarios.edit')->with(['usuario' => $usuario,'nivel' => $nivel]);
    }

    public function update(User $usuario, Request $request) {
        // dd($usuario,$request->all());
        $usuario->fill($request->all())->save();
        return to_route('usuarios.index');
    }

    public function destroy(User $usuario) {
        $usuario->delete();
        return to_route('usuarios.index');
    }
}
