<?php
	session_start();
	
error_reporting(E_ALL ^ E_NOTICE);
	$nome = $_SESSION['userName'];



?>
<html>

<!-- Head -->
<head> 
	<meta charset="utf-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Chat - PHP</title>
	<link rel="icon" href="../img/icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


	<link rel="stylesheet" type="text/css" href="../css/estilo.css"/>
	
</head> 
<!-- Final do Head -->
	<!-- Inicio do body -->
<body>
				

				
			
					<div class="fundo col s12">

							<div class="chat" id="chat">
									
							</div>

						<!-- Formulário de envios das mensagens -->
						<div id="texto">

						<div class="formulariomsg centered" action="index.php" method="POST">
								<textarea name="mensagem" id='msg' class="mensagem" placeholder="Digite sua mensagem aqui."></textarea>
								<input type="button" class="botaoEnviar" Value="Enviar" id="btnEnviar">
						</div>
					</div>

						</div>
					
				<!-- Final do col-md-7 -->

	
			<!-- Final da row -->
		
	
		<!-- Final do container -->
		
	</body>
	<!-- Final do body -->

	<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<!-- /jQuery -->

	<script type="text/javascript">
		
		/*
		#########
			função responsável por abaixar a barra de rolagem do chat
		#########
		*/
		function abaixarbarra(){
			var div = document.getElementById('chat');
			div.scrollTo(0, 1000);
		}

		/*
		#########
			função ajax responsável por 
			renderizar em tempo real as
			ultimas mensagens enviadas no chat
		#########
		*/
		function ajax(){
						var req = new XMLHttpRequest();
						req.onreadystatechange = function(){
							if (req.readyState == 4 && req.status == 200) {
									document.getElementById('chat').innerHTML = req.responseText;
							}
				}
			req.open('GET', '../src/php/chat.php', true);
			req.send();

		}


		/*
		#########
			Utilidade responsável por
			executar a função Ajax toda vez
			que a página for carregada
		#########
		*/
		window.onload = (event) => {
			ajax();
		};

		$(function(){

			$('#btnEnviar').click(function(){
				
				if($('#msg').val() === ''){

					
				}else{
					var data = {
					mensagem: $('#msg').val()

					}

					$.post('http://localhost/TGE/chat/src/index.php', data);	

					$('#msg').val('');
				}
				
			});

		});


		//função que determina o tempo em que o chat será atualizado(1000 = 1 segundo)
		setInterval(function(){ajax();}, 1000);
</script>

		<?php
			require_once('./php/chat-conexao.php');

			$mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

			if($mensagem == ''){
				return false;
			}else{
			
			$sql = $pdo->prepare('INSERT INTO mensagens (nome, mensagem) VALUES (:nameParam, :msgParam)');

			$nomes = htmlspecialchars($nome);
			$mensagem = htmlspecialchars($mensagem);

			$sql->bindParam(':nameParam', $nomes);
			$sql->bindParam(':msgParam', $mensagem);
			$sql->execute();
			
}
?>


	
	







</html>