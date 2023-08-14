<x-layout title="Editar Equipe">
    <form action="{{ route('equipes.update', $equipe->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $equipe->nome }}" class="form-control"/>
        <label for="capitao" class="form-label">Capitão:</label>
        <select id="capitao" name="capitao" class="form-select">
            @foreach ($participantes as $participante)
            <option value="{{ $participante->id }}">{{ $participante->nome }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layout>