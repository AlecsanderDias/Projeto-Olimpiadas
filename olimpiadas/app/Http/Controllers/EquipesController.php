<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\Participante;
use Illuminate\Http\Request;

class EquipesController extends Controller
{
    public function index () {
        $equipes = Equipe::all();
        return view('equipes.index')->with(['equipes' => $equipes, 'title' => 'Equipes']);
    }

    public function create() {
        return view('equipes.create');
    }

    public function store(Request $request) {
        Equipe::create($request->all());
        return to_route('equipes.index')->with(['mensagem.sucesso' => "A Equipe ($request->nome) foi adicioada com sucesso!"]);;
    }

    public function edit(Equipe $equipe) {
        $participantes = Participante::select('id','nome')->where('equipe_id','=',"$equipe->id")->get();
        return view('equipes.edit')->with(['equipe' => $equipe, 'participantes' => $participantes]);
    }

    public function update(Equipe $equipe,Request $request) {
        $equipe->fill($request->all())->save();
        Participante::where('equipe_id','=',"$equipe->id")->update(['capitao' => false]);
        Participante::where('id','=',"$equipe->capitao")->update(['capitao' => true]);
        return to_route('equipes.index')->with(['mensagem.sucesso' => "A Equipe ($equipe->nome) foi atualizada com sucesso!"]);
    }

    public function destroy(Equipe $equipe) {
        Participante::where('equipe_id','=',"$equipe->id")->update(['equipe_id' => null]);
        $equipe->delete();
        return to_route('equipes.index')->with(['mensagem.sucesso' => "A equipe ($equipe->nome) foi deletada com sucesso!"]);
    }
}
