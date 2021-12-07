import React, { useState } from 'react';
import QRCodeCanvas from './QRCodeCanvas'
import QRCodeImage from './QRCodeImage'

import "./styles.css";

export default function App() {

  const [url, setUrl] = useState();
  const [options, setOptions] = useState();
  const [optionsForImageType, setOptionsForImageType] = useState();

  function generateQRCode(){
    let website = document.getElementById("website").value;
    console.log(website)
    if (website) {
    
      setUrl(website)

      setOptions({
        level: 'H',
        margin: 10,
        scale: 8,
        width: 256,
        color: {
          dark: '#5868bfff',
          light: '#ffffffff',
        }
      });

      setOptionsForImageType({
        type: "image/png",
        quality: 1,
        level: 'H',
        margin: 10,
        scale: 8,
        width: 256,
        color: {
          dark: '#5868bfff',
          light: '#ffffffff',
        }
      });

      document.getElementById("qrcode-container").style.display = "block";
    

    }
    else{
      alert("Please enter a valid URL");
    }
  }

  return (
    <div className="App">
      <div className="form">
      <h1>QR Code using react-qrcodes</h1>
        <input type="url" id="website" name="website" 
               placeholder="https://webisora.com" required />
        <button type="button" onClick={generateQRCode}>
          Generate QR Code
        </button>

      <div id="qrcode-container">
        <hr/>
        {url ? 
        <>
          <h4>Canvas</h4>
          <QRCodeCanvas url = {url} />
        </>
        : null 
        }
        {url && options ?
          <>
            <h4>Canvas with some styles</h4>
            <QRCodeCanvas url = {url} options={options}/>
          </>
          : null
        }
        <hr/>
        {url ? 
        <>
          <h4>Image</h4>
          <QRCodeImage url = {url} />
        </>
        : null 
        }
        {url && optionsForImageType ?
          <>
            <h4>Image with some styles</h4>
            <QRCodeImage url = {url} options={optionsForImageType}/>
          </>
          : null
        }
      </div>
    </div>
    </div>
  );
}
