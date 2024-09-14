<?php

require_once "../../../vendor/autoload.php";
require_once "../../database/conexao.php";
require_once "../../../PHPMailer/src/PHPMailer.php";
require_once "../../../PHPMailer/src/Exception.php";
require_once "../../../PHPMailer/src/SMTP.php";


header('Content-type: application/pdf');

use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$options = new Options();
$options->setChroot(__DIR__);
$options->setIsRemoteEnabled(true);

$codigo_retorno = 0;
$mensagem_operacao = '';

// Classes

class Tutor {
    public $nome;
    public $sobrenome;
    public $numCPF;
    public $numRg;
    public $tipo;
    
    public $tel1;
    public $tel2;
    public $tel3;

    public $email1;
    public $email2;

    public function __construct($nome, $sobrenome, $numCPF, $numRg, $tipo, $tel1, $tel2, $tel3, $email1, $email2) {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->numCPF = $numCPF;
        $this->numRg = $numRg;
        $this->tipo = $tipo;

        $this->tel1 = $tel1;
        $this->tel2 = $tel2;
        $this->tel3 = $tel3;

        $this->email1 = $email1;
        $this->email2 = $email2;
    }
}

class Campista {
    public $nome;
    public $sobrenome;
    public $numRg;
    public $dataNasci;
    public $idade;
    public $sexo;
    public $tamCamiseta;

    public $tipoSangue;
    public $doencas;
    public $vacinas;

    public function __construct($nome, $sobrenome, $numRg, $dataNasci, $idade, $sexo, $tamCamiseta, $tipoSangue, $doencas, $vacinas) {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->numRg = $numRg;
        $this->dataNasci = $dataNasci;
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->tamCamiseta = $tamCamiseta;
        
        $this->tipoSangue = $tipoSangue;
        $this->doencas = $doencas;
        $this->vacinas = $vacinas;
    }
}
        
class Endereco {
    public $cep;
    public $rua;
    public $casaNum;
    public $bairro;
    public $cidade;
    public $uf;

    public function __construct($cep, $rua, $casaNum, $bairro, $cidade, $uf) {
        $this->cep = $cep;
        $this->rua = $rua;
        $this->casaNum = $casaNum;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
    }
}

class Inscricao {
    public $temporada;
    public $pagamento;
    public $dataInit;
    public $dataFim;
    
    public function __construct($temporada, $pagamento, $dataInit, $dataFim) {
        $this->temporada = $temporada;
        $this->pagamento = $pagamento;
        $this->dataInit = $dataInit;
        $this->dataFim = $dataFim;
    }
}
        
// Objetos

$tutor = new Tutor(
    $_POST['res-nom'], 
    $_POST['res-sob'], 
    $_POST['res-cpf'], 
    $_POST['res-rg'], 
    $_POST['res-tipo'], 
    $_POST['res-tel-1'], 
    $_POST['res-tel-2'], 
    $_POST['res-tel-3'], 
    $_POST['res-eml-1'], 
    $_POST['res-eml-2']
);

$camp = new Campista(
    $_POST['cri-nom'], 
    $_POST['cri-sob'], 
    $_POST['cri-rg'], 
    $_POST['cri-dtn'], 
    $_POST['cri-idd'], 
    $_POST['cri-sex'], 
    $_POST['cri-tam'], 
    $_POST['cri-sangue'],
    "",
    ""
);


$res = new Endereco(
    $_POST['end-cep'], 
    $_POST['end-rua'], 
    $_POST['end-num'], 
    $_POST['end-bai'], 
    $_POST['end-cid'], 
    $_POST['end-uf']
);


// $sql = "INSERT INTO tutor (tutorCPF, tutorNome, tutorSobrenome, tutorRG, tutorEmail1, tutorEmail2, tutorTel1, tutorTel2, tutorTel3) VALUES ('$tutor->numCPF','$tutor->nome','$tutor->sobrenome','$tutor->numRG','$tutor->email1','$tutor->email2','$tutor->tel1','$tutor->tel2','$tutor->tel3');
// INSERT INTO endereco (resNum, resBairro, resRua, resCEP, resCidade, resUF) VALUES ('$res->casaNum', '$res->bairro', '$res->rua', '$res->cep', '$res->cidade', '$res->uf');
// INSERT INTO campista (campNome, campSobrenome, campRG, campDataNasci, campIdade, campSexo, campCamiseta, campSangue, campMedLib, camp_resId) VALUES ();
// INSERT INTO tutor_campista (tc_campId, tc_tutorCPF) VALUES (1, '12345678901');
// INSERT INTO inscricao (inscCodigo, inscData, inscPagamento, insc_tutorCPF, insc_campId, insc_tempId) VALUES ();"
// $salvar = mysqli_query($conexao,$sql);
// mysqli_close($conexao);

// Configuração do PDF

try {
    // Conexão e consulta SQL
    $sql = "SELECT * FROM temporadas ORDER BY tempId DESC LIMIT 1";
    $comando = $banco->prepare($sql);
    $comando->execute();
    $result = $comando->fetch(PDO::FETCH_ASSOC);

    $inscricao = new Inscricao(
        $result["tempNome"], 
        $_POST["preco"], 
        $result["tempDataInicio"], 
        $result["tempDataFim"]
    );

} catch(PDOException $e) {
    $codigo_retorno = 400;
    $mensagem_operacao = 'Falha na inserção!';
    echo json_encode(["codigo" => $codigo_retorno, "mensagem" => $mensagem_operacao]);
    exit();
}

$pdf = new Dompdf($options);
$pdf->setPaper('A4', 'portrait');

$html = file_get_contents(__DIR__ . '/contrato.html');
$html = str_replace(
    [
        "{{ tutorNome }}",
        "{{ tutorRg }}",
        "{{ campistaNome }}",
        "{{ campistaRg }}",
        "{{ campistaIdade }}",
        "{{ campistaDataNasci }}",
        "{{ residLogradouro }}",
        "{{ residCasa }}",
        "{{ residBairro }}",
        "{{ residCep }}",
        "{{ residCidade }}",
        "{{ residUf }}",
        "{{ periodo }}",
        "{{ tutorCPF }}",
        "{{ tel1 }}",
        "{{ tel2 }}",
        "{{ email1 }}"
    ], [
        $tutor->nome.' '.$tutor->sobrenome,
        $tutor->numRg,
        $camp->nome.' '.$camp->sobrenome,
        $camp->numRg,
        $camp->idade,
        $camp->dataNasci,
        $res->rua,
        $res->casaNum,
        $res->bairro,
        $res->cep,
        $res->cidade,
        $res->uf,
        $inscricao->temporada,
        $tutor->numCPF,
        $tutor->tel1,
        $tutor->tel2,
        $tutor->email1
    ],
    $html
);


$pdf->loadHtml($html);
$pdf->render();

// Salvando o PDF temporariamente
$arquivo = $pdf->output();
$caminho = "../../documents/".$tutor->numCPF."_".$camp->numRg.".pdf";

file_put_contents($caminho, $arquivo);
echo $arquivo;
/*
// Configuração do email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';//smtp-mail.outlook.com
    $mail->SMTPAuth = true;
    $mail->Username = 'lrasoppi11@gmail.com';
    $mail->Password = 'jogos11.';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('lrasoppi11@gmail.com', 'Acampamento de Férias - RP Eventos');
    $mail->addAddress($tutor->email1, $tutor->nome);
    $mail->Subject = 'Contrato de Inscrição - Acampamento de Férias';
    $mail->Body = "Prezado(a) {$tutor->nome}, \n\nEnviamos em anexo o contrato de inscrição para o Acampamento de Férias. \n\nAtenciosamente, \nRP Eventos";

    $mail->addAttachment($caminho, 'Contrato_Inscricao.pdf');

    $mail->send();

    echo $arquivo;

} catch (Exception $e) {
    echo "Erro ao enviar o email: {$mail->ErrorInfo}";
}*/
?>