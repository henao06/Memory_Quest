<?php
// Detectar imágenes en la carpeta "images"
$files = glob(__DIR__ . "/images/*.{jpg,JPG,png,PNG}", GLOB_BRACE);

// Filtrar imágenes válidas (excluyendo reverso.png y reverso.jpg)
$imagenes = [];
foreach ($files as $file) {
  $nombre = basename($file);
  if ($nombre === "reverso.png" || $nombre === "reverso.jpg") continue;
  $imagenes[] = pathinfo($nombre, PATHINFO_FILENAME);
}

// Crear pares y mezclarlos
$tablero = array_merge($imagenes, $imagenes);
shuffle($tablero);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Juego de Memoria</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body class="flex items-center justify-center min-h-screen flex-col">

  <h1 class="text-4xl font-bold mb-8">Juego de Memoria</h1>

  <!-- Tablero -->
  <div id="game-board" class="grid grid-cols-4 gap-4 hidden">
    <?php foreach ($tablero as $index => $img): ?>
      <div class="card" data-fruta="<?= $img ?>" data-index="<?= $index ?>">
        <div class="card-face card-back"></div>
        <div class="card-face card-front">
          <img src="images/<?= $img ?>.jpg" alt="imagen <?= $img ?>" class="w-full h-full object-cover">
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Vidas -->
  <div id="vidas" class="mt-8 text-2xl font-semibold">
    Vidas: <span id="vidas-count">5</span>
  </div>

  <!-- Mensaje de estado -->
  <div id="game-state" class="mt-8 text-center hidden">
    <div id="game-message" class="text-3xl font-bold mb-4"></div>
    <button id="restart-button" class="btn mt-8">Volver a intentarlo </button>
  </div>

  <!-- Botón de inicio -->
  <button id="start-button" class="btn mt-8">Iniciar Juego</button>

  <script src="game.js"></script>

</body>

</html>