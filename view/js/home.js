// mostrar para crear la pregunta
function openPopup() {
    document.getElementById("popup").style.display = "block"; // Muestra el popup
}

// Función para cerrar el popup
function closePopup() {
    document.getElementById("popup").style.display = "none"; // Oculta el popup
}


// mostrar el ranking
function openRanking() {
    document.getElementById("rankingPopup").style.display = "block";
}

// Función para cerrar el popup de clasificación
function closeRanking() {
    document.getElementById("rankingPopup").style.display = "none";
}


// Cerrar el popup al hacer clic fuera de él
window.onclick = function(event) {
    if (event.target === document.getElementById("rankingPopup")) {
        closeRanking();
    }
    if (event.target === document.getElementById("popup")) {
        closePopup();
    }
}