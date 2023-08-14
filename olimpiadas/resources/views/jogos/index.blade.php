<x-layout title="Jogos">
    <h2>{{ $campeonato->nome }}</h2>
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
                <p>{{ $jogo->placar }}</p>
                <a href="{{ route('campeonatos.jogos.edit', [ 'campeonato' => $campeonato->id, 'jogo' => $jogo->id]) }}" class="btn btn-primary">Editar</a>
            </li>
            @endforeach
        @else
            <li>Ainda não há jogos criados!</li>
        @endif
    </ul>
    <!-- <a href="route('jogos.create')}}" class="btn btn-secondary">Adicionar Jogo</a> -->
    <a href="{{ route('campeonatos.show', $campeonato->id) }}" class="btn btn-primary">Acessar Início</a>
</x-layout>