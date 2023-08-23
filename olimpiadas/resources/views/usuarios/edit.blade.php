<x-layout title="Editar Usuário">
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="post">
        @csrf
        @method('PUT')
        <label for="name" class="form-label">Nome:</label>
        <input type="text" id="name" name="name" value="{{ $usuario->name }}" class="form-control"/>
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" value="{{ $usuario->email }}" class="form-control"/>
        <label for="nivelAcesso" class="form-label">Nível Acesso:</label>
        <select id="nivelAcesso" name="nivelAcesso" class="form-select">
            @for ($i = 0; $i <= 2; $i++)
                <option @if($i == $usuario->nivelAcesso) selected @endif value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</x-layout>