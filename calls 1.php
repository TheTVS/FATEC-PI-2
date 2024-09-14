<?php

require_once "conexaopdo.php";

function selectAllCamps($camp_id, $ord){   
    try{
        if(isset($ord)){
            if(isset($camp_id)){
                $sql = "SELECT * FROM campista WHERE campId = :id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $camp_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM campista ORDER BY $ord";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }

        }else{
            if(isset($camp_id)){
                $sql = "SELECT * FROM campista WHERE campId = :id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $camp_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM campista";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            
        }
        
        echo 'Ok';

    }catch (PDOException $e){
        echo  'Falha ao listar campistas';
    }    
}

function selectAllTutors($tutor_id, $ord){
    try{
        if(isset($ord)){
            if(isset($tutor_id)){
                $sql = "SELECT * FROM tutor WHERE tutorCPF = :id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $tutor_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM tutor ORDER BY $ord";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }

        }else{
            if(isset($tutor_id)){
                $sql = "SELECT * FROM tutor WHERE tutorCPF = :id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $tutor_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM tutor";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            
        }

        echo 'Ok';

    }catch (PDOException $e){
        echo 'Falha ao listar responsáveis';
    }    
}

function selectAllInscs($temp_id, $ord){
    try{ 
        if(isset($ord)){
            if(isset($temp_id)){
                $sql = "SELECT * FROM inscricao WHERE inscId = :id AND insc_tempId = $temp_id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $temp_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM inscricao ORDER BY $ord";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }

        }else{
            if(isset($temp_id)){
                $sql = "SELECT * FROM inscricao WHERE inscId = :id AND insc_tempId = $temp_id";
                $consulta = $banco->prepare($sql);
                $consulta->execute(array(":id" => $temp_id));

                $result = $consulta->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql = "SELECT * FROM inscricao WHERE insc_tempId = $temp_id";
                $consulta = $banco->query($sql);

                $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
            }
            
        }

        echo 'Ok';

    }catch(PDOException $e){
        echo 'Falha ao lista inscrições';
    }    

}

function selectLastTempId(){    
    try{
        $sql = "SELECT * FROM temporadas ORDER BY tempId DESC LIMIT 1";
        $comp = $banco->query($sql);
        $result = $comp->fetch(PDO::FETCH_ASSOC);

        return $result["tempId"];

    }catch (PDOException $e){
        $codigo_retorno = 400;
        $mensagem_operacao = 'Falha ao acessar o banco!! Erro: ' . $e->getMessage();
    }

}
?>