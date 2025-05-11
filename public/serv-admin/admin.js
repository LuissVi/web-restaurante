

document.addEventListener("DOMContentLoaded", () => {
    fetch("http://localhost/proyecto-web-reservas/app/cliente.php")
        .then(response => response.json())
        .then(datos => {

            const tabla = document.getElementById("tabla-datos");
            datos.forEach(usuario => {
                const campos = ["id", "nombre", "email", "fecha", "hora", "nroPersonas", "observacion", "aceptar", "negar"]
                let fila = document.createElement("div");
                fila.classList.add("fila");
                //creacion de celdas
                campos.forEach(campo => {
                    let celda = document.createElement("div");
                    celda.classList.add("celda");
                    if (campo === "id") {
                        celda.classList.add("hidden");
                    }
                    //creamos button para elementos vacios(no tiene datos en la DB)
                    if (campo === "aceptar") {
                        const check = document.createElement("button");
                        check.innerHTML = '<i class="bi bi-check-circle-fill d-flex align-items-center"></i>';
                        check.classList.add("btn", "btn-success", "btn-sm");

                        check.addEventListener("click", () => {
                            let accion = "aceptar";
                            enviarCorreo(usuario.email, usuario.nombre, accion = "aceptar");
                        })

                        celda.appendChild(check);

                    }
                    else if (campo === "negar") {
                        const cruz = document.createElement("button");
                        cruz.innerHTML = '<i class="bi bi-x-circle"></i>';
                        cruz.classList.add("btn", "btn-danger", "btn-sm");
                        celda.appendChild(cruz);

                        cruz.addEventListener("click", () => {
                            let accion = "negar";
                            enviarCorreo(usuario.email, usuario.nombre, accion = "negar");
                        })
                    }
                    else {
                        celda.textContent = usuario[campo];
                    }
                    fila.appendChild(celda);
                })
                tabla.appendChild(fila);
            })

            function enviarCorreo(email, nombre, accion) {
                // const params = new URLSearchParams();
                // params.append("email", email);
                // params.append("nombre", nombre);
                const form = new FormData();
                form.append("email", email);
                form.append("nombre", nombre);
                form.append("accion", accion);
                fetch("http://localhost/proyecto-web-reservas/app/enviarCorreo.php", {
                    method: "POST",
                    //  headers: {
                    //      "Content-Type": "application/x-www-form-urlencoded"
                    //    },
                    body: form
                }).then(response => response.json())
                    .then(datos => {
                        if (datos.message) {
                            console.log(datos.message);
                            alert("Correo enviado correctamente");
                        } else if (datos.error) {
                            console.error(datos.error);
                            alert("Error: " + datos.error);
                        }
                    })
                    .catch(error => {
                        console.error("Error en la petición:", error);
                    });
            }
        })
})

