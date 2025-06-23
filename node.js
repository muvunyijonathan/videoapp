// server.js
const WebSocket = require('ws');
const wss = new WebSocket.Server({ port: 3000 });

const rooms = {};

wss.on('connection', ws => {
  ws.on('message', message => {
    const data = JSON.parse(message);
    const { type, room, payload } = data;

    if (type === 'join') {
      rooms[room] = rooms[room] || [];
      rooms[room].push(ws);

      // Notifier l'autre pair si déjà deux
      if (rooms[room].length === 2) {
        rooms[room].forEach(client => {
          if (client !== ws) {
            client.send(JSON.stringify({ type: 'ready' }));
          }
        });
      }
    }

    // Relayer les messages WebRTC à l'autre client
    if (['offer', 'answer', 'ice-candidate'].includes(type)) {
      rooms[room].forEach(client => {
        if (client !== ws) {
          client.send(JSON.stringify({ type, payload }));
        }
      });
    }
  });

  ws.on('close', () => {
    for (const room in rooms) {
      rooms[room] = rooms[room].filter(client => client !== ws);
    }
  });
});
