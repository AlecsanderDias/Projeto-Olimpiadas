<x-layout title="Participantes">
    <ol>
        @foreach ($participantes as $participante)
        <li class="d-flex gap-4">
            <p>{{ $participante->nome }}</p>
            <p>{{ $participante->ala }}</p>
            <p>{{ $participante->dataNascimento }}</p>
            <p>{{ $participante->equipe_id }}</p>
            <a href="{{ route('participantes.edit', $participante->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('participantes.destroy', $participante->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Excluir</button>
            </form>
        </li>
        @endforeach
    </ol>
    <a href="{{route('participantes.create')}}" class="btn btn-secondary">Adicionar Participante</a>
    <a href="{{ route('home.index') }}" class="btn btn-primary">Acessar Início</a>
</x-layout>