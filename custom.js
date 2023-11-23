$(document).ready(function() {
    $('#listar-agua').DataTable({
        // "processing": true,
        "serverSide": true,
        "ajax": "listar_usuarios.php",
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
        },
        "responsive": true,
        "columnDefs": [
            {
                'targets': 0,
                'checkboxes': true
            },
            {
                "targets": 7, 
                "className": "text-end" 
            },
            {
                "targets": 8, // Número da coluna (baseado em zero)
                "createdCell": function (td, cellData, rowData, row, col) {
                    // Verifica se a célula contém um elemento select
                    var selectElement = $(td).find('select');

                    if (selectElement.length > 0) {
                        // Obtém o valor selecionado no select
                        var selectedValue = selectElement.val();
        
                        if (selectedValue === "1") {
                            selectElement.css('background-color', '#fffcec');
                            selectElement.css('color', '#ffb424'); // Define o background como verde
                            selectElement.css('border-color', '#ffb424'); // Define o background como verde
                        }else if (selectedValue === "2") {
                            selectElement.css('background-color', '#edf5ff');
                            selectElement.css('color', '#0049d3'); // Define o background como verde
                            selectElement.css('border-color', '#0049d3'); // Define o background como verde
                        }else if (selectedValue === "3") {
                            selectElement.css('background-color', '#f4fff4');
                            selectElement.css('color', '#72c173'); // Define o background como verde
                            selectElement.css('border-color', '#72c173'); // Define o background como verde
                        }
                    }
                }
            }
        ],
        "order": [[1, 'asc']],
    });
  });


  var selectStatus = document.getElementsByClassName('custom-select h-25 py-0 rounded-pill');

  $(document).on('change', selectStatus, function() {
    var selectedValue = $(this).val();

    if (selectedValue === "1") {
        $(this).css('background-color', '#fffcec'); 
        $(this).css('color', '#ffb424'); 
        $(this).css('border-color', '#ffb424'); 

    } else if (selectedValue === "2") {
        $(this).css('background-color', '#edf5ff');
        $(this).css('color', '#0049d3'); 
        $(this).css('border-color', '#0049d3');

    } else if (selectedValue === "3") {
        $(this).css('background-color', '#f4fff4'); 
        $(this).css('color', '#72c173'); 
        $(this).css('border-color', '#72c173');

    } else {
        $(this).css('background-color', ''); // Remove a cor de fundo se nenhuma opção corresponder
    }
});
  const formNewUser = document.getElementById("form-cad-usuario");
  const fecharModalCad = new bootstrap.Modal(document.getElementById("modalCadastro"));
  if (formNewUser) {
    
    var salvarCadastroButton = document.getElementById('salvar_cadastro');

    salvarCadastroButton.addEventListener('click', async function () {

        const dadosForm = new FormData(formNewUser);
  
        const dados = await fetch("cadastrar.php", {
            method: "POST",
            body: dadosForm,
        });
        const resposta = await dados.json();
        //console.log(resposta);
  
        if (resposta['status']) {
        
        var successMessageContent = 'Requisição Cadastrada com Sucesso!</a>';
        var successMessage = document.getElementById('successMessage');
        successMessage.innerHTML = successMessageContent; // Definir o conteúdo da mensagem de sucesso
        successMessage.classList.remove('d-none'); // Mostrar a mensagem de sucess
        successMessage.classList.add('show'); // Mostrar a mensagem de sucess

        setTimeout(function() {
            successMessage.classList.remove('show');
            // Mostrar a mensagem de sucess
        }, 6000);
          
        setTimeout(function() {
            successMessage.classList.add('d-none');
        }, 6300);

        formNewUser.reset();
        fecharModalCad.hide();
        listarDataTables = $('#listar-agua').DataTable();
        listarDataTables.draw();

        } else {
            console.log("erro");
        }
    });
  }
  
  async function visUsuario(id) {
    //console.log("Acessou: " + id);
    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);
  
    if (resposta['status']) {
        const visModal = new bootstrap.Modal(document.getElementById("visUsuarioModal"));
        visModal.show();
  
        document.getElementById("idUsuario").innerHTML = resposta['dados'].id;
        document.getElementById("nomeUsuario").innerHTML = resposta['dados'].nome;
        document.getElementById("salarioUsuario").innerHTML = resposta['dados'].salario;
        document.getElementById("idadeUsuario").innerHTML = resposta['dados'].idade;
  
        document.getElementById("msgAlerta").innerHTML = "";
    } else {
        document.getElementById("msgAlerta").innerHTML = resposta['msg'];
    }
  }
  
  
  async function capId(id) {
  const formEditStatus = document.getElementById('form-status-'+ id);
  
  if (formEditStatus) {

        const formEdit = new FormData();
        formEdit.append("id", id);
        formEdit.append("statuss", formEditStatus.value);

        const dados = await fetch("status.php", {
            method: "POST",
            body: formEdit
        });
  
        const resposta = await dados.json();
  
        if (resposta['status']) {
            // Atualizar a lista de registros
            listarDataTables = $('#listar-agua').DataTable();
            listarDataTables.draw();
        } else {
        }

  }
}

  async function apagarUsuario(id) {
    //console.log("Acessou: " + id);
    
    var confirmar = confirm("Tem certeza que deseja excluir o registro selecionado?");

    if (confirmar) {
        
        var ArrayIDs = await consultarID();

        for (var i = 0;i < ArrayIDs.length; i++){
        
        const dados = await fetch("apagar.php?id=" + ArrayIDs[i]);
        const resposta = await dados.json();
        //

        if (resposta['status']) {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
            setTimeout(function() {
                document.getElementById("msgAlerta").innerHTML = "";
                // Mostrar a mensagem de sucess
            }, 3000);

            //console.log(resposta.msg);
            // Atualizar a lista de registros
            listarDataTables = $('#listar-agua').DataTable();
            listarDataTables.draw();
        } else {
            document.getElementById("msgAlerta").innerHTML = resposta['msg'];
        }
        }
    }
  }

  async function consultarID() {
    var retorno = [];
    var checklist = document.getElementsByClassName("dt-checkboxes");

    for (var i = 0; i < checklist.length; i++) {
        var item = checklist[i];

        // Faça o que deseja com o item individual
        var parentCell = item.parentElement;

        // Encontre a célula <td> da primeira coluna (índice 1) na mesma linha
        var firstColumnCell = parentCell.nextElementSibling;

        // Obtenha o valor da primeira coluna
        var idValue = firstColumnCell.textContent;

        if (item.checked) {
            console.log('O item ' + idValue + ' está marcado.');
            retorno.push(idValue);
        } else {
            console.log('O item ' + idValue + ' não está marcado.');
        }
    }
    
    console.log(retorno);
    
    // Retorna o valor da variável retorno
    return retorno;
}

  setTimeout(function() {
    var checklist = document.getElementsByClassName("dt-checkboxes");
    
    for (var i = 0; i < checklist.length; i++) {

        (function(item) { // Cria um escopo separado para cada item
            item.addEventListener("change", function() {
                // Faça o que deseja com o item individual
                var parentCell = item.parentElement;

                // Encontre a célula <td> da primeira coluna (índice 1) na mesma linha
                var firstColumnCell = parentCell.nextElementSibling;

                // Obtenha o valor da primeira coluna
                var idValue = firstColumnCell.textContent;

                if (item.checked) {
                    console.log('O item ' + idValue + ' está marcado.');
                    // Realize outras ações conforme necessário
                } else {
                    console.log('O item ' + idValue + ' não está marcado.');
                    // Realize outras ações conforme necessário
                }
            });
        })(checklist[i]); // Passe o item atual para a função imediata
    }
}, 3000);

async function setorAlt(){

    function obterSetor(callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'setorArray.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                callback(data);
            }
        };
        xhr.send();
    }
    
    // Exemplo de uso:
    obterSetor(function(valoresENomesSetor) {
        
        var secV = document.getElementById("sec_option");
        var setorV = document.getElementById("setor_alt");

        setorV.innerHTML = '';
        var num = secV.value;
        console.log(num);
        var novasOpcoes = '';

        if (num == 1) {

            for (var i = 1; i <= 5; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }

        } else if (num == 2) {

            for (var i = 6; i <= 12; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }
        } else if (num == 2) {

            for (var i = 6; i <= 12; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }
        } else if (num == 3) {

            for (var i = 13; i <= 16; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }
        } else if (num == 4) {

            for (var i = 17; i <= 20; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }
        } else if (num == 9) {

            for (var i = 21; i <= 22; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = valoresENomesSetor[i]
                setorV.appendChild(option);
            }
        } else if (num == 5 || num == 6 || num == 7 || num == 8 || num == 10 ) {

                var option = document.createElement("option");
                option.value = 0;
                option.text = valoresENomesSetor[0]
                setorV.appendChild(option);
        } 

        for (var i = 0; i < novasOpcoes.length; i++) {
            
        }
    });
}