<nav  id="logo" >
      <div  id="nav">
          <img id="logoimg" src="<?php echo URL_BASE?>/imagens/logo.png" alt="" width="116" height="70" >
          <div id="perfil_link">
          <img  src="<?php echo URL_BASE?>/imagens/icon.png" alt="" width="40" height="40" id="icon" >
          <a href="<?php echo URL_BASE?>/login/loginFunc.php" id="nick"><?php 
          if(isset($_SESSION['userName'])){
            echo $nomeUsuario;

          }else{
            echo 'Iniciar Sessão';

          }
          ?>
          </a>
          </div>
      </div>
    </nav>
 
 
 
 
 
