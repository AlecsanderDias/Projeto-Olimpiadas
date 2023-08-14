<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipantesController extends Controller
{
    public function index () {
        $participantes = Participante::all();
        return view('participantes.index')->with(['participantes' => $participantes, 'title' => 'Participantes']);
    }

    public function create() {
        $equipes = Equipe::select('id','nome')->get();
        return view('participantes.create')->with(['equipes' => $equipes]);
    }

    public function store(Request $request) {
        Participante::create($request->all());
        return to_route('participantes.index')->with(['mensagem.sucesso' => "Participante ($request->nome) foi adiconado(a) com sucesso!"]);
    }

    public function edit(Participante $participante) {
        $equipes = Equipe::select('id','nome')->get();
        return view('participantes.edit')->with(['equipes' => $equipes, 'participante' => $participante]);
    }

    public function update(Participante $participante, Request $request) {
        $participante->fill($request->all())->save();
        return to_route('participantes.index')->with(['mensagem.sucesso' => "Participante ($participante->nome) foi atualizado(a) com sucesso!"]);
    }

    public function destroy(Participante $participante) {
        if($participante->capitao) {
            Equipe::where('capitao','=',"$participante->id")->update(['capitao' => null]);
        }
        $participante->delete();
        return to_route('participantes.index')->with(['mensagem.sucesso' => "Participante ($participante->nome) foi deletado(a) com sucesso!"]);
    }
}
