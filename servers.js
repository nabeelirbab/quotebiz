const app = require('express')();
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
  cors: {
    origins: ['http://*.quotebiz.local:8000']
  }
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

http.listen(3000, () => {
  console.log('listening on *:3000');
});