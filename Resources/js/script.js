const inputEndereco = document.getElementById("input-endereco")
const inputCep = document.getElementById("input-cep")
const inputCidade = document.getElementById("input-cidade")
const inputBairro = document.getElementById("input-bairro")
const inputRua = document.getElementById("input-rua")
const inputEstado = document.getElementById("input-estado")
const inputEntregaDelivery = document.getElementById("input-entrega-delivery");
const inputEntregaRetirar = document.getElementById("input-entrega-retirar");
const inputNumero = document.getElementById("input-numero");
const inputComplemento = document.getElementById("input-complemento");

const buscarCep = () => {
    let url = `https://viacep.com.br/ws/${inputCep.value}/json/`
    fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {

            inputCidade.value = data.localidade;
            inputBairro.value = data.bairro;
            inputRua.value = data.logradouro;
            inputEstado.value = data.uf;

            document.getElementById("input-numero").focus();
            
        })

}

inputCep.onkeyup = () => {
    if (inputCep.value.length >= 8) {
        buscarCep();
    } else {
        inputCidade.value = null;
        inputBairro.value = null;
        inputRua.value = null;
        inputEstado.value = null;
    }
    
}

inputEntregaDelivery.onclick = () => {
    inputCep.removeAttribute("disabled");
    inputNumero.removeAttribute("disabled");
    inputComplemento.removeAttribute("disabled");

    inputEndereco.style.display = "block";

   
}

inputEntregaRetirar.onclick = () => {
    inputCep.setAttribute("disabled", true);
    inputNumero.setAttribute("disabled", true);
    inputComplemento.setAttribute("disabled", true);

    inputEndereco.style.display = "none";

    inputCep.value = null;
    inputCidade.value = null;
    inputBairro.value = null;
    inputRua.value = null;
    inputEstado.value = null;
    inputNumero.value = null;
    inputComplemento.value = null;

}