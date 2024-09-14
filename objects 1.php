<?php

require_once "conexaopdo.php";

// Classes

class Tutor{
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

    public function __construct($nome, $sobrenome, $numCPF, $numRg, $tipo, $tel1, $tel2, $tel3, $email1, $email2){  //contrutor de objeto do tipo Tutor
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

    public function addTutor(){         //Retorna o id do tutor
        if(!isset($this->numCPF)){  //verifica se o valor do cpf foi informado
            echo 'Erro ao enviar dados à operação';

        }elseif(trim($this->numCPF) == ''){ //verifica se o valor do cpf sem espaço não é uma string vazia
            echo 'Os campos devem ser preenchidos com ao menos um caractere';

        }else{
            try{        
                $select = "SELECT * FROM tutor WHERE tutorCPF = :cpf";  //verifica se o tutor já foi cadastrado antes
                $comp = $banco->prepare($select);
                $comp->execute(array(":cpf" => $this->numCPF));
                $result = $comp->fetch(PDO::FETCH_ASSOC); //retorna falso se o tutor ainda não está no banco

                if($result){
                    echo 'Tutor já incluído no banco';

                }else{
                    $insert = 'INSERT INTO tutor (tutorCPF, tutorNome, tutorSobrenome, tutorRG, tutorEmail1, tutorEmail2, tutorTel1, tutorTel2, tutorTel3) VALUES (:cpf, :nome, :sobrenome, :rg, :email1, :email2, :tel1, :tel2, :tel3)';
                    $comando = $banco->prepare($insert);
                    $comando->execute(array(        //substitui o valor das variaveis SQL
                        ":cpf" => $this->numCPF,
                        ":nome" => $this->nome,
                        ":sobrenome" => $this->sobrenome,
                        ":rg" => $this->numRG,
                        ":email1" => $this->email1,
                        ":email2" => $this->email2,
                        ":tel1" => $this->tel1,
                        ":tel2" => $this->tel2,
                        ":tel3" => $this->tel3
                    ));
            
                    echo 'Novo tutor inserido!!';
                    
                    $sql = "SELECT * FROM tutor WHERE tutorCPF = :cpf";
                    $comp = $banco->prepare($sql);
                    $comp->execute(array(":cpf" => $this->numCPF));
                    
                    return $this->numCPF;   //retorna a chave primaria do tutor
                }
            }catch (PDOException $e){
                echo 'Falha na inserção!! ' . $e->getMessage();
            }
        }
    }
    
    public function updateTutor($nome, $sobrenome, $numRg, $tipo, $tel1, $tel2, $tel3, $email1, $email2){  //atualiza os dados do tutor
        if(trim($this->email2) == ''){
            $this->email2 = null;
        }

        if(trim($this->tel2) == ''){
            $this->tel2 = null;
        }

        if(trim($this->tel3) == ''){
            $this->tel3 = null;
        }

        if(!isset($this->numCPF)){
            echo 'Chave primária não informada';

        }elseif(trim($this->numCPF) == ''){
            echo 'Chave primaria em branco';

        }else{
            try{        
                $update = 'UPDATE tutor SET tutorNome = :nome, tutorSobrenome = :sobrenome, tutorRg = :rg, tutorEmail1 = :email1, tutorEmail2 = :email2, tutorTel1 = :tel1, tutorTel2 = :tel2, tutorTel3 = :tel3 WHERE tutorCPF = :cpf';
                $comando = $banco->prepare($update);
                $comando->execute(array(
                    ":cpf" => $this->numCPF,
                    ":nome" => $this->nome,
                    ":sobrenome" => $this->sobrenome,
                    ":rg" => $this->numRG,
                    ":email1" => $this->email1,
                    ":email2" => $this->email2,
                    ":tel1" => $this->tel1,
                    ":tel2" => $this->tel2,
                    ":tel3" => $this->tel3
                ));

                echo 'Tutor atualizado com sucesso!!';

            }catch (PDOException $e){
                echo 'Falha na atualização!! ' . $e->getMessage();
            }
        }

    }
}

class Campista{
    public $id;
    public $nome;
    public $sobrenome;
    public $numRg;
    public $dataNasci;
    public $idade;
    public $sexo;
    public $tamCamiseta;
    public $tipoSangue;

    //Endereço

    public $cep;
    public $rua;
    public $casaNum;
    public $bairro;
    public $cidade;
    public $uf;

    public function __construct($nome, $sobrenome, $numRg, $dataNasci, $idade, $sexo, $tamCamiseta, $tipoSangue, $cep, $rua, $casaNum, $bairro, $cidade, $uf){
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->numRg = $numRg;
        $this->dataNasci = $dataNasci;
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->tamCamiseta = $tamCamiseta;
        $this->tipoSangue = $tipoSangue;

        //Endereço
        
        $this->cep = $cep;
        $this->rua = $rua;
        $this->casaNum = $casaNum;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
    }

    public function addCamp(){  //Retorna/define o id do campista automaticamente
        if(!isset($this->numRg) || !isset($this->nome) || !isset($this->sobrenome)){
            echo 'Erro ao enviar dados à operação';

        }elseif(trim($this->numRg) == '' || trim($this->nome) == '' || trim($this->sobrenome) == ''){
            echo 'Os campos devem ser preenchidos com ao menos um caractere';

        }else{
            try{
                $select = "SELECT * FROM campista WHERE campRG = :rg AND campNome = :nome AND campSobrenome = :sobrenome";
                $comp = $banco->prepare($select);
                $comp->execute(array(":rg" => $this->numRg, ":nome" => $this->nome, ":sobrenome" => $this->sobrenome));
                $result = $comp->fetch(PDO::FETCH_ASSOC);
        
                if($result){
                    echo 'Campista já incluído no banco';

                    $this->id = $result["campId"];

                }else{
                    $insert = 'INSERT INTO campista (campNome, campSobrenome, campRG, campDataNasci, campIdade, campSexo, campCamiseta, campSangue, campCEP, campRua, campCasa, campBairro, campCidade, campUF) VALUES (:nome, :sobrenome, :numRg, :dataNasci, :idade, :sexo, :camiseta, :sangue, :cep, :rua, :casa, :bairro, :cidade, :uf)';
                    $comando = $banco->prepare($insert);
                    $comando->execute(array(
                        ":nome" => $this->nome, 
                        ":sobrenome" => $this->sobrenome, 
                        ":numRg" => $this->numRg, 
                        ":dataNasci" => $this->dataNasci, 
                        ":idade" => $this->idade,
                        ":sexo" => $this->sexo,
                        ":sangue" => $this->tipoSangue,
                        ":camiseta" => $this->tamCamiseta,
                        ":cep" => $this->cep = $cep,
                        ":rua" => $this->rua = $rua,
                        ":casa" => $this->casaNum = $casaNum,
                        ":bairro" => $this->bairro = $bairro,
                        ":cidade" => $this->cidade = $cidade,
                        ":uf" => $this->uf = $uf
                    ));
                    
                    echo 'Novo campista inserido!!';
                    
                    $sql = "SELECT * FROM campista WHERE campId = :id";
                    $comp = $banco->prepare($sql);
                    $this->id = $banco->lastInsertId();
                    $comp->execute(array(":id" => $this->id));
                }

                return $this->id;
        
            }catch (PDOException $e){
                echo 'Falha na inserção!! ' . $e->getMessage();
            }
        }
    }

    public function updateCamp($nome, $sobrenome, $numRg, $dataNasci, $idade, $sexo, $tamCamiseta, $tipoSangue, $doencas, $vacinas, $cep, $rua, $casaNum, $bairro, $cidade, $uf){
        try{       
            $update = 'UPDATE campista SET campNome = :nome, campSobrenome = :sobrenome, campRG = :numRg, campIdade = :idade, campSexo = :sexo, campCamiseta = :camiseta, campCEP = :cep, campRua = :rue, campCasa = :casa, campBairro = :bairro, campCidade = :cidade, campUF = :uf WHERE campId = :id';
            $comando = $banco->prepare($update);
            $comando->execute(array(
                ":id" => $this->id,
                ":nome" => $this->nome, 
                ":sobrenome" => $this->sobrenome, 
                ":numRg" => $this->numRg, 
                ":idade" => $this->idade,
                ":sexo" => $this->sexo,
                ":camiseta" => $this->tamCamiseta,
                ":cep" => $this->cep = $cep,
                ":rua" => $this->rua = $rua,
                ":casa" => $this->casaNum = $casaNum,
                ":bairro" => $this->bairro = $bairro,
                ":cidade" => $this->cidade = $cidade,
                ":uf" => $this->uf = $uf
            ));

            echo 'Campista atualizado com sucesso!!';
            
        }catch (PDOException $e){
            echo 'Falha na atualização!! ' . $e->getMessage();
        }
    }

    public function deleteCamp(){
        try{
            $sql = "DELETE FROM campista WHERE campId = $this->id";
            $consulta = $banco->query($sql);
            
            echo 'Ok';
        }catch (PDOException $e){
            echo 'Falha ao deletar campista';
        }
    }
}

class Temporada{
    public $id;
    public $nome;
    public $dataInit;
    public $dataFim;
    public $maxParc;
    public $preco;

    public function __construct($nome, $dataInit, $dataFim, $maxParc, $preco){
        $this->nome = $nome;
        $this->dataInit = $dataInit;
        $this->dataFim = $dataFim;
        $this->maxParc = $maxParc;
        $this->preco = $preco;
    }

    public function addTemp(){  //Retorna/define o id da temporada automaticamente
        if(!isset($this->nome) || !isset($this->dataInit) || !isset($this->dataFim) || !isset($this->maxParc) || !isset($this->preco)){
            echo 'Erro ao enviar dados à operação';

        }elseif(trim($this->nome) == '' || trim($this->dataInit) == '' || trim($this->dataFim) == '' || trim($this->maxParc) == '' || trim($this->preco) == ''){
            echo 'Os campos devem ser preenchidos com ao menos um caractere';

        }else{
            try{
                $insert = 'INSERT INTO temporadas (tempNome, tempDataInicio, tempDataFim, tempMaxParcela, tempPreco) VALUES (:nome, :inicio, :fim, :maxParc, :precoInsc)';
                $comando = $banco->prepare($insert);
                $comando->execute(array(
                    ":nome" => $this->nome,
                    ":inicio" => $this->dataInit,
                    ":fim" => $this->dataFim,
                    ":maxParc" => $this->maxParc,
                    ":precoInsc" => $this->preco
                ));
        
                $diretorio = "../../../documents/";
                $arqs = scandir($diretorio);
        
                foreach ($arqs as $arq) {
                    if($arq == '.' || $arq == '..') {
                        continue;
                    }
        
                    $arquivo = $diretorio."/".$arq;
        
                    if(is_file($arquivo)){
                        unlink($arquivo);
                    }
                }
        
                echo 'Nova temporada inserida!!';

            }catch (PDOException $e){
                echo 'Falha na inserção!!';
            
            }
        
            $this->id = $banco->lastInsertId();
            return $this->id;
        }        
    }    
}

class Inscricao{
    public $id_default;  //id da inscrição INDEPENDENTE DA TEMPORADA
    public $id_temp;     //id da inscrição POR TEMPORADA
    public $tutor;
    public $camp;
    public $pagParc;    //numero de parcelas do pagamento (int)
    public $temp;
    
    public function __construct($tutor, $camp, $pagParc){
        $this->tutor = $tutor;
        $this->camp = $camp;
        $this->pagParc = $pagParc;
    }

    public function addInsc(){  //Retorna/define o id padrao da inscrição
        if(!isset($this->tutor) || !isset($this->camp) || !isset($this->pagParc)){
            echo 'Erro ao enviar dados à operação';

        }elseif(trim($this->tutor) == '' || trim($this->camp) == '' || trim($this->pagParc) == ''){
            echo 'Os campos devem ser preenchidos com ao menos um caractere';

        }else{
            try{
                $sql = "SELECT tempId FROM temporadas ORDER BY tempId DESC LIMIT 1";
                $comp = $banco->query($sql);
                $result = $comp->fetch(PDO::FETCH_ASSOC);
                $this->temp = $result["tempId"];

                $select = "SELECT * FROM inscricao WHERE insc_campId = :camp AND insc_tempId = :temp";
                $comp = $banco->prepare($select);
                $comp->execute(array(":camp" => $this->camp, ":temp" => $this->temp));
                $result = $comp->fetch(PDO::FETCH_ASSOC);
        
                if($result){
                    echo 'Campista já inscrito';

                    $this->id_default = $result["inscId"];
                    $this->id_temp = $result["inscCodigo"];

                }else{
                    $sql = "SELECT * FROM inscricao ORDER BY inscId DESC LIMIT 1";
                    $aux = $banco->query($sql);
                    $lastInsc = $aux->fetch(PDO::FETCH_ASSOC);
        
                    if($lastInsc["insc_tempId"] == $this->temp){    //verifica se a ultima inscrilção é da mesma temporada
                        $this->id_temp = $lastInsc["inscCodigo"]+1; //incrementa no código com base no anterior
                    }else{
                        $this->id_temp = 1;                         //zera a contagem de inscrições por temporada
                    }
        
                    $insert = 'INSERT INTO inscricao VALUES (default, :cont, :pagParc, CURRENT_TIMESTAMP(), :tutor, :camp, :temp)';
                    $comando = $banco->prepare($insert);
                    $comando->execute(array(
                        ":cont" => $this->id_temp,
                        ":pagParc" => $this->pagParc,
                        ":tutor" => $this->tutor,
                        ":camp" => $this->camp,
                        ":temp" => $this->temp
                    ));
            
                    echo 'Nova inscrição realizada!!';
                    
                    $this->id_default = $banco->lastInsertId();    
                }

                return $this->id_default;
        
            }catch (PDOException $e){
                echo 'Falha na inserção!! ' . $e->getMessage();
            }
        }
    }

    public function deleteInsc(){// Deleta a inscrição
        try{
            $sql = "DELETE FROM inscricao WHERE inscId = $this->id_default";
            $consulta = $banco->query($sql);
            
            echo 'Ok';
        }catch (PDOException $e){
            echo 'Falha ao deletar inscrição';
        }
    }
}

class RegistroMedico{
    public $id; //id do registro médico
    public $doencasSis;    //array com todas as doenças sistemicas que o paciente ja teve
    public $doencasCron;    //array com todas as doenças cronicas que o paciente tem
    public $vacinas;    //array com todas as vascinas que o paciente ja tomou
    public $medicamentos;    //array com todos os medicamentos que paciente toma
    
    public $id_camp;    //id do campista

    //Informações do convênio

    public $id_conv;    //id do convenio
    public $numConv;    //numeração de identificação do convênio
    public $nomeConv;   
    public $telConv;    //telefone do convenio

    public function __construct($doencasSis, $doencasCron, $vacinas, $medicamentos, $id_camp){
        $this->doencasSis = $doencasSis;
        $this->doencasCron = $doencasCron;
        $this->vacinas = $vacinas;
        $this->medicamentos = $medicamentos;
        $this->id_camp = $id_camp;
    }

    public function addRegMedico(){ //retorna/define o id do registro médico
        //(não tem nada aqui porque depende de como vcs vão estruturar o banco pro histórico médico)
    }

    public function addConv($nomeC, $numC, $telC){      //Retorna/define o id do convenio  
        if(!isset($nomeC) || !isset($numC) || !isset($telC)){
            echo 'Erro ao enviar dados à operação';

        }elseif(trim($nomeC) == '' || trim($numC) == '' || trim($telC) == ''){
            echo 'Os campos devem ser preenchidos com ao menos um caractere';

        }else{
            try{
                $select = "SELECT * FROM convenio WHERE convNum = :num AND convNome = :nome AND conv_campId = :id_camp";    // verifica se o convenio já está registrado
                $comp = $banco->prepare($select);      
                $comp->execute(array(":num" => $numC, ":nome" => $nomeC, ":id_camp" => $this->id_camp));                    

                $result = $comp->fetch(PDO::FETCH_ASSOC);

                if($result){
                    echo 'Convenio já incluído no banco';
                    $this->id_conv = $result["convId"];
                    $this->telConv = $result["convTel"];

                }else{
                    $insert = 'INSERT INTO convenio VALUES (default, :nome, :num, :tel, :obs, :id_camp)';
                    $comando = $banco->prepare($insert);
                    $comando->execute(array(":nome" => $nomeC, ":num" => $numC, ":tel" => $telC, ":obs" => $dados["obs"], ":id_camp" => $this->id_camp));

                    $this->id_conv = $banco->lastInsertId();
                    echo 'Novo convenio inserido com sucesso!!';
                    
                    $this->telConv = $telC;
                }

                $this->numConv = $numC;
                $this->nomeConv = $nomeC;

                return $this->id_conv;
                
            }catch(PDOException $e){
                echo 'Falha na inserção!!';
            }

        }
    }
}