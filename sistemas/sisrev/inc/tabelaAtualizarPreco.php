<?php
if ($_GET['acao'] == 1) {

    $displayAtualizaOne = 'none';
    $displayAtualizaTwo = 'block';

    switch ($_GET['empresa']) {
        case '55':
            $queryListaPreco = "SELECT item, descricao, rrp as valor, status_item FROM 'sisrev_atualizacao_preco_triumph'";
            $resultListaPreco = $conn->query($queryListaPreco);

            $tabela = '<thead>
                            <tr>
                            <th scope="col" class="capitalize">codigo item</th>
                            <th scope="col" class="capitalize">descrição</th>
                            <th scope="col" class="capitalize">valor</th>
                            <th scope="col" class="capitalize">status</th>
                            </tr>
                        </thead>
                        <tbody>';

            while ($listaPreco = $resultListaPreco->fetch_assoc()) {
                $tabela .= '<tr>
                            <td>' . $listaPreco['item'] . '</td>
                            <td>' . $listaPreco['descricao'] . '</td>
                            <td>R$ ' . $listaPreco['valor'] . '</td>
                            <td>' . $listaPreco['status_item'] . '</td>
                        </tr>';
            }

            $tabela .= '</tbody>';

            $nomeEmpresa = 'Triumph';
            break;
        case '56':
            $queryListaPreco = "SELECT item, descricao, rrp as valor, status_item FROM 'sisrev_atualizacao_preco_ducati'";
            $resultListaPreco = $conn->query($queryListaPreco);

            $tabela = '<thead>
                          <tr>
                          <th scope="col" class="capitalize">codigo item</th>
                          <th scope="col" class="capitalize">descrição</th>
                          <th scope="col" class="capitalize">valor</th>
                          <th scope="col" class="capitalize">status</th>
                          </tr>
                      </thead>
                      <tbody>';

            while ($listaPreco = $resultListaPreco->fetch_assoc()) {
                $tabela .= '<tr>
                            <td>' . $listaPreco['item'] . '</td>
                            <td>' . $listaPreco['descricao'] . '</td>
                            <td>R$ ' . $listaPreco['valor'] . '</td>
                            <td>' . $listaPreco['status_item'] . '</td>
                        </tr>';
            }

            $tabela .= '</tbody>';

            $nomeEmpresa = 'Ducati';
            break;
        case '10':
            $queryListaPreco = "SELECT * FROM sisrev_atualizacao_preco_honda";
            $resultListaPreco = $conn->query($queryListaPreco);

            $tabela = '<thead>
                            <tr>
                            <th scope="col" class="capitalize">codigo item</th>
                            <th scope="col" class="capitalize">descrição</th>
                            <th scope="col" class="capitalize">Preco avista</th>                        
                            <th scope="col" class="capitalize">Preco publico atual</th>                        
                            <th scope="col" class="capitalize">Preco publico</th>                        
                            <th scope="col" class="capitalize">Data preço</th>
                            <th scope="col" class="capitalize">status</th>
                            </tr>
                        </thead>
                        <tbody>';

            while ($listaPreco = $resultListaPreco->fetch_assoc()) {
                $tabela .= '<tr>
                                <td>' . $listaPreco['item'] . '</td>
                                <td>' . $listaPreco['descricao'] . '</td>
                                <td>R$ ' . $listaPreco['preco_avista'] . '</td>
                                <td>R$ ' . $listaPreco['preco_publico_atual'] . '</td>
                                <td>R$ ' . $listaPreco['preco_publico'] . '</td>
                                <td>' . $listaPreco['dta_preco'] . '</td>
                                <td>' . $listaPreco['status_item'] . '</td>
                            </tr>';
            }

            $tabela .= '</tbody>';

            $nomeEmpresa = 'Honda';
            break;
    }
} else {
    $displayAtualizaOne = 'block';
    $displayAtualizaTwo = 'none';
}
