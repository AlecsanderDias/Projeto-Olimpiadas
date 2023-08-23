<x-layout title="Criar Campeonatos">
    <form action="{{ route('campeonatos.store') }}" method="post">
        @csrf
        <label for="nome" class="form-label">Nome:</label>
        <input id="nome" name="nome" type="text" placeholder="Ex: Futsal dos manos" class="form-control" />
        <label for="tipo" class="form-label">Tipo:</label>
        <select id="tipo" name="tipo_id" class="form-select">
            @foreach ($tipos as $tipo)
            <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
            @endforeach
        </select>
        <label for="modalidade" class="form-label">Modalidade:</label>
        <select id="modalidade" name="modalidade_id" class="form-select">
            @foreach ($modalidades as $modalidade)
            <option value="{{ $modalidade->id }}">{{ $modalidade->nome }}</option>
            @endforeach
        </select>
        <label for="especialidade" class="form-label">Especialidade:</label>
        <select id="especialidade" name="especialidade_id" class="form-select">
            @foreach ($especialidades as $especialidade)
            <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
            @endforeach
        </select>
        <label for="timesPorEquipe" class="form-label">Quantidade de Times por Equipe:</label>
        <select id="timesPorEquipe" name="timesPorEquipe" class="form-select">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>

        <!-- Lista de Equipes que vão participar do torneio -->
        <label for="listaEquipes" class="form-label">Lista de Equipes:</label>
        <div class="form-control form-control-lg" id="listagem">
        </div>
        <input id="listaEquipes" name="listaEquipes" class="form-control" hidden/>
        <input type="number" id="quantidadeEquipes" name="quantidadeEquipes" class="form-control" hidden>
        <select id="listaDeEquipes" name="listaDeEquipes" class="form-select" onchange="adicionarElemento(this)">
        </select>

        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
    <script>
        var arrayEquipesOriginal = {{ Js::from($equipes) }};
        var arrayEquipesSelecionadas = [];
        var lista = document.getElementById("listaDeEquipes");
        var quantidadeEquipes = document.getElementById('quantidadeEquipes');
        atualizarListaEquipes("listaDeEquipes");

        // Cria a lista de opções de equipes
        function atualizarListaEquipes(idElemento) {
            let elemento = document.getElementById(idElemento);
            elemento.innerHTML = '';
            criarElementoLista(idElemento, "Selecione uma equipe...", "0");
            arrayEquipesOriginal.forEach(equipe => {
                criarElementoLista(idElemento, equipe.nome, equipe.id);
            });
            quantidadeEquipes.value = arrayEquipesSelecionadas.length;
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

        // Adiciona o elemento de botao da equipe ao selecionar um opção
        function adicionarElemento(elemento) {
            let ele = document.getElementById("timesPorEquipe").children;
            let e = elemento.options[elemento.options.selectedIndex];
            arrayEquipesOriginal = arrayEquipesOriginal.filter(objeto => objeto.id != e.value && objeto.nome != e.text);
            
            // Só adicionar o elemento se não existir na lista de equipes selecionada
            criarElementoTexto(e.text, e.value);
            arrayEquipesSelecionadas.push({id:e.value, nome:e.text});
            // console.log("Arrays => ", arrayEquipesOriginal, arrayEquipesSelecionadas, ele);
            
            atualizarResultado(arrayEquipesSelecionadas);
            atualizarListaEquipes("listaDeEquipes");
        };

        // Atualiza os valores do array de id dos participantes
        function atualizarResultado(array) {
            array = array.map(item => JSON.stringify(item).replace(',','-'));
            // array = array.map(item => item.id);
            // console.log("Array selecionada => ", array);
            let lista = document.getElementById("listaEquipes");
            lista.value = array.toString();
        }

        function deletaElementoTexto(elemento) {
            let atributo = elemento.getAttribute("value");
            let elementoNaLista = arrayEquipesSelecionadas.filter(item => item.id == atributo)[0];
            arrayEquipesSelecionadas = arrayEquipesSelecionadas.filter(item => item.id != elementoNaLista.id);
            arrayEquipesOriginal.push(elementoNaLista);
            atualizarListaEquipes("listaDeEquipes");
            atualizarResultado(arrayEquipesSelecionadas);
            elemento.remove();
        }

        function imprime(elemento) {
            console.log(elemento.value);
        }
    </script>
</x-layout>