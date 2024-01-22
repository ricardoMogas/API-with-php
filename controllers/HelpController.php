<?php 
final class HelpController
{
    function index(){}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controlador de ejemplo</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background: linear-gradient(to bottom, #111, #2c3e50); /* Fondo entre negro y gris azulado */
      color: #ecf0f1; /* Color del texto */
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    .card {
      background-color: #34495e; /* Color de fondo de la card */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Sombreado */
      max-width: 500px;
      width: 100%;
    }

    .card h1 {
        text-align: center;
        color: #3498db; /* Color del título */
    }

    .card p {
        text-align: center;
        margin-bottom: 20px;
    }

    .card code {
        background-color: #444; /* Color de fondo del bloque de código */
        color: #ecf0f1; /* Color del texto del bloque de código */
        padding: 8px;
        border-radius: 5px;
        display: block;
        overflow-x: auto;
        white-space: pre-wrap;
        counter-reset: lineNumber; /* Inicializar el contador */
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Cuerpo de un controlador</h1>
    <p>
        Un controlador debe tener la nomenclatura PascalCase y 
        siempre terminar en <strong>Controller</strong>.
    </p>
    <code>
                    final class ExempleController{
                        function index(){}
                    }
    </code>
  </div>
</body>
</html>
