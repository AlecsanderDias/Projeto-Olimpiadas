<x-layout title="Editar Time">
    <form action="{{ route('campeonatos.times.update', ['campeonato' => $campeonato->id ,'time' => $time->id]) }}" method="post">
        @csrf
        @method('PUT')
        <label for="nome" class="form-label">Nome do Time:</label>
        <input type="text" id="nome" name="nome" value="{{ $time->nome }}" class="form-control" disabled/>
        <div class="form-control form-control-lg" id="listagem">
        </div>
        <input id="listaParticipantes" name="listaParticipantes" class="form-control" hidden/>
        <label for="participantes" class="form-label">Equipe:</label>
        <select id="participantes" name="participantes" class="form-select" onchange="adicionarElemento(this)">
            @foreach ($participantes as $participante)
            <option value="{{ $participante->id }}">{{ $participante->nome }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Atualizar Time</button>
    </form>

    <script>
        var arrayParticipantesOriginal = {{ Js::from($participantes) }};
        // console.log(arrayParticipantesOriginal);
        var arrayParticipantesSelecionados = {{ Js::from($time->participantes) }};
        // console.log("Participantes Selecionado => ", arrayParticipantesSelecionados ,"Participantes Original => " , arrayParticipantesOriginal);
        arrayParticipantesSelecionados.forEach(participante => {
            criarElementoTexto(participante.nome, participante.id);
            arrayParticipantesOriginal = arrayParticipantesOriginal
            .filter(objeto => objeto.id != participante.id && objeto.nome != participante.nome);
        })
        // console.log("Participantes Selecionado => ", arrayParticipantesSelecionados ,"Participantes Original => " , arrayParticipantesOriginal);
        
        atualizarResultado(arrayParticipantesSelecionados);
        var lista = document.getElementById("participantes");
        atualizarListaParticipantes("participantes");

        // Cria a lista de opções de Participantes
        function atualizarListaParticipantes(idElemento) {
            let elemento = document.getElementById(idElemento);
            elemento.innerHTML = '';
            criarElementoLista(idElemento, "Selecione um Participante...", "0");
            arrayParticipantesOriginal.forEach(participante => {
                criarElementoLista(idElemento, participante.nome, participante.id);
            });
        }

        // Criação da opção na lista de opções
        function criarElementoLista(idElemento, nome, id) {
            let opcao = document.createElement("option");
            let texto = document.createTextNode(nome);
            opcao.setAttribute("value", id);
            opcao.appendChild(texto);
            let elemento = document.getElementById(idElemento);
            elemento.appendChild(opcao);
        }

        // Criação do botão na lista
        function criarElementoTexto(nome, id) {
            let elemento = document.createElement("span");
            elemento.innerHTML = nome;
            elemento.classList.add("btn","btn-secondary","mx-1", "my-1");
            elemento.setAttribute("value",id);
            let deletar = document.createElement("button");
            deletar.classList.add("btn-close","disabled");
            deletar.setAttribute("type","button");
            deletar.setAttribute("aria-label","Close");
            elemento.appendChild(deletar);
            elemento.onclick = () => deletaElementoTexto(elemento);
            document.getElementById("listagem").appendChild(elemento);
        }

        // Adiciona o elemento de botao da Participante ao selecionar um opção
        function adicionarElemento(elemento) {
            let e = elemento.options[elemento.options.selectedIndex];
            arrayParticipantesOriginal = arrayParticipantesOriginal.filter(objeto => objeto.id != e.value && objeto.nome != e.text);
            
            // Só adicionar o elemento se não existir na lista de Participantes selecionada
            criarElementoTexto(e.text, e.value);
            arrayParticipantesSelecionados.push({id:e.value, nome:e.text});
            // console.log("Arrays => ", arrayParticipantesOriginal, arrayParticipantesSelecionados, ele);
            
            atualizarResultado(arrayParticipantesSelecionados);
            atualizarListaParticipantes("participantes");
        };

        // Atualiza os valores do array de id dos participantes
        function atualizarResultado(array) {
            array = array.map(item => JSON.stringify(item).replace(',','-'));
            // array = array.map(item => item.id);
            // console.log("Array selecionada => ", array);
            let lista = document.getElementById("listaParticipantes");
            lista.value = array.toString();
        }

        function deletaElementoTexto(elemento) {
            let atributo = elemento.getAttribute("value");
            let elementoNaLista = arrayParticipantesSelecionados.filter(item => item.id == atributo)[0];
            arrayParticipantesSelecionados = arrayParticipantesSelecionados.filter(item => item.id != elementoNaLista.id);
            arrayParticipantesOriginal.push(elementoNaLista);
            atualizarListaParticipantes("participantes");
            atualizarResultado(arrayParticipantesSelecionados);
            elemento.remove();
        }
    </script>
</x-layout>