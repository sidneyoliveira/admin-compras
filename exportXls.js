
async function gerarXls(value){
  var htmlcompleto = "";

  var ArrayIDs = await consultarID();
  
  console.log(ArrayIDs.length);


  const progress = document.getElementById("progress-bar");
  
  progress.classList.remove("d-none");

  document.getElementById("progress-export").style.width = "0%";

  var valor = 0;

  for (var i = 0;i < ArrayIDs.length; i++){

    

    const dados = await fetch("exportDados.php?id=" + ArrayIDs[i]);
    var resposta = await dados.json();
    var dado = resposta.data[0];

    var id = dado[0];
    var data = dado[1];
    var setor = dado[2].toUpperCase();
    var sec = dado[3].toUpperCase();
    var item = dado[4];
    
    var num_item = 1;
    if (dado[4] == "ÁGUA MINERAL NATURAL - 500ML"){
      num_item = 1;
    }else if(dado[4] == "RECARGA DE ÁGUA MINERAL NATURAL - 20 LT"){
      num_item = 2;
    } else if(dado[4] == "VASILHAME PARA ÁGUA EM POLICARBONATO (COMPLETO)"){
    }

    var quant = dado [5];
    var v_unit = dado [6];
    var v_total = dado [7];

    var htmlContent = new Array(ArrayIDs.length);
    htmlContent[i] = `
      <meta charset="UTF-8">
      <style>
            table {
              border: 1px solid #111;
              border-collapse: collapse;
              margin: 2vw 2vw;
              padding: 0;
              width: 95%;
              table-layout: fixed;
            }
            
            table caption {
              font-size: 1em;
              margin: .2em 0 .5em;
            }
            
            table tr {
              background-color: #f8f8f8;
              border: 1px solid #111;
              padding: .35em;
            }
            
            table th,
            table td {
              border: 1px solid #111;
              padding: .2em .2em ;
              text-align: center;
              break-inside: avoid-column;
            }
            
            table th {
              font-size: .85em;
              letter-spacing: .1em;
              
            }
            
            table#header {
              border-collapse: collapse;
            }
            
            table#header th,
            table#header td {
              border: none;
            }
            
            table#info th,
            table#info td {
              border: none;
            }
            
            table#info tr {
              background-color: #f8f8f8;
              border: none;
              padding: .35em;
            }
            
            .vazio{
              font-size: 0.1em !important;
            }
            .linha {
              border: 1px dashed #111;
              border-radius: 2px; /* Opcional: arredonda as pontas da linha */
              width: 95%; /* Largura da linha */
              height: 1px; /* Altura da linha */
              margin: 8vw  auto; /* Margens opcionais para centralizar a linha */
              border-spacing: 20px;
            }
            
            /* general styling */
            body {
              font-family: "Inter", sans-serif;
              line-height: 1.5;
            }
      </style>
      <table id="header" >
        <thead>
          <tr style="background-color: #ffffff;">
            <th scope="col" style="width: 10%"><img src="https://i.ibb.co/WHgFD6x/link207.png" alt="Minha Figura" style="width: 7vw;padding: .5vw;"></th>
            <th scope="col" style="width: 60%; text-align: center; letter-spacing: normal; line-height: 0.5em;">
              <h2 style="font-size: 1em; margin-top: 1em;">PREFEITURA MUNICIPAL DE ITAREMA</h2>
              <h2 style="font-size: 0.7em; font-weight: 200;">Praça Nossa Senhora de Fátima, 48</h2>
              <h2 style="font-size: 0.7em; font-weight: 200;">Centro - Itarema - CE - Brasil | CEP: 62.590-000</h2>
              <h2 style="font-size: 1em; margin-top: 1em;">REQUISIÇÃO DE COMPRA</h2>
            </th>
            <th scope="col" style="width: 10%"><img src="https://i.ibb.co/GvMqGTJ/logo.png" alt="Minha Figura" style="width: 7vw;padding: .5vw;"></th>
          </tr>
        </thead>
      </table>
      <table id="info">
        <thead>
          <tr class="vazio">
            <th scope="col" style="width: 1%;">&nbsp;</th>
            <th scope="col" style="width: 10%;">&nbsp;</th>
            <th scope="col" style="width: 5%;">&nbsp;</th>
            <th scope="col" style="width: 8%;">&nbsp;</th>
            <th scope="col" style="width: 35%;">&nbsp;</th>
            <th scope="col" style="width: 6%;">&nbsp;</th>
            <th scope="col" style="width: 10%;">&nbsp;</th>
            <th scope="col" style="width: 1%;">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr style="font-size: 0.7em;">
            <td>&nbsp;</td>
            <td style="text-align:left;">Nº REQ:</td>
            <td id="num_req" style="text-align:left;border: 1px solid #111 !important;border-collapse:collapse;">${id}</td>
            <td>SECRET:</td>
            <td id="sec" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align:left;border: 1px solid #111 !important;border-collapse:collapse;">${sec}</td>
            <td>SETOR:</td>
            <td id="setor" style="text-align:left;border: 1px solid #111 !important;border-collapse:collapse;">${setor}</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="vazio">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr style="font-size: 0.7em;">
            <td>&nbsp;</td>
            <td style="text-align:left;">EMPRESA:</td>
            <td id="sec" colspan="3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align:left; border: 1px solid #111 !important;border-collapse:collapse;">FORT FRIOS</td>
            <td>HORA:</td>
            <td id="setor" style="text-align:left;border: 1px solid #111 !important;border-collapse:collapse;">9:00</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="vazio">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr style="font-size: 0.7em;">
            <td>&nbsp;</td>
            <td style="text-align:left;">OBJETO:</td>
            <td id="sec" colspan="3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align:left; border: 1px solid #111 !important;border-collapse:collapse;">AGUA</td>
            <td>DATA:</td>
            <td id="data" style="text-align:left;border: 1px solid #111 !important;border-collapse:collapse;">${data}</td>
            <td>&nbsp;</td>
          </tr>
          <tr class="vazio">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <table id="table">
        <thead>
          <tr style="background-color: #18dbdb;">
            <th scope="col" style="width: 5%;">ITEM</th>
            <th scope="col" style="width: 8%;">QUANT.</th>
            <th scope="col" style="width: 5%;">UND.</th>
            <th scope="col" style="width: 30%;">DESCRIÇÃO</th>
            <th scope="col" style="width: 8%;">V.UNIT.</th>
            <th scope="col" style="width: 8%;">V.TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr style="font-size: 0.65em; height: 1em !important">
            <td style="padding: .5em" id="item">${num_item}</td>
            <td id="quant">${quant}</td>
            <td id="und">UND</td>
            <td id="desc" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item}</td>
            <td id="v_unit">${v_unit}</td>
            <td id="v_total">${v_total}</td>
          </tr>
        </tbody>
      </table>
      <table id="total">
        <thead>
          <tr>
            <th scope="col" colspan="7" style="text-align:left;">TOTAL GERAL</th>
            <th scope="col">${v_total}</th>
          </tr>
        </thead>
      </table>
      <table id="ass">
        <thead>
          <tr>
            <th scope="col" style="height: 5em; border: none !important;border-collapse:collapse;">TOTAL GERAL</th>
            <th scope="col" style="height: 5em; border: none !important;border-collapse:collapse;"></th>
          </tr>
        </thead>
      </table>
      <div class="linha" ></div>
`

      console.log(i);
      
      htmlcompleto += htmlContent[i];

      console.log(htmlcompleto);
      console.log(htmlContent[i]);

      valor = (150/(ArrayIDs.length))*(i+1);

    document.getElementById("progress-export").style.width = valor+"%";
          console.log(valor+"%");
  }

    progress.classList.add("d-none");
    valor = 0;
    var blob = new Blob([htmlcompleto], { type: 'text/html' });


// Seu HTML que deseja converter em PDF
    setTimeout(function() { 

      const tabela = htmlcompleto;
      const nomeArquivo = 'tabela.xls';
  
      // Chame a função da biblioteca para exportar a tabela para XLS
      tableToExcel(tabela, nomeArquivo);
    
    }, 100);

}


