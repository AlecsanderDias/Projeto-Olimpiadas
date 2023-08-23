<x-layout title="Criar Usuário">
    <form action="{{ route('usuarios.store') }}" method="post">
        @csrf
        <label for="name" class="form-label">Nome:</label>
        <input type="text" id="name" name="name" placeholder="Ex: João da Costa" class="form-control"/>
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" placeholder="Ex: name@example.com" class="form-control"/>
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" id="password" name="password" class="form-control"/>
        <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"/>
        <button type="submit" class="btn btn-primary">Adicionar</button>
    </form>
</x-layout>