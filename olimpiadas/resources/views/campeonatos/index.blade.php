<x-layout title="Campeonatos">
    <ol>
        @foreach ($campeonatos as $campeonato)
        <li class="d-flex gap-4">
            {{ $nivel }}
            @if($nivel > 0)
                <p>{{ $campeonato->nome }}</p>
            @else
                <p>
                    <a href="{{ route('campeonatos.jogos.index', ['campeonato' => $campeonato->id]) }}">{{ $campeonato->nome }}</a>
                </p>
            @endif
            <p>{{ $campeonato->tipo_id }}</p>
            <p>{{ $campeonato->modalidade_id }}</p>
            <p>{{ $campeonato->especialidade_id }}</p>
            <p>{{ $campeonato->timesPorEquipe }}</p>
            @if($nivel > 0)
                <a href="{{ route('campeonatos.show', $campeonato->id ) }}" class="btn btn-primary">Gerenciar Campeonato</a>
                <!-- <a href=" route('campeonatos.edit', $campeonato->id) }}" class="btn btn-primary">Editar</a> -->
                <form action="{{ route('campeonatos.destroy', $campeonato->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
            @endif
        </li>
        @endforeach
    </ol>
    <a href="{{route('campeonatos.create')}}" class="btn btn-secondary">Adicionar Campeonato</a>
    <a href="{{ route('home.index') }}" class="btn btn-primary">Acessar Início</a>
</x-layout>