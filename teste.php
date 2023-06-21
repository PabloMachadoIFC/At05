<!DOCTYPE html>
<html>
<head>
  <title>Quadro</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: row;
      text-align: center;
      font-family: Arial, sans-serif;
    }

    .canvas-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-right: 20px;
    }

    #canvas {
      border: 1px solid #000;
    }

    .button-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="canvas-wrapper">
    <h1>Quadro</h1>
    <canvas id="canvas" width="800" height="400"></canvas>
    <br>
    <input type="color" id="backgroundColorPicker" value="#ffffff">
  </div>

  <div class="button-wrapper">
    <button id="brush" class="btn"><img src="assets/img/pincel.png" alt="" width="42px"></button>
    <input type="color" style="height: 35px;border: none;padding: 0;background-color: #fff;cursor: pointer;" id="colorPicker" value="#000000">
    <button id="eraser" class="btn"><img src="assets/img/borracha.png" alt="" width="42px"></button>
    <button id="increaseSize" class="btn"><img src="assets/img/sinal-de-mais.png" alt="" width="42px"></button>
    <button id="decreaseSize" class="btn"><img src="assets/img/sinal-de-menos.png" alt="" width="42px"></button>
    <button id="clear" class="btn"><img src="assets/img/limpar-limpo.png" alt="" width="42px"></button>
  </div>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    window.addEventListener('load', function () {
      var canvas = document.getElementById('canvas');
      var context = canvas.getContext('2d');
      var isDrawing = false;
      var brush = document.getElementById('brush');
      var eraser = document.getElementById('eraser');
      var increaseSize = document.getElementById('increaseSize');
      var decreaseSize = document.getElementById('decreaseSize');
      var colorPicker = document.getElementById('colorPicker');
      var backgroundColorPicker = document.getElementById('backgroundColorPicker');
      var eraserSize = 10;

      canvas.addEventListener('mousedown', startDrawing);
      canvas.addEventListener('mouseup', stopDrawing);

      brush.addEventListener('click', function () {
        context.strokeStyle = colorPicker.value;
      });

      eraser.addEventListener('click', function () {
        context.strokeStyle = '#fff';
        context.lineWidth = eraserSize;
      });

      increaseSize.addEventListener('click', function () {
        eraserSize += 5;
        context.lineWidth = eraserSize;
      });

      decreaseSize.addEventListener('click', function () {
        if (eraserSize > 5) {
          eraserSize -= 5;
          context.lineWidth = eraserSize;
        }
      });

      colorPicker.addEventListener('change', function () {
        context.strokeStyle = colorPicker.value;
     

 });

      backgroundColorPicker.addEventListener('change', function () {
        context.fillStyle = backgroundColorPicker.value;
        context.fillRect(0, 0, canvas.width, canvas.height);
      });

      document.getElementById('clear').addEventListener('click', function () {
        context.clearRect(0, 0, canvas.width, canvas.height);
      });

      function startDrawing(event) {
        isDrawing = true;
        context.beginPath();
        context.moveTo(event.pageX - canvas.offsetLeft, event.pageY - canvas.offsetTop);
        canvas.addEventListener('mousemove', draw);
      }

      function draw(event) {
        if (isDrawing) {
          context.lineTo(event.pageX - canvas.offsetLeft, event.pageY - canvas.offsetTop);
          context.stroke();
        }
      }

      function stopDrawing() {
        isDrawing = false;
        canvas.removeEventListener('mousemove', draw);
      }
    });
  </script>
</body>
</html>