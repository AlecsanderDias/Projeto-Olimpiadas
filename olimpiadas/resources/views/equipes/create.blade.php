<x-layout title="Criar Equipe">
    <form action="{{ route('equipes.store') }}" method="post">
        @csrf
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: Equipe 1" class="form-control"/>
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
</x-layout>