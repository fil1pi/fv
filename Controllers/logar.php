<?php

require_once("conexao-banco.php");






   $email =  $_POST["email"];
   $senha = $_POST["senha"];
   
 
      
   $sql = "select * from usuarios where email=? and senha=?";
   $sqlprep=$conexao->prepare($sql);
   $sqlprep->bind_param("ss",$email,$senha);
   $sqlprep->execute();
   $resultadosql = $sqlprep->get_result();
   
   $vetorUMRegistro = mysqli_fetch_assoc($resultadosql);

 

if (isset($vetorUMRegistro )) {

    session_start();
$_SESSION["id"] = $vetorUMRegistro["id"];
$_SESSION["email"] = $vetorUMRegistro["email"];
$_SESSION["nome"] = $vetorUMRegistro["nome"];

   if ($vetorUMRegistro["adm"]===1) {

    header("location: ../view/Homeadm.php");
   } else {
      
    header("location: ../view/gestao.php");
   }
} else  {
   session_start();
   $_SESSION["id"] != $vetorUMRegistro["id"];
   $_SESSION["email"] != $vetorUMRegistro["email"];
   $_SESSION["nome"] != $vetorUMRegistro["nome"];
$_SESSION["ErroLogin"] = "Erro de login ou senha.";
header("location: ../view/login.php");
}
   
?>