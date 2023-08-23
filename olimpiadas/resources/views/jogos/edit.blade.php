<x-layout title="Editar Equipe">
    <form action="{{ route('campeonatos.jogos.update', ['campeonato' => $campeonato->id, 'jogo' => $jogo->id]) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nomeJogo" class="form-label">Nome do Jogo:</label>
        <input type="text" id="nome" name="nomeJogo" value="{{ $jogo->nome }}" class="form-control" disabled/>
        <label for="data" class="form-label">Data do Jogo:</label>
        <input type="date" id="data" name="data" value="{{ $jogo->data }}" class="form-control"/>
        <label for="casa" class="form-label">Time Casa:</label>
        <select id="casa" name="casa" class="form-select" @if (isset($jogo->casa)) disabled @endif>
            @foreach ($times as $time)
            <option value="{{ $time->id }}" @if($jogo->casa == $time->id) selected @endif>{{ $time->nome }}</option>
            @endforeach
        </select>
        <label for="adversario" class="form-label">Time Adversario:</label>
        <select id="adversario" name="adversario" class="form-select" @if (isset($jogo->adversario)) disabled @endif>
            @foreach ($times as $time)
            <option value="{{ $time->id }}" @if($jogo->adversario == $time->id) selected @endif>{{ $time->nome }}</option>
            @endforeach
        </select>
        <label for="resultadoCasa" class="form-label">Resultado Casa:</label>
        <select id="resultadoCasa" name="resultadoCasa" class="form-select" onchange="trocar(this)">
            @foreach ($resultados as $abreviacao=>$resultado)
            <option value="{{ $abreviacao }}" @if ($jogo->resultadoCasa == $abreviacao) selected
            @endif >{{ $resultado }}</option>
            @endforeach
        </select>
        <label for="resultadoAdversario" class="form-label">Resultado Adversario:</label>
        <select id="resultadoAdversario" name="resultadoAdversario" class="form-select" onchange="trocar(this)">
            @foreach (array_reverse($resultados) as $abreviacao=>$resultado)
                <option value="{{ $abreviacao }}" @if ($jogo->resultadoAdversario == $abreviacao) selected
                @endif >{{ $resultado }}</option>
            @endforeach
        </select>
        <label for="placarCasa" class="form-label">Placar Casa:</label>
        <input type="number" id="placarCasa" name="placarCasa" value="{{ $jogo->placarCasa }}" class="form-control"/>
        <label for="placarAdversario" class="form-label">Placar Adversário:</label>
        <input type="number" id="placarAdversario" name="placarAdversario" value="{{ $jogo->placarAdversario }}" class="form-control"/>
        
        <button type="submit" class="btn btn-primary">Atualizar Jogo</button>
    </form>
    <script>
        var arrayResultado = {{ Js::from($resultados) }};
        function trocar(elemento) {
            let resultado;
            if (elemento.id == 'resultadoAdversario') {
                resultado = document.getElementById('resultadoCasa');
            } 
            if(elemento.id == 'resultadoCasa') {
                resultado = document.getElementById('resultadoAdversario');
            } 
            switch (elemento.value) {
                case 'V':
                    resultado.value = 'D';
                    break;
                case 'D':
                    resultado.value = 'V';
                    break;
                default:
                    resultado.value = 'E';
                    break;
            }
            // console.log(valor, arrayResultado['E'], resultadoAdversario.value);
        }
    </script>
</x-layout>