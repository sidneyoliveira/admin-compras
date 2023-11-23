<?php
              include('conexaoUser.php');

              if(isset($_POST['form_user']) || isset($_POST['form_pass'])) {
                
                  if(strlen($_POST['form_user']) == 0) {
                      echo "<div class=\"text-danger mb-1\">Preencha seu e-mail!</div>";
                  } else if(strlen($_POST['form_pass']) == 0) {
                      echo "<div class=\"text-danger mb-1\"> Preencha sua senha!</div>";
                  } else {

                      $user = $mysqli->real_escape_string($_POST['form_user']);
                      $senha = $mysqli->real_escape_string($_POST['form_pass']);

                      $sql_code = "SELECT * FROM data_users WHERE user = '$user' AND pass = '$senha'";
                      $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

                      $quantidade = $sql_query->num_rows;

                      if($quantidade == 1) {
                          
                          $usuario = $sql_query->fetch_assoc();

                          if(!isset($_SESSION)) {
                              session_start();
                          }

                          $_SESSION['id'] = $usuario['id'];
                          $_SESSION['nome'] = $usuario['nome'];
                          $_SESSION['cargo'] = $usuario['cargo'];
                          $_SESSION['cpf'] = $usuario['cpf'];

                          header("Location: painel.php");

                      } 

                  }

              }
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
                <li class="lista"><a href="#">
                    <i class='bx bx-home'></i>
                    <span class="link-name">Inicio</span>
                </a></li>
                <li  class="lista"><a href="#">
                    <i class='bx bx-package'></i>
                    <span class="link-name">Pedidos</span>
                </a></li>
                <li  class="lista"><a href="#">
                    <i class='bx bx-line-chart'></i>
                    <span class="link-name">Relatórios</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li  class="lista"><a href="#">
                    <i class='bx bx-log-out'></i>
                    <span class="link-name">Sair</span>
                </a></li>

                <!-- <li class="logout-mode">
                    <div class="mode-toggle p-1 mt-2">
                        <span class="switch"></span>
                      </div>
                </a> </li>-->
            </ul> 
        </div>
    </nav>

    <section class="dashboard" style="padding: 50px 0 0 0  !important">
        <div class="top">
            <i class='bx bx-menu'></i>
        </div>
<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color:var(--panel-color)">
    <div class="container">
      <div class="row gx-lg-5 align-items-start">
        <div class="col-lg-6 mb-6 mb-lg-0">
          <h1 class="my-3 display-3 fw-bold ls-tight" style="letter-spacing: -0.05em" >
            Departamento <br />
            <span class="text-primary mb-5 " style="letter-spacing: -0.05em">de Compras</span>
          </h1>
        <p>
            <p class="frase_mot mb-2" style="color: hsl(217, 10%, 50.8%)"></p>
            <cite class="autor_mot" style="font-size: 0.75em; color: hsl(217, 10%, 50.8%)"></cite>
        </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">

            
              <form action="" method="POST">
                
                <!-- Email input -->
                <div class="form-outline mb-4">
                <label class="form-label">Usuário</label>
                  <input type="text" name="form_user"  class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Senha</label>
                  <input type="password" name="form_pass" class="form-control" />
                </div>

                <!-- Checkbox
                <div class="form-check d-flex mb-4 align-items-center">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                  <label class="form-check-label" for="form2Example33">
                    Lembre-me
                  </label>
                </div> -->

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Login
                </button>
                <!-- Esqueceu a Senha
                <div class="text-center m-0">
                  <p class="mb-1" style="color: hsl(217, 10%, 50.8%)">Primeiro Acesso </p>
                  <p class="mb-1" style="color: hsl(217, 10%, 50.8%)">Entre em contato com o suporte:</p>
                  <p class="mb-0" style="font-size: 0.8em; color: hsl(217, 10%, 50.8%)"> <em> compras@itarema.ce.gov.br </em></p>
                </div> -->

                <!-- Primeiro Acesso-->
                <div class="text-center m-0">
                  <p class="mb-1" style="color: hsl(217, 10%, 50.8%)">Primeiro Acesso? / Esqueceu a senha? </p>
                  <p class="mb-1" style="color: hsl(217, 10%, 50.8%)">Entre em contato com o suporte:</p>
                  <p class="mb-0" style="font-size: 0.8em; color: hsl(217, 10%, 50.8%)"> <em> crc@itarema.ce.gov.br </em></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
           
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
    
    <!-- Custom JS -->
    <script src="script.js"></script>
    <script src="custom.js"></script>
    <script src="export.js"></script>
    <script src="frase.js"></script>


</body>
</html>
