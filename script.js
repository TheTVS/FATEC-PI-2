
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

    // Inputs de RG
    var idsRG = ['res-rg', 'cri-rg'];
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
      if (document.getElementById("ale-ali").checked) {
        var camposAleAli = document.getElementsByClassName("obrigatorioAleAli");
        for (var i = 0; i < camposAleAli.length; i++) {
          if (camposAleAli[i].value === '') {
            todosPreenchidos = false;
            camposAleAli[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleAli[i];
            }
          } else {
            camposAleAli[i].style.border = "";
          }
        }
      }
      if (document.getElementById("ale-pdi").checked) {
        var camposAlePdi = document.getElementsByClassName("obrigatorioAlePdi");
        for (var i = 0; i < camposAlePdi.length; i++) {
          if (camposAlePdi[i].value === '') {
            todosPreenchidos = false;
            camposAlePdi[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAlePdi[i];
            }
          } else {
            camposAlePdi[i].style.border = "";
          }
        }
      }
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
    } else {
      if (document.getElementById("doe-con").checked) {
        var camposAleCon = document.getElementsByClassName("obrigatorioDoeCon");
        for (var i = 0; i < camposAleCon.length; i++) {
          if (camposAleCon[i].value === '') {
            todosPreenchidos = false;
            camposAleCon[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleCon[i];
            }
          } else {
            camposAleCon[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-car").checked) {
        var camposAleCar = document.getElementsByClassName("obrigatorioDoeCar");
        for (var i = 0; i < camposAleCar.length; i++) {
          if (camposAleCar[i].value === '') {
            todosPreenchidos = false;
            camposAleCar[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleCar[i];
            }
          } else {
            camposAleCar[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-des").checked) {
        var camposAleDes = document.getElementsByClassName("obrigatorioDoeDes");
        for (var i = 0; i < camposAleDes.length; i++) {
          if (camposAleDes[i].value === '') {
            todosPreenchidos = false;
            camposAleDes[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleDes[i];
            }
          } else {
            camposAleDes[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-dia").checked) {
        var camposAleDia = document.getElementsByClassName("obrigatorioDoeDia");
        for (var i = 0; i < camposAleDia.length; i++) {
          if (camposAleDia[i].value === '') {
            todosPreenchidos = false;
            camposAleDia[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleDia[i];
            }
          } else {
            camposAleDia[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-hem").checked) {
        var camposAleHem = document.getElementsByClassName("obrigatorioDoeHem");
        for (var i = 0; i < camposAleHem.length; i++) {
          if (camposAleHem[i].value === '') {
            todosPreenchidos = false;
            camposAleHem[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleHem[i];
            }
          } else {
            camposAleHem[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-hip").checked) {
        var camposAleHip = document.getElementsByClassName("obrigatorioDoeHip");
        for (var i = 0; i < camposAleHip.length; i++) {
          if (camposAleHip[i].value === '') {
            todosPreenchidos = false;
            camposAleHip[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleHip[i];
            }
          } else {
            camposAleHip[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-enx").checked) {
        var camposAleEnx = document.getElementsByClassName("obrigatorioDoeEnx");
        for (var i = 0; i < camposAleEnx.length; i++) {
          if (camposAleEnx[i].value === '') {
            todosPreenchidos = false;
            camposAleEnx[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleEnx[i];
            }
          } else {
            camposAleEnx[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-bro").checked) {
        var camposAleBro = document.getElementsByClassName("obrigatorioDoeBro");
        for (var i = 0; i < camposAleBro.length; i++) {
          if (camposAleBro[i].value === '') {
            todosPreenchidos = false;
            camposAleBro[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleBro[i];
            }
          } else {
            camposAleBro[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-dis").checked) {
        var camposAleDis = document.getElementsByClassName("obrigatorioDoeDis");
        for (var i = 0; i < camposAleDis.length; i++) {
          if (camposAleDis[i].value === '') {
            todosPreenchidos = false;
            camposAleDis[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposAleDis[i];
            }
          } else {
            camposAleDis[i].style.border = "";
          }
        }
      }
      if (document.getElementById("doe-out").checked) {
        var camposAleOut = document.getElementsByClassName("obrigatorioDoeOut");
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

    // Verificação dos campos da "Histórico de Saúde"
    if (!verificarSelecao('his-sau-var')) {
      todosPreenchidos = false;
      document.getElementsByName("his-sau-var")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("his-sau-var")[0];
      }
    }
    if (!verificarSelecao('his-sau-son')) {
      todosPreenchidos = false;
      document.getElementsByName("his-sau-son")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("his-sau-son")[0];
      }
    } else {
      if (document.getElementById("his-sau-son-sim").checked) {
        var camposHisSauSonObs = document.getElementsByClassName("obrigatorioHisSauSonObs");
        for (var i = 0; i < camposHisSauSonObs.length; i++) {
          if (camposHisSauSonObs[i].value === '') {
            todosPreenchidos = false;
            camposHisSauSonObs[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposHisSauSonObs[i];
            }
          } else {
            camposHisSauSonObs[i].style.border = "";
          }
        }
      }
    }

    // Histórico Vacinal
    if (!verificarSelecao('tem-his-vac-out')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-his-vac-out")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-his-vac-out")[0];
      }
    } else {
      if (document.getElementById("tem-his-vac-out-sim").checked) {
        var camposHisVacOut = document.getElementsByClassName("obrigatorioHisVacOut");
        for (var i = 0; i < camposHisVacOut.length; i++) {
          if (camposHisVacOut[i].value === '') {
            todosPreenchidos = false;
            camposHisVacOut[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposHisVacOut[i];
            }
          } else {
            camposHisVacOut[i].style.border = "";
          }
        }
      }
    }
    if (!verificarSelecao('tem-his-vac-obs')) {
      todosPreenchidos = false;
      document.getElementsByName("tem-his-vac-obs")[0].style.border = "1px solid red";
      if (campoFoco == -1) {
        campoFoco = document.getElementsByName("tem-his-vac-obs-sim")[0];
      }
    } else {
      if (document.getElementById("tem-his-vac-obs-sim").checked) {
        var camposHisVacObs = document.getElementsByClassName("obrigatorioHisVacObs");
        for (var i = 0; i < camposHisVacObs.length; i++) {
          if (camposHisVacObs[i].value === '') {
            todosPreenchidos = false;
            camposHisVacObs[i].style.border = "1px solid red";
            if (campoFoco == -1) {
              campoFoco = camposHisVacObs[i];
            }
          } else {
            camposHisVacObs[i].style.border = "";
          }
        }
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

// Função de mostrar campo outro responsavel
function mostrarCamposSelect(select, textareaId) {
  var textarea = document.getElementById(textareaId);
  textarea.style.display = select.value === "outro" ? "block" : "none";
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

document.addEventListener('DOMContentLoaded', function() {
  const inputDocumento = document.getElementById('input-documento');
  const labelDocumento = document.getElementById('label-documento');

  inputDocumento.addEventListener('input', function() {
      let valor = inputDocumento.value.trim();
      let novoId, novoName, novoFor, novoMinLength, novoMaxLength, tipo;

      if (/^\d/.test(valor)) {
          // Começa com número, considera como RG
          tipo = 'RG';
          novoId = 'res-rg';
          novoName = 'res-rg';
          novoFor = 'res-rg';
          novoMinLength = '12';
          novoMaxLength = '12';

          valor = valor.replace(/\D/g, ''); // Remove não números
          valor = valor.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})(\d{1})$/, '$1.$2.$3-$4');
      } else if (/^[a-zA-Z]/.test(valor)) {
          // Começa com letra, considera como RNE
          tipo = 'RNE';
          novoId = 'res-rne';
          novoName = 'res-rne';
          novoFor = 'res-rne';
          novoMinLength = '9';
          novoMaxLength = '9';

          valor = valor.toUpperCase().replace(/[^\w]/g, ''); // Remove caracteres especiais
          valor = valor.replace(/^(\w{1})(\d{6})(\w{1})(\d{1})$/, '$1$2-$3');
      } else {
          // Padrão para caso inicial vazio ou outro formato não esperado
          tipo = 'RG'; // Por padrão, começará como RG se não houver entrada válida
          novoId = 'res-rg';
          novoName = 'res-rg';
          novoFor = 'res-rg';
          novoMinLength = '12';
          novoMaxLength = '12';
          valor = '';
      }

      // Altera dinamicamente o texto do label para RG ou RNE
      labelDocumento.textContent = tipo;

      // Aplica as novas configurações
      inputDocumento.id = novoId;
      inputDocumento.name = novoName;
      labelDocumento.setAttribute('for', novoFor);
      inputDocumento.minLength = novoMinLength;
      inputDocumento.maxLength = novoMaxLength;
      inputDocumento.value = valor;

      // Aplica a máscara conforme o tipo de documento
      if (tipo === 'RG') {
          if (valor.length > 2) {
              valor = valor.slice(0, 2) + '.' + valor.slice(2);
          }
          if (valor.length > 6) {
              valor = valor.slice(0, 6) + '.' + valor.slice(6);
          }
          if (valor.length > 10) {
              valor = valor.slice(0, 10) + '-' + valor.slice(10);
          }
      } else if (tipo === 'RNE') {
          // Aplica a máscara para RNE
          if (valor.length > 1) {
              valor = valor.slice(0, 1) + '.' + valor.slice(1);
          }
          if (valor.length > 7) {
              valor = valor.slice(0, 7) + '-' + valor.slice(7);
          }
      }

      inputDocumento.value = valor;
  });
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

// IDs de CPF, Telefone e CEP
const CPFIds = ['res-cpf'];
const TelIds = ['res-tel-1', 'res-tel-2', 'res-tel-3'];
const CEPIds = ['end-cep'];

// Aplicando as máscaras e validações apenas para CPF, Telefone e CEP
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
