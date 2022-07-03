<?php
    session_start()
    include(config.php);
    
    if(isset($_SESSION) == false){
        header('Location:'DIR_PATH.'/login/loginFunc.php');
    }
    $nomeUsuario = $_SESSION['userName'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste do Chat</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="chat">
        
        <div class="menssage">
            <input type="text" name="username" placeholder="Digite seu usuário">    
        </div>
        
        <div id="divChat">
            <input type="text" name="menssage" id="inputtexto" placeholder="Digite sua menssagem">
            <button type="submit" id="botaoChat">Enviar</button>
        </div>

    </form>
<script type="text/javascript">

    var socket = io('http://localhost:3000');

    function renderMenssage(menssage){
        $('.menssage').append('<div class="menssages"> <div class="nomeTexto"><div class="nick"><strong>'+menssage.autor+'</strong></div>'+menssage.menssage+'</div></div>');
    }

    socket.on('previousMenssage', function(menssages){
        for(menssage of menssages){
            renderMenssage(menssage)
        }
    })


    socket.on('receiveMenssage', function(menssage){
        renderMenssage(menssage);
    });
  
    $('#chat').submit(function(event){
        event.preventDefault();

        var autor = $('input[name=username]').val();
        var menssage = $('input[name=menssage]').val();

        if(autor.length && menssage.length){
            var menssageObject = {
                autor: autor,
                menssage: menssage,
            };

            renderMenssage(menssageObject);

            socket.emit('sendMenssage', menssageObject);


        }
    });

</script>


</body>
</html>