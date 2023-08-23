<x-layout title="Usuários do Sistema">
    <ul>
        @foreach($usuarios as $usuario)
            @if($usuario->id != $id)
            <li class="d-flex gap-3">
                <p>{{ $usuario->name }}</p>
                <p>{{ $usuario->email }}</p>
                <p>{{ $usuario->nivelAcesso }}</p>
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary">Editar</a>
                <!-- <a href=" route('campeonatos.edit', $campeonato->id) }}" class="btn btn-primary">Editar</a> -->
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
            </li>
            @endif
        @endforeach
    </ul>
    <a href="{{ route('home.index') }}" class="btn btn-primary">Acessar Início</a>
</x-layout>