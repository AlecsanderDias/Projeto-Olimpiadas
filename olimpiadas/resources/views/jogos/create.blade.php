<x-layout title="Criar Jogos">
    <form action="{{ route('campeonatos.jogos.store', $campeonato->id) }}" method="post">
        @csrf
        <label for="listaEquipes" class="form-label">Lista de Equipes Participando:</label>
        <input type="text" id="quantidadeEquipes" name="quantidadeEquipes" value="{{ count($equipes) }}" class="form-control" hidden/>
        <div class="form-control form-control-lg" id="listagemEquipes">
            @foreach ($equipes as $equipe)
                <span class="btn btn-secondary mx-1 my-1 disabled" >{{ $equipe->nome }}</span>
            @endforeach
        </div>
        <label for="listaTimes" class="form-label">Lista de Times Participando:</label>
        <input type="text" id="quantidadeTimes" name="quantidadeTimes" value="{{ count($times) }}" class="form-control" hidden/>
        <div class="form-control form-control-lg" id="listaTimes">
            @foreach ($times as $time)
                <span class="btn btn-secondary mx-1 my-1 disabled">{{ $time->nome }}</span>
            @endforeach
        </div>
        @if($campeonato->tipo_id > 2)
            <label for="timesClassificados" class="form-label">Quantidade de Times para Eliminatórias:</label>
            <select id="timesClassificados" name="timesClassificados" class="form-select">
                @for ($i = 2; $i <= count($times); $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        @endif
        <button type="submit" class="btn btn-primary">Criar Jogos</button>
    </form>
</x-layout>