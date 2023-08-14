<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Campeonato;
use App\Models\Equipe;
use App\Models\Participante;
use App\Models\Time;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class TimesController extends Controller
{
    public function store(Campeonato $campeonato, Request $request) {
        // dd($request->nomeTime, $request->equipe);
        Time::create(['nome' => $request->nomeTime ,'campeonato_id' => $campeonato->id ,'equipe_id' => $request->equipe ]);
        $equipes = $campeonato->equipes()->select('nome')->get();
        $times = $campeonato->times()->select('id','nome')->get();
        return redirect()->route('campeonatos.show', ['campeonato' => $campeonato, 'equipes' => $equipes, 'times' => $times]);
    }

    public function destroy(Campeonato $campeonato, Time $time ) {
        // dd($campeonato);
        $time->delete();
        $equipes = $campeonato->equipes()->select('nome')->get();
        $times = $campeonato->times()->select('id','nome')->get();
        return redirect()->route('campeonatos.show', ['campeonato' => $campeonato, 'equipes' => $equipes, 'times' => $times]);
    }

    public function edit(Campeonato $campeonato, Time $time) {
        $participantes = Equipe::find($time->equipe_id)->participantes()->select('id','nome')->get();
        $timeSecundario = Campeonato::find($campeonato->id)->times()->select('id','nome','participantes')->where([['equipe_id','=',$time->equipe_id],['id','<>',$time->id]])->get();
        // dd("Checar se existe outro time", $timeSecundario, isset($timeSecundario[0]));
        $time->participantes = resultadoParticipantes($time->participantes, $participantes);
        if(isset($timeSecundario[0])) $timeSecundario = resultadoParticipantes($timeSecundario[0]->participantes, $participantes);
        // dd($time->participantes, $timeSecundario);
        $participantes = filtrarParticipantes($participantes, $time->participantes);
        $participantes = filtrarParticipantes($participantes, $timeSecundario);
        // dd("Editar", $participantes, $time->participantes);
        
        return view('times.edit')->with(['campeonato' => $campeonato , 'participantes' => $participantes , 'time' => $time]);
    }

    public function update(Campeonato $campeonato, Time $time, Request $request) {
        // dd($request->listaParticipantes);
        if($request->listaParticipantes == null) $idParticipantes = $request->listaParticipantes;
        else {
            $arrayParticipantes = explode(',', $request->listaParticipantes);
            // dd($arrayParticipantes);              
            $idParticipantes = [];
            foreach($arrayParticipantes as $participante) {
                $objParticipante = json_decode(str_replace('-',',',$participante));
                $idParticipantes[] = $objParticipante->id;
            }
            $idParticipantes = implode(',', $idParticipantes);
        } 
        $time->fill(['participantes' => $idParticipantes])->save();
        $equipes = $campeonato->equipes()->select('nome')->get();
        $times = $campeonato->times()->select('id','nome')->get();
        return view('campeonatos.show')->with(['campeonato' => $campeonato, 'equipes' => $equipes, 'times' => $times]);
    }

}
