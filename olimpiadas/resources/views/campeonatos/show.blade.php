<x-layout title="{{ $campeonato->nome }}">
    <h2>Campeonato : {{ $campeonato->nome }} </h2>
    <ul>
        <li class="d-flex gap-4">
            <p>{{ $campeonato->tipo_id }}</p>
            <p>{{ $campeonato->modalidade_id }}</p>
            <p>{{ $campeonato->especialidade_id }}</p>
            <p>{{ $campeonato->timesPorEquipe }}</p>
        </li>
        <h3>Times</h3>
        @foreach ($equipes as $equipe)
        <li class="d-flex gap-4">
            <h4>{{ $equipe->nome }}</h4>
            <ul class="d-flex gap-4">
                @for($i = 1; $i <= $campeonato->timesPorEquipe; $i++)
                    @php($criar = false)
                    @foreach ($times as $time)
                        @if(str_contains($time->nome, $equipe->nome) && str_contains($time->nome, $i))
                        <li>
                            <p> {{ $time->nome }}</p>
                            <a href="{{ route('campeonatos.times.edit', ['campeonato' => $campeonato->id,'time' => $time->id] ) }}" class="btn btn-primary">Editar Equipe</a>
                            <form action="{{ route('campeonatos.times.destroy', ['campeonato' => $campeonato->id, 'time' => $time->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Excluir Equipe</button>
                            </form>
                        </li>
                        @php($criar = true)
                        @break
                        @endif
                    @endforeach
                    @if($criar == false)
                        <li>
                        @php($nome = "$equipe->nome $i")
                            <p>{{ $nome }}</p>
                            <form action="{{ route('campeonatos.times.store', ['campeonato' => $campeonato->id,'equipe' => $equipe->id, 'nomeTime' => $nome ]) }}" method="post">
                                @csrf
                                <button class="btn btn-primary">Criar Equipe</button>
                            </form>
                        </li>
                    @endif
                @endfor
            </ul>
        </li>
        @endforeach
    </ul>
    <a href="{{ route('campeonatos.jogos.create', $campeonato->id) }}" class="btn btn-primary">Criar Jogos</a>
    <a href="{{ route('campeonatos.jogos.index', ['campeonato' => $campeonato->id]) }}" class="btn btn-primary">Visualizar Jogos</a>
    <a href="{{ route('campeonatos.index') }}" class="btn btn-primary">Voltar</a>
</x-layout>