/* clase de los elementos del formulario */
const idsBlocks = document.querySelectorAll(".st-usuario");
const idsHidden = document.querySelectorAll(".st-none");
const form = document.getElementById("form-data");
/** creamos dinamicamente los option del select(hora) */
document.addEventListener("DOMContentLoaded", () => {
    let hora = document.getElementById("hora");
    for (let i = 10; i <= 22; i++) {
        let option = document.createElement("option");
        option.value = `${i}:00`;
        option.textContent = `${i}:00`;
        hora.appendChild(option);
    }
})

/* pasasmos al siguiente campo del formulario al hacer click en el boton siguiente y validamos con una clase bootstrap*/
let btnNext = document.getElementById("btn-next");
let fecha = document.getElementById("fecha");
let hora = document.getElementById("hora");
let personas = document.getElementById("personas");
btnNext.addEventListener("click", () => {
    if (fecha.value.trim() != "" && hora.value.trim() != "" && personas.value.trim() != "") {
        idsBlocks.forEach((el) => {
            el.classList.remove("hidden");
            el.classList.add("st-block");
        });
        idsHidden.forEach((el) => {
            el.classList.remove("st-block");
            el.classList.add("hidden");
        });
    } else {
        [fecha, hora, personas].forEach((campo) => {
            if (campo.value.trim() === "") {
                campo.classList.add("is-invalid");
            } else {
                campo.classList.remove("is-invalid");
            }
        })
    } 
});

/* regresamos al campo anterior al hacer clic en el boton atras*/
let btnback = document.getElementById("btn-back");
btnback.addEventListener("click", () => {
    [fecha, hora,personas].forEach((campo)=>campo.classList.remove("is-invalid"));
    idsBlocks.forEach((el) => {
        el.classList.remove("st-block");
        el.classList.add("hidden");
    })
    idsHidden.forEach((el) => {
        el.classList.remove("hidden");
        el.classList.add("st-block");
    })
})

