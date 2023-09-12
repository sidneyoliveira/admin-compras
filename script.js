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

// // table.js
// // dados.js
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
//   ];
  
// Função para fazer uma solicitação AJAX para obter dados da tabela 'agua'
function obterDadosDaTabela() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'ajax.php', true); // Substitua 'obter_dados.php' pelo nome do seu arquivo PHP no servidor
    console.log(xhr);
    
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var dados = JSON.parse(xhr.responseText);
        exibirDadosNaTabela(dados);
      }
    };
    xhr.send();
  }
  
  // Função para exibir os dados obtidos na tabela HTML
function exibirDadosNaTabela(dados) {
    var tabela = document.getElementById('table_1');
    tabela.innerHTML = ''; // Limpa o conteúdo da tabela
    
    for (var i = 0; i < dados.length; i++) {
      var row = tabela.insertRow(i);
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
      var cell8 = row.insertCell(7);
      var cell9 = row.insertCell(8);
  
      cell1.textContent = dados[i].num_req;
      cell2.textContent = dados[i].setor;
      cell3.textContent = dados[i].sec;
      cell4.textContent = dados[i].data;
      cell5.textContent = dados[i].item;
      cell6.textContent = dados[i].quant;
      cell7.textContent = dados[i].v_unit;
      cell8.textContent = dados[i].v_total;
    }
    console.log(dados);

  }

  
  // Chamando a função para obter os dados e exibi-los na tabela
obterDadosDaTabela();



$(document).ready(function() {
   var table = $('#table_1').DataTable({
        'responsive': true,
        // 'data': dados,
        'columnDefs': [
          {
             'targets': 0,
             'checkboxes': true
          }
       ],
       'order': [[1, 'asc']]
   });
});