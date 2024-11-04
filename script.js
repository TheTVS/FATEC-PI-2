
// Consultar CEP
function consultarEndereco() {
  let cep = document.querySelector('#end-cep').value;

  let url = `https://viacep.com.br/ws/${cep}/json/`;

  fetch(url).then(function (response) {
    response.json().then(mostrarEndereco);
  });
}

function mostrarEndereco(dados) {
  let ruaInput = document.querySelector('#end-rua');
  let bairroInput = document.querySelector('#end-bai');
  let cidadeInput = document.querySelector('#end-cid');
  let estadoSelect = document.querySelector('#end-uf');

  if (dados.erro) {
    //alert("CEP não encontrado.");
  } else {
    ruaInput.value = dados.logradouro;
    bairroInput.value = dados.bairro;
    cidadeInput.value = dados.localidade;

    let estadoOption = estadoSelect.querySelector(`option[value="${dados.uf.toLowerCase()}"]`);
    if (estadoOption) {
      estadoOption.selected = true;
    } else {
      //alert("Estado não encontrado na lista.");
    }
  }
}

// Função de calcular idade
const birthdayEl = document.getElementById("birthday");
const resultEl = document.getElementById("result");

function calculateAge() {
  const birthdayValue = birthdayEl.value;
  if (isDateComplete(birthdayValue)) {
    const age = getAge(birthdayValue);
    resultEl.innerText = `${age}`;
  } else {
    resultEl.innerText = "";
  }
}

function getAge(birthdayValue) {
  const currentDate = new Date();
  const birthdayDate = new Date(birthdayValue);
  let age = currentDate.getFullYear() - birthdayDate.getFullYear();
  const month = currentDate.getMonth() - birthdayDate.getMonth();

  if (month < 0 || (month === 0 && currentDate.getDate() < birthdayDate.getDate())) {
    age--;
  }
  return age;
}

function isDateComplete(dateString) {
  return dateString.length === 10;
}

birthdayEl.addEventListener('blur', calculateAge);



// Função de verificar e passar para o próximo passo
function mostrarPagina(pagina) {
  const paginas = document.querySelectorAll('.pagina');

  // Pagina 2
  if (pagina == 2) {
    var campos = document.getElementsByClassName("obrigatorioTexto-p1");
    var camposSelect = document.getElementsByClassName("obrigatorioSelect-p1");
    var todosPreenchidos = true;
    var campoFoco = -1;

    // Input texto
    for (var i = 0; i < campos.length; i++) {
      if (campos[i].value === '') {
        todosPreenchidos = false;
        campos[i].style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = campos[i];
        }
      } else {
        campos[i].style.border = "";
      }
    }

    // Select
    for (var i = 0; i < camposSelect.length; i++) {
      if (camposSelect[i].value === '') {
        todosPreenchidos = false;
        camposSelect[i].style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = camposSelect[i];
        }
      } else {
        camposSelect[i].style.border = "";
      }
    }

    // Verificação dos campos da "Responsaveis"
    function verificarCamposResponsavel() {
      var todosPreenchidos = true;
      var campoFoco = -1;

      // Verifica se "outro" foi selecionado
      if (document.getElementById("res-res-outro").checked) {
        var camposResponsavel = document.getElementsByClassName("obrigatorioResponsavel");
        for (var i = 0; i < camposResponsavel.length; i++) {
          if (camposResponsavel[i].value === '') {
            todosPreenchidos = false;
            camposResponsavel[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposResponsavel[i];
            }
          } else {
            camposResponsavel[i].style.border = "";
          }
        }
      }
      return todosPreenchidos;
    }
    if (!verificarSelecao('res-res')) {
      todosPreenchidos = false;
      document.getElementsByName("res-res")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("res-res")[0];
      }
    } else {
      if (!verificarCamposResponsavel()) {
        todosPreenchidos = false;
      }
    }

    // Inputs de RG
    var idsRG = ['res-rg'];
    var minLengthTelefone = 11;

    idsRG.forEach(id => {
      var RG = document.getElementById(id);
      if (RG.value.length < minLengthTelefone) {
        todosPreenchidos = false;
        RG.style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = RG;
        }
      } else {
        RG.style.border = "";
      }
    });

    // Inputs de CPF
    var idsCPF = ['res-cpf'];
    var minLengthTelefone = 14;

    idsCPF.forEach(id => {
      var CPF = document.getElementById(id);
      if (CPF.value.length < minLengthTelefone) {
        todosPreenchidos = false;
        CPF.style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = CPF;
        }
      } else {
        CPF.style.border = "";
      }
    });

    // Inputs de telefone
    var idsTelefone = ['res-tel-1'];
    var minLengthTelefone = 15;

    idsTelefone.forEach(id => {
      var Tel = document.getElementById(id);
      if (Tel.value.length < minLengthTelefone) {
        todosPreenchidos = false;
        Tel.style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = Tel;
        }
      } else {
        Tel.style.border = "";
      }
    });

    // Inputs de CEP
    var idsTelefone = ['end-cep'];
    var minLengthTelefone = 9;

    idsTelefone.forEach(id => {
      var Tel = document.getElementById(id);
      if (Tel.value.length < minLengthTelefone) {
        todosPreenchidos = false;
        Tel.style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = Tel;
        }
      } else {
        Tel.style.border = "";
      }
    });

    // Foco
    if (todosPreenchidos) {
      paginas.forEach(p => p.classList.add('hidden'));
      document.getElementById('pagina-' + pagina).classList.remove('hidden');
      window.scrollTo(0, 0);
    } else {
      //alert('Por favor, preencha todos os campos!');
      campoFoco.focus();
    }
  } else if (pagina == 3) {
    var campos = document.getElementsByClassName("obrigatorioTexto-p2");
    var camposSelect = document.getElementsByClassName("obrigatorioSelect-p2");
    var camposCheckbox = document.getElementsByClassName("obrigatorioCheckbox-p2");
    var todosPreenchidos = true;
    var campoFoco = -1;

    // Input texto
    for (var i = 0; i < campos.length; i++) {
      if (campos[i].value === '') {
        todosPreenchidos = false;
        campos[i].style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = campos[i];
        }
      } else {
        campos[i].style.border = "";
      }
    }

    // Select
    for (var i = 0; i < camposSelect.length; i++) {
      if (camposSelect[i].value === '') {
        todosPreenchidos = false;
        camposSelect[i].style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = camposSelect[i];
        }
      } else {
        camposSelect[i].style.border = "";
      }
    }

    // Checkbox
    for (var i = 0; i < camposCheckbox.length; i++) {
      if (!camposCheckbox[i].checked) {
        todosPreenchidos = false;
        camposCheckbox[i].style.border = "#ffcccc";
        if (campoFoco == -1) {
          campoFoco = camposCheckbox[i];
        }
      } else {
        camposCheckbox[i].style.border = "";
      }
    }

    // Radio
    // Verificação dos campos do "Convênio médico"
    if (!verificarSelecao('tem-con')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-con")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-con")[0];
      }
    } else {
      if (document.getElementById("tem-con-sim").checked) {
        var camposConvenio = document.getElementsByClassName("obrigatorioConvenio");
        for (var i = 0; i < camposConvenio.length; i++) {
          if (camposConvenio[i].value === '') {
            todosPreenchidos = false;
            camposConvenio[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposConvenio[i];
            }
          } else {
            camposConvenio[i].style.border = "";
          }
        }
      }
      if (!verificarSelecao('tem-con-obs')) {
        todosPreenchidos = false;
        document.getElementsByName("tem-con-obs")[0].style.border = "1px solid red";
        if (campoFoco == -1) {
          campoFoco = document.getElementsByName("tem-con-obs")[0];
        }
      } else {
        if (document.getElementById("tem-con-obs-sim").checked) {
          var camposConvenioObs = document.getElementsByClassName("obrigatorioConvenioObs");
          for (var i = 0; i < camposConvenioObs.length; i++) {
            if (camposConvenioObs[i].value === '') {
              todosPreenchidos = false;
              camposConvenioObs[i].style.border = "1px solid red";
              if (campoFoco == -1) {
                campoFoco = camposConvenioObs[i];
              }
            } else {
              camposConvenioObs[i].style.border = "";
            }
          }
        }
      }
    }

    // Verificação dos campos da "Alergia a medicamento"
    if (!verificarSelecao('tem-ale-med')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-ale-med")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-ale-med")[0];
      }
    } else {
      if (document.getElementById("tem-ale-med-sim").checked) {
        var camposAleMed = document.getElementsByClassName("obrigatorioAleMed");
        for (var i = 0; i < camposAleMed.length; i++) {
          if (camposAleMed[i].value === '') {
            todosPreenchidos = false;
            camposAleMed[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleMed[i];
            }
          } else {
            camposAleMed[i].style.border = "";
          }
        }
      }
    }

    // Verificação dos campos da "Alergia"
    if (!verificarSelecao('tem-ale')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-ale")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-ale")[0];
      }
    } else {
      if (document.getElementById("ale-out").checked) {
        var camposAleOut = document.getElementsByClassName("obrigatorioAleOut");
        for (var i = 0; i < camposAleOut.length; i++) {
          if (camposAleOut[i].value === '') {
            todosPreenchidos = false;
            camposAleOut[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleOut[i];
            }
          } else {
            camposAleOut[i].style.border = "";
          }
        }
      }
    }

    // Verificação dos campos da "Doença Crônicas"
    if (!verificarSelecao('tem-doe')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-doe")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-doe")[0];
      }
    }

    // Foco
    if (todosPreenchidos) {
      paginas.forEach(p => p.classList.add('hidden'));
      document.getElementById('pagina-' + pagina).classList.remove('hidden');
      window.scrollTo(0, 0);
    } else {
      //alert('Por favor, preencha todos os campos!');
      campoFoco.focus();
      camposConvenio[campoFoco].focus()
    }
  } else {
    paginas.forEach(p => p.classList.add('hidden'));
    document.getElementById('pagina-' + pagina).classList.remove('hidden');
    window.scrollTo(0, 0);
  }

}

// Função de mostrar campos a partir de um checkbox
function mostrarCamposCheckbox(checkbox, textareaId) {
  var textarea = document.getElementById(textareaId);
  textarea.style.display = checkbox.checked ? "block" : "none";
}

// Função de mostrar campos a partir de um radio
function mostrarCamposRadio(radio, textareaId) {
  var textarea = document.getElementById(textareaId);
  textarea.style.display = radio.checked ? "block" : "none";

  if (radio.value == 'nao') {
    textarea.style.display = "none";
  }
}

function mostrarCamposRadioResponsavel(radio, textareaId) {
  var textarea = document.getElementById(textareaId);
  textarea.style.display = radio.value === 'outro' ? "block" : "none";
}

function verificarSelecao(grupo) {
  // Obtém todos os input radio com o name "opcao"
  var opcoes = document.getElementsByName(grupo);
  var selecionado = false;

  // Verifica se pelo menos um dos input radio está selecionado
  for (var i = 0; i < opcoes.length; i++) {
    if (opcoes[i].checked) {
      selecionado = true;
      break;
    }
  }

  // Se pelo menos um input radio estiver selecionado, exibe uma mensagem
  if (!selecionado) {
    //alert('Nenhuma opção foi selecionada! ' + grupo);
  }
  return selecionado
}


//##popup
function openPopup() {
  var popup = document.getElementById("popup");
  var overlay = document.getElementsByClassName("overlay")[0];
  popup.style.display = "block";
  overlay.style.display = "block";
}

function closePopup() {
  var popup = document.getElementById("popup");
  var overlay = document.getElementsByClassName("overlay")[0];
  popup.style.display = "none";
  overlay.style.display = "none";
}

var agreeCheckbox = document.getElementById("agreeCheckbox");
var form = document.getElementById("form-principal");

//## Desabilita o botão de envio se a caixa de seleção não estiver marcada
form.addEventListener("submit", function (event) {
  if (!agreeCheckbox.checked) {
    event.preventDefault(); // Impede o envio do formulário
  }
});

// Função para permitir apenas números e aplicar máscara de acordo com o tipo
function aplicarMascara(event, tipo) {
  const input = event.target;
  let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos

  if (tipo === 'CPF') {
    if (value.length > 3) {
      value = value.slice(0, 3) + '.' + value.slice(3);
    }
    if (value.length > 7) {
      value = value.slice(0, 7) + '.' + value.slice(7);
    }
    if (value.length > 11) {
      value = value.slice(0, 11) + '-' + value.slice(11);
    }
  } else if (tipo === 'Telefone') {
    if (value.length > 0) {
      value = '(' + value;
    }
    if (value.length > 3) {
      value = value.slice(0, 3) + ') ' + value.slice(3);
    }
    if (value.length > 9) {
      value = value.slice(0, 10) + '-' + value.slice(10);
    }
  } else if (tipo === 'CEP') {
    if (value.length > 5) {
      value = value.slice(0, 5) + '-' + value.slice(5);
    }
  } else if (tipo === 'RG') {
    if (value.length > 2) {
      value = value.slice(0, 2) + '.' + value.slice(2);
    }
    if (value.length > 6) {
      value = value.slice(0, 6) + '.' + value.slice(6);
    }
    if (value.length > 10) {
      value = value.slice(0, 10) + '-' + value.slice(10);
    }
  }

  input.value = value;
}

// Função para permitir apenas números
function apenasNumeros(event) {
  const input = event.target;
  input.value = input.value.replace(/\D/g, '');
}

// Função para aplicar máscaras e validações nos campos
function aplicarMascaraCampos(ids, tipo) {
  ids.forEach(id => {
    const input = document.getElementById(id);
    input.addEventListener('input', (event) => {
      apenasNumeros(event);
      aplicarMascara(event, tipo);
    });
  });
}

// IDs de RG, CPF, Telefone e CEP
const RGIds = ['res-rg'];
const CPFIds = ['res-cpf'];
const TelIds = ['res-tel-1', 'res-tel-2', 'res-tel-3'];
const CEPIds = ['end-cep'];

// Aplicando as máscaras e validações apenas para RG, CPF, Telefone e CEP
aplicarMascaraCampos(RGIds, 'RG');
aplicarMascaraCampos(CPFIds, 'CPF');
aplicarMascaraCampos(TelIds, 'Telefone');
aplicarMascaraCampos(CEPIds, 'CEP');


//## Aumentar fonte
document.addEventListener('DOMContentLoaded', () => {
  const increaseButton = document.getElementById('increase-font');
  const resetButton = document.getElementById('reset-font');

  const elements = document.querySelectorAll('.formulario-titulo, .formulario-grupo, .formulario-linha, input, label, select, option');

  const defaultFontSizes = {
    '.formulario-titulo': 24,
    '.formulario-grupo': 16,
    '.formulario-linha': 16,
    'input': 14,
    'label': 14,
    'select': 14,
    'option': 14
  };

  const maxClicks = 5;
  let clickCount = 0;

  let currentFontSizes = { ...defaultFontSizes };

  increaseButton.addEventListener('click', () => {
    if (clickCount < maxClicks) {
      updateFontSizes(1);
      clickCount++;
    }
  });

  resetButton.addEventListener('click', () => {
    currentFontSizes = { ...defaultFontSizes };
    clickCount = 0;
    updateFontSize();
  });

  function updateFontSizes(increment) {
    for (let selector in currentFontSizes) {
      currentFontSizes[selector] += increment;
    }
    updateFontSize();
  }

  function updateFontSize() {
    elements.forEach(element => {
      for (let selector in currentFontSizes) {
        if (element.matches(selector)) {
          element.style.fontSize = `${currentFontSizes[selector]}px`;
        }
      }
    });
  }

  // Inicializa os tamanhos de fonte padrão
  updateFontSize();
});

//## Botão de Normas
document.addEventListener('DOMContentLoaded', () => {
  const confirmButton = document.getElementById('confirm-button');
  const checkbox = document.getElementById('nor');

  confirmButton.addEventListener('click', () => {
    checkbox.checked = true;
  });
});

//## Tamanho do Header
document.addEventListener('DOMContentLoaded', () => {
  const header = document.getElementById('header');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 0) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
});

function alert(bool) {
  alert("teste");
}