const express = require('express');
const cors = require('cors');
const app = express();

app.use(cors())

const { proxy, scriptUrl } = require('rtsp-relay')(app);

const handler = proxy({
  url: 'rtsp://admin:CAmera62@172.16.151.228/Streaming/Channels/1',
  // if your RTSP stream need credentials, include them in the URL as above
  verbose: true,
});

// the endpoint our RTSP uses
app.ws('/api/stream', handler);

// this is an example html page to view the stream
app.get('/', (req, res) =>
  res.send(`
  <canvas id='canvas'></canvas>
 <script src='${scriptUrl}'></script>
  <script>
    loadPlayer({
      url: 'ws://' + location.host + '/api/stream',
      canvas: document.getElementById('canvas')
    });
  </script>
`),
);

app.listen(2000);
