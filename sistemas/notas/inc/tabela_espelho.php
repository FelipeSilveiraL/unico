<?php

//demais informações
if (empty($_GET['idUsuario'])) {
  $menu = '<li class="breadcrumb-item">Usuários</li>';
  $texto = '<p>Nesta tela só é permitido fazer espelhamento dentre os usuários.</p>
              <p> Caso seja necessario mudar outras informações como por exemplo; usuário, senha, etc... Basta clicar neste icone <a href="../../../front/usuarios.php?pg=2&conf=1" target="_blank" class="btn btn-info btn-sm"><i class="ri-user-settings-line"></i></a></p>
            ';

  $queryUsuarios .= " WHERE U.deletar = 0";
  $resultadoUsuarios = $conn->query($queryUsuarios);

  while ($usuarios = $resultadoUsuarios->fetch_assoc()) {
    $tabela .=
      '<tr>
              <th scope="row">' . $usuarios['id_usuario'] . '</th>
              <td>' . $usuarios['nome_usuario'] . '</td>
              <td>' . $usuarios['email'] . '</td>
              <td>' . $usuarios['cpf'] . '</td>
              <td>
                <a href="espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&idUsuario=' . $usuarios['id_usuario'] . '" title="Configurações" class="btn btn-primary btn-sm"><i class="ri-user-settings-line"></i></a>
              </td>
            </tr>';
  } //fim while

} else {
  $queryUsuarios .= " WHERE U.id_usuario = " . $_GET['idUsuario'];
  $resultadoUsuario = $conn->query($queryUsuarios);
  $usuario = $resultadoUsuario->fetch_assoc();
  $texto = 'Tabela contendo usuarios que estão sendo espelhados para o(a) ' . $usuario['nome_usuario'];
  $menu = '<li class="breadcrumb-item"><a href="espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '">Usuários</a></li><li class="breadcrumb-item">' . $usuario['nome_usuario'] . '</li>';
  $queryUsuariosEspleho = "SELECT 
                                U.id_usuario,
                                U.nome,
                                U.cpf,
                                U.email
                            FROM
                                unico.usuarios U
                            WHERE
                                U.id_usuario IN (";

  $resultNOTASuser = $connNOTAS->query("SELECT id_usuarioPai FROM dbnotas.cad_espelho C WHERE C.id_usuariofilho = " . $_GET['idUsuario']);
  while ($notasuser = $resultNOTASuser->fetch_assoc()) {
    $queryUsuariosEspleho .= "'" . $notasuser['id_usuarioPai'] . "',";
  }
  $queryUsuariosEspleho .= "'')";

  $resultadoUsuariosEspleho = $conn->query($queryUsuariosEspleho);
  while ($usuariosEspleho = $resultadoUsuariosEspleho->fetch_assoc()) {
    $tabela .=
      '<tr>
                <th scope="row">' . $usuariosEspleho['id_usuario'] . '</th>
                <td>' . $usuariosEspleho['nome'] . '</td>
                <td>' . $usuariosEspleho['email'] . '</td>
                <td>' . $usuariosEspleho['cpf'] . '</td>
                <td>
                  <a href="../inc/espelhar_usuarios.php?pg=' . $_GET['pg'] . '&tela=' . $_GET['tela'] . '&acao=2&idUsuarioremover=' . $usuariosEspleho['id_usuario'] . '&idUsuario=' . $_GET['idUsuario'] . '" title="Remover" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                </td>
              </tr>';

  } //fim while

}//fim if $_GET['idUsuario']


//mostrando os usuários para serem salvos
$queryUsuariosEspe = "SELECT
U.id_usuario, 
U.nome AS nome_usuario
FROM
usuarios U WHERE U.id_usuario IN (";
$resultadoUsuariosRateio = $connNOTAS->query("SELECT DISTINCT id_usuario FROM cad_rateiofornecedor GROUP BY id_usuario");
while ($usuariosRateio = $resultadoUsuariosRateio->fetch_assoc()) {
  $queryUsuariosEspe .= $usuariosRateio['id_usuario'] . ",";
}
$queryUsuariosEspe .= "'') ORDER BY nome ASC";
