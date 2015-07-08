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

    session_start();
    
    if(!isset($_SESSION["usuario1"])) {
      echo "Erro";
      exit(1);
    }
    
    echo "Olá ".$_SESSION["usuario1"].
         ", seu último acesso foi em ".$_COOKIE["ultimoacesso"]."<BR><BR>";
         
    
  ?>   
  
  <?php

if(isset($_REQUEST['logout']) && $_REQUEST['logout'] == true ){
    session_destroy();
    header("Location:inicio.php");
}

?>
  
   <FORM method=POST name='logout' action="?logout=true" >
  <INPUT type="submit" name="Logout" value="Logout" id="Logout" >
  <INPUT type="button" name="Criar Rota" value ="Criar Rota" onclick='javascript:location.href="index.html"'>
  
  </FORM>
                           
  </body>
  
  
</html>
<?php
ob_flush();
?>