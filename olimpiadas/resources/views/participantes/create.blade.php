<x-layout title="Adicionar Participante">
    <form action="{{ route('participantes.store') }}" method="post">
        @csrf
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Ex: João da Costa" class="form-control"/>
        <label for="ala" class="form-label">Ala:</label>
        <input type="text" id="ala" name="ala" placeholder="Ex: Águas Claras 2 ou Não membro" class="form-control"/>
        <label for="dataNascimento" class="form-label">Data Nascimento:</label>
        <input type="date" id="dataNascimento" name="dataNascimento" class="form-control"/>
        <label for="equipe_id" class="form-label">Equipe:</label>
        <select id="equipe_id" name="equipe_id" class="form-select">
            @foreach ($equipes as $equipe)
            <option value="{{ $equipe->id }}">{{ $equipe->nome }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>