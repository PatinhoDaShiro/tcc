const { Socket } = require('dgram');
const express = require('express');
const path = require('path');

const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server);

app.use(express.static(path.join(__dirname, 'public')));
app.set('views', path.join(__dirname, 'public'));
app.engine('php', require('ejs').renderFile);
app.set('view engine', 'php');

app.use('/', (req, res)=>{
    res.render('index.php');
});

let menssages = [];



io.on('connection', Socket=>{
    console.log(`Socket connectado: ${Socket.id}`);

    Socket.emit('previousMenssage', menssages);

    Socket.on('sendMenssage', data=>{
        menssages.push(data);
        Socket.broadcast.emit('receiveMenssage', data);
    });
});


server.listen(3000);