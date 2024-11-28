function mostrarFondo(categoria) {
    var colorFondo;
    console.log('Categoria:', categoria); // Verificar el valor de la categoría

    if (categoria == 'Arte') {
        colorFondo = '#ff9800';
    } else if (categoria == 'Cine') {
        colorFondo = '#9c27b0';
    } else if (categoria == 'Deportes') {
        colorFondo = '#f44336';
    } else if (categoria == 'Historia') {
        colorFondo = '#ffeb3b';
    } else if (categoria == 'Ciencia') {
        colorFondo = '#4caf50';
    } else if (categoria == 'Geografía') {
        colorFondo = '#2196f3';
    }
    document.body.style.backgroundColor = colorFondo;
}

let countdownElement = document.getElementById('countdown');
let progressBar = document.getElementById('progressBar');
let totalTime = 15; // Tiempo total en segundos
let timeLeft = totalTime;
let modal = document.getElementById('timeOverModal');
let closeModal = document.getElementById('closeModal');

// Función para actualizar el contador y la barra de progreso
let countdownInterval = setInterval(() => {
    timeLeft--;
    countdownElement.textContent = timeLeft;

    // Calcular el ancho de la barra de progreso
    let progressPercentage = ((totalTime - timeLeft) / totalTime) * 100;
    progressBar.style.width = progressPercentage + '%';

    if (timeLeft <= 0) {
        clearInterval(countdownInterval); // Detener el temporizador

        // Reproducir el sonido
       // let alertSound = document.getElementById('alertSound');
      //  alertSound.play();

        modal.style.display = "flex";

        closeModal.onclick = function() {
            window.location.href = '/app/Partida/validarRespuesta';
            modal.style.display = "none"; // Cerrar el modal
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                window.location.href = '/app/Partida/validarRespuesta';
                modal.style.display = "none"; // Cerrar el modal
            }
        };
    }
}, 1000); // Actualizar cada segundo
/*
// temporalizador
let countdownElement = document.getElementById('countdown');
let progressBar = document.getElementById('progressBar');
let totalTime = 3; // Tiempo total en segundos
let timeLeft = totalTime;
let modal = document.getElementById('timeOverModal');
let closeModal = document.getElementById('closeModal');

// Función para actualizar el contador y la barra de progreso
let countdownInterval = setInterval(() => {
    timeLeft--;
    countdownElement.textContent = timeLeft;

    // Calcular el ancho de la barra de progreso
    let progressPercentage = ((totalTime - timeLeft) / totalTime) * 100;
    progressBar.style.width = progressPercentage + '%';

    if (timeLeft <= 0) {
        clearInterval(countdownInterval); // Detener el temporizador

        // Reproducir el sonido
        //let alertSound = document.getElementById('alertSound');
     //   alertSound.play();

        // Mostrar el modal
      //  modal.style.display = "flex";

        // Esperar a que se cierre el modal para redirigir
      //  closeModal.onclick = function() {
      //      modal.style.display = "none"; // Cerrar el modal
      //      window.location.href = 'home.html'; // Asegúrate de que esta ruta sea correcta
     //   };

        // También cerrar el modal al hacer clic fuera del contenido
     //   window.onclick = function(event) {
       //     if (event.target == modal) {
        //         modal.style.display = "none"; // Cerrar el modal
         //        window.location.href = 'home.html'; // Asegúrate de que esta ruta sea correcta
          //  }
      //  };
    }
}, 1000); // Actualizar cada segundo
/*
let enviarRespuesta=document.getElementById("enviarRespuesta")

   enviarRespuesta.addEventListener("click",()=>{
        let valorDelContador=countdownElement.textContent
       document.getElementById("tiempo").setAttribute("value", valorDelContador);




        alert(valorDelContador)

    })*/

function mostrarModalReportar() {
    document.getElementById("reportarPreguntaModal").style.display = "block";
}

// Función para cerrar el modal
document.getElementById("closeModal").onclick = function() {
    document.getElementById("reportarPreguntaModal").style.display = "none";
}

// Función para reportar la pregunta (puedes ajustarla según tu lógica)
function reportarPregunta() {
    let motivo = document.getElementById("motivoReporte").value;
    alert("Pregunta reportada con motivo: " + motivo);
    // Aquí podrías agregar la lógica para enviar el reporte al servidor
    document.getElementById("reportarPreguntaModal").style.display = "none"; // Cerrar el modal después de enviar el reporte
}
