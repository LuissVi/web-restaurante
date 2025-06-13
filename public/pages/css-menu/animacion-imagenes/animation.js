/* texto impar(izquierdo)(por probar) */
  document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          // Si solo quieres animar una vez:
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.25 // 25% visible para activar
    });

    document.querySelectorAll('.texto-impar').forEach(el => observer.observe(el));
  });


/*texot par(derecho) */
   document.addEventListener("DOMContentLoaded", () => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, {
      threshold: 0.25 // empieza la animación cuando el 25% del elemento sea visible
    });

    // Selecciona todos los elementos con la clase .texto-par
    document.querySelectorAll('.texto-par').forEach(el => observer.observe(el));
  });


