const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".bx-menu");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
});

// table.js
// dados.js
// var dados = [
//     [
//        "1",
//        "Tiger Nixon",
//        "System Architect",
//        "Edinburgh",
//        "5421",
//        "2011\/04\/25",
//        "$320,800",
//        "$170,750",
//        "$170,750",
//     ],
//     [
//        "2",
//        "Garrett Winters",
//        "Accountant",
//        "Tokyo",
//        "8422",
//        "2011\/07\/25",
//        "$170,750",
//        "$170,750",
//        "$170,750",
//     ],
//   ];



  // Chamando a função para obter os dados e exibi-los na tabela

 async function obterDados(callback) {

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'ajax.php', true); // Substitua 'obter_dados.php' pelo nome do seu arquivo PHP no servidor
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var dados = JSON.parse(xhr.responseText);

          var resultado = [];
          for (var i = 0; i < dados.length; i++) {
            var objeto = dados[i];
            var novoArray = [];
            novoArray.push(objeto.id); 
            novoArray.push(objeto.id); 
            novoArray.push(objeto.setor);  
            novoArray.push(objeto.sec);
            novoArray.push(objeto.data);
            novoArray.push(objeto.item);
            novoArray.push(objeto.quant);
            novoArray.push(objeto.v_unit);
            novoArray.push(objeto.v_total);
        
            resultado.push(novoArray);
          }
          console.log(resultado)
          callback(resultado);
          
        }
      };
      xhr.send();
  }


$(document).ready(function() {
  
  obterDados(function(dadosTransformados) {
    var table = $('#table_1').DataTable({
      
      responsive: true,
      'data': dadosTransformados,
      'columnDefs': [
        {
           'targets': 0,
           'checkboxes': true
        }
      ],
      'order': [[1, 'asc']],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
      }

    });
});
});


document.addEventListener('DOMContentLoaded', function () {
  var salvarCadastroButton = document.getElementById('salvar_cadastro');

  salvarCadastroButton.addEventListener('click', function () {
    // Recupere os valores com base nas IDs
    var setor = document.getElementById('setor').value;
    var sec = document.getElementById('sec').value;
    var data = document.getElementById('data').value;
    var item = document.getElementById('item').value;
    var quant = document.getElementById('quant').value;

    // Você pode fazer o que quiser com os valores aqui
    console.log('Setor:', setor);
    console.log('Secretaria:', sec);
    console.log('Data:', data);
    console.log('Item:', item);
    console.log('Quantidade:', quant);
    
    var formData = new FormData();
    formData.append('setor', setor);
    formData.append('sec', sec);
    formData.append('data', data);
    formData.append('item', item);
    formData.append('quant', quant);
    

    // Faça uma solicitação fetch para o arquivo PHP
    fetch('dados.php', {
      method: 'POST',
      body: formData,

    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Erro na solicitação');
        }
      })
      .then(data => {
          var successMessageContent = 'Requisição Cadastrada com Sucesso!  <a href="#" class="alert-link" id="reloadLink"> Clique aqui para atualizar a página.</a>';
          var successMessage = document.getElementById('successMessage');
          successMessage.innerHTML = successMessageContent; // Definir o conteúdo da mensagem de sucesso
          successMessage.classList.remove('d-none'); // Mostrar a mensagem de sucess
          successMessage.classList.add('show'); // Mostrar a mensagem de sucess

          var reloadLink = document.getElementById('reloadLink');
          reloadLink.addEventListener('click', function(event) {
            event.preventDefault(); // Impede o comportamento padrão do link (não seguir o link)
            location.reload(); // Recarrega a página
          });

          setTimeout(function() {
            successMessage.classList.remove('show');
            // Mostrar a mensagem de sucess
          }, 6000);
          
          setTimeout(function() {
            successMessage.classList.add('d-none');
          }, 6300);

                    
      })
      .catch(error => {
        console.error('Erro:', error);
      
      });
  });
});

