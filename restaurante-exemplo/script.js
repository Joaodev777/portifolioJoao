/* Open the sidenav */
function openNav() {
  document.getElementById("mySidenav").style.width = "100%";
}

/* Close/hide the sidenav */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
// obtém a hora atual
var horaAtual = new Date().getHours();
let result = document.getElementById("result");
// verifica se está aberto
if (horaAtual >= 8 && horaAtual < 18) {
  result.innerHTML = " RESTAURANTE ABERTO! ";
} else {
  result.innerHTML = " ABERTO EM BREVE";
}

//CONTATO
/* Abre a janela modal */
function openWindow() {
  var modal = document.getElementById("myModal");
  modal.style.display = "block";
}

/* Fecha a janela modal */
var closeBtn = document.getElementsByClassName("close")[0];
closeBtn.onclick = function () {
  var modal = document.getElementById("myModal");
  modal.style.display = "none";
};

/* Fecha a janela modal se o usuário clicar fora do conteúdo */
window.onclick = function (event) {
  var modal = document.getElementById("myModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};

// sistema de tira e volta dos cards
window.addEventListener("resize", function () {
  var display = document.querySelector("display");
  var width = area.offsetWidth;
  if (width <= 710) {
    display.classList.add("text-center  justify-content-center");
  } else {
    display.classList.remove("text-center  justify-content-center");
  }
});

const animationCards = document.querySelector("btn-double");

function cardsPlay() {
  console.log("OAL");
}
// cardapio
const preco = document.getElementById("preco-script");
const btn = document.getElementById("click");
btn.addEventListener("click", () => {
  preco.innerHTML = "27.30 "
});
