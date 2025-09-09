<?php
// Detectar imágenes en la carpeta "images"
$files = glob(__DIR__ . "/images/*.{jpg,JPG,png,PNG}", GLOB_BRACE);

// Filtrar imágenes válidas
$imagenes = [];
foreach ($files as $file) {
  $nombre = basename($file);
  if ($nombre === "reverso.png" || $nombre === "reverso.jpg") continue;
  $imagenes[] = pathinfo($nombre, PATHINFO_FILENAME);
}

// Crear pares y mezclarlos
$tablero = array_merge($imagenes, $imagenes);
shuffle($tablero);

// Devolver tablero en HTML
foreach ($tablero as $index => $img): ?>
  <div class="card" data-fruta="<?= $img ?>" data-index="<?= $index ?>">
    <div class="card-face card-back"></div>
    <div class="card-face card-front">
      <img src="images/<?= $img ?>.jpg" alt="imagen <?= $img ?>" class="w-full h-full object-cover">
    </div>
  </div>
<?php endforeach; ?>