<?php

if (!empty($_GET['msn'])) {

    switch ($_GET['msn']) {
        case '1':
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span style="font-size: 12px">Usuário removido ou desativado!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            break;
        case '2':
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span style="font-size: 12px"> E-mail ou senha incorretas!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            break;
        case '3':
            echo '
                <script>
                    alert("Perfil Editado com sucesso, deslogue e logue novamente no sistema!");
                </script>';
            break;
        case '4':
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span style="font-size: 12px">Editado com sucesso!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            break;
        case '5':
            echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Desativado com sucesso!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
        case '6':
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Ativado com sucesso!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
        case '7':
            echo '
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Senha alterada, agora logue para confirmar!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
        case '8':
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Adicionado / Criado com sucesso!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
        case '9':
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span style="font-size: 12px"> Não foi possivel logar. Erro session_start!</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            break;
        case '10':
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Não foi possivel prosseguir com a solicitação</h4>
                <p>Infelizmente houve algum erro que não deixou prosseguir. Abaixo segue uma lista de possíveis erros:</p>
                <hr>';
            switch ($_GET['erro']) {
                case '1':
                    echo '<p class="mb-0"><i class="bi bi-pin"></i> Não foi possivel salvar log da execução!</p>';
                    break;
                case '2':
                    echo '<p class="mb-0"><i class="bi bi-pin"></i> Não foi possivel salvar o arquivo no servidor!</p>';
                    break;
                case '3':
                    echo '<p class="mb-0"><i class="bi bi-pin"></i> Tipo de arquivo inválido!</p>';
                    break;
                case '4':
                    echo '<p class="mb-0"><i class="bi bi-pin"></i> Não foi possivel carregar o arquivo por completo - Contate o TI!</p>';
                    break;
                case '5':
                    echo '<p class="mb-0"><i class="bi bi-pin"></i>Preenchas os campo(s) obrigatórios(s)!</p>';
                    break;
            }
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            break;
        case '11':
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Arquivo Importado com sucesso!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
        case '12':
            echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px"><p><i class="bi bi-exclamation-triangle me-1"></i>Foram encontrados dados da ultima atualização que <code>não foram finalizados</code>!</p>
                    <p>Deseja finalizar ?</p></span>
                        <a href="../inc/politicamente_exposto.php?pg='.$_GET['pg'].'&tela='.$_GET['tela'].'&confirma=1&part=4" class="btn btn-info btn-sm" title="irá ignorar o arquivo atual e fazer o anterior">SIM</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '13':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Erro ao adicionar! Por favor entrar em contato via <a href="http://10.100.1.217/glpi/index.php">GLPI<a/></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '14':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Deletado com sucesso!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '15':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Por favor carregue um arquivo antes de realizar a carga!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '15':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Usuário já cadastrado!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '16':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Já existe uma empresa com esse departamento cadastrado!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '17':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Departamento já possui relação em outra tabela!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '18':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Já existe uma regra adicionada com a empresa e o departamento!</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '19':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">CPF ou CNPJ já cadastrado</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
            case '20':
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span style="font-size: 12px">Já existem dados cadastrados</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            break;
    }   
}
