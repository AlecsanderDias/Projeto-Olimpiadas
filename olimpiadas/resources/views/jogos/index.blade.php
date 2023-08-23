<x-layout title="Jogos">
    <h2>{{ $campeonato->nome }}</h2>
    
    @if($campeonato->tipo_id < 5)
        <h3>Tabela de Resultados</h3>
        <ul>
            <li class="d-flex gap-4">
                <p>Posição</p>
                <p>Nome do Time</p>
                <p>Partidas Jogadas</p>
                <p>Pontos</p>
                <p>Vitórias</p>
                <p>Empates</p>
                <p>Derrotas</p>
            </li>
            @foreach ($resultados as $resultado)
            <li class="d-flex gap-4">
                <p>{{ $loop->index + 1 }}</p>
                <p>{{ $resultado['nome'] }}</p>
                <p>{{ $resultado['partidasJogadas'] }}</p>
                <p>{{ $resultado['pontos'] }}</p>
                <p>{{ $resultado['vitorias'] }}</p>
                <p>{{ $resultado['empates'] }}</p>
                <p>{{ $resultado['derrotas'] }}</p>
            </li>
            @endforeach
        </ul>
    @endif
    
    <h3>Tabela de Jogos</h3>
    <ul>
        @if($jogos->first())
            @foreach ($jogos as $jogo)
            <li class="d-flex gap-4">
                <p>{{ $jogo->nome }}</p>
                <p>{{ $jogo->data }}</p>
                <p>{{ $jogo->casa }}</p>
                <p>{{ $jogo->adversario }}</p>
                <p>{{ $jogo->resultadoCasa }}</p>
                <p>{{ $jogo->resultadoAdversario }}</p>
                @if(is_null($jogo->placarCasa))
                <p>{{ "Não foi jogado!" }}</p>
                @else
                <p>{{ $jogo->placarCasa }} X {{ $jogo->placarAdversario }}</p>
                @endif
                @if($nivel > 0)
                    <a href="{{ route('campeonatos.jogos.edit', [ 'campeonato' => $campeonato->id, 'jogo' => $jogo->id]) }}" class="btn btn-primary">Editar</a>
                @endif
            </li>
            @endforeach
        @else
            <li>Ainda não há jogos criados!</li>
        @endif
    </ul>
    <!-- <a href="route('jogos.create')}}" class="btn btn-secondary">Adicionar Jogo</a> -->
    @if($nivel > 0)
        <a href="{{ route('campeonatos.show', $campeonato->id) }}" class="btn btn-primary">Acessar Início</a>
    @else
        <a href="{{ route('campeonatos.index') }}" class="btn btn-primary">Acessar Campeonatos</a>
        <a href="{{ route('home.index') }}" class="btn btn-primary">Acessar Início</a>
    @endif
</x-layout>