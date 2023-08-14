<?php
if (!function_exists('resultadoParticipantes')) {
    function resultadoParticipantes($participantesDoTime, $participantesDaEquipe)
    {
        // dd($participantesDoTime, $participantesDaEquipe);
        if ($participantesDoTime == null) {
            return [];
        } else {
            $participantesDoTime = explode(',', $participantesDoTime);
            $listaParticipantes = [];
            foreach ($participantesDaEquipe as $participante) {
                foreach ($participantesDoTime as $selecionado) {
                    if ($participante->id == $selecionado) {
                        $listaParticipantes[] = $participante;
                    }
                }
            }
        }
        // dd("Resultado Participantes",$participantesDoTime);
        return $listaParticipantes;
    }
}

if (!function_exists('filtrarParticipantes')) {
    function filtrarParticipantes($listaTodosParticipantes, $listaExcluidos)
    {
        // dd($listaExcluidos);
        if ($listaExcluidos == [] || $listaTodosParticipantes == []) return $listaTodosParticipantes;
        $listaFiltrada = [];
        $indices = [];
        foreach ($listaTodosParticipantes as $participante) {
            $listaFiltrada[] = $participante;
            $indices[] = $participante->id;
        }
        foreach ($listaExcluidos as $excluido) {
            $resultado = array_search($excluido->id, $indices);
            // dd($resultado);
            if ($resultado > -1) {
                unset($listaFiltrada[$resultado]);
            }
        }
        $listaFiltrada = array_values($listaFiltrada);
        // dd("Dados finais", $listaFiltrada);
        return $listaFiltrada;
    }
}

if (!function_exists('criarArrayTimesSeparados')) {
    function criarArrayTimesSeparados($arrayTodosTimes, $quantidadePorEquipe, $listaTodasEquipes)
    {
        $todosTimes = [];
        // dd($arrayTodosTimes, $quantidadePorEquipe);
        foreach ($listaTodasEquipes as $equipe) {
            $times = [];
            foreach ($arrayTodosTimes as $time) {
                for ($i = 1; $i <= $quantidadePorEquipe; $i++) {
                    $nomeTime = "$equipe->nome $i";
                    // dd($equipe->nome ,$arrayTodosTimes->nome);
                    if ($time->nome == $nomeTime) {
                        // dd("Funcionou");
                        $times[] = $time;
                    } else $times[] = null;
                }
            }
            $todosTimes[] = [
                "$equipe->nome" => $times,
            ];
        }
        // dd("Fim da função", $todosTimes, $arrayTodosTimes, $listaTodasEquipes);
        return $todosTimes;
    }
}

if (!function_exists('criarArrayPartidas')) {
    function criarArrayPartidas($campeonatoId, $quantidadeTimes, $quantidadeClassificados, $tipoCampeonato)
    {
        $quantidadeRodadas = $quantidadeTimes - 1;
        $quantidadeJogosIda = ($quantidadeTimes * $quantidadeRodadas) / 2;
        $quantidadeJogosVolta = $quantidadeJogosIda * 2;
        $quantidadeEliminatorias = $quantidadeClassificados - 1;

        switch ($tipoCampeonato) {
            case 1:
                $quantidadeJogos = $quantidadeJogosIda;
                $resultado = organizarArrayPartidas($campeonatoId, $tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda);
                break;

            case 2:
                $quantidadeJogos = $quantidadeJogosVolta;
                $resultado = organizarArrayPartidas($campeonatoId, $tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda);
                break;

            case 3:
                $quantidadeJogos = $quantidadeJogosIda + $quantidadeEliminatorias;
                $resultado = organizarArrayPartidas($campeonatoId, $tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda, $quantidadeEliminatorias);
                break;

            case 4:
                $quantidadeJogos = $quantidadeJogosVolta + $quantidadeEliminatorias;
                $resultado = organizarArrayPartidas($campeonatoId,$tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda, $quantidadeEliminatorias);
                break;

            default:
                $quantidadeJogos = $quantidadeEliminatorias;
                $resultado = organizarArrayPartidas($campeonatoId,$tipoCampeonato, $quantidadeJogos, null, $quantidadeEliminatorias);
                break;
        }
        // dd($tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda, $quantidadeJogosVolta, $quantidadeEliminatorias, $resultado);
        return $resultado;
    }
}

if (!function_exists('organizarArrayPartidas')) {
    function organizarArrayPartidas($campeonatoId, $tipoCampeonato, $quantidadeJogos, $quantidadeJogosIda = null, $quantidadeEliminatorias = null)
    {
        $nomeJogos = [
            "Rodada Ida", "Rodada Volta", "Oitavas",
            "Quartas", "Semifinal", "Final"
        ];
        $arrayJogos = [];
        // dd();
        for ($i = 0; $i < $quantidadeJogos; $i++) {
            switch ($tipoCampeonato) {
                case 1:
                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[0]);
                    break;
                case 2:
                    if ($i < $quantidadeJogosIda) {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[0]);
                    } else {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[1]);
                    }
                    break;
                case 3:
                    if ($i < $quantidadeJogosIda) {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[0]);
                    } elseif ($i < ($quantidadeJogos - $quantidadeEliminatorias)) {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[1]);
                    } else {
                        $numeroRestante = $quantidadeEliminatorias;
                        while ($numeroRestante > 0) {
                            if($numeroRestante > 7) $contador = (int)log($numeroRestante, 2);
                            else $contador = intdiv($numeroRestante, 2);
                            // dd($contador, $numeroRestante, $arrayJogos);
                            switch ($contador) {
                                case 0:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[5]);
                                    break;
                                case 1:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[4]);
                                    break;
                                case 2:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[3]);
                                    break;
                                default:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[2]);
                                    break;
                            }
                            $i++;
                            $numeroRestante--;
                            // dd($contador, $i, $numeroRestante, $arrayJogos, $quantidadeJogos, $quantidadeEliminatorias);
                        }
                        // dd($contador, $i, $numeroRestante, $arrayJogos, $quantidadeJogos, $quantidadeEliminatorias);
                    }
                    break;
                case 4:
                    if ($i < $quantidadeJogosIda) {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[0]);
                    } elseif ($i < ($quantidadeJogos - $quantidadeEliminatorias)) {
                        $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[1]);
                    } else {
                        $numeroRestante = $quantidadeEliminatorias;
                        while ($numeroRestante > 0) {
                            if($numeroRestante > 7) $contador = (int)log($numeroRestante, 2);
                            else $contador = intdiv($numeroRestante, 2);
                            // dd($contador, $numeroRestante, $arrayJogos);
                            switch ($contador) {
                                case 0:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[5]);
                                    break;
                                case 1:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[4]);
                                    break;
                                case 2:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[3]);
                                    break;
                                default:
                                    $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[2]);
                                    break;
                            }
                            $i++;
                            $numeroRestante--;
                            // dd($contador, $i, $numeroRestante, $arrayJogos, $quantidadeJogos, $quantidadeEliminatorias);
                        }
                    }
                    break;
                default:
                    $numeroRestante = $quantidadeEliminatorias;
                    while ($numeroRestante > 0) {
                        $contador = (int)log($numeroRestante, 2);
                        // dd($contador, $numeroRestante, $arrayJogos);
                        switch ($contador) {
                            case 0:
                                $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[5]);
                                break;
                            case 1:
                                $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[4]);
                                break;
                            case 2:
                                $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[3]);
                                break;
                            default:
                                $arrayJogos[] = nomearPartidas($campeonatoId, $i, $nomeJogos[2]);
                                break;
                        }
                        $i++;
                        $numeroRestante--;
                        // dd($contador, $i, $numeroRestante, $arrayJogos, $quantidadeJogos, $quantidadeEliminatorias);
                    }
                    break;
            }
        }
        return $arrayJogos;
    }
}

if (!function_exists('nomearPartidas')) {
    function nomearPartidas($campeonatoId, $numeroJogo, $nomeJogos)
    {
        $numeroJogo++;
        return [
            'nome' => "Jogo $numeroJogo - $nomeJogos",
            'campeonato_id' => $campeonatoId
        ];
    }
}

if(!function_exists('rodizioTimes')) {
    function rodizioTimes($arrayTimes, $arrayJogos, $tipoCampeonato) {
        $quantidadeTimes = count($arrayTimes);
        $quantidadeRodadas = $quantidadeTimes - 1;
        $jogosPorRodada = (int) $quantidadeTimes / 2;
        $indice = 0;
        // Criar opções para os tipos diferentes de campeonato
        for($i = 0; $i < $quantidadeRodadas; $i++) {
            $arrayTimes = rotacionarElementosArray($arrayTimes);
            for($j = 0; $j < $jogosPorRodada; $j++) {
                $arrayJogos[$indice]['casa'] = $arrayTimes[$j]->id;
                $arrayJogos[$indice]['adversario'] = $arrayTimes[($quantidadeTimes-1) - $j]->id;
                $indice++;
            }
        }
        while($indice < count($arrayJogos)) {
            $arrayJogos[$indice]['casa'] = null;
            $arrayJogos[$indice]['adversario'] = null;
            $indice++;
        }
        dd($arrayTimes, $arrayJogos, $indice);
        return $arrayJogos;
    }
}

if(!function_exists('rotacionarElementosArray')) {
    function rotacionarElementosArray($arrayTimes) {
        $ultimoIndice = count($arrayTimes) - 1;
        $auxiliar = $arrayTimes[1];
        for($i = 1; $i < $ultimoIndice; $i++) {
            $arrayTimes[$i] = $arrayTimes[$i + 1];
        }
        $arrayTimes[$ultimoIndice] = $auxiliar;
        return $arrayTimes;
    }
}