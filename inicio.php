<?php

ob_start();

?>
<html>  
  
  <head>
  <BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
  <center><h1>ONBIKE</h1></center>
  
  </head>
  
  <body>
        
      <?php
    if(isset($_REQUEST["autenticar"]) && $_REQUEST["autenticar"] == true) {
    
      $hashDaSenha = md5($_POST["senha"]);
      
      try
		  {
		    $connection = new PDO("mysql:host=localhost;dbname=onbike", "root", "");
      }
      catch(PDOException $e)
      {
        echo "Falha: " . $e->getMessage();
        exit();
      }

      $rs = $connection->prepare("SELECT NOME FROM USUARIOS WHERE USUARIO = ? AND SENHA = ?");                           
    
      $rs->bindParam(1, $_POST["usuario"]);
      $rs->bindParam(2, $hashDaSenha);

      if($rs->execute())
      {
        if($registro = $rs->fetch(PDO::FETCH_OBJ))
        {
        
          setcookie("ultimoacesso", date("d/m/Y"), time() + 30*24*60*60);
        
          session_start();
          $_SESSION["usuario1"] = $registro->NOME;
        
          header("location: home.php");
        
        }      
        else 
        {
          echo "Usuário ou senha incorreto.";
        }
      }
    }
    
    ?>
        
        
        
          <FORM method=POST name='registro' action='?autenticar=true' >
    		<center><input type="text" placeholder="usuario" id="usuario" name="usuario"><br>
				<input type="password" placeholder="senha" id="senha" name="senha"><br>
				<input type="submit" value="login" id="login" name="login">
				<input type="button" onclick='javascript:location.href="cadastro.php"' value="Cadastre-se" name="Cadastro"></center><br>
		
    

    
    
    
  </body>
  
  
</html>
<?php

ob_flush();

?>