<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parallax Scroll</title>
  <link rel="stylesheet" href="style.css">

  <styl>

</head>

<body>

  <!-- Sección de bienvenida con efecto Parallax -->
  <div class="section bg-1" id="section1">
    <div class="text-container" id="welcome-container">
      <h1 class="text-white text-5xl font-extrabold tracking-tight">
        ¡bienvenido a mi juego !
      </h1>
      <p class="mt-4 text-gray-200">
        desplázate hacia abajo para ver más sobre el juego.
      </p>
    </div>
  </div>

  <!-- Segunda sección con mensaje central -->
  <div class="section bg-2" id="section2">
    <div class="text-container hidden" id="message-container">
      <h2 class="text-white text-4xl font-extrabold tracking-tight">
        ¡este es un juego de adivinanza!
      </h2>
      <p class="mt-4 text-gray-200">
        Aqui podras divertirte y desestresarte con jugando
      </p>
    </div>
  </div>

  <!-- Tercera sección con el enlace -->
  <div class="section bg-3" id="section3">
    <div class="text-container hidden" id="link-container">
      <h2 class="text-white text-4xl font-extrabold tracking-tight">
        Continúa tu aventura
      </h2>
      <p class="mt-4 text-gray-200">
        Haz clic en el botón para ir al juego.
      </p>
      <br>
      <br>
      <a href="index.php" class="link-button">
        Ir a la página
      </a>
    </div>
  </div>

  <scrip>
    <script>
      // Obtener los contenedores de mensaje, enlace y bienvenida
      const welcomeContainer = document.getElementById('welcome-container');
      const messageContainer = document.getElementById('message-container');
      const linkContainer = document.getElementById('link-container');

      // Asegúrate de que el contenedor de bienvenida esté visible al cargar la página
      welcomeContainer.classList.add('visible');
      welcomeContainer.classList.remove('hidden');

      // Función para manejar el evento de scroll
      window.addEventListener('scroll', () => {
        // Calcular la posición de desplazamiento actual
        const scrollPosition = window.scrollY;

        // Obtener la altura de la ventana
        const windowHeight = window.innerHeight;

        // Obtener las secciones
        const section1 = document.getElementById('section1'); // Obtener la sección 1
        const section2 = document.getElementById('section2');
        const section3 = document.getElementById('section3');

        // Lógica para el contenedor de bienvenida (section1)
        // Se oculta cuando el usuario se desplaza más allá del 20% de la primera sección (ajusta este valor si quieres)
        const section1Threshold = section1.offsetTop + (windowHeight * 0.2); // El 20% de la altura de la sección 1

        if (scrollPosition > section1Threshold) {
          welcomeContainer.classList.remove('visible');
          welcomeContainer.classList.add('hidden');
        } else {
          welcomeContainer.classList.remove('hidden');
          welcomeContainer.classList.add('visible');
        }

        // Lógica para la Sección 2
        const section2Top = section2.offsetTop;
        const section2VisibleThreshold = section2Top - windowHeight / 2;

        if (scrollPosition > section2VisibleThreshold) {
          messageContainer.classList.remove('hidden');
          messageContainer.classList.add('visible');
        } else {
          messageContainer.classList.remove('visible');
          messageContainer.classList.add('hidden');
        }

        // Lógica para la Sección 3
        const section3Top = section3.offsetTop;
        const section3VisibleThreshold = section3Top - windowHeight / 2;

        if (scrollPosition > section3VisibleThreshold) {
          linkContainer.classList.remove('hidden');
          linkContainer.classList.add('visible');
        } else {
          linkContainer.classList.remove('visible');
          linkContainer.classList.add('hidden');
        }
      });
    </script>
</body>

</html>