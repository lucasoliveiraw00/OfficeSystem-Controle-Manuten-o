var BASE = "http://localhost/OfficeSystem/";

function SelecionaCliente(id,nome,cpfcnpj) {
    $("#id_cliente").val(id);
    $("#nome_cliente").val(nome);
    $("#cpfcnpj").val(cpfcnpj);
    
};

function SelecionaCliente2(id,nome,cpfcnpj) {
    $("#id_cliente").val(id);
    $("#nome").val(nome);
    $("#cpfcnpj").val(cpfcnpj);

    //LIMPAR OS CAMPOS DE DADOS DE VEICULO
    if(document.getElementById('id_veiculo').value!="") {
        document.getElementById('id_veiculo').value="";
        document.getElementById('modelo_veiculo').value="";
        document.getElementById('marca_veiculo').value="";
        document.getElementById('ano_veiculo').value="";
        document.getElementById('placa_veiculo').value="";
    
        }
    
};

function SelecionaVeiculo(id,modelo,marca,ano,placa) {
    $("#id_veiculo").val(id);
    $("#modelo_veiculo").val(modelo);
    $("#marca_veiculo").val(marca);
    $("#ano_veiculo").val(ano);
    $("#placa_veiculo").val(placa);


};

function SelecionaProcedimento(id,descricao,codigo) {
    $("#id_proc").val(id);
        $("#descricao_proc").val(descricao);
            $("#codigo_proc").val(codigo);

};

function SelecionaComponente(id,descricao,codigo) {
    
    $("#id_comp").val(id);
        $("#descricao_comp").val(descricao);
            $("#codigo_comp").val(codigo);
};

function SelecionaComponente2(id,descricao,codigo) {

    $("#id_comp").val(id);
        $("#descricao_comp").val(descricao);
            $("#codigo_comp").val(codigo);

    //LIMPAR OS CAMPO ITEM E CODIGO
    if(document.getElementById('id_item').value!="") {
        document.getElementById('id_item').value="";
        document.getElementById('descricao_item').value="";
        document.getElementById('codigo_item').value="";
    }
};

function SelecionaItem(id,descricao,codigo) {
    
    $("#id_item").val(id);
        $("#descricao_item").val(descricao);
            $("#codigo_item").val(codigo);
};

function SelecionaColaboradorApt(id,nome,matricula) {
    $("#id_col").val(id);
    $("#nome").val(nome);
    $("#matricula").val(matricula);

};

function SelecionaColaborador(id,nome,matricula) {
    $("#id_colaborador").val(id);
    $("#nome_usuario").val(nome);
    $("#matricula").val(matricula);

};

function SelecionaVeiculoRl(id,modelo,placa) {
    $("#id_veiculo").val(id);
    $("#modelo").val('Modelo: '+modelo+', Placa: '+placa);

};

function SelecionaColaboradorRl(id,nome,matricula) {
    $("#id_col").val(id);
    $("#nome").val('Nome: '+nome+', Matricula: '+matricula);

    $("#tipo").append('<option value="unico" selected >Unico</option>');

};

function SelecionaOrdem(numero_os) {
    $("#numero_os").val(numero_os);

};