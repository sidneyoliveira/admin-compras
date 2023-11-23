$(document).ready(function() {
  const $body = $("body"),
        $modeToggle = $(".mode-toggle"),
        $sidebar = $("nav"),
        $sidebarToggle = $(".bx-menu");

  let getMode = localStorage.getItem("mode");
  if (getMode && getMode === "dark") {
    $body.toggleClass("dark");
  }

  let getStatus = localStorage.getItem("status");
  if (getStatus && getStatus === "close") {
    $sidebar.toggleClass("close");
  }

  $modeToggle.on("click", () => {
    $body.toggleClass("dark");
    if ($body.hasClass("dark")) {
      localStorage.setItem("mode", "dark");
    } else {
      localStorage.setItem("mode", "light");
    }
  });

  $sidebarToggle.on("click", () => {
    $sidebar.toggleClass("close");
    if ($sidebar.hasClass("close")) {
      localStorage.setItem("status", "close");
    } else {
      localStorage.setItem("status", "open");
    }
  });
});


// var modalCadastro = document.getElementById('modalCadastro');

// modalCadastro.addEventListener('click', function (){
//   var 

// });

// document.addEventListener('DOMContentLoaded', function () {
//   var salvarCadastroButton = document.getElementById('salvar_cadastro');

//   salvarCadastroButton.addEventListener('click', function () {
//     // Recupere os valores com base nas IDs
//     var setor = document.getElementById('setor').value;
//     var sec = document.getElementById('sec').value;
//     var data = document.getElementById('data').value;
//     var item = document.getElementById('item').value;
//     var quant = document.getElementById('quant').value;

//     // Você pode fazer o que quiser com os valores aqui
//     console.log('Setor:', setor);
//     console.log('Secretaria:', sec);
//     console.log('Data:', data);
//     console.log('Item:', item);
//     console.log('Quantidade:', quant);
    
//     var formData = new FormData();
//     formData.append('setor', setor);
//     formData.append('sec', sec);
//     formData.append('data', data);
//     formData.append('item', item);
//     formData.append('quant', quant);
    

//     // Faça uma solicitação fetch para o arquivo PHP
//     fetch('dados.php', {
//       method: 'POST',
//       body: formData,

//     })
//       .then(response => {
//         if (!response.ok) {
//           throw new Error('Erro na solicitação');
//         }
//       })
//       .then(data => {
//           var successMessageContent = 'Requisição Cadastrada com Sucesso!  <a href="#" class="alert-link" id="reloadLink"> Clique aqui para atualizar a página.</a>';
//           var successMessage = document.getElementById('successMessage');
//           successMessage.innerHTML = successMessageContent; // Definir o conteúdo da mensagem de sucesso
//           successMessage.classList.remove('d-none'); // Mostrar a mensagem de sucess
//           successMessage.classList.add('show'); // Mostrar a mensagem de sucess

//           var reloadLink = document.getElementById('reloadLink');
//           reloadLink.addEventListener('click', function(event) {
//             event.preventDefault(); // Impede o comportamento padrão do link (não seguir o link)
//             location.reload(); // Recarrega a página
//           });

//           setTimeout(function() {
//             successMessage.classList.remove('show');
//             // Mostrar a mensagem de sucess
//           }, 6000);
          
//           setTimeout(function() {
//             successMessage.classList.add('d-none');
//           }, 6300);

                    
//       })
//       .catch(error => {
//         console.error('Erro:', error);
      
//       });
//   });
// });

// async function editcell(id){
//   await fetch('')
// }