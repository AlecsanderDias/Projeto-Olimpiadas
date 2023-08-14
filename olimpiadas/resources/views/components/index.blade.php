<x-layout title="Início">
    <h2>Menu de Acesso</h2>
    <a href="{{ route('equipes.index') }}" class="btn btn-primary">Acessar Equipes</a>
    <a href="{{ route('participantes.index') }}" class="btn btn-primary">Acessar Participantes</a>
    <a href="{{ route('campeonatos.index') }}" class="btn btn-primary">Acessar Campeonatos</a>
</x-layout>