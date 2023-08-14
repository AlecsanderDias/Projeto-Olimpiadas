<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Jogo;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JogosController extends Controller
{
    public function index(Campeonato $campeonato, Time $times ,Request $request) {
        $jogos = $campeonato->jogos()->get();
        $times = $campeonato->times()->select('id','nome')->get();
        // dd($request, $times);
        return view('jogos.index')->with(['campeonato' => $campeonato, 'jogos' => $jogos, 'times' => $times]);
    }

    public function create(Campeonato $campeonato, Request $request) {
        // dd($campeonato, $request);
        $equipes = $campeonato->equipes()->get();
        $times = $campeonato->times()->get();
        return view('jogos.create')->with(['campeonato' => $campeonato, 'equipes' => $equipes, 'times' => $times]);
    }

    public function store(Campeonato $campeonato, Request $request) {
        $jogos = criarArrayPartidas($campeonato->id, $request->quantidadeTimes, $request->timesClassificados, $campeonato->tipo_id);
        $times = $campeonato->times()->select('id')->get();
        // dd($campeonato->tipo_id);
        $jogos = rodizioTimes($times, $jogos, $campeonato->tipo_id);
        dd($jogos, $times);
        Jogo::insert($jogos);
        return to_route('campeonatos.jogos.index', ['campeonato' => $campeonato->id]);
    }

    public function edit(Campeonato $campeonato, Jogo $jogo, Request $request) {
        $resultados = ['V' => 'Vitória','E' => 'Empate','D' => 'Derrota'];
        $times = $campeonato->times()->select('id','nome')->get();
        // dd($times, $request);
        return view('jogos.edit')->with(['campeonato' => $campeonato, 'jogo' => $jogo, 'times' => $times, 'resultados' => $resultados]);
    }
}
