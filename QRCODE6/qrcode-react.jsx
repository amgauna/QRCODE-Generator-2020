import React from 'react';
import { useQRCode } from 'react-qrcodes';

function App() {
  const [qrRef] = useQRCode({
    text: 'https://webisora.com',
    options: {
      level: 'H',
      margin: 10,
      scale: 8,
      width: 256,
      color: {
        dark: '#5868bfff',
        light: '#ffffffff',
      },
    },
  });
  
  return <canvas ref={qrRef} />;
};

export default App;
