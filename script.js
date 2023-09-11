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


const fs = require('fs');

// Nome do arquivo de texto a ser lido
const fileName = 'data.txt';

// Lê o arquivo de texto
fs.readFile(fileName, 'utf8', (err, data) => {
    if (err) {
        console.error(`Erro ao ler o arquivo ${fileName}: ${err}`);
        return;
    }

    console.log(`Conteúdo do arquivo ${fileName}:\n${data}`);
});

import data from ".data.sql"

var table = $('#table_1').DataTable({
       'data': data,
       'columnDefs': [
          {
             'targets': 0,
             'checkboxes': true
          }
       ],
       'order': [[1, 'asc']]
});
 