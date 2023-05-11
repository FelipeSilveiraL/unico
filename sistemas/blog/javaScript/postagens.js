//função para adicionar mais arquivos no input Imagem/Video

function addFileInput() {
    var inputGroup = document.createElement('div');
    inputGroup.className = 'input-group col-sm-15 mb-1';

    var fileInput = document.createElement('input');
    fileInput.className = 'form-control';
    fileInput.type = 'file';
    fileInput.required = true;

    var removerBotao = document.createElement('button');
    removerBotao.className = 'btn btn-danger';
    removerBotao.type = 'button';
    removerBotao.innerHTML = '-';
    removerBotao.addEventListener('click', function () {
        inputGroup.parentNode.removeChild(inputGroup);
    });

    inputGroup.appendChild(fileInput);
    inputGroup.appendChild(removerBotao);

    document.getElementById('formFile').parentNode.insertBefore(inputGroup, null);
}

function exclusao(){
    var valor = document.getElementById('selectData').value;

    if(valor == 1){//1 = SIM
        document.getElementById('dataExclusao').style.display = 'block';
    }else{
        document.getElementById('dataExclusao').style.display = 'none';
    }


}