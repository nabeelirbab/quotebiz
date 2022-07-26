const app = require('express')();
const cors = require('cors');
const sslConfig = require('./ssl-config');

keysOpt = {
    key: sslConfig.keySSL,
    cert: sslConfig.crtSSL,
  };

const server = require('https').Server(keysOpt, app);

const io = require('socket.io')(server, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"],
        transports: ['websocket', 'polling'],
        credentials: true
    },
    allowEIO3: true
});
const port = 3000;
server.listen(port, () => {
  // eslint-disable-next-line no-console
  console.info('listening on %d', port);
});

io.on('connection', (socket) => {
  // console.log(socket.rooms,'ss');
  socket.on('register',(id) =>{
    socket.join(id);
  });
  console.log('a user connected');
  socket.on('disconnect', () => {
    console.log('user disconnected');
  });

  socket.on('sendMsg', (data) => {
		io.to(data.receiver_id+"").emit('receiveMsg', data);
	});

  socket.on('deleteMsg', (data) => {
    console.log(data);
    io.to(data.receiver_id+"").emit('receiveDeleteMsg', data);
  });

  socket.on('updateMsg', (data) => {
    console.log(data);
    io.to(data.receiver_id+"").emit('receiveUpdateMsg', data);
  });

  socket.on('readMsg', (data) => {
    console.log(data);
    io.to(data.id+"").emit('receiveReadMsg', data);
  });

});

