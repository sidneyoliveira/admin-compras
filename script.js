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
var dados = [
    [
       "1",
       "Tiger Nixon",
       "System Architect",
       "Edinburgh",
       "5421",
       "2011\/04\/25",
       "$320,800",
       "$170,750",
       "$170,750",
    ],
    [
       "2",
       "Garrett Winters",
       "Accountant",
       "Tokyo",
       "8422",
       "2011\/07\/25",
       "$170,750",
       "$170,750",
       "$170,750",
    ],
  ];
  

$(document).ready(function() {
   var table = $('#table_1').DataTable({
        'responsive': true,
        'data': dados,
        'columnDefs': [
          {
             'targets': 0,
             'checkboxes': true
          }
       ],
       'order': [[1, 'asc']]
   });
});

// $(function(){
//     //chama a função atualizaDados daqui à 5000ms (5s)
//     window.setTimeout(atualizaDados, 5000);
//     function atualizaDados() {
//         //carrega o conteúdo do arquivo "ajax.php" para dentro da div#exibeDados
//         $("#exibeDados").load('ajax.php');
//         //para perpetuar a chamada da função sempre a cada 5s
//         window.setTimeout(atualizaDados, 5000);
//     }
// });