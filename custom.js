import { obterDados } from './script.js';

$(document).ready(function() {
  
    obterDados(function(dadosTransformados) {
      var table = $('#table_1').DataTable({
        'responsive': true,
        'data': dadosTransformados,
        'processing': true,
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
  