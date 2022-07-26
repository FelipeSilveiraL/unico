<?php

// ################################ LISTANDO MENUS ################################ //
switch ($_GET['drop']) {
    case '1':
        //EMPRESA
        $breadcrumbs = '<li class="breadcrumb-item active">Empresa</li>';        
        $marginLeftBotao = "83%";//posição do botão adicionar
        $nome = 'Empresas';
        $colunas = array("ID", "Nome", "CNPJ", "Ação");

        //LINHAS
        $resultado = $conn->query($queryEmpresa);
        while ($dados = $resultado->fetch_assoc()) {
            $linha .= '<tr><th scope="row">' . $dados['id'] . '</th><td>' . $dados['nome'] . '</td><td>' . $dados['cnpj'] . '</td><td><a href="../front/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=1" title="Editar" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a> <a href="../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=2" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a></td></tr>';
        }

        //EDITANDO OU EXCLUINDO
        if (!empty($_GET['acao'])) {

            switch ($_GET['acao']) {
                case '1': //EDITAR
                    $corButton = "primary";
                    $nomeButton = "Editar";
                    $queryEmpresa .= " AND id=" . $_GET['id_menu'];
                    $resultado = $conn->query($queryEmpresa);
                    $dados = $resultado->fetch_assoc();
                    $form = '../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=1';

                    //CAMPOS FORMULARIO
                    $displayNome = "flex";
                    $displayCNPJ = "flex";

                    break;

                case '3': //ADICIONAR
                    $corButton = "success";
                    $nomeButton = "Adicionar";
                    $form = '../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&acao=3';

                    //CAMPOS FORMULARIO
                    $displayNome = "flex";
                    $displayCNPJ = "flex";

                    break;
            }
        }
        break;

    case '2':
        //DEPARTAMENTO
        $breadcrumbs = '<li class="breadcrumb-item active">Departamento</li>';        
        $marginLeftBotao = "79%";//posição do botão adicionar
        $nome = 'Departamento';
        $colunas = array("ID", "Nome", "Ação");
        //LINHAS
        $resultado = $conn->query($queryDepartamento);
        while ($dados = $resultado->fetch_assoc()) {
            $linha .= '<tr><th scope="row">' . $dados['id'] . '</th><td>' . $dados['nome'] . '</td><td><a href="../front/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=1" title="Editar" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></a> <a href="../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=2" title="Excluir" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a></td></tr>';
        }

        //EDITANDO OU EXCLUINDO
        if (!empty($_GET['acao'])) {

            switch ($_GET['acao']) {
                case '1': //EDITAR
                    //ESTILO
                    $corButton = "primary";
                    $nomeButton = "Editar";
                    $queryDepartamento .= " AND id=" . $_GET['id_menu'];
                    $resultado = $conn->query($queryDepartamento);
                    $dados = $resultado->fetch_assoc();
                    $form = '../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&id_menu=' . $dados['id'] . '&acao=1';

                    //CAMPOS FORMULARIO
                    $displayNome = "flex";
                    $displayCNPJ = "none";
                    break;

                case '3': //ADICIONAR
                    //ESTILO
                    $corButton = "success";
                    $nomeButton = "Adicionar";
                    $form = '../inc/dropdownsAcao.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '&menu=' . $_GET['menu'] . '&drop=' . $_GET['drop'] . '&acao=3';

                    //CAMPOS FORMULARIO
                    $displayNome = "flex";
                    $displayCNPJ = "none";
                    break;
            }
        }
        break;
}

// ################################ //

switch ($_GET['menu']) {
    case '1':
        $breadcrumbsMenu = '<li class="breadcrumb-item"><a href="dropdowns.php?pg=' . $_GET['pg'] . '&conf=' . $_GET['conf'] . '">Menu suspenso</a></li>';
        $display = 'style="display: none";';
        $displayDrop = 'style="display: "block";';
        break;

    default:
        $breadcrumbsMenu = '<li class="breadcrumb-item active">Menu suspenso</li>';
        $display = 'style="display: block";';
        $displayDrop = 'style="display: none";';
        break;
}
