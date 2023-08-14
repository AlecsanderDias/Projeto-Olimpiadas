<x-layout title="Equipes">
    <ol>
        @foreach ($equipes as $equipe)
        <li class="d-flex gap-4">
            <p>{{ $equipe->nome }}</p>
            <p>{{ $equipe->capitao }}</p>
            <p>{{ $equipe->pontuacao }}</p>
            <a href="{{ route('equipes.edit', $equipe->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('equipes.destroy', $equipe->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Excluir</button>
            </form>
        </li>
        @endforeach
    </ol>
    <a href="{{route('equipes.create')}}" class="btn btn-secondary">Adicionar Equipe</a>
    <a href="{{ route('home.index') }}" class="btn btn-primary">Acessar Início</a>
</x-layout>