const chatbot = document.getElementById("ChatBot");
const botoncerrar = document.querySelector('.title button');
var boton = document.querySelector('.boton-fijo');
boton.addEventListener('click', function () {
    if (chatbot.style.display === "none") {
        chatbot.style.display = "block";
    } else {
        chatbot.style.display = "none";
    }
});
botoncerrar.addEventListener('click', function () {
    chatbot.style.display = "none";
});

function mostrar() {
    document.getElementById("sidebar").style.width = "300px";
    document.getElementById("contenido").style.marginLeft = "300px";
    document.getElementById("abrir").style.display = "none";
    document.getElementById("cerrar").style.display = "inline";
}

function ocultar() {
    document.getElementById("sidebar").style.width = "0";
    document.getElementById("contenido").style.marginLeft = "0";
    document.getElementById("abrir").style.display = "inline";
    document.getElementById("cerrar").style.display = "none";
}
const element = document.querySelector('.info');

const observer = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
        element.classList.add('animacion');
    }
});

observer.observe(element);

const element2 = document.querySelector('.container-calc-content');

const observer2 = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
        element2.classList.add('animacion');
    }
});

observer2.observe(element2);




