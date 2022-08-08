<div class="tab-pane fade <?php if($_GET['f'] == NULL) {echo 'show active';} ?>" id="telas" role="tabpanel" aria-labelledby="telas-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Telas
                        <a href="acessos_alterar.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>&acao=1" class="btn btn-success button-rigth-card" title="Nova tela">
                            <i class="bi bi-plus"></i>
                        </a>
                    </h5>
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Endereço</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //chamando acessos
                                $queryAcessos .= " WHERE deletar = 0";
                                $resultado = $conn->query($queryAcessos);

                                while ($acessos = $resultado->fetch_assoc()) {
                                    echo '
                                    <tr>
                                        <th scope="row">' . $acessos['id'] . '</th>
                                        <td>' . $acessos['nome'] . '</td>
                                        <td>' . $acessos['endereco'] . '</td>
                                        <td> 
                                            <a href="acessos_alterar.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&id=' . $acessos['id'] . '&acao=2" title="Editar" class="btn btn-primary btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="#" title="Excluir" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#basicModal' . $acessos['id'] . '">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Inicio do Modal de desativar -->
                                    <div class="modal fade" id="basicModal' . $acessos['id'] . '" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Excluir Acessos Rápidos</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="#" method="post">
                                                    <div class="row mb-3" style="margin-top: 13px;">
                                                        <label for="nome" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Nome:</label>
                                                        <div class="col-md-7 col-lg-8">                                                            
                                                            <input name="nome" type="text" class="form-control" id="nome" value="' . $acessos['nome'] . '" disabled>
                                                        </div>
                                                    </div>                                                        
                                                    <div class="row mb-3" style="margin-top: 13px;">
                                                        <label for="endereco" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Endereço:</label>
                                                        <div class="col-md-7 col-lg-8">
                                                            <input name="endereco" type="text" class="form-control" id="endereco" value="' . $acessos['endereco'] . '" disabled>
                                                        </div>
                                                    </div>   
                                                </form>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <a href="../inc/acessos_alterar.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&acao=3&id=' . $acessos['id'] . '" title="Excluir" class="btn btn-danger">Deletar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim do Modal-->';
                                }
                            ?>
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</div>