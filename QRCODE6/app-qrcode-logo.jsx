import React, { useState } from 'react';
import QRCode from './QRCode'

import "./styles.css";

export default function App() {

  const [url, setUrl] = useState();
  const [options, setOptions] = useState();

  function generateQRCode(){
    let website = document.getElementById("website").value;
    console.log(website)
    if (website) {
    
      setOptions({
        ecLevel: 'M', //The error correction level of the QR Code
        enableCORS: false, //Enable crossorigin attribute
        size: 250, //The size of the QR Code
        quietZone: 10, //The size of the quiet zone around the QR Code. This will have the same color as QR Code bgColor
        bgColor: "#FFFFFF", //Background color
        fgColor: "#ebb434", //Foreground color
        logoImage: "https://webisora.com/wp-content/uploads/2017/09/WebisoraLogo_B.png", //The logo image. It can be a url/path or a base64 value
        logoWidth: 180,
        logoHeight: 40,
        logoOpacity: 1,
        qrStyle: "squares" //Style of the QR Code modules - dots or squares
      });
      setUrl(website)
      
      document.getElementById("qrcode-container").style.display = "block";
    

    }
    else{
      alert("Please enter a valid URL");
    }
  }

  return (
    <div className="App">
      <div className="form">
      <h1>QR Code using react-qrcode-logo</h1>
        <input type="url" id="website" name="website" 
               placeholder="https://webisora.com" required />
        <button type="button" onClick={generateQRCode}>
          Generate QR Code
        </button>

      <div id="qrcode-container">
        <hr/>
        {url ? 
        <>
          <QRCode url = {url} options={options}/>
        </>
        : null 
        }
        
      </div>
    </div>
    </div>
  );
}
