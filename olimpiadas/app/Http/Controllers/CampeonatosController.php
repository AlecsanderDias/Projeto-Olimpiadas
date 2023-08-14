<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Equipe;
use App\Models\Especialidade;
use App\Models\Modalidade;
use App\Models\Time;
use App\Models\Tipo;
use Illuminate\Http\Request;

class CampeonatosController extends Controller
{
    public function index() {
        $campeonatos = Campeonato::all();
        return view('campeonatos.index')->with(['campeonatos' => $campeonatos]);
    }

    public function create() {
        $tipos = Tipo::all();
        $modalidades = Modalidade::all();
        $especialidades = Especialidade::all();
        $maximoTimes = 2;
        $equipes = Equipe::select('id','nome')->get();
        $arrayEquipes = [];
        return view('campeonatos.create')->with(['tipos' => $tipos, 'modalidades' => $modalidades, 'especialidades' => $especialidades, 'maximoTimes' => $maximoTimes, 'equipes' => $equipes, 'arrayEquipes' => $arrayEquipes]);
    }

    public function store(Request $request) {
        $arrayEquipes = explode(',',$request->listaEquipes);
        $idEquipes = [];
        $times = [];
        // dd($request->listaEquipes);
        $campeonato = Campeonato::create($request->all());
        foreach($arrayEquipes as $equipe) {
            $objeto = json_decode(str_replace('-',',',$equipe));
            $idEquipes[] = $objeto->id;
            for($i = 1; $i <= $request->timesPorEquipe; $i++) {
                $times[] = [
                    'nome' => "$objeto->nome $i",
                    'equipe_id' => $objeto->id,
                    'campeonato_id' => $campeonato->id,
                ];
            }
        }
        $campeonato->equipes()->attach($idEquipes);
        Time::insert($times);
        return to_route('campeonatos.index')->with(['mensagem.sucesso' => "Campeonato ($request->nome) foi adiconado(a) com sucesso!"]);
    }

    public function destroy(Campeonato $campeonato) {
        $campeonato->delete();
        return to_route('campeonatos.index')->with(['mensagem.sucesso' => "Campeonato ($campeonato->nome) foi deletado(a) com sucesso!"]);
    }

    public function show(Campeonato $campeonato) {
        $equipes = $campeonato->equipes()->select('id','nome')->get();
        $times = $campeonato->times()->select('id','nome')->get();
        // dd($equipes, $times);
        // $times = criarArrayTimesSeparados($times, $campeonato->timesPorEquipe, $equipes);
        // dd($resultado);
        return view('campeonatos.show')->with(['campeonato' => $campeonato, 'equipes' => $equipes, 'times' => $times]);
    }
}
