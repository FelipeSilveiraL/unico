<div class="tab-pane fade <?php if($_GET['f'] != NULL) {echo 'show active';}?>" id="funcoes" role="tabpanel" aria-labelledby="funcoes-tab">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cadastrar Funções
                        <a href="#" class="btn btn-success button-rigth-card" title="Nova função" data-bs-toggle="modal" data-bs-target="#novaFuncaoModal" <?= $usuarioFuncao ?> >
                            <i class="bi bi-plus"></i>
                        </a>
                    </h5>
                    <!-- Inicio do Modal de nova Função -->
                    <div class="modal fade" id="novaFuncaoModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Criar nova Função</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="../inc/telas_funcoes.php?pg=<?= $_GET['pg'] ?>&tela=<?= $_GET['tela'] ?>&acao=1" method="post">
                                    <div class="row mb-3" style="margin-top: 13px;">
                                        <label for="nome" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Nome:</label>
                                        <div class="col-md-7 col-lg-8">
                                            <input name="nome" type="text" class="form-control" id="nome" value="" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3" style="margin-top: 13px;">
                                        <label for="descricao" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Descrição:</label>
                                        <div class="col-md-7 col-lg-8">
                                            <input name="descricao" type="text" class="form-control" id="descricao" value="" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tela" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Tela:</label>
                                        <div class="col-md-7 col-lg-8">
                                            <select id="tela" name="tela" class="form-select" required>
                                                <option value =''>Escolha...</option>
                                                    <?php
                                                        $queryAcessos .= " ORDER BY nome ASC";
                                                        $resultModulos = $conn->query($queryAcessos);
                                                        while ($rowModulos = $resultModulos->fetch_assoc()) {
                                                            echo'<option value='.$rowModulos['id'].'>'.$rowModulos['nome'].'</option>';
                                                        }                                  
                                                    ?>                                  
                                            </select>                                
                                        </div>
                                    </div>                          
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-success">Salvar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fim do Modal-->
                    <!-- Tabela com as funções cadastradas -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">ID &nbsp;&nbsp;</th>
                                <th scope="col">Função</th>
                                <th scope="col">Modulo</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $resultadoFuncoes = $conn->query($queryFuncaoModulos);
                                while ($rowFuncoes = $resultadoFuncoes->fetch_assoc()) {
                                echo' 
                                    <tr>
                                        <th scope="row">' .$rowFuncoes['id_funcao']. '</th>
                                        <td>' .$rowFuncoes['nome']. '</td>
                                        <td>' .$rowFuncoes['modulo']. '</td>
                                        <td>' .$rowFuncoes['descricao']. '</td>
                                        <td> 
                                        <a href="#" title="Editar" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal'.$rowFuncoes['id_funcao'].'" '.$usuarioFuncao.'>
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="#" title="Excluir" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletarModal'.$rowFuncoes['id_funcao'].'" '.$usuarioFuncao.'>
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        </td>
                                    </tr>
                                
                                    <!-- Inicio do Modal de Editar -->
                                    <div class="modal fade" id="editarModal'.$rowFuncoes['id_funcao'].'" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Editar Funções</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../inc/telas_funcoes.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&acao=2&id=' . $rowFuncoes['id_funcao'] . '" method="post">
                                                
                                                <div class="row mb-3" style="margin-top: 13px;">
                                                    <label for="nome" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Função:</label>
                                                    <div class="col-md-7 col-lg-8">
                                                        <input name="nome" type="text" class="form-control" id="nome" value="'.$rowFuncoes['nome'].'">
                                                    </div>                                      
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="tela" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Modulo:</label>
                                                        <div class="col-md-7 col-lg-8">
                                                            <select id="tela" name="tela" class="form-select" required>';
                                                                //trazendo as informações do editar do banco
                                                                $queryTelaEditar = "SELECT * FROM sisrev_funcao SF
                                                                                    LEFT JOIN sisrev_modulos SM
                                                                                    ON SF.id_modulos = SM.ID WHERE id_funcao = '".$rowFuncoes['id_funcao']."'";
                                                                $resultTelasEditar = $conn->query($queryTelaEditar);
                                                                while ($rowTelasEditar = $resultTelasEditar->fetch_assoc()) {
                                                                    echo'<option value='.$rowTelasEditar['id'].'>'.$rowTelasEditar['nome'].'</option>';
                                                                }
                                                                echo'
                                                                <option value="">----------</option>';
                                                                    $resultModulos = $conn->query($queryAcessos);
                                                                    while ($rowModulos = $resultModulos->fetch_assoc()) {
                                                                    echo'<option value='.$rowModulos['id'].'>'.$rowModulos['nome'].'</option>';
                                                                    }
                                                                echo'
                                                            </select>                                        
                                                        </div>
                                                    </div> 

                                                    <div class="row mb-3" style="margin-top: 13px;">
                                                        <label for="descricao" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Descrição:</label>
                                                        <div class="col-md-7 col-lg-8">
                                                            <input name="descricao" type="text" class="form-control" id="descricao" value="'.$rowFuncoes['descricao'].'">
                                                        </div>                                      
                                                    </div>     
                                                                                  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-success">Salvar</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim do Modal-->
                                    
                                    <!-- Inicio do Modal de Deletar -->
                                    <div class="modal fade" id="deletarModal'.$rowFuncoes['id_funcao'].'" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Deletar Função</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="../inc/telas_funcoes.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&acao=3&id='.$rowFuncoes['id_funcao'].'" method="post">
                                                    <div class="row mb-3" style="margin-top: 13px;">                                                       
                                                        <label for="descricao" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Descrição:</label>
                                                        <div class="col-md-7 col-lg-8">
                                                            <input name="descricao" type="text" class="form-control" id="descricao" value="'.$rowFuncoes['descricao'].'" disabled>                                                            
                                                        </div>                                      
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="tela" class="col-md-4 col-lg-3 col-form-label" style="margin-left: 12px;">Tela:</label>
                                                        <div class="col-md-7 col-lg-8"> 
                                                            <input name="descricao" type="text" class="form-control" id="descricao" value="'.$rowFuncoes['nome'].'" disabled>
                                                        </div>
                                                    </div>                                   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn btn-danger">Apagar</a>
                                                    </div>
                                                </form>
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