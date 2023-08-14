<x-layout title="Editar Participante">
    <form action="{{ route('participantes.update', $participante->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $participante->nome }}" class="form-control"/>
        <label for="ala" class="form-label">Ala:</label>
        <input type="text" id="ala" name="ala" value="{{ $participante->ala }}" class="form-control"/>
        <label for="dataNascimento" class="form-label">Data Nascimento:</label>
        <input type="date" id="dataNascimento" name="dataNascimento" value="{{ $participante->dataNascimento }}" class="form-control"/>
        <label for="equipe_id" class="form-label">Equipe:</label>
        <select id="equipe_id" name="equipe_id" class="form-select">
            @foreach ($equipes as $equipe)
            <option @if($equipe->id == $participante->equipe_id) selected @endif value="{{ $equipe->id }}">{{ $equipe->nome }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layout>