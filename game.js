document.addEventListener('DOMContentLoaded', () => {
  const gameBoard = document.getElementById('game-board');
  const startButton = document.getElementById('start-button');
  const gameMessage = document.getElementById('game-message');
  const restartButton = document.getElementById('restart-button');
  const gameStateContainer = document.getElementById('game-state');
  const vidasElement = document.getElementById('vidas-count');

  let hasFlippedCard = false;
  let lockBoard = false;
  let firstCard, secondCard;
  let vidas = 5; // vidas 
  let paresEncontrados = 0;

  // Cargar tablero dinámico desde game.php
  function loadBoard() {
    fetch('game.php')
      .then(res => res.text())
      .then(html => {
        gameBoard.innerHTML = html;
        addCardListeners();
      });
  }

  function addCardListeners() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => card.addEventListener('click', flipCard));
  }

  function flipCard() {
    if (lockBoard) return;
    if (this === firstCard) return;

    this.classList.add('is-flipped');

    if (!hasFlippedCard) {
      hasFlippedCard = true;
      firstCard = this;
      return;
    }

    secondCard = this;
    checkForMatch();
  }

  function checkForMatch() {
    let isMatch = firstCard.dataset.fruta === secondCard.dataset.fruta;
    isMatch ? disableCards() : unflipCards();
  }

  function disableCards() {
    firstCard.removeEventListener('click', flipCard);
    secondCard.removeEventListener('click', flipCard);

    paresEncontrados++;
    if (paresEncontrados === document.querySelectorAll('.card').length / 2) {
      setTimeout(() => {
        resetGame('¡Felicidades, ganaste!');
      }, 1000);
    }
    resetBoard();
  }

  function unflipCards() {
    lockBoard = true;
    vidas--;
    vidasElement.textContent = vidas;

    if (vidas === 0) {
      setTimeout(() => {
        resetGame('¡Has perdido! Vuelve a intentarlo.');
      }, 1000);
      return;
    }

    setTimeout(() => {
      firstCard.classList.remove('is-flipped');
      secondCard.classList.remove('is-flipped');
      resetBoard();
    }, 1000);
  }

  function resetBoard() {
    [hasFlippedCard, lockBoard] = [false, false];
    [firstCard, secondCard] = [null, null];
  }

  function showAllCards() {
    const cards = document.querySelectorAll('.card');
    lockBoard = true; // Bloquear clics mientras se muestran las cartas
    cards.forEach(card => card.classList.add('is-flipped'));

    setTimeout(() => {
      cards.forEach(card => card.classList.remove('is-flipped'));
      resetBoard(); // 🔥 Limpia firstCard, secondCard y hasFlippedCard
      lockBoard = false; // Ahora sí desbloquea
    }, 3000); // tiempo en que se muestran las cartas 
  }


  function resetGame(message) {
    gameStateContainer.classList.remove('hidden');
    gameMessage.textContent = message;
    gameBoard.classList.add('hidden');
  }


  function startGame() {
    startButton.classList.add('hidden');
    gameBoard.classList.remove('hidden');
    vidas = 5;
    paresEncontrados = 0;
    vidasElement.textContent = vidas;
    resetBoard(); // 🔥 Resetear estado
    loadBoard();
    setTimeout(showAllCards, 500);
  }

  startButton.addEventListener('click', startGame);

  restartButton.addEventListener('click', () => {
    gameStateContainer.classList.add('hidden');
    gameMessage.textContent = '';
    startGame();
  });
});