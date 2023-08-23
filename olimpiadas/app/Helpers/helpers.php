<?php

use function PHPUnit\Framework\isNull;

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
            "Ida", "Volta", "Oitavas",
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
            'nome' => "Jogo $numeroJogo - $nomeJogos x",
            'campeonato_id' => $campeonatoId
        ];
    }
}

if(!function_exists('rodizioTimes')) {
    function rodizioTimes($arrayTimes, $arrayJogos, $tipoCampeonato) {
        $quantidadeTimes = count($arrayTimes);
        if($quantidadeTimes % 2 == 0) $quantidadeRodadas = $quantidadeTimes - 1;
        else $quantidadeRodadas = $quantidadeTimes;
        $jogosPorRodada = intdiv($quantidadeTimes, 2);
        $arrayOriginal = $arrayTimes;
        $indice = 0;
        // Criar opções para os tipos diferentes de campeonato
        if($tipoCampeonato == 1 || $tipoCampeonato == 3) {
            for($i = 0; $i < $quantidadeRodadas; $i++) {
                for($j = 0; $j < $jogosPorRodada; $j++) {
                    $rodada = $i + 1;
                    $arrayJogos[$indice]['nome'] = str_replace("x", "Rodada $rodada", $arrayJogos[$indice]['nome']);
                    $arrayJogos[$indice]['casa'] = $arrayTimes[$j]->id;
                    $arrayJogos[$indice]['adversario'] = $arrayTimes[($quantidadeTimes-1) - $j]->id;
                    $indice++;
                }
                $arrayTimes = rotacionarElementosArray($arrayTimes);
            }
        }
        if($tipoCampeonato == 2 || $tipoCampeonato == 4) {
            $quantidadeRodadas *= 2;
            for($i = 0; $i < $quantidadeRodadas; $i++) {
                for($j = 0; $j < $jogosPorRodada; $j++) {
                    $rodada = $i+1;
                    $arrayJogos[$indice]['nome'] = str_replace("x", "- Rodada $rodada", $arrayJogos[$indice]['nome']);
                    // dd($arrayJogos[$indice]['nome']);
                    if($i < $quantidadeRodadas/2) {
                        $arrayJogos[$indice]['casa'] = $arrayTimes[$j]->id;
                        $arrayJogos[$indice]['adversario'] = $arrayTimes[($quantidadeTimes-1) - $j]->id;
                    } else {
                        $arrayJogos[$indice]['casa'] = $arrayTimes[($quantidadeTimes-1) - $j]->id;
                        $arrayJogos[$indice]['adversario'] = $arrayTimes[$j]->id;
                    }
                    $indice++;
                }
                if($quantidadeRodadas < $quantidadeRodadas/2) {
                    $arrayTimes = rotacionarElementosArray($arrayTimes);
                } else {
                    $arrayTimes = $arrayOriginal;
                    $arrayTimes = rotacionarElementosArray($arrayTimes);
                }
            }
        }
        if($tipoCampeonato > 2) {
            while($indice < count($arrayJogos)) {
                $arrayJogos[$indice]['casa'] = null;
                $arrayJogos[$indice]['adversario'] = null;
                $arrayJogos[$indice]['nome'] = str_replace("x", "", $arrayJogos[$indice]['nome']);
                $indice++;
            }
        }
        // dd($arrayTimes, $arrayJogos, $indice);
        return $arrayJogos;
    }
}

if(!function_exists('rotacionarElementosArray')) {
    function rotacionarElementosArray($arrayTimes) {
        $ultimoIndice = count($arrayTimes) - 1;
        if(count($arrayTimes) % 2 == 0) $valorIndice = 1;
        else $valorIndice = 0;
        $auxiliar = $arrayTimes[$valorIndice];
        for($i = $valorIndice; $i < $ultimoIndice; $i++) {
            $arrayTimes[$i] = $arrayTimes[$i + 1];
        }
        $arrayTimes[$ultimoIndice] = $auxiliar;
        return $arrayTimes;
    }
}

if(!function_exists('tabelaPontosCorridos')) {
    function tabelaPontosCorridos($times, $jogos) {
        $tabelaResultado = [];
        foreach($times as $time) {
            $tabelaResultado[$time['id']]['nome'] = $time['nome'];
            $tabelaResultado[$time['id']]['pontos'] = 0;
            $tabelaResultado[$time['id']]['partidasJogadas'] = 0;
            $tabelaResultado[$time['id']]['vitorias'] = 0;
            $tabelaResultado[$time['id']]['empates'] = 0;
            $tabelaResultado[$time['id']]['derrotas'] = 0;
            foreach($jogos as $jogo) {
                if($jogo['casa'] == $time['id'] || $jogo['adversario'] == $time['id']) {
                    if($jogo['casa'] == $time['id']) $mando = 'resultadoCasa';
                    if($jogo['adversario'] == $time['id']) $mando = 'resultadoAdversario';
                    // $tabelaResultado[$time['id']][] = [
                    //     "idPartida" => $jogo['id'],
                    //     "resultado" => $jogo[$mando]
                    // ];
                    switch ($jogo[$mando]) {
                        case 'V':
                            $tabelaResultado[$time['id']]['vitorias']++;
                            $tabelaResultado[$time['id']]['partidasJogadas']++;
                            break;
                        case 'E':
                            $tabelaResultado[$time['id']]['empates']++;
                            $tabelaResultado[$time['id']]['partidasJogadas']++;
                            break;
                        case 'D':
                            $tabelaResultado[$time['id']]['derrotas']++;
                            $tabelaResultado[$time['id']]['partidasJogadas']++;
                            break;
                    }
                }
            }
            $tabelaResultado[$time['id']]['pontos'] = $tabelaResultado[$time['id']]['vitorias'] * 3 + $tabelaResultado[$time['id']]['empates'];
        }
        return $tabelaResultado;
    }
}

if(!function_exists('ordenarTabelaResultados')) {
    function ordenarTabelaResultados($arrayTabela) {
        $resultado = array_orderby($arrayTabela, 'pontos', SORT_DESC, 'vitorias', SORT_DESC, 'empates', SORT_DESC, 'partidasJogadas', SORT_ASC);
        return $resultado;
    }
}

if(!function_exists('array_orderby')) {
    function array_orderby() {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
                }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }
}