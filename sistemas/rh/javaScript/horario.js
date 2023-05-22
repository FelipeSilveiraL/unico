
function almocoSemanal() {

    var valueI = document.getElementById('almocoInicialSemanal').value;

    var valueF = document.getElementById('almocoFinalSemanal').value;

    if (!valueI) {
        document.getElementById('almocoFinalSemanal').required = false;
    } else {
        document.getElementById('almocoFinalSemanal').required = true;
    }

    if (!valueF) {
        document.getElementById('almocoInicialSemanal').required = false;
    } else {
        document.getElementById('almocoInicialSemanal').required = true;
    }


}

function sabadoHorario() {
    var valueSI = document.getElementById('sabadoHorarioInicial').value;
    var valueSF = document.getElementById('sabadoHorarioFinal').value;

    if (!valueSI) {
        document.getElementById('sabadoHorarioFinal').required = false;
    } else {
        document.getElementById('sabadoHorarioFinal').required = true;
    }

    if (!valueSF) {
        document.getElementById('sabadoHorarioInicial').required = false;
    } else {
        document.getElementById('sabadoHorarioInicial').required = true;
    }
}

function sabadoAlmoco() {
    var valueSAI = document.getElementById('sabadoAlmocoInicial').value;
    var valueSAF = document.getElementById('sabadoAlmocoFinal').value;

    if (!valueSAI) {
        document.getElementById('sabadoAlmocoFinal').required = false;
    } else {
        document.getElementById('sabadoAlmocoFinal').required = true;
    }

    if (!valueSAF) {
        document.getElementById('sabadoAlmocoInicial').required = false;
    } else {
        document.getElementById('sabadoAlmocoInicial').required = true;
    }
}


//validar Horario comercial

function validarHorarioComercial(hora) {
    const horarioComercialInicio = new Date();
    horarioComercialInicio.setHours(8, 0, 0); // 08:00:00

    const horarioComercialFim = new Date();
    horarioComercialFim.setHours(18, 0, 0); // 18:00:00

    const horaInserida = new Date();
    horaInserida.setHours(hora.substring(0, 2), hora.substring(3, 5), 0); // Transforma a string de hora inserida em um objeto Date

    return horaInserida >= horarioComercialInicio && horaInserida <= horarioComercialFim;
}

function validarForm() {

    //SEMANAL
    const horaEntradaSemanal = document.getElementById("HoraInicioSemanal").value;
    const horaSaidaSemanal = document.getElementById("HoraFinalSemanal").value;

    if (horaEntradaSemanal) {

        //validar horaio comercial
        /* if (!validarHorarioComercial(horaEntradaSemanal) || !validarHorarioComercial(horaSaidaSemanal)) {
            alert("Por favor, insira um horário semanal entre 08:00 e 18:00");
            return false;
        } */

        //validar se a entrada é maior que a saida
        if (horaEntradaSemanal >= horaSaidaSemanal) {
            alert("O horário de entrada semanal não pode ser maior que o da saída");
            return false;
        }

    }

    //SEMANAL ALMOÇO
    const horaEntradaAlmoco = document.getElementById("almocoInicialSemanal").value;
    const horaSaidaAlmoco = document.getElementById("almocoFinalSemanal").value;


    if (horaEntradaAlmoco) {
        /* if (!validarHorarioComercial(horaEntradaAlmoco) || !validarHorarioComercial(horaSaidaAlmoco)) {
            alert("Por favor, insira um horário de almoço semanal entre 08:00 e 18:00");
            return false;
        } */

        if (horaEntradaAlmoco >= horaSaidaAlmoco) {
            alert("O horário de entrada de almoço não pode ser maior que o da saída");
            return false;
        }
    }

    //SABADO
    const horaEntradaSabado = document.getElementById("sabadoHorarioInicial").value;
    const horaSaidaSabado = document.getElementById("sabadoHorarioFinal").value;

    if (horaEntradaSabado) {
        //validacao se esta dentro do horario comercial
        /* if (!validarHorarioComercial(horaEntradaSabado) || !validarHorarioComercial(horaSaidaSabado)) {
            alert("Por favor, insira um horário de sábado entre 08:00 e 18:00");
            return false;
        }*/

        if (horaEntradaSabado > horaSaidaSabado) {
            alert("O horário de entrada de sábado não pode ser maior que o da saída");
            return false;
        }
    }

    //SABADO ALMOÇO
    const horaEntradaSabadoAlmoco = document.getElementById("sabadoAlmocoInicial").value;
    const horaSaidaSabadoAlmoco = document.getElementById("sabadoAlmocoFinal").value;

    if (horaEntradaSabadoAlmoco) {
        /* if (!validarHorarioComercial(horaEntradaSabadoAlmoco) || !validarHorarioComercial(horaSaidaSabadoAlmoco)) {
            alert("Por favor, insira um horário de almoço do sábado entre 08:00 e 18:00");
            return false;
        } */

        if (horaEntradaSabadoAlmoco > horaSaidaSabadoAlmoco) {
            alert("O horário de entrada do almoço de sábado não pode ser maior que o da saída");
            return false;
        }
    }

    // Se a validação passar, envia o formulário
    return true;
}





