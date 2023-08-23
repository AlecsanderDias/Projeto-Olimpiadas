<x-layout title="Início">
    <h2>Menu de Acesso</h2>
    {{ $nivel }}
    @if($nivel > 0)
        <a href="{{ route('equipes.index') }}" class="btn btn-primary">Acessar Equipes</a>
        <a href="{{ route('participantes.index') }}" class="btn btn-primary">Acessar Participantes</a>
        @if($nivel == 2) 
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Acessar Usuários</a>
        @endif
    @endif
        <a href="{{ route('campeonatos.index') }}" class="btn btn-primary">Acessar Campeonatos</a>
</x-layout>