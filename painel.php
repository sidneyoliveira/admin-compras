<?php

include('protect.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style.css">
    
    <!----===== Box Icons CSS ===== -->
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <!-- ---bootstrap--- -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- DataTable CSS  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link type="text/css" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    
    
    <title>Departamento de Compras</title> 
</head>
<body>
    <nav class="opacity-100">
        <div class="logo-name">
            <div class="logo-image">
                <img src="assets/Logo.svg" alt="">
            </div>

            <div>
                <!-- <spam class="logo-name tl">Departamento de</spam> 
                <spam class="logo-name st">Compras</spam> -->
                <spam class="logo-name tl">Departamento de</spam> 
                <spam class="logo-name st">Compras</spam>
            </div>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <!-- <li class="lista"><a href="index.php">
                    <i class='bx bx-home'></i>
                    <span class="link-name">Inicio</span>
                </a></li> -->
                <li  class="lista"><a href="painel.php">
                    <i class='bx bx-package'></i>
                    <span class="link-name">Pedidos</span>
                </a></li>
                <li  class="lista"><a href="#">
                    <i class='bx bx-line-chart'></i>
                    <span class="link-name">Relatórios</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li  class="lista"><a href="logout.php">
                    <i   class='bx bx-log-out'></i>
                    <span  class="link-name">Sair</span>
                </a></li>

                <!-- <li class="logout-mode">
                    <div class="mode-toggle p-1 mt-2">
                        <span class="switch"></span>
                      </div>
                </a> </li>-->
            </ul> 
        </div>
    </nav>

    <section class="dashboard">
        <div class="top d-flex justify-content-between">
            <i class='bx bx-menu'></i>
            <div class="px-5 h6 mb-0"><?php echo $_SESSION['id']; ?> - <?php echo $_SESSION['nome']; ?><p class="mb-0"></p></div>
        </div>

            <div class="dash-content">
                <div class="activity">
                    <div class="title rounded shadow-sm">
                    <i class='bx bx-package'></i>
                    <span class="text">Solicitações</span>
                    </div>
                    <span id="msgAlerta"></span>
                    
                    <div class="container rounded shadow-sm p-3 m-0 mw-100 bg-white border-primary">
                        <!-- Button trigger modal -->
                        <div class="d-flex botoes-top">
                            <button type="button" class="btn btn-sm mb-2 mt-0  py-1 rounded" style="background-color: #27af55;color: white;border-color: #069d3e;" data-toggle="modal" data-target="#modalCadastro">
                                Nova Requisição
                            </button>
                            <button type="button" onclick="apagarUsuario()"; class="btn btn-sm mb-2 mt-0 m-2 py-1 rounded" style="background-color: #b32f2f;color: white;border-color: #751717;" data-toggle="modal" data-target="">
                                Excluir
                            </button>
                            <!-- <select class="form-select form-select-sm py-1 w-auto h-25 rounded" onchange="gerarArq(value)" data-toggle="modal"name="export" data-target="#export">
                            <option selected disabled>+ Exportar</option>

                                <option value="1">Arquivo PDF</option>
                                <option value="2">Arquivo Exel</option>
                            </select> -->
                            <button type="button" onclick="gerarArq()" class="btn btn-sm mb-2 mt-0 m-2 py-0 rounded border" >
                                <i class='bx bx-printer'></i>
                                Imprimir
                            </button>
                            <div id="progress-bar" class="progress ml-2 mt-2 w-25 d-none" >
                                <div id="progress-export" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%;  animation: 1s linear infinite progress-bar-stripes !important; transition: var(--bs-progress-bar-transition);"></div>
                            </div>
                        </div>
                        
                        <!-- DataTable Code starts -->
                        <table id="listar-agua" class="table table-hover display dataTable text-muted" style="width:100%">
                        
                                <thead>
                                    <tr class="fs-6">
                                        <th id="check"></th>
                                        <th>Nº</th>
                                        <th>DATA</th>
                                        <th>SETOR</th>
                                        <th>SECRETARIA</th>
                                        <th>ITEM</th> 
                                        <th>QTD</th>
                                        <th>VALOR</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                        </table>

                        
                <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <iframe id="frame1" src="" width="800" height="1000" frameborder="0" scrolling="auto"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCadastroLabel">Cadastro de Requisição</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="form-cad-usuario">
                                    <div class="form-row">
                                    
                                    <div class="col-md-8 mb-3">
                                        <label>Secretaria</label>
                                        <select class="custom-select" id="sec_option" name="sec" onchange="setorAlt()">
                                            <option value="1">Secretaria Municipal de Administração, Finanças e Planejamento - SEAFIN</option>
                                            <option value="2">Secretaria Municipal de Proteção Social e Cidadania - SMPS</option>
                                            <option value="3">Secretaria Municipal da Educação - SME</option>
                                            <option value="4">Secretaria Municipal da Saúde - SMS</option>
                                            <option value="5">Controladoria Geral do Município - CGM</option>
                                            <option value="6">Secretaria Municipal de Desenvolvimento Rural e Pesca (SDRP) - SDRP</option>
                                            <option value="7">Secretaria Municipal de Esporte, Juventude e Lazer - SECUJ</option>
                                            <option value="8">Secretaria Municipal de Infraestrutura, Mobilidade e Serviços Públicos - SEINFR</option>
                                            <option value="9">Secretaria Municipal de Meio Ambiente, Turismo e Cultura - SEMAT</option>
                                            <option value="10">Gabinete do Prefeito - GABPREF</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Setor</label>
                                        <select class="custom-select" id="setor_alt" name="setor">
                                            <option  value="1">Guarda</option>
                                            <option  value="2">Tributos</option>
                                            <option  value="3">Almoxarifado</option>
                                            <option  value="4">Raio</option>
                                            <option  value="5">Cotar</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 mb-3">
                                            <label for="quant">Quantidade</label>
                                            <input class="form-control" value="" id="quant" name="quant" type="number"  min="0" placeholder="Quant.">    
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label >Item</label>
                                            <select class="custom-select" id="item" name="item">
                                                <option value="1">ÁGUA MINERAL NATURAL - 500ML </option>
                                                <option value="2">RECARGA DE ÁGUA MINERAL NATURAL - 20 LT</option>
                                                <option value="3">VASILHAME PARA ÁGUA EM POLICARBONATO (COMPLETO)</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                            <label >Data</label>
                                            <input class="form-control" id="data" name="data" type="date" >    
                                        </div>
                                    </div>
                                    
                                
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="cancelar_cadastro" class="btn text-white bg-danger" data-dismiss="modal" >Cancelar</button>
                                <button type="button" id="salvar_cadastro"class="btn text-white bg-success" data-dismiss="modal" >Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="successMessage" class="alert alert-success d-none fade mb-3 w-50 " role="alert">
                </div>
                </div>
            </div>

        </div>
    </section>
    
    <!-- DataTable JS -->
    <!-- DataTable JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    
    <!-- -- bootstrap--- -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@grabzit/js@3.5.2/grabzit.min.js"></script>
    <script type="application/javascript" src="https://api.ipify.org?format=jsonp&callback=getIP"></script>
    
    <!-- Custom JS -->
    <script src="script.js"></script>
    <script src="custom.js"></script>
    <script src="export.js"></script>


</body>
</html>
