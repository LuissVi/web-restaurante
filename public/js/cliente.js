
let overlay = document.getElementById("popOverlay");
let popUp_reserva = document.getElementById("popUp_reserva");
const formulario = document.getElementById("form-data");
const h3 = document.getElementById("h3-reserva");
h3.textoActual = h3.innerHTML;
console.log(h3.textoActual);

/* campos del formulario(nombre;email*/
let nom = document.getElementById("nombre");
let email = document.getElementById("email");
document.getElementById("form-data").addEventListener("submit", (e) => {
  e.preventDefault();

  /* ---estilos popUp--- */
  overlay.classList.add("overlay");
  popUp_reserva.classList.add("mostrar_popUp");

  document.querySelector(".bg-overlay").classList.add("activado");
  setTimeout(() => {
    h3.innerHTML = "GRACIAS";
  }, 500);

  /* insercion de datos a DB*/
  const form_Data = new FormData(form);
  console.log(form_Data);

  fetch("app/cliente.php", {
    method: "POST",

    body: form_Data
  }).then(response => response.json())
    .then(datos => {

      // console.log(text);
      let h3_dinamico = document.createElement("h3");
      h3_dinamico.classList.add("msg-reserva");
      let p = document.createElement("p");
      p.classList.add("parrafo-reserva");
      if (datos.status === "success") {
        h3_dinamico.innerText = datos.message;
        p.innerText = "En breve recibirá un mensaje de confirmación.";

        popUp_reserva.appendChild(h3_dinamico);
        popUp_reserva.appendChild(p);
      } else if (datos.status === "error") {
        h3_dinamico.innerText = datos.message;
        popUp_reserva.appendChild(h3_dinamico);
      }
    })
    .catch(error => {
      console.error("Error:", error);

    });
});



/* ---funcion cerrar el popUp */
function ocultarPopUp() {
  let idsBlocks = document.querySelectorAll(".st-usuario");
  let idsHidden = document.querySelectorAll(".st-none");
  overlay.classList.remove("overlay")
  popUp_reserva.classList.remove("mostrar_popUp")
  popUp_reserva.classList.add("popUp_reserva");
  document.querySelector(".bg-overlay").classList.remove("activado");
  formulario.reset();
  idsBlocks.forEach((el) => {
    el.classList.remove("st-block");
    el.classList.add("hidden");
  })
  idsHidden.forEach((el) => {
    el.classList.remove("hidden");
    el.classList.add("st-block");
  })
  h3.innerHTML = h3.textoActual;
}

// EVENTO PARA ANIMACION DE EVENTO DE TEXTO E IMAGEN
document.addEventListener('DOMContentLoaded', () => {
  const texto = document.querySelector('.texto');
  const texto2 = document.querySelector('.texto2');
  const wrapper = document.querySelector('.div-carousel-wrapper');
  const carousel = document.querySelector('.carousel-item '); //selector que activa el carousel


  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        texto.classList.add('visible');
        setTimeout(() => {
          texto2.classList.add('visible');
        }, 250);
        // setTimeout(() => {
        //   wrapper.classList.add("visible");
        //   carousel.offsetHeight;offsetHeight; como truco para reiniciar animaciones
        // }, 300);
        requestAnimationFrame(() => {
          wrapper.classList.remove('visible');
          wrapper.offsetHeight; // Fuerza el repaint si fuera necesario
          wrapper.classList.add('visible');
          carousel.offsetHeight; // Fuerza el repaint si fuera necesario
        });
      }
    });
  });

  // usamos este contenedor estable para mostrar
  const trigger = document.querySelector('#seccion4');

  observer.observe(trigger);
});

/** animacion lenta los cambios de desplazamiento en la pagina */
document.querySelectorAll('a[href^="#"]').forEach(enlace => {
  enlace.addEventListener('click', function (e) {
    e.preventDefault();
    const destino = document.querySelector(this.getAttribute('href'));
    if (destino) {
      destino.scrollIntoView({
        behavior: 'smooth'
      });
    }
  });
});
