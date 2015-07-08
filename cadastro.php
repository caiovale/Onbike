  <?php
  
  $erro = null;
  $valido = false;
  
  if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true) {
  
  	// Atenção para o uso de caixa alta e caixa baixa nos nomes das variáveis
  
  	if(strlen($_POST["nome"]) < 5) {
  		$erro = "Preencha o campo nome corretamente";
  	}
  	else if(strlen($_POST["email"]) < 5) {
  		$erro = "Preencha o campo email corretamente";
  	}
  	else if(!is_numeric($_POST["idade"])) {
  		$erro = "Preencha o campo idade corretamente";
  	}
  	else if($_POST["sexo"] != "M" && $_POST["sexo"] != "F") {
  		$erro = "Preencha o campo sexo corretamente";
  	}
    else if(strlen($_POST["usuario"]) < 5) {
  		$erro = "Preencha o campo usuario corretamente";
  	}
  	
  	else {
  		$valido = true;
      
      
   
    $passwordHash = md5($_POST["senha"]);
    
      
      
    $connection = new PDO("mysql:host=localhost;dbname=ONBIKE","root", "");
    
    $stmt = $connection->prepare("INSERT INTO USUARIOS(NOME,EMAIL,IDADE,SEXO,USUARIO,SENHA) values(?, ?, ?, ?, ?,?)");
    $stmt->bindparam(1, $_POST["nome"]);
    $stmt->bindparam(2, $_POST["email"]);
    $stmt->bindparam(3, $_POST["idade"]);
    $stmt->bindparam(4, $_POST["sexo"]);
    $stmt->bindparam(5, $_POST["usuario"]);
    $stmt->bindparam(6, $passwordHash);
    
    $stmt->execute();
    
    
   
      
      
  	}
  }
  
  ?>
  
  <HTML>
    <HEAD>
    </HEAD>
    <BODY>
  
  <?php
  
  if(!$valido) {
  	if(isset($erro)) {
  		echo $erro . "<BR><BR>";
  	}
   
  
  
  
  ?>
  
  <SCRIPT language='JavaScript'>
  
  function validaFormulario() {
  
  	if(document.forms['registro'].nome.value == "") {
  		alert('Preencha corretamente o campo nome.');
  		return;
  	}
  	else if(document.forms['registro'].email.value == "") {
  		alert('Preencha corretamente o campo email.');
  		return;
  	}
  	else if(document.forms['registro'].idade.value == "" || 
  		isNaN(document.forms['registro'].idade.value)) {
  		alert('Preencha corretamente o campo idade.');
  		return;
  	}
  	else if(document.forms['registro'].senha.value == "") {
  		alert('Preencha corretamente o campo senha.');
  		return;
  	}
    else if(document.forms['registro'].usuario.value == "") {
  		alert('Preencha corretamente o campo usuario.');
  		return;
  	}
  	else
  		document.forms['registro'].submit();
  }
  
  </SCRIPT>
  
  <FORM method=POST name='registro' onSubmit='validaFormulario(); return false;' 
        action='?validar=true'>
  
  Nome: 	
    <INPUT type=TEXT name=nome
  	<?php if(isset($_POST["nome"])) { echo "value='".$_POST["nome"]."'"; } ?>
  	><BR>
  
  E-mail:	
    <INPUT type=TEXT name=email
  	<?php if(isset($_POST["email"])) { echo "value='".$_POST["email"]."'"; } ?>
  	><BR>
  
  Idade: 	
    <INPUT type=TEXT name=idade
  	<?php if(isset($_POST["idade"])) { echo "value='".$_POST["idade"]."'"; } ?>
  	><BR>
  
  Sexo: 	
    <INPUT type=RADIO name=sexo value='M'
  	<?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") { echo "checked"; } ?>
  	>Masculino
  
  	<INPUT type=RADIO name=sexo value='F'
  	<?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") { echo "checked"; } ?>
  	>Feminino<BR>  
  Usuario: 	
    <INPUT type=TEXT name=usuario
  	<?php if(isset($_POST["usuario"])) { echo "value='".$_POST["usuario"]."'"; } ?>
  	><BR>
  Senha: 	
    <INPUT type=PASSWORD name=senha><BR>
  	<INPUT type=SUBMIT value='Enviar' >
  
  </FORM>
  <?php
   }
    else {
    echo "Dados recebidos e validados com sucesso!";
   echo "<BR><a href='inicio.php'><input type=submit value=Pronto name=Pronto></a>";
   }
   
   ?>
   
      
    </BODY>
  </HTML>
