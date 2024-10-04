<?php
    include('resource/database/conexao.php');

    $texto = '';
    //Select para mostrar qual temporada esta
    $sql = "SELECT temp_data_inicio,temp_data_fim,temp_preco,temp_max_parcela FROM temporada WHERE temp_id = (SELECT MAX(temp_id) FROM temporada)";

    $result = $conexao->query($sql);

    // Verifica se um resultado foi encontrado
    if ($result->num_rows > 0) {
        // Busca os dados
        $row = $result->fetch_assoc();

        // Salva os dados em variáveis
        $dataInicio = $row['temp_data_inicio'];
        $dataFim = $row['temp_data_fim'];
        $valorInscrição = $row['temp_preco'];
        $maxParcelas = $row['temp_max_parcela'];

    } else {
        $texto = "Nenhuma temporada encontrada.";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Básico</title>
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <div class="formulario-wrapper">
        <div class="container-header" id="header">
            <div class="header-linha">
                <div class="header-grupo" style="flex-basis: 10in;">
                    <div class="logo-wrapper">
                        <img src="imgs/RP_Acamps.svg" alt="Logo">
                    </div>
                </div>
                <div class="header-grupo" style="flex-basis: 50in;">
                    <div class="container-header-slogan">A semana mais incrível do ano!</div>
                </div>
                <div class="header-grupo" style="flex-basis: 10in;">
                    <div class="font-size-controls">
                        <button class="svg-button" id="increase-font">
                            <img src="imgs/up-right-and-down-left-from-center.svg" alt="Logo">
                        </button>
                        <button class="svg-button" id="reset-font">
                            <img src="imgs/font.svg" alt="Logo">
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-principal" action="resource\scripts\PHP\main.php" method="post">
            <!-- PAGINA 1 -->
            <div id="pagina-1" class="pagina">
                <div class="container" style="text-align: center;">
                    <div>
                        <h1>Inscrição do Acampamento</h1>
                        <h3>Acampamento <?php echo "$dataInicio até $dataFim"; ?></h3>
                    </div>
                </div>
                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Área do responsável</h2>
                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="res-nom" name="res-nom" maxlength="100"
                                    class="obrigatorioTexto-p1">
                                <label for="res-nom">Nome<span style="color: red;">*</span></label>

                            </div>

                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="res-sob" name="res-sob" maxlength="200"
                                    class="obrigatorioTexto-p1">
                                <label for="res-sob">Sobrenome<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="res-cpf" name="res-cpf" maxlength="14"
                                    oninput="aplicarMascara(event)" class="obrigatorioTexto-p1">
                                <label for="res-cpf">CPF<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="res-tel-1" name="res-tel-1" minlength="15"
                                    maxlength="15" class="obrigatorioTexto-p1" required>
                                <label for="res-tel-1">Telefone 1<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">

                                <input placeholder="‎" type="text" id="res-tel-2" name="res-tel-2" maxlength="15">
                                <label for="res-tel-2">Telefone 2</label>
                            </div>

                            <div class="formulario-grupo">

                                <input placeholder="‎" type="text" id="res-tel-3" name="res-tel-3" maxlength="15">
                                <label for="res-tel-3">Telefone 3</label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="email" id="res-eml-1" name="res-eml-1"
                                    class="obrigatorioTexto-p1">
                                <label for="res-eml-1">Email 1<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">
                                <input placeholder="‎" type="email" id="res-eml-2" name="res-eml-2">
                                <label for="res-eml-2">Email 2</label>
                            </div>
                        </div>

                        <div class="formulario-grupo">
                            <span class="label" for="res-res">Responsável<span style="color: red;">*</span></span>
                        </div>
                        <div class="formulario-linha-checkbox">
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="res-res-pai" name="res-res" value="pai"
                                    onclick="mostrarCamposRadioResponsavel(this, 'camposResponsavel')">
                                <label for="res-res-pai">Pai</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="res-res-mae" name="res-res" value="mae"
                                    onclick="mostrarCamposRadioResponsavel(this, 'camposResponsavel')">
                                <label for="res-res-mae">Mãe</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="res-res-outro" name="res-res" value="outro"
                                    onclick="mostrarCamposRadioResponsavel(this, 'camposResponsavel')">
                                <label for="res-res-outro">Outro</label>
                            </div>
                        </div>

                        <div id="camposResponsavel" style="display: none;">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="res-out" name="res-out"
                                    class="obrigatorioResponsavel">
                                <label for="res-out">Responsável<span style="color: red;">*</span></label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Endereço</h2>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="end-cep" name="end-cep" maxlength="9"
                                    class="obrigatorioTexto-p1" onblur="consultarEndereco()">
                                <label for="end-cep">CEP<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">

                                <input placeholder="‎" type="text" id="end-rua" name="end-rua" maxlength="200"
                                    class="obrigatorioTexto-p1">
                                <label for="end-rua">Rua<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">

                                <input placeholder="‎" type="text" id="end-bai" name="end-bai" maxlength="100"
                                    class="obrigatorioTexto-p1">
                                <label for="end-bai">Bairro<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="end-cid" name="end-cid" maxlength="100"
                                    class="obrigatorioTexto-p1">
                                <label for="end-cid">Cidade<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">
                                <select id="end-uf" name="end-uf" class="obrigatorioSelect-p1">
                                    <option value="" disabled selected></option>
                                    <option value="ac">AC</option>
                                    <option value="al">AL</option>
                                    <option value="ap">AP</option>
                                    <option value="am">AM</option>
                                    <option value="ba">BA</option>
                                    <option value="ce">CE</option>
                                    <option value="df">DF</option>
                                    <option value="es">ES</option>
                                    <option value="go">GO</option>
                                    <option value="ma">MA</option>
                                    <option value="mt">MT</option>
                                    <option value="ms">MS</option>
                                    <option value="mg">MG</option>
                                    <option value="pa">PA</option>
                                    <option value="pb">PB</option>
                                    <option value="pr">PR</option>
                                    <option value="pe">PE</option>
                                    <option value="pi">PI</option>
                                    <option value="rj">RJ</option>
                                    <option value="rn">RN</option>
                                    <option value="rs">RS</option>
                                    <option value="ro">RO</option>
                                    <option value="rr">RR</option>
                                    <option value="sc">SC</option>
                                    <option value="sp">SP</option>
                                    <option value="se">SE</option>
                                    <option value="to">TO</option>
                                </select>
                                <label placeholder="‎" for="end-uf">Estado<span style="color: red;">*</span></label>
                            </div>
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="number" step="1" id="end-num" name="end-num" maxlength="10"
                                    class="obrigatorioTexto-p1">
                                <label for="end-num">Número<span style="color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Área da criança</h2>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="cri-nom" name="cri-nom" maxlength="100"
                                    class="obrigatorioTexto-p1">
                                <label for="cri-nom">Nome<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">
                                <input placeholder="‎" type="text" id="cri-sob" name="cri-sob" maxlength="200"
                                    class="obrigatorioTexto-p1">
                                <label for="cri-sob">Sobrenome<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <input type="date" id="birthday" name="birthday" min="2000-01-01" max="2030-12-31"
                                    class="data0, obrigatorioSelect-p1">
                                <label placeholder="‎" for="birthday">Data de nascimento<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="formulario-grupo">
                                <div class="formulario-grupo-idade">
                                    <div id="result" class="idade"></div>
                                </div>
                                <label placeholder="‎" for="cri-idd">Idade<span style="color: red;">*</span></label>
                            </div>
                        </div>

                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <select id="sexo" name="sexo" class="obrigatorioSelect-p1">
                                    <option value="" disabled selected></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                                <label placeholder="‎" for="sexo">Sexo<span style="color: red;">*</span></label>
                            </div>

                            <div class="formulario-grupo">
                                <select id="cri-tar" name="cri-tar" class="obrigatorioSelect-p1">
                                    <option value="" disabled selected></option>
                                    <option value="p">P</option>
                                    <option value="m">M</option>
                                    <option value="g">G</option>
                                    <option value="gg">GG</option>
                                    <option value="exg">EXG</option>
                                    <option value="06">06 Infantil</option>
                                    <option value="08">08 Infantil</option>
                                    <option value="10">10 Infantil</option>
                                    <option value="12">12 Infantil</option>
                                </select>
                                <label placeholder="‎" for="cri-tar">Tamanho da camiseta<span
                                        style="color: red;">*</span></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Valores</h2>
                        <div class="formulario-grupo">
                            <div class="formulario-linha-valor">
                                <div class="formulario-grupo-moeda">
                                    <h5>R$</h5>
                                </div>
                                <div class="formulario-grupo-valor">
                                    <h1><?php echo "$valorInscrição"; ?></h1>
                                </div>
                            </div>
                            <h5 id="valor-calculado">R$<?php echo "$valorInscrição em $maxParcelas de R$".($valorInscrição/$maxParcelas);?></h5>
                        </div>
                        <br>
                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <select id="val-par" name="val-par" class="obrigatorioSelect-p1">
                                    <option value="1" disabled selected></option>
                                    <?php 
                                            for ($i = 1; $i <= $maxParcelas; $i++) {
                                                echo "<option value='$i'>$i</option>";
                                            }
                                    ?>
                                </select>
                                <script>
                                    document.getElementById('val-par').addEventListener('change', function() {
                                        const selectedValue = this.value;
                                        const valorInscricao = <?php echo $valorInscrição; ?>;
                                        const newValor = (valorInscricao / selectedValue).toFixed(2);
                                        document.getElementById('valor-calculado').innerText = `R$${valorInscricao} em ${selectedValue} de R$${newValor}`;
                                    });
                                </script>
                                <label placeholder="‎" for="val-par">Parcelas<span style="color: red;">*</span></label>
                            </div>
                            <div class="formulario-grupo" style="flex-basis: 50%;"></div>
                        </div>
                    </div>
                </div>

                <div class="progresso-container">
                    Passo 1 de 2
                    <div class="barra-progresso">
                        <div class="barra-preenchida" style="width: 50%;"></div>
                    </div>
                </div>

                <div class="botao">
                    <button type="button" class="formulario-botao" onclick="mostrarPagina(2)">Seguinte</button>
                </div>
            </div>


            <!-- PAGINA 2 -->
            <div id="pagina-2" class="pagina hidden">
                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Área médica</h2>
                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <select id="sangue" name="sangue" class="obrigatorioSelect-p2">
                                    <option value="" disabled selected></option>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="ab">AB</option>
                                    <option value="o">O</option>
                                    <option value="falso-o">Falso O</option>
                                </select>
                                <label placeholder="‎" for="sangue">Tipagem sanguínea<span
                                        style="color: red;">*</span></label>
                            </div>
                            <div class="formulario-grupo">
                                <select id="rh" name="rh" class="obrigatorioSelect-p2">
                                    <option value="" disabled selected></option>
                                    <option value="pos">+</option>
                                    <option value="neg">-</option>
                                    <option value="rh-nulo">RH Nulo</option>
                                </select>
                                <label placeholder="‎" for="rh">Fator RH<span style="color: red;">*</span></label>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Convênio médico</h2>

                        <div class="formulario-grupo">
                            <span class="label" for="tem-con">Você possui convênio médico?<span
                                    style="color: red;">*</span></span>
                        </div>
                        <div class="formulario-linha-checkbox">
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-con-sim" name="tem-con" value="sim"
                                    onclick="mostrarCamposRadio(this, 'camposConvenio')">
                                <label for="tem-con-sim">Sim</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-con-nao" name="tem-con" value="nao"
                                    onclick="mostrarCamposRadio(this, 'camposConvenio')">
                                <label for="tem-con-nao">Não</label>
                            </div>
                        </div>
                        <div id="camposConvenio">
                            <div class="formulario-linha">
                                <div class="formulario-grupo">
                                    <input placeholder="‎" type="text" id="con-num" name="con-num"
                                        class="obrigatorioConvenio">
                                    <label for="con-num">Código do Convênio<span style="color: red;">*</span></label>
                                </div>
                                <div class="formulario-grupo">
                                    <input placeholder="‎" type="text" id="con-nom" name="con-nom"
                                        class="obrigatorioConvenio">
                                    <label for="con-nom">Nome do Convênio<span style="color: red;">*</span></label>
                                </div>
                                <div class="formulario-grupo">
                                    <input placeholder="‎" type="text" id="con-cnt" name="con-cnt"
                                        class="obrigatorioConvenio">
                                    <label for="con-cnt">Contato do Convênio<span style="color: red;">*</span></label>
                                </div>
                            </div>

                            <div class="formulario-grupo">
                                <span for="tem-con-obs">Alguma observação?<span style="color: red;">*</span></span>
                            </div>
                            <div class="formulario-linha-checkbox">
                                <div class="formulario-grupo-checkbox">
                                    <input type="radio" id="tem-con-obs-sim" name="tem-con-obs" value="sim"
                                        onclick="mostrarCamposRadio(this, 'camposConvenioObs')">
                                    <label for="tem-con-obs-sim">Sim</label>
                                </div>
                                <div class="formulario-grupo-checkbox">
                                    <input type="radio" id="tem-con-obs-nao" name="tem-con-obs" value="nao"
                                        onclick="mostrarCamposRadio(this, 'camposConvenioObs')" checked>
                                    <label for="tem-con-obs-nao">Não</label>
                                </div>
                            </div>
                            <div id="camposConvenioObs">
                                <div class="formulario-linha">
                                    <div class="formulario-grupo">
                                        <textarea placeholder="‎" id="tem-con-obs" name="tem-con-obs" rows="2"
                                            style="resize: vertical;" class="obrigatorioConvenioObs"></textarea>
                                        <label for="tem-con-obs">Observações<span style="color: red;">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Alergia a medicamento</h2>
                        <div class="formulario-grid">
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-aps" name="ale-med-aps">
                                <label for="ale-med-aps">Aspirina</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-mel" name="ale-med-mel">
                                <label for="ale-med-mel">Melhoral</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-nov" name="ale-med-nov">
                                <label for="ale-med-nov">Novalgina (dipirona)</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-pla" name="ale-med-pla">
                                <label for="ale-med-pla">Plasil (metoclopramida)</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-dra" name="ale-med-dra">
                                <label for="ale-med-dra">Dramin</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-pov" name="ale-med-pov">
                                <label for="ale-med-pov">Povidine (iodo)</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-cat" name="ale-med-cat">
                                <label for="ale-med-cat">Cataflan (diclofenaco)</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-med-pen" name="ale-med-pen">
                                <label for="ale-med-pen">Penicilina</label>
                            </div>
                        </div>

                        <div class="formulario-grupo">
                            <span for="tem-ale-med">O participante tem alergia a alguma outro medicamento não
                                mencionado
                                acima?<span style="color: red;">*</span></span>
                        </div>

                        <div class="formulario-linha-checkbox">
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-ale-med-sim" name="tem-ale-med" value="sim"
                                    onclick="mostrarCamposRadio(this, 'camposAleMed')">
                                <label for="tem-ale-med-sim">Sim</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-ale-med-nao" name="tem-ale-med" value="nao"
                                    onclick="mostrarCamposRadio(this, 'camposAleMed')">
                                <label for="tem-ale-med-nao">Não</label>
                            </div>
                        </div>
                        <div id="camposAleMed">
                            <div class="formulario-linha">
                                <div class="formulario-grupo">
                                    <textarea placeholder="‎" id="ale-med-obs" name="ale-med-obs" rows="1"
                                        style="resize: vertical;" class="obrigatorioAleMed"></textarea>
                                    <label for="ale-med-obs">Qual?<span style="color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Alergia</h2>
                        <div class="formulario-grupo">
                            <span for="tem-ale">O participante tem alguma alergia?<span
                                    style="color: red;">*</span></span>
                        </div>
                        <div class="formulario-linha-checkbox">
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-ale-sim" name="tem-ale" value="sim"
                                    onclick="mostrarCamposRadio(this, 'camposAle')">
                                <label for="tem-ale-sim">Sim</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-ale-nao" name="tem-ale" value="nao"
                                    onclick="mostrarCamposRadio(this, 'camposAle')">
                                <label for="tem-ale-nao">Não</label>
                            </div>
                        </div>
                        <!-- Alergias -->
                        <div id="camposAle">
                            <div class="formulario-grupo">
                                <span for="tem-ale">Selecione qual(is) alergia(s) o participante possui</span>
                            </div>
                            <!-- Pó -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-po" name="ale"
                                    onclick="mostrarCamposCheckbox(this, 'ale-po-textarea')">
                                <label for="ale-po">Pó</label>
                            </div>
                            <!-- Alimentos -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-ali" name="ale"
                                    onclick="mostrarCamposCheckbox(this, 'ale-ali-textarea')">
                                <label for="ale-ali">Alimentos</label>
                            </div>
                            <div class="formulario-linha" id="ale-ali-textarea" style="display: none;">
                                <div class="formulario-grupo">
                                    <textarea placeholder="‎" id="ale-ali-obs" name="ale-ali-obs" rows="2"
                                        style="resize: vertical;" class="obrigatorioAleAli"></textarea>
                                    <label for="ale-ali-obs">Descreva qual(is) alimento(s) o participante tem
                                        alergia<span style="color: red;">*</span></label>
                                </div>
                            </div>
                            <!-- Picadas de Insetos -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-pdi" name="ale"
                                    onclick="mostrarCamposCheckbox(this, 'ale-pdi-textarea')">
                                <label for="ale-pdi">Picadas de Insetos</label>
                            </div>
                            <div class="formulario-linha" id="ale-pdi-textarea" style="display: none;">
                                <div class="formulario-grupo">
                                    <textarea placeholder="‎" id="ale-pdi-obs" name="ale-pdi-obs" rows="2"
                                        style="resize: vertical;" class="obrigatorioAlePdi"></textarea>
                                    <label for="ale-pdi-obs">Descreva qual(is) inseto(s) o participante tem
                                        alergia<span style="color: red;">*</span></label>
                                </div>
                            </div>
                            <!-- Outras alergias -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="ale-out" name="ale"
                                    onclick="mostrarCamposCheckbox(this, 'ale-out-textarea')">
                                <label for="ale-out">Outros</label>
                            </div>
                            <div class="formulario-linha" id="ale-out-textarea" style="display: none;">
                                <div class="formulario-grupo">
                                    <textarea placeholder="‎" id="ale-out-obs" name="ale-out-obs" rows="2"
                                        style="resize: vertical;" class="obrigatorioAleOut"></textarea>
                                    <label for="ale-out-obs">Descreva sobre a(s) alergia(s) adicional(is)<span
                                            style="color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Doença Crônica</h2>
                        <div class="formulario-grupo">
                            <span for="tem-doe">O participante tem alguma doença crônica?<span
                                    style="color: red;">*</span></span>
                        </div>

                        <div class="formulario-linha-checkbox">
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-doe-sim" name="tem-doe" value="sim"
                                    onclick="mostrarCamposRadio(this, 'camposDoe')">
                                <label for="tem-doe-sim">Sim</label>
                            </div>
                            <div class="formulario-grupo-checkbox">
                                <input type="radio" id="tem-doe-nao" name="tem-doe" value="nao"
                                    onclick="mostrarCamposRadio(this, 'camposDoe')">
                                <label for="tem-doe-nao">Não</label>
                            </div>
                        </div>
                        <!-- Doenças crônicas -->
                        <div id="camposDoe">
                            <div class="formulario-grupo">
                                <span for="tem-ale">Selecione qual(is) doença(s) o participante possui</span>
                            </div>
                            <!-- Convulsão -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-con" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-con-textarea')">
                                <label for="doe-con">Convulsões</label>
                            </div>
                            <!-- Cardiopatias -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-car" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-car-textarea')">
                                <label for="doe-car">Cardiopatias</label>
                            </div>
                            <!-- Desmaios -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-des" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-des-textarea')">
                                <label for="doe-des">Desmaios</label>
                            </div>
                            <!-- Diabetes -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-dia" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-dia-textarea')">
                                <label for="doe-dia">Diabetes</label>
                            </div>
                            <!-- Hemorragias -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-hem" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-hem-textarea')">
                                <label for="doe-hem">Hemorragias</label>
                            </div>
                            <!-- Hipoglicemia -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-hip" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-hip-textarea')">
                                <label for="doe-hip">Hipoglicemia</label>
                            </div>
                            <!-- Enxaqueca -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-enx" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-enx-textarea')">
                                <label for="doe-enx">Enxaqueca</label>
                            </div>
                            <!-- Asma/Bronquite -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-bro" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-bro-textarea')">
                                <label for="doe-bro">Asma / Bronquite</label>
                            </div>
                            <!-- Distúrbios neurológicos -->
                            <div class="formulario-grupo-checkbox">
                                <input type="checkbox" id="doe-dis" name="doe"
                                    onclick="mostrarCamposCheckbox(this, 'doe-dis-textarea')">
                                <label for="doe-dis">Distúrbios neurológicos</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Registro de Sintomas e Medicamentos</h2>
                        <div class="formulario-linha">
                            <div class="formulario-grupo">
                                <span placeholder="‎" for="reg-sin-med-obs">Caso o participante apresente algum dos
                                    seguintes sintomas
                                    (febre,
                                    gripe, cólica, dor de cabeça, dor de ouvido, náuseas/vômitos, dor de garganta, má
                                    digestão), por favor, especifique os medicamentos liberados para uso.<span
                                        style="color: red;">*</span></span>
                                <textarea id="reg-sin-med-obs" name="reg-sin-med-obs" rows="3" style="resize: vertical;"
                                    class="obrigatorioTexto-p2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Histórico Vacinal</h2>

                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-bcg" name="his-vac-bcg">
                            <label for="his-vac-bcg">BCG (Tuberculose) - Dose única</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-hpb" name="his-vac-hpb">
                            <label for="his-vac-hpb">Hepatite B - 3 doses</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-tet" name="his-vac-tet">
                            <label for="his-vac-tet">Tríplice ou Tetra Bacteriana (Difteria, Tétano, Coqueluche e
                                Haemophilus Influenzae B) - 3 doses + 2 reforços</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-pol" name="his-vac-pol">
                            <label for="his-vac-pol">Poliomielite (Paralisia Infantil) - 3 doses + 2 reforços</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-rot" name="his-vac-rot">
                            <label for="his-vac-rot">Rotavírus - 2 ou 3 doses</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-sar" name="his-vac-sar">
                            <label for="his-vac-sar">Tríplice Viral (Sarampo, Caxumba e Rubéola) - 1 dose + 1
                                reforço</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-hpa" name="his-vac-hpa">
                            <label for="his-vac-hpa">Hepatite A - 2 doses</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-var" name="his-vac-var">
                            <label for="his-vac-var">Varicela (Catapora) - 1 dose + 1 reforço</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-men" name="his-vac-men">
                            <label for="his-vac-men">Meningocócica Conjugada C (Meningite Bacteriana) - 3 doses ou dose
                                única</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-pne" name="his-vac-pne">
                            <label for="his-vac-pne">Pneumocócica Conjugada 7, 10 ou 13 Valente (Doenças Pneumocócicas)
                                - 4
                                doses, 3 doses, 2 doses ou única</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-inf" name="his-vac-inf">
                            <label for="his-vac-inf">Influenza (Gripe) - Anual</label>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="his-vac-feb" name="his-vac-feb">
                            <label for="his-vac-feb">Febre Amarela</label>
                        </div>

                <div class="container">
                    <div class="formulario">
                        <h2 class="formulario-titulo">Normas e Regulamentos</h2>

                        <div class="formulario-linha">
                            <button class="formulario-botao" type="button" onclick="openPopup()">Ler as normas</button>
                        </div>
                        <div class="formulario-grupo-checkbox">
                            <input type="checkbox" id="nor" name="nor" class="obrigatorioCheckbox-p2">
                            <label for="nor">Estou ciente e concordo com as normas <span
                                    style="color: red;">*</span></label>
                        </div>
                    </div>
                </div>

                <div class="progresso-container">
                    <p>Passo 2 de 2</p>
                    <div class="barra-progresso">
                        <div class="barra-preenchida" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="formulario-linha">
                    <button type="button" class="formulario-botao" onclick="mostrarPagina(1)">Voltar</button>
                    <div class="botao">
                        <button type="button" class="formulario-botao" onclick="mostrarPagina(3)">Enviar</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="overlay" onclick="closePopup()"></div>
        <div class="popup" id="popup">
            <div class="formulario-grupo">
                <h2 class="formulario-titulo">Normas e Regulamentos</h2>
                <p>1. A monitoria trabalha em parceria com os pais, visando garantir a segurança e o máximo
                    aproveitamento
                    do passeio. Portanto, solicitamos que os responsáveis compartilhem conosco qualquer informação
                    sobre
                    comportamento de extrema importância, mantendo total confidencialidade. Apenas dessa forma
                    poderemos
                    cuidar adequadamente de seus filhos. Por favor, não deixem de fornecer informações importantes
                    para
                    a
                    segurança do participante.</p>

                <p>2. Para garantir o bom andamento das atividades, pedimos que as visitas aconteçam apenas se forem
                    inadiáveis
                    e indispensáveis durante o acampamento e informamos que os telefonemas dos pais serão atendidos
                    por
                    um
                    responsável do acampamento, e repassados para os acampantes apenas em situações urgentes. Caso
                    seja
                    necessário, o responsável entrará em contato imediatamente com os pais.</p>

                <p>3. O monitor é responsável por comandar o horário de alvorada e silêncio total no alojamento. É
                    importante
                    que todos obedeçam a essas regras para garantir que todos estejam bem-dispostos no dia seguinte.
                </p>

                <p>4. Os pais ou responsáveis devem orientar o acampante a comunicar imediatamente qualquer
                    indisposição
                    ou
                    mal-estar ao monitor. Dessa forma, o monitor poderá acionar a coordenação, onde o responsável
                    será
                    comunicado imediatamente para providenciar o cuidado necessário.</p>

                <p>5. Não é permitido nas bagagens objetos de valor, tais como celulares, filmadoras, relógios,
                    joias,
                    games e
                    máquinas fotográficas, uma vez que não nos responsabilizamos por eventuais danos ou perdas de
                    equipamentos
                    ou objetos de qualquer natureza. Além disso, durante o acampamento, não será permitida a entrada
                    de
                    alimentos como balas, chicletes e salgadinhos. Caso algum desses itens seja encontrado, eles
                    serão
                    recolhidos na chegada e devolvidos no final da temporada. Por favor verifique a bagagem do
                    acampante
                    para
                    evitar transtornos.</p>

                <p>6. É fundamental que todos os pertences (roupas, lanternas, bonés, meias etc.) sejam devidamente
                    identificados com o nome do acampante, a fim de evitar extravios ou trocas. Cada participante é
                    responsável
                    por seus materiais. Solicitamos aos pais e/ou responsáveis que orientem seus filhos/acampantes a
                    preservarem
                    suas roupas e objetos. Os materiais e roupas esquecidos ou deixados no local serão recolhidos e
                    encaminhados
                    à sede da RP Eventos. Caso não sejam retirados na sede, serão doados a instituições carentes. O
                    prazo
                    para
                    retirada é de 30 dias após o término do Acampamento de Férias.</p>

                <p>7. Recomendamos que os seguintes itens sejam levados: agasalhos e roupas adequadas para o frio,
                    roupa
                    de
                    cama completa, travesseiros, bonés, lanternas e pilhas, repelente, protetor solar, materiais de
                    higiene
                    pessoal, sacos plásticos para embalar roupas sujas, pelo menos duas toalhas, uma pequena mochila
                    com
                    garrafa
                    simples de água para caminhadas, roupa de banho, roupas para práticas esportivas.</p>

                <p>8. Medicamentos de uso regular (informados e listados na ficha médica com horários e posologia),
                    devem
                    ser
                    entregues a Enfermeira do acampamento, nenhum medicamento é permitido nos alojamentos. Todos os
                    medicamentos
                    são ministrados exclusivamente pela Enfermeira, nenhum acampante pode se auto medicar, por mais
                    que
                    sejam
                    remédios de uso continuo, ou emergenciais com os quais o acampanete já tenha experiência diária
                    em
                    casa.</p>

                <p>9. Caso um acampante ignore repetidos avisos e explicações, colocando a si mesmo ou aos outros em
                    situações
                    perigosas ou desrespeitando colegas e monitores, solicitaremos que seus pais o busquem e os
                    valores
                    destinados ao acampamento não serão ressarcidos.</p>

                <p>10. As fotos e filmagens dos acampantes podem ser usadas para fins publicitários e compartilhadas
                    nas
                    redes
                    sociais @rpeventos. E essa ciência é dada na assinatura do contrato para participação do
                    acampamento.</p>

                <p>11. Todos os aniversários dos acampantes que ocorrerem durante a temporada serão celebrados no
                    acampamento,
                    durante o jantar, com bolo e refrigerante. Os pais dos aniversariantes devem informar no campo
                    de
                    observação
                    deste regulamento.</p>

                <p>12. O valor do investimento no acampamento inclui acomodações, banheiro, alimentação composta por
                    05
                    refeições diárias, atividades descritas na programação e monitoria especializada. Cabe ressaltar
                    que,
                    caso
                    haja cancelamento da inscrição por parte do responsável pelo acampante, não haverá direito à
                    devolução
                    dos
                    valores pagos.</p>

                <p>13. Em caso de desistência do acampante durante a semana de férias, o valor pago, não é
                    devolvido.
                </p>

                <p>14. É imprescindível que a ficha médica seja preenchida de forma completa e assinada pelos pais
                    ou
                    responsáveis, considerando que as informações fornecidas são de inteira responsabilidade de quem
                    as
                    preenche. É indispensável mencionar qualquer medicação que o participante esteja tomando, de
                    forma
                    detalhada, para que a equipe esteja ciente. Dedicamos especial atenção aos itens relacionados a
                    alergias
                    e
                    doenças crônicas. Para garantirmos um trabalho eficiente no cuidado de seus filhos, é
                    fundamental
                    que
                    tenhamos informações precisas, atualizadas e abrangentes.</p>

                <p>15. Ao término do acampamento, os responsáveis, receberão um link do Google drive, onde terão
                    acesso
                    a
                    todas
                    as fotos da nossa semana mágica em um prazo de até 10 dias úteis.</p>

                <p>--------------------</p>

                <p>Com o objetivo de proporcionar a melhor atenção ao seu filho durante nossas atividades, nos
                    esforçamos
                    para
                    estar sempre atualizados sobre seu histórico de saúde. É importante ressaltar que todos os
                    campos da
                    ficha
                    devem ser preenchidos, bem como quaisquer observações relevantes. É importante destacar que, em
                    casos de
                    urgência médica grave, seu filho será encaminhado ao hospital mais próximo.</p>

                <p>Programação do Acampamento - O Acampamento está programado para ocorrer de 15 a 20 de julho de
                    2024.
                    Os
                    responsáveis devem levar os participantes até o local às 8h30 da segunda-feira e buscá-los às 9h
                    do
                    sábado
                    seguinte! O Acampamento será realizado no Rancho Paumar, localizado em Itatiba, na estrada que
                    segue
                    em
                    direção a Louveira, antes do pedágio.</p>

                <p>As crianças são acompanhadas por monitores altamente capacitados e experientes, que estão
                    disponíveis
                    para
                    elas durante as 24 horas do dia. O acampamento oferece cinco refeições diárias, incluindo café
                    da
                    manhã,
                    almoço, lanche da tarde, jantar e ceia. Para garantir a segurança e conforto das crianças, elas
                    são
                    acomodadas em alojamentos separados, conforme sua idade e sexo.</p>

                <p>Os pais terão a oportunidade de acompanhar as atividades dos filhos através de fotos postadas no
                    feed
                    e
                    stories do Instagram. Além disso, terão os números de telefone dos coordenadores que estão
                    presentes
                    no
                    local 24 horas por dia. Durante o acampamento, as crianças poderão participar de diversas festas
                    temáticas,
                    como o Café da Manhã do Pijama, a Festa do Branco, Festa Junina e o Jantar dos Times. O
                    acampamento
                    é
                    destinado a crianças com idades entre 4 e 13 anos.</p>

                <p>Declaro estar de acordo com as providências julgadas as mais indicadas pela Coordenação do
                    Acampamento
                    de
                    Férias - RP Eventos ou Atendimento à saúde. Assumo total responsabilidade pelas informações
                    acima
                    assinaladas.</p>

                <p>--------------------</p>

                <p>Eu, responsável pelo acampante descrito acima, dou total permissão para sua participação no
                    acampamento de acordo com todos os termos e regulamentos aplicáveis.</p>
                <p>Declaro estar de acordo com as providências julgadas as mais indicadas pela Coordenação do
                    Acampamento de Férias - RP Eventos ou Atendimento à saúde. Assumo total responsabilidade pelas
                    informações acima assinaladas.</p>
            </div>
            <br>
            <div class="formulario-linha">
                <button class="formulario-botao" id="confirm-button" onclick="closePopup()">OK</button>
            </div>
        </div>

        <!-- PAGINA 3 -->
        <div id="form-principal">
            <div id="pagina-3" class="pagina hidden">
                <div class="container" style="text-align: center;">
                    <h2>Formulário enviado com sucesso!</h2>
                    <p>Obrigado por se inscrever no acampamento.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>