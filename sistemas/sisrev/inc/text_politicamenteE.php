<?php
switch ($_GET['part']) {
    case '1':
        $textAPOLLO = '<div class="d-flex align-items-center">
                            <strong>Limpando registros anteriores = APOLLO</strong>
                            <div class="spinner-border ms-auto text-danger" role="status" aria-hidden="true"></div>
                        </div>';
        $textNBS = '<p class="card-text">Limpando registros anteriores = NBS</p>';
        $textNBSR = '<p class="card-text">Limpando registros anteriores = NBS Ribeirão</p>';
        $textAll = '<p class="card-text">Importantando novos dados = Todos os Sistemas</p>';
        break;

    case '2':
        $textAPOLLO = '<div class="d-flex align-items-center">
                            <span>Limpando registros anteriores = APOLLO</span>
                            <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                        </div>';
        $textNBS = '<div class="d-flex align-items-center">
                        <strong>Limpando registros anteriores = NBS</strong>
                        <div class="spinner-border ms-auto text-danger" role="status" aria-hidden="true"></div>
                    </div>';
        $textNBSR = '<p class="card-text">Limpando registros anteriores = NBS Ribeirão</p>';
        $textAll = '<p class="card-text">Importantando novos dados = Todos os Sistemas</p>';
        break;

    case '3':
        $textAPOLLO = '<div class="d-flex align-items-center">
                                <span>Limpando registros anteriores = APOLLO</span>
                                <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                            </div>';
        $textNBS = '<div class="d-flex align-items-center">
                        <span>Limpando registros anteriores = NBS</span>
                        <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                    </div>';
        $textNBSR = '<div class="d-flex align-items-center">
                        <strong>Limpando registros anteriores = NBS Ribeirão</strong>
                        <div class="spinner-border ms-auto text-danger" role="status" aria-hidden="true"></div>
                    </div>';
        $textAll = '<p class="card-text">Importantando novos dados = Todos os Sistemas</p>';
        break;

    case '4':
        $textAPOLLO = '<div class="d-flex align-items-center">
                                <span>Limpando registros anteriores = APOLLO</span>
                                <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                            </div>';
        $textNBS = '<div class="d-flex align-items-center">
                        <span>Limpando registros anteriores = NBS</span>
                        <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                    </div>';
        $textNBSR = '<div class="d-flex align-items-center">
                        <span>Limpando registros anteriores = NBS Ribeirão</span>
                        <div class="text-success px-2" aria-hidden="true"> [Finalizado]</div>
                    </div>';
        $textAll = '<div class="d-flex align-items-center">
                        <strong>Importantando novos dados = Todos os Sistemas</strong>
                        <div class="spinner-border ms-auto text-danger" role="status" aria-hidden="true"></div>
                    </div>';
        break;
}