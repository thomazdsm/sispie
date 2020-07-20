<?php
include_once "db.php";
//include_once "clsMail.php";
//include_once "clsLog.php";

class clsApply extends db{

  private $id;
  private $nome_completo;
  private $nome_social;
  private $dt_birth;
  private $cpf;
  private $rg;
  private $expedidor;
  private $uf;
  private $cep;
  private $endereco;
  private $cidade;
  private $estado;
  private $email;
  private $telefone;
  private $curso;
  private $campus;
  private $matricula;
  private $cr;
  private $ingresso;
  private $link_lattes;
  private $link_freire;
  private $banco;
  private $agencia;
  private $corrente;
  private $concorda;
  private $anexo_identidade;
  private $anexo_historico;
  private $dt_cad;

  function getid(){ return $this->id;}
  function setid($id){ $this->id = $id;}
  
  function getnome_completo(){ return $this->nome_completo;}
  function setnome_completo($nome_completo){ $this->nome_completo = $nome_completo;}
  
  function getnome_social(){ return $this->nome_social;}
  function setnome_social($nome_social){ $this->nome_social = $nome_social;}
  
  function getdt_birth(){ return $this->dt_birth;}
  function setdt_birth($dt_birth){ $this->dt_birth = $dt_birth;}
  
  function getcpf(){ return $this->cpf;}
  function setcpf($cpf){ $this->cpf = $cpf;}
  
  function getrg(){ return $this->rg;}
  function setrg($rg){ $this->rg = $rg;}
  
  function getexpedidor(){ return $this->expedidor;}
  function setexpedidor($expedidor){ $this->expedidor = $expedidor;}
  
  function getuf(){ return $this->uf;}
  function setuf($uf){ $this->uf = $uf;}
  
  function getcep(){ return $this->cep;}
  function setcep($cep){ $this->cep = $cep;}
  
  function getendereco(){ return $this->endereco;}
  function setendereco($endereco){ $this->endereco = $endereco;}

  function getcidade(){ return $this->cidade;}
  function setcidade($cidade){ $this->cidade = $cidade;}
  
  function getestado(){ return $this->estado;}
  function setestado($estado){ $this->estado = $estado;}
  
  function getemail(){ return $this->email;}
  function setemail($email){ $this->email = $email;}
  
  function gettelefone(){ return $this->telefone;}
  function settelefone($telefone){ $this->telefone = $telefone;}
  
  function getcurso(){ return $this->curso;}
  function setcurso($curso){ $this->curso = $curso;}
  
  function getcampus(){ return $this->campus;}
  function setcampus($campus){ $this->campus = $campus;}
  
  function getmatricula(){ return $this->matricula;}
  function setmatricula($matricula){ $this->matricula = $matricula;}
  
  function getcr(){ return $this->cr;}
  function setcr($cr){ $this->cr = $cr;}

  function getingresso(){ return $this->ingresso;}
  function setingresso($ingresso){ $this->ingresso = $ingresso;}
  
  function getlink_lattes(){ return $this->link_lattes;}
  function setlink_lattes($link_lattes){ $this->link_lattes = $link_lattes;}
  
  function getlink_freire(){ return $this->link_freire;}
  function setlink_freire($link_freire){ $this->link_freire = $link_freire;}
  
  function getbanco(){ return $this->banco;}
  function setbanco($banco){ $this->banco = $banco;}
  
  function getagencia(){ return $this->agencia;}
  function setagencia($agencia){ $this->agencia = $agencia;}
  
  function getcorrente(){ return $this->corrente;}
  function setcorrente($corrente){ $this->corrente = $corrente;}
  
  function getconcorda(){ return $this->concorda;}
  function setconcorda($concorda){ $this->concorda = $concorda;}
  
  function getanexo_identidade(){ return $this->anexo_identidade;}
  function setanexo_identidade($anexo_identidade){ $this->anexo_identidade = $anexo_identidade;}
  
  function getanexo_historico(){ return $this->anexo_historico;}
  function setanexo_historico($anexo_historico){ $this->anexo_historico = $anexo_historico;}
  
  function getdt_cad(){ return $this->dt_cad;}
  function setdt_cad($dt_cad){ $this->dt_cad = $dt_cad;}

  //INSERT NA DATABASE
  function insertRP($check_CPF){
    if($check_CPF == 'OK'){
      $objDB = new db();
      $return = '';
    
      if ($objDB->connectDB()){
        $sequencia = $objDB->getSequenceID("id","res_pedagogica");
        
        $objDB->consulta = "INSERT INTO neperge_db.res_pedagogica (`id`,
              `nome_completo`,
              `nome_social`,
              `dt_birth`,
              `cpf`,
              `rg`,
              `expedidor`,
              `uf`,
              `cep`,
              `endereco`,
              `cidade`,
              `estado`,
              `email`,
              `telefone`,
              `curso`,
              `campus`,
              `matricula`,
              `cr`,
              `ingresso`,
              `link_lattes`,
              `link_freire`,
              `banco`,
              `agencia`,
              `corrente`,
              `concorda`,
              `anexo_identidade`,
              `anexo_historico`,
              `dt_cad`)

              VALUES (".$sequencia.",
              '" . $this->nome_completo . "',
              '" . $this->nome_social . "',
              '" . $this->dt_birth . "',
              '" . $this->cpf . "',
              '" . $this->rg . "',
              '" . $this->expedidor . "',
              '" . $this->uf . "',
              '" . $this->cep . "',
              '" . $this->endereco . "',
              '" . $this->cidade . "',
              '" . $this->estado . "',
              '" . $this->email . "',
              '" . $this->telefone . "',
              '" . $this->curso . "',
              '" . $this->campus . "',
              '" . $this->matricula . "',
              '" . $this->cr . "',
              '" . $this->ingresso . "',
              '" . $this->link_lattes . "',
              '" . $this->link_freire . "',
              '" . $this->banco . "',
              '" . $this->agencia . "',
              '" . $this->corrente . "',
              '" . $this->concorda . "',
              '" . $this->anexo_identidade . "',
              '" . $this->anexo_historico . "',
              NOW());";
              $resultado = $objDB->executeSQL($objDB->consulta);
        if ($resultado) {
          //$objLog = new clsLog();
          //$objLog->setIDUsuario($_SESSION["idUsuario_CEC"]);
          //$objLog->setAcao($_SESSION["usuario_CEC"]. " - Cadastrou um Comunicado Inicial | ". trataValor($objDB->consulta));
          //$objLog->insereLog();
          echo "SUCESSO";	
          
        }else{
          echo "FALHA";
        }
        
      }else{
        echo "Nao foi possivel conectar ao banco de dados.";
      }
    }else{
      echo "FALHA (CPF j? inscrito!)";
    }
  }


  //GET NOME DA CIDADE A PARTIR DO ID
  function NomeCidade($id){        
    $objDB = new db();
    if ($objDB->connectDB()){
      $objDB->consulta = "SELECT * FROM neperge_db.cidade WHERE id = ".$id."";
      $resultado = $objDB->executeSQL($objDB->consulta);
      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
        exit();
      }else{
        while ($linha = mysql_fetch_assoc($resultado)){
          $nome = $linha['cidade'];
        }
      }
      
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
    }
    return $nome;
  }

  //GET NOME DO CAMPUS A PARTIR DO ID
  function NomeCampus($id){        
    $objDB = new db();
    if ($objDB->connectDB()){
      $objDB->consulta = "SELECT * FROM neperge_db.campus WHERE id = ".$id."";
      $resultado = $objDB->executeSQL($objDB->consulta);
      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
        exit();
      }else{
        while ($linha = mysql_fetch_assoc($resultado)){
          $nome = $linha['nome'];
        }
      }
      
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
    }
    return $nome;
  }
  
  //GET MUNICIPIO DO CAMPUS A PARTIR DO ID
  function IdMunicipioCampus($id){        
    $objDB = new db();
    if ($objDB->connectDB()){
      $objDB->consulta = "SELECT * FROM neperge_db.campus WHERE id = ".$id."";
      $resultado = $objDB->executeSQL($objDB->consulta);
      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
        exit();
      }else{
        while ($linha = mysql_fetch_assoc($resultado)){
          $id_cidade = $linha['id_cidade'];
        }
      }        
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
    }
    return $id_cidade;
  }

  //CONTAR INSCRITOS
  function CountInscritos($curso){    
    $count = 0;    
    $objDB = new db();
    if ($objDB->connectDB()){
      $objDB->consulta = "SELECT * FROM neperge_db.res_pedagogica WHERE curso = '".$curso."'";
      $resultado = $objDB->executeSQL($objDB->consulta);
      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
        exit();
      }else{
        while ($linha = mysql_fetch_assoc($resultado)){
          $count++;
        }
      }        
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
    }
    return $count;
  }

  //VERIFICA CURSO --> PROFESSOR/ADMIN
  function CheckCurso($curso,$responsavel){
    $msg = 'FAIL';
    $objDB = new db();
    if ($objDB->connectDB()){
      $objDB->consulta = "SELECT * FROM neperge_db.curso WHERE curso = '".$curso."'";
      $resultado = $objDB->executeSQL($objDB->consulta);
      if(!$resultado){
        echo "Nao foi possivel realizar a consulta ao banco de dados: " . $objDB->consulta;
        exit();
      }else{
        while ($linha = mysql_fetch_assoc($resultado)){
          if($linha['id_responsavel'] == $responsavel){
            $msg = 'OK';
          }
        }
      }        
    }else{
      echo "Nao foi possivel conectar ao banco de dados.";
    }
    return $msg;
  }


}