<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Celke</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
            <h1 class="display-5 mb-4">Listar Usuários</h1>

            <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadUsuarioModal">Cadastrar</button>
        </div>

        <span id="msgAlerta"></span>

        <table id="listar-usuario" class="table table-striped table-hover display" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Salário</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="cadUsuarioModal" tabindex="-1" aria-labelledby="cadUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadUsuarioModalLabel">Cadastrar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErroCad"></span>
                    <form method="POST" id="form-cad-usuario">
                        <div class="row mb-3">
                            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="salario" class="col-sm-2 col-form-label">Salário</label>
                            <div class="col-sm-10">
                                <input type="text" name="salario" class="form-control" id="salario" placeholder="Salário">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="idade" class="col-sm-2 col-form-label">Idade</label>
                            <div class="col-sm-10">
                                <input type="number" name="idade" class="form-control" id="idade" placeholder="Idade">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn-sm" value="Cadastrar">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="visUsuarioModal" tabindex="-1" aria-labelledby="visUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visUsuarioModalLabel">Detalhes do Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">
                        <dt class="col-sm-3">ID</dt>
                        <dd class="col-sm-9"><span id="idUsuario"></span></dd>

                        <dt class="col-sm-3">Nome</dt>
                        <dd class="col-sm-9"><span id="nomeUsuario"></span></dd>

                        <dt class="col-sm-3">Salário</dt>
                        <dd class="col-sm-9"><span id="salarioUsuario"></span></dd>

                        <dt class="col-sm-3">Idade</dt>
                        <dd class="col-sm-9"><span id="idadeUsuario"></span></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="msgAlertErroEdit"></span>
                    <form method="POST" id="form-edit-usuario">
                        <input type="hidden" name="id" id="editid">

                        <div class="row mb-3">
                            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" class="form-control" id="editnome" placeholder="Nome completo">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="salario" class="col-sm-2 col-form-label">Salário</label>
                            <div class="col-sm-10">
                                <input type="text" name="salario" class="form-control" id="editsalario" placeholder="Salário">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="idade" class="col-sm-2 col-form-label">Idade</label>
                            <div class="col-sm-10">
                                <input type="number" name="idade" class="form-control" id="editidade" placeholder="Idade">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-warning btn-sm" value="Salvar">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script src="js/custom.js"></script>
</body>

</html>